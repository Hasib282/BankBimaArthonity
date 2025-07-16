// function ShowReceiveFromClients(data, startIndex) {
//     let tableRows = '';
//     let totalBillAmount = 0;
    
//     if(data.length > 0){
//         $.each(data, function(key, item) {
//             tableRows += `
//                 <tr>
//                     <td>${startIndex + key + 1}</td>
//                     <td>${item.tran_id}</td>
//                     <td>${item.user.user_name}</td>
//                     <td style="text-align: right">${item.bill_amount.toLocaleString('en-US', { minimumFractionDigits: 0 })} Tk.</td>
//                     <td>
//                         <div style="display: flex;gap:5px;">
//                             <button class="open-modal" data-modal-id="editModal" id="edit"
//                                     data-id="${item.tran_id}"><i class="fas fa-edit"></i></button>
                            
//                             <button data-id="${item.tran_id}" id="delete"><i class="fas fa-trash"></i></button>
                            
//                         </div>
//                     </td>
//                 </tr>
//             `;

//             totalBillAmount += parseFloat(item.bill_amount) || 0;
//         });

//         // Inject the generated rows into the table body
//         $('.load-data .show-table tbody').html(tableRows);


//         $('.load-data .show-table tfoot').html(`
//             <tr>
//                 <td style="text-align: right" colspan="3">Total:</td>
//                 <td style="text-align: right">${totalBillAmount.toLocaleString('en-US', { minimumFractionDigits: 0 })} Tk.</td>
//                 <td></td>
//             </tr>
//         `);
//     }
//     else{
//         $('.load-data .show-table tbody').html('');
//         $('.load-data .show-table tfoot').html('<tr><td colspan="11" style="text-align:center;">No Transaction Found</td></tr>')
//     }
// }; // End Function

function ShowReceiveFromClients(res) {
    tableInstance = new GenerateTable({
        tableId: '#data-table',
        data: res.data,
        tbody: ['tran_id','user.user_name',{key:'bill_amount', type: 'number',footerType:'sum'}],
       actions: (row) => {
            let buttons = '';

        
            if (userPermissions.includes(43) || role == 1) {
                buttons += `
                    <button data-modal-id="editModal" id="edit" data-id="${row.id}"><i class="fas fa-edit"></i></button>
                `;
            }
            

            if (userPermissions.includes(44) || role == 1) {
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
        { label: 'Transaction Id', key: 'tran_id' },
        { label: 'User Name', key: 'user.user_name' },
        { label: 'Amount' },
        { label: 'Action', type: 'button' }
    ]);



    // Load Data on Hard Reload
    ReloadData('transaction/party/receive', ShowReceiveFromClients);
    

    // Add Modal Open Functionality
    AddModalFunctionality("#date", function(){
        GetTransactionWith(2, 'Receive', '#within');
        $('.due-grid tbody').html('');
        $('.due-grid tfoot').html('');
    });


    // Insert Ajax
    InsertAjax('transaction/party/receive', 
        {
            user: { selector: '#user', attribute: 'data-id' },
            withs: { selector: '#user', attribute: 'data-with' },
            'groupe': 2,
            'head': 1,
            'type': 2,
            'method': 'Receive',
        }, 
        function() {
            $('#user').removeAttr('data-id');
            $('#user').removeAttr('data-with');
            $('.due-grid tbody').html('');
            $('.due-grid tfoot').html('');
        }
    );


    //Edit Ajax
    EditAjax(EditFormInputValue);


    // Update Ajax
    // UpdateAjax('transaction/party/receive', ShowReceiveFromClients);
    

    // Delete Ajax
    // DeleteAjax('transaction/party/receive', ShowReceiveFromClients);


    // Search By Date
    SearchByDateAjax('transaction/party/receive/search', ShowReceiveFromClients);


    // Additional Edit Functionality
    function EditFormInputValue(item){
        GetTransactionWith(2, 'Receive', '#within');
        $('.due-grid tbody').html('');
        $('.due-grid tfoot').html('');

        $('#updateTranId').val(item.tran_id);

        getDueListByUserId(item.tran_user, '.due-grid tbody');
        $('#updateUser').attr('data-id',item.tran_user);
        $('#updateUser').val(item.user.user_name);
        $('#updateAmount').val(item.receive);
        $('#updateDiscount').val(item.discount);
    }
});