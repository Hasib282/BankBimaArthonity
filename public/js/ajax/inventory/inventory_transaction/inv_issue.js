// function ShowInventoryIssues(data, startIndex) {
//     let tableRows = '';
//     let totalBillAmount = 0;
//     let totalDiscount = 0;
//     let totalNetAmount = 0;
//     let totalAdvance = 0;
//     let totalDueCol = 0;
//     let totalDueDiscount = 0;
//     let totalDue = 0;
    
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
//                     <td style="text-align: right">${item.receive.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                     <td style="text-align: right">${item.due_col.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                     <td style="text-align: right">${item.due_disc.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                     <td style="text-align: right">${item.due.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                     <td>
//                         <div style="display: flex;gap:5px;">
                        
//                             <a class="print-receipt" href="/api/get/invoice?id=${item.tran_id}&status=1"> <i class="fa-solid fa-receipt"></i></a>
                        
//                             <button class="open-modal" data-modal-id="editModal" id="edit"
//                                 data-id="${item.tran_id}"><i class="fas fa-edit"></i></button>
                        
//                             <button data-id="${item.tran_id}" id="delete"><i class="fas fa-trash"></i></button>
                            
//                         </div>
//                     </td>
//                 </tr>
//             `;
//             totalBillAmount += item.bill_amount;
//             totalDiscount += item.discount;
//             totalNetAmount += item.net_amount;
//             totalAdvance += item.receive;
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
//             </tr>`
//         );
//     }
//     else{
//         $('.load-data .show-table tbody').html('');
//         $('.load-data .show-table tfoot').html('<tr><td colspan="11" style="text-align:center;">No Data Found</td></tr>')
//     }
// }; // End Function


function ShowInventoryIssues(res) {
    tableInstance = new GenerateTable({
        tableId: '#data-table',
        data: res.data,
        tbody: ['tran_id','user.user_name',{key:'bill_amount', type: 'number',footerType:'sum'},{key:'discount', type: 'number',footerType:'sum'},{key:'net_amount', type: 'number',footerType:'sum'},{key:'receive', type: 'number',footerType:'sum'},{key:'due_col', type: 'number',footerType:'sum'},{key:'due_disc', type: 'number',footerType:'sum'},{key:'due', type: 'number',footerType:'sum'}],
       
        actions: (row) => {
            let buttons = '';

            buttons += `
                    <a class="print-receipt" href="/api/get/invoice?id=${row.tran_id}&status=1"> <i class="fa-solid fa-receipt"></i></a>
                `;
        
            if (userPermissions.includes(237) || role == 1) {
                buttons += `
                    <button data-modal-id="editModal" id="edit" data-id="${row.id}"><i class="fas fa-edit"></i></button>
                `;
            }

            if (userPermissions.includes(238) || role == 1) {
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
    GetTransactionGroupe(5, "Receive");


    // Load Data on Hard Reload
    ReloadData('inventory/transaction/issue', ShowInventoryIssues);
    

    // Add Modal Open Functionality
    AddModalFunctionality("#product", function(){
        GetTransactionWith(2, 'Receive', '#within');
        $('#store').val(1)
        $('#user').val('General Customer')
        $('#user').attr('data-id', 'CL000000001')
        $('#user').attr('data-with', 4);
        localStorage.removeItem('transactionData');
        $('.transaction_grid tbody').html('');
    });


    // Insert Into Local Storage
    InsertLocalStorage(true);


    // Insert Inventory Issue ajax
    InsertTransaction('inventory/transaction/issue', 'Issue', '5', function() {
        $('#store').val("Store 1")
        $('#store').attr("data-id", '1');
        $('#user').val('General Customer')
        $('#user').attr('data-id', 'CL000000001')
        $('#user').attr('data-with', 4);
        $('.transaction_grid tbody').html('');
        $('#product').focus();
    });


    //Edit Ajax
    EditAjax(EditFormInputValue);


    // Update Inventory Issue ajax
    UpdateTransaction('inventory/transaction/issue', 'Issue', "5");
    

    // Delete Ajax
    DeleteAjax('inventory/transaction/issue');


    // Delete status  Ajax
    DeleteStatusAjax('inventory/transaction/issue');


    // Search By Ajax
    SearchByDateAjax('inventory/transaction/issue/search', ShowInventoryIssues, { type: 5, method: 'Issue' });


    // Additional Edit Functionality
    function EditFormInputValue(res){
        $('#updateProduct').val('');
        $('#updateProduct').removeAttr('data-id');
        $('#updateProduct').removeAttr('data-groupe');
        $('#updateQuantity').val('1');
        $('#updateMrp').val('');
        $('#updateTotAmount').val('');
        $('#dId').val('');
        GetTransactionWith(2, 'Receive', '#updatewithin');
        localStorage.removeItem('transactionData');
        $('.transaction_grid tbody').html('');
        
        getTransactionGrid(res.data.tran_id);
        $('#id').val(res.data.id);
        
        $('#updateTranId').val(res.data.tran_id);
        var timestamps = new Date(res.data.tran_date);
        var formattedDate = timestamps.toLocaleDateString('en-US', { timeZone: 'UTC' });
        $('#updateDate').val(formattedDate);
        $('#updateStore').val(res.data.store_id);
        $('#updateUser').attr('data-id',res.data.tran_user);
        $('#updateUser').attr('data-with',res.data.tran_type_with);
        $('#updateUser').val(res.data.user.user_name);
        $('#updateTotalDiscount').val(res.data.discount);
        $('#updateAdvance').val(res.data.receive);
        $('#updateName').val(res.data.user_name);
        $('#updatePhone').val(res.data.user_phone);
        $('#updateAddress').val(res.data.user_address);
        $("#updateProduct").focus();
    }

    

    // Get Store 
    GetSelectInputList('admin/stores/get', function (res) {
        CreateSelectOptions('#store', 'Select Store', res.data, 'store_name');
        CreateSelectOptions('#updateStore', 'Select Store', res.data, 'store_name');
    })
});