// ///////////////////////////////////////////////  Updated Format Start From Here /////////////////////////////////  
// function ShowTransactionReceives(data, startIndex) {
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
//                                     data-id="${item.tran_id}"><i class="fas fa-edit"></i></button>
                                    
//                             <button data-id="${item.tran_id}" id="delete"><i class="fas fa-trash"></i></button>
                            
//                         </div>
//                     </td>
//                 </tr>
//             `;

//             totalBillAmount += parseFloat(item.bill_amount) || 0;
//             totalDiscount += parseFloat(item.discount) || 0;
//             totalNetAmount += parseFloat(item.net_amount) || 0;
//             totalAdvance += parseFloat(item.receive) || 0;
//             totalDueCol += parseFloat(item.due_col) || 0;
//             totalDueDiscount += parseFloat(item.due_disc) || 0;
//             totalDue += parseFloat(item.due) || 0;
//         });

//         // Inject the generated rows into the table body
//         $('.load-data .show-table tbody').html(tableRows);

    
//         $('.load-data .show-table tfoot').html(`
//                 <tr>
//                     <td colspan="3">Total:</td>
//                     <td style="text-align: right">${totalBillAmount.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                     <td style="text-align: right">${totalDiscount.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                     <td style="text-align: right">${totalNetAmount.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                     <td style="text-align: right">${totalAdvance.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                     <td style="text-align: right">${totalDueCol.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                     <td style="text-align: right">${totalDueDiscount.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                     <td style="text-align: right">${totalDue.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
//                     <td></td>
//                 </tr>
//         `);
//     }
//     else{
//         $('.load-data .show-table tbody').html('');
//         $('.load-data .show-table tfoot').html('<tr><td colspan="11" style="text-align:center;">No Transaction Found</td></tr>')
//     }
// }; // End Function

function ShowTransactionReceives(res) {
    tableInstance = new GenerateTable({
        tableId: '#data-table',
        data: res.data,
        tbody: ['tran_id','user.user_name',{key:'bill_amount', type: 'number',footerType:'sum'},{key:'discount', type: 'number',footerType:'sum'},{key:'net_amount', type: 'number',footerType:'sum'},{key:'receive', type: 'number',footerType:'sum'},{key:'due_col', type: 'number',footerType:'sum'},{key:'due_disc', type: 'number',footerType:'sum'},{key:'due', type: 'number',footerType:'sum'}],
        

        actions: (row) => {
            let buttons = '';

            buttons += `
                    <a class="print-receipt" href="/api/get/invoice?id=${row.tran_id}&status=1"> <i class="fa-solid fa-receipt"></i></a>
                `;
        
            if (userPermissions.includes(35) || role == 1) {
                buttons += `
                    <button data-modal-id="editModal" id="edit" data-id="${row.id}"><i class="fas fa-edit"></i></button>
                `;
            }

            if (userPermissions.includes(36) || role == 1) {
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
    GetTransactionGroupe(1, "Receive");


    // Load Data on Hard Reload
    ReloadData('transaction/receive', ShowTransactionReceives);
    

    // Add Modal Open Functionality
    AddModalFunctionality("#date", function(){
        GetTransactionWith('2', 'Receive', '#within');
        localStorage.removeItem('transactionData');
        $('.transaction_grid tbody').html('');
    });


    // Insert Into Local Storage
    InsertLocalStorage();


    // Insert Transaction Receive ajax
    InsertTransaction('transaction/receive', 'Receive', '1', function() {
        $('#location').removeAttr('data-id');
        $('#user').removeAttr('data-id');
        $('#user').removeAttr('data-with');
        $('#date').focus();
        $('.transaction_grid tbody').html('');
    });


    //Edit Ajax
    EditAjax(EditFormInputValue);


    // Update Transaction Receive ajax
    UpdateTransaction('transaction/receive', 'Receive', '1');
    

    // Delete Ajax
    DeleteAjax('transaction/receive');
    

    // Delete status Ajax
    DeleteStatusAjax('transaction/receive');


    // Search By Date
    SearchByDateAjax('transaction/receive/search', ShowTransactionReceives, {type: 1, method: 'Receive', status:1});


    // Additional Edit Functionality
    function EditFormInputValue(item){
        $('#updateHead').val('');
        $('#updateHead').removeAttr('data-id');
        $('#updateHead').removeAttr('data-groupe');
        $('#updateQuantity').val('1');
        $('#updateAmount').val('');
        $('#updateTotAmount').val('');
        $('#dId').val('');
        GetTransactionWith('2', 'Receive', '#within');
        localStorage.removeItem('transactionData');
        $('.transaction_grid tbody').html('');

        getTransactionGrid(item.tran_id);

        $('#id').val(item.id);
        
        $('#updateTranId').val(item.tran_id);

        var timestamps = new Date(item.tran_date);
        var formattedDate = timestamps.toLocaleDateString('en-US', { timeZone: 'UTC' });
        $('#updateDate').val(formattedDate);
        
        $('#updateUser').attr('data-id',item.tran_user);
        $('#updateUser').attr('data-with',item.tran_type_with);
        $('#updateUser').val(item.user.user_name);


        $('#updateTotalDiscount').val(item.discount);

        $('#updateAdvance').val(item.receive);

        
        $("#updateHead").focus();
    }
});