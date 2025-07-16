// function ShowInventoryPurchases(data, startIndex) {
//     let tableRows = '';
//     let totalBillAmount = 0;
//     let totalDiscount = 0;
//     let totalNetAmount = 0;
//     let totalAdvance = 0;
//     let totalDueCol = 0;
//     let totalDueDiscount = 0;
//     let totalDue = 0;
//     let params = GetQueryParams();
    
//     if(data.length > 0){
//         $.each(data, function(key, item) {
//             tableRows += `
//                 <tr>
//                     <td>${startIndex + key + 1}</td>
//                     <td>${item.tran_id}</td>
//                     <td>${item.user.user_name}</td>
//                     <td style="text-align: right">${item.bill_amount.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                     <td style="text-align: right">${item.discount.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                     <td style="text-align: right">${item.net_amount.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                     <td style="text-align: right">${item.payment.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                     <td style="text-align: right">${item.due_col.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                     <td style="text-align: right">${item.due_disc.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                     <td style="text-align: right">${item.due.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                     <td>
//                         <div style="display: flex;gap:5px;">
//                             ${params['status'] == 2 ? 
//                                 `<button class="open-modal" data-modal-id="verifyModal" id="verify"
//                                         data-id="${item.tran_id}"><i class="fa-solid fa-check"></i> Verify</button>`
//                                 :
//                                 ""
//                             }
//                             <a class="print-receipt" href="/api/get/invoice?id=${item.tran_id}&status=${params['status'] ? params['status'] : 1}"> <i class="fa-solid fa-receipt"></i></a>
                            
//                             <button class="open-modal" data-modal-id="editModal" id="edit"
//                                     data-id="${item.tran_id}"><i class="fas fa-edit"></i></button>
                            
//                             <button data-id="${item.tran_id}" id="delete"><i class="fas fa-trash"></i></button>
                            
//                         </div>
//                     </td>
//                 </tr>
//             `;

//             totalBillAmount += item.bill_amount;
//             totalDiscount += item.discount;
//             totalNetAmount += item.net_amount;
//             totalAdvance += item.payment;
//             totalDueCol += item.due_col;
//             totalDueDiscount += item.due_disc;
//             totalDue += item.due;
//         });

//         // Inject the generated rows into the table body
//         $('.load-data .show-table tbody').html(tableRows);
//         $('.load-data .show-table tfoot').html(`
//             <tr>
//                 <td colspan="3">Total:</td>
//                 <td style="text-align: right">${totalBillAmount.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                 <td style="text-align: right">${totalDiscount.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                 <td style="text-align: right">${totalNetAmount.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                 <td style="text-align: right">${totalAdvance.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                 <td style="text-align: right">${totalDueCol.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                 <td style="text-align: right">${totalDueDiscount.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                 <td style="text-align: right">${totalDue.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                 <td></td>
//             </tr>
//         `)
//     }
//     else{
//         $('.load-data .show-table tbody').html('');
//         $('.load-data .show-table tfoot').html('<tr><td colspan="11" style="text-align:center;">No Data Found</td></tr>')
//     }
// }; // End Function


function ShowInventoryPurchases(res) {
    tableInstance = new GenerateTable({
        tableId: '#data-table',
        data: res.data,
        tbody: ['tran_id','user.user_name',{key:'bill_amount', type: 'number',footerType:'sum'},{key:'discount', type: 'number',footerType:'sum'},{key:'net_amount', type: 'number',footerType:'sum'},{key:'payment', type: 'number',footerType:'sum'},{key:'due_col', type: 'number',footerType:'sum'},{key:'due_disc', type: 'number',footerType:'sum'},{key:'due', type: 'number',footerType:'sum'}],
        actions: (row) => {
            let buttons = '';
            
            if ($('#status').val() == 2 && userPermissions.includes(234)) {
                buttons += `<button class="open-modal" data-modal-id="verifyModal" id="verify" data-id="${row.tran_id}"><i class="fa-solid fa-check"></i> Verify</button>`
            }

            buttons += `
                    <a class="print-receipt" href="/api/get/invoice?id=${row.tran_id}&status=1"> <i class="fa-solid fa-receipt"></i></a>
                `;
        
            if (userPermissions.includes(232) || role == 1) {
                buttons += `
                    <button data-modal-id="editModal" id="edit" data-id="${row.id}"><i class="fas fa-edit"></i></button>
                `;
            }

            if (userPermissions.includes(233) || role == 1) {
                buttons += `
                <button data-id="${row.id}" id="delete_status" class="icon-wrapper" title="Toggle Delete"><i class="fa-solid fa-trash-arrow-up main-icon"></i><i class="fa-solid fa-arrows-rotate ring-icon"></i></button>
                `;
                
                if (role == 1 || role == 2) {
                    buttons += `
                        <button data-id="${row.id}" id="delete"><i class="fas fa-trash"></i></button>
                    `;
                }
            }
        
            return buttons;
        }
    });
}



$(document).ready(function () {
    // Render The Table Heads
    renderTableHead([
        { label: 'SL:', type: 'rowsPerPage', options: [15, 30, 50, 100, 500] },
        { label: 'Id', key: 'tran_id' },
        { label: 'User', key: 'user.user_name' },
        { label: 'Total' },
        { label: 'Discount' },
        { label: 'Net Total' },
        { label: 'Advance' },
        { label: 'Due Col' },
        { label: 'Due Discount' },
        { label: 'Due' },
        { label: 'Action', type: 'button' }
    ]);

    // Load Transaction Groupe
    GetTransactionGroupe(5, "Payment");


    // Load Data on Hard Reload
    ReloadData('inventory/transaction/purchase', ShowInventoryPurchases);
    

    // Add Modal Open Functionality
    AddModalFunctionality("#product", function(){
        GetTransactionWith(2, 'Payment', '#within');
        localStorage.removeItem('transactionData');
        $('.transaction_grid tbody').html('');
    });


    // Insert Into Local Storage
    InsertLocalStorage();


    // Insert Inventory Purchase ajax
    InsertTransaction('inventory/transaction/purchase', 'Purchase', '5', function() {
        $('#location').removeAttr('data-id');
        $('#user').removeAttr('data-id');
        $('#user').removeAttr('data-with');
        $('#status').val('1');
        $('.transaction_grid tbody').html('');
    });


    //Edit Ajax
    EditAjax(EditFormInputValue);


    // Update Inventory Purchase ajax
    UpdateTransaction('inventory/transaction/purchase', 'Purchase', "5");
    

    // Delete Ajax
    DeleteAjax('inventory/transaction/purchase');
    

    // Delete status Ajax
    DeleteStatusAjax('inventory/transaction/purchase');


    // Search By Date
    SearchByDateAjax('inventory/transaction/purchase/search', ShowInventoryPurchases, { type: 5, method: 'Purchase' });


    // Search By Methods, Roles, Types
    SearchBySelect('inventory/transaction/purchase/search', ShowInventoryPurchases, '#status', { type: 5, method: 'Purchase' } );


    // Additional Edit Functionality
    function EditFormInputValue(item){
        $('#updateProduct').val('');
        $('#updateProduct').removeAttr('data-id');
        $('#updateProduct').removeAttr('data-groupe');
        $('#updateUnit').val('');
        $('#updateUnit').removeAttr('data-id');
        $('#updateQuantity').val('1');
        $('#updateCp').val('');
        $('#updateMrp').val('');
        let currentDate = new Date().toISOString().split('T')[0];
        $('#updateExpiry').val(currentDate);
        $('#updateTotAmount').val('');
        $('#dId').val('');
        GetTransactionWith(2, 'Payment', '#updatewithin');
        localStorage.removeItem('transactionData');
        $('.transaction_grid tbody').html('');


        getTransactionGrid(item.tran_id);

        $('#id').val(item.id);
        
        $('#updateTranId').val(item.tran_id);

        var timestamps = new Date(item.tran_date);
        var formattedDate = timestamps.toLocaleDateString('en-US', { timeZone: 'UTC' });
        $('#updateDate').val(formattedDate);

        $('#updateStore').val(item.store_id);
        
        $('#updateUser').attr('data-id',item.tran_user);
        $('#updateUser').attr('data-with',item.tran_type_with);
        $('#updateUser').val(item.user.user_name);

        $('#updateTotalDiscount').val(item.discount);

        $('#updateAdvance').val(item.payment);
        
        $("#updateProduct").focus();
    }

    
    


    /////////////// ------------------ Verify Inventory Purchase Ajax Part Start ---------------- /////////////////////////////
    // Verify Button Functionality
    $(document).off('click', '#verify').on('click', '#verify', function (e) {
        e.preventDefault();
        $('#verifyModal').show();
        let id = $(this).attr('data-id');
        $('#yes').attr('data-id',"");
        $('#yes').attr('data-id',id);
        $('#no').focus();
    });

    // Cancel Button Functionality
    $(document).off('click', '#no').on('click', '#no', function (e) {
        e.preventDefault();
        $('#verifyModal').hide();
    });

    // Confirm Button Functionality
    $(document).off('click', '#yes').on('click', '#yes', function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajax({
            url: `${apiUrl}/inventory/transaction/purchase/verify`,
            method: 'DELETE',
            data: { id },
            success: function (res) {
                if (res.status) {
                    ReloadData('inventory/transaction/purchase', ShowInventoryPurchases);
                    $('#verifyModal').hide();
                    toastr.success('Transaction Main Data Deleted Successfully', 'Deleted!');
                }
            }
        });
    });
    
    /////////////// ------------------ Verify Inventory Purchase Ajax Part End ---------------- /////////////////////////////



    // Get Store 
    GetSelectInputList('admin/stores/get', function (res) {
        CreateSelectOptions('#store', 'Select Store', res.data, 'store_name');
        CreateSelectOptions('#updateStore', 'Select Store', res.data, 'store_name');
    })
});