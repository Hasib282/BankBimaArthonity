// function ShowInventoryClientReturns(data, startIndex) {
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
//                     <td style="text-align: right">
//                         ${item.tran_method == 'Receive' ? item.receive.toLocaleString('en-US', { minimumFractionDigits: 0 }): item.payment.toLocaleString('en-US', { minimumFractionDigits: 0 })} 
//                     </td>
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
//             item.tran_method == 'Receive' ? totalAdvance += item.receive : totalAdvance += item.payment;
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
//             `
//         );
//     }
//     else{
//         $('.load-data .show-table tbody').html('');
//         $('.load-data .show-table tfoot').html('<tr><td colspan="11" style="text-align:center;">No Data Found</td></tr>')
//     }
// }; // End Function

function ShowInventoryClientReturns(res) {
    tableInstance = new GenerateTable({
        tableId: '#data-table',
        data: res.data,
        tbody: ['tran_id','user.user_name',{key:'bill_amount', type: 'number',footerType:'sum'},{key:'discount', type: 'number',footerType:'sum'},{key:'net_amount', type: 'number',footerType:'sum'},{key:'receive', type: 'number',footerType:'sum'},{key:'due_col', type: 'number',footerType:'sum'},{key:'due_disc', type: 'number',footerType:'sum'},{key:'due', type: 'number',footerType:'sum'}],
       
        actions: (row) => {
            let buttons = '';

            buttons += `
                    <a class="print-receipt" href="/api/get/invoice?id=${row.tran_id}&status=1"> <i class="fa-solid fa-receipt"></i></a>
                `;
        
            if (userPermissions.includes(241) || role == 1) {
                buttons += `
                    <button data-modal-id="editModal" id="edit" data-id="${row.id}"><i class="fas fa-edit"></i></button>
                `;
            }

            if (userPermissions.includes(242) || role == 1) {
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


    // Load Data on Hard Reload
    ReloadData('inventory/transaction/return/client', ShowInventoryClientReturns);
    

    // Add Modal Open Functionality
    AddModalFunctionality("#store", function () {
        $('#AddForm')[0].reset();
        $('#type').val(5);
        $('#method').val('Issue');
        $('#batch').removeAttr('data-id');
        $('#store').removeAttr('data-id');
        $('#user').removeAttr('data-id');
        $('#user').removeAttr('data-with');
        $('#product').removeAttr('data-id');
        $('#product').removeAttr('data-groupe');
        GetTransactionWith(2, 'Receive', '#within');
        localStorage.removeItem('transactionData');
        $('.transaction_grid tbody').html('');
        $('#batch-details-list tbody').html('');
    });


    // Insert Into Local Storage
    InsertLocalStorage(false, true);


    // Insert Inventory Purchase ajax
    InsertTransaction('inventory/transaction/return/client', 'Client Return', '5', function() {
        $('#batch').removeAttr('data-id');
        $('#user').removeAttr('data-id');
        $('#user').removeAttr('data-with');
        $('#product').removeAttr('data-batch');
        $('#product').removeAttr('data-quantity');
        $('#product').removeAttr('data-groupe');
        $('.transaction_grid tbody').html('');
        $("#store").focus();
    });


    //Edit Ajax
    EditAjax(EditFormInputValue);


    // Update Ajax
    // UpdateAjax('inventory/transaction/return/client', ShowInventoryClientReturns);
    

    // Delete Ajax
    DeleteAjax('inventory/transaction/return/client');
    

    // Delete status Ajax
    DeleteStatusAjax('inventory/transaction/return/client');
    
    
    // Search By Date Ajax
    SearchByDateAjax('inventory/transaction/return/client/search', ShowInventoryClientReturns, { type: 5, method: 'Client Return' });


    // Additional Edit Functionality
    function EditFormInputValue(res){
        $('#id').val(res.location.id);
        // Create options dynamically
        $('#updateDivision').empty();
        $('#updateDivision').append(`<option value="Dhaka" ${res.location.division === 'Dhaka' ? 'selected' : ''}>Dhaka</option>
                                    <option value="Chittagong" ${res.location.division === 'Chittagong' ? 'selected' : ''}>Chittagong</option>
                                    <option value="Rajshahi" ${res.location.division === 'Rajshahi' ? 'selected' : ''}>Rajshahi</option>
                                    <option value="Khulna" ${res.location.division === 'Khulna' ? 'selected' : ''}>Khulna</option>
                                    <option value="Sylhet" ${res.location.division === 'Sylhet' ? 'selected' : ''}>Sylhet</option>
                                    <option value="Barishal" ${res.location.division === 'Barishal' ? 'selected' : ''}>Barishal</option>
                                    <option value="Rangpur" ${res.location.division === 'Rangpur' ? 'selected' : ''}>Rangpur</option>
                                    <option value="Mymensingh" ${res.location.division === 'Mymensingh' ? 'selected' : ''}>Mymensingh</option>`);
        $('#updateDistrict').val(res.location.district);
        $('#updateUpazila').val(res.location.upazila);
        $('#updateDivision').focus();
    }



    // Get Store 
    GetSelectInputList('admin/stores/get', function (res) {
        CreateSelectOptions('#store', 'Select Store', res.data, 'store_name');
        CreateSelectOptions('#updateStore', 'Select Store', res.data, 'store_name');
    })




    // // Remove Product from Local Storage
    // $(document).off("click", '.remove').on("click", '.remove', function (e){
    //     let index = $(this).attr('data-index');
    //     let productGrids = JSON.parse(localStorage.getItem('transactionData')) || [];

    //     productGrids.splice(index, 1);
    //     localStorage.setItem('transactionData', JSON.stringify(productGrids));
    //     DisplayTransactionGrid();
    // })



    // // Function to Display ProductGrids in The Transaction Grid Table
    // function DisplayTransactionGrid() {
    //     let productIssues = JSON.parse(localStorage.getItem('transactionData')) || [];
    //     $('.transaction_grid tbody').html("");

    //     let total = 0;
    //     productIssues.forEach((products, index) => {
    //         $('.transaction_grid tbody').append(`
    //             <tr>
    //                 <td>${index + 1}</td>
    //                 <td>${products.name}</td>
    //                 <td>${products.quantity}</td>
    //                 <td>${products.mrp}</td>
    //                 <td>${products.totAmount}</td>
    //                 <td>${products.batch}</td>
    //                 <td><div class="center"><button class="remove" data-index="${index}"><i class="fas fa-trash"></i></button></div></td>
    //             </tr>`
    //         );

    //         total = total + Number(products.totAmount);
    //     });
        

    //     // Calculate Add Modal Bill
    //     $("#amountRP").val(total);
    //     let discount = Number($("#totalDiscount").val());
    //     let netAmount = total - discount;
    //     $("#netAmount").val(netAmount);
    //     let advance = Number($("#advance").val());
    //     let balance = netAmount - advance;
    //     $("#balance").val(balance);

    //     // Calculate Edit Modal Bill
    //     $("#updateAmountRP").val(total);
    //     let updateDiscount = Number($("#updateTotalDiscount").val());
    //     let updateNetAmount = total - updateDiscount;
    //     $("#updateNetAmount").val(updateNetAmount);
    //     let updateAdvance = Number($("#updateAdvance").val());
    //     let updateBalance = updateNetAmount - updateAdvance;
    //     $("#updateBalance").val(updateBalance);
    // }

















    // /////////////// ------------------ Add and Delete Purchase Product Details Into Local Storage Ajax Part Start ---------------- /////////////////////////////
    // // Function to validate form data
    // function validateAddFormData() {
    //     let isValid = true;
    //     let errors = {};

    //     let product = $('#product').attr('data-id');
    //     let batch = $('#product').attr('data-batch');
    //     let pq = Number($('#product').attr('data-quantity'));
    //     let quantity = Number($('#quantity').val());
    //     let mrp = $('#price').val();
    //     let totAmount = $('#totAmount').val();

    //     // Validate Product
    //     if (!product) {
    //         isValid = false;
    //         errors.product = "Product name is required.";
    //     }
    //     else if (isProductDuplicate(product, batch)) {
    //         isValid = false;
    //         errors.product = "This product has already been added.";
    //     }

        
    //     // Validate Quantity
    //     if (!quantity || isNaN(quantity) || quantity <= 0) {
    //         isValid = false;
    //         errors.quantity = "Quantity must be a positive number.";
    //     }
    //     else if(quantity > pq){
    //         isValid = false;
    //         errors.quantity = "Quantity is bigger than the invoice quantity.";
    //     }

    //     // Validate MRP
    //     if (!mrp || isNaN(mrp) || mrp <= 0) {
    //         isValid = false;
    //         errors.mrp = "MRP must be a positive number.";
    //     }
        

    //     // Validate Total Amount
    //     if (!totAmount || isNaN(totAmount) || totAmount <= 0) {
    //         isValid = false;
    //         errors.totAmount = "Total amount must be a positive number.";
    //     }

    //     displayErrors(errors);
    //     return isValid;
    // }


    // // Function to check for duplicate products
    // function isProductDuplicate(product, batch) {
    //     let productGrids = JSON.parse(localStorage.getItem('transactionData')) || [];
    //     return productGrids.some(products => products.product == product && products.batch == batch);
    // }



    // // Function to display error messages
    // function displayErrors(errors) {
    //     $('#product_error').html(errors.product || '');
    //     $('#quantity_error').html(errors.quantity || '');
    //     $('#price_error').html(errors.mrp || '');
    //     $('#totAmount_error').html(errors.totAmount || '');
    // }
    
    
    
    // // Insert Product Into Local Storage
    // $(document).on('click', '#Add', function (e) {
    //     e.preventDefault();
    //     // Validate form data
    //     if (!validateAddFormData()) {
    //         return;
    //     }

    //     let product = Number($('#product').attr('data-id'));
    //     let batch = $('#product').attr('data-batch');
    //     let name = $('#product').val();
    //     let groupe = $('#product').attr('data-groupe');
    //     let quantity = $('#quantity').val();
    //     let mrp = $('#price').val();
    //     let totAmount = $('#totAmount').val();


    //     let productGrid = {
    //         product,
    //         name,
    //         groupe,
    //         quantity,
    //         mrp,
    //         totAmount,
    //         batch
    //     };

    //     // Retrieve existing productGrids from local storage
    //     let productGrids = JSON.parse(localStorage.getItem('transactionData')) || [];

    //     // Add the new productGrids to the list
    //     productGrids.push(productGrid);

    //     // Save updated productGrids back to local storage
    //     localStorage.setItem('transactionData', JSON.stringify(productGrids));

    //     DisplayTransactionGrid();


    //     $('#product').val('');
    //     $('#product').removeAttr('data-id');
    //     $('#product').removeAttr('data-groupe');
    //     $('#product').removeAttr('data-batch');
    //     $('#quantity').val('1');
    //     $('#price').val('');
    //     $('#totAmount').val('');
    //     $("#batch").focus();

    // });
    // /////////////// ------------------ Add and Delete Purchase Product Details Into Local Storage Ajax Part End ---------------- /////////////////////////////
    

    // /////////////// ------------------ Add Inventory Client Return Ajax Part Start ---------------- /////////////////////////////
    // $(document).on('click', '#Insert', function (e) {
    //     e.preventDefault();
    //     let products = localStorage.getItem('transactionData');
    //     if (!products) {
    //         $('#message_error').html('No product added' || '');
    //         return;
    //     }

    //     products = JSON.parse(products);

    //     let method = 'Client Return';
    //     let type = '5';
    //     let withs = $('#user').attr('data-with');
    //     let user = $('#user').attr('data-id');
    //     let store = $('#store').attr('data-id');
    //     let amountRP = $('#amountRP').val();
    //     let discount = $('#totalDiscount').val();
    //     let netAmount = $('#netAmount').val();
    //     let advance = $('#advance').val();
    //     let balance = $('#balance').val();
    //     let batch = $('#batch').val();
    //     let company = $('#company').attr('data-id');
    //     $.ajax({
    //         url: `${apiUrl}/inventory/transaction/return/client`,
    //         method: 'POST',
    //         data: { products:JSON.stringify(products), batch, type, method, withs, user, store, amountRP, discount, netAmount, advance, balance, company },
    //         success: function (res) {
    //             if (res.status) {
    //                 $('#AddForm')[0].reset();
    //                 $('#store').removeAttr('data-id');
    //                 $('#user').removeAttr('data-id');
    //                 $('#user').removeAttr('data-with');
    //                 $('#batch').removeAttr('data-id');
    //                 $('.transaction_grid tbody').html('');
    //                 $('#batch-details-list tbody').html('');
    //                 ReloadData('inventory/transaction/return/client', ShowInventoryClientReturns);
    //                 $('#store').focus();
    //                 localStorage.removeItem('transactionData');
    //                 toastr.success('Client Return Added Successfully', 'Added!');
    //             }
    //         }
    //     });
    // });
});