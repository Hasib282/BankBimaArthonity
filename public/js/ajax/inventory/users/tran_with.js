function ShowTranWith(data, startIndex) {
    let tableRows = '';
    
    if(data.length > 0){
        $.each(data, function(key, item) {
            tableRows += `
                <tr>
                    <td>${startIndex + key + 1}</td>
                    <td>${item.tran_with_name}</td>
                    <td>${item.role.name}</td>
                    <td>${item.tran_method}</td>
                    <td>
                        <div style="display: flex;gap:5px;">
                            
                            <button class="open-modal" data-modal-id="editModal" id="edit" data-id="${item.id}"><i class="fas fa-edit"></i></button>
                            
                            <button data-id="${item.id}" id="delete"><i class="fas fa-trash"></i></button>
                            
                        </div>
                    </td>
                </tr>
            `;
        });

        // Inject the generated rows into the table body
        $('.load-data .show-table tbody').html(tableRows);
        $('.load-data .show-table tfoot').html('')
    }
    else{
        $('.load-data .show-table tbody').html('');
        $('.load-data .show-table tfoot').html('<tr><td colspan="8" style="text-align:center;">No Data Found</td></tr>')
    }
}; // End Function



$(document).ready(function () {
    $(document).off(`.${'SearchBySelect'}`);

    // Load Data on Hard Reload
    ReloadData('inventory/users/usertype', ShowTranWith);
    

    // Add Modal Open Functionality
    AddModalFunctionality("#name");


    // Insert Ajax
    InsertAjax('inventory/users/usertype', ShowTranWith, {tranType: 5}, function() {
        $('#name').focus();
        $('#company').removeAttr('data-id');
    });


    //Edit Ajax
    EditAjax('inventory/users/usertype', EditFormInputValue);


    // Update Ajax
    UpdateAjax('inventory/users/usertype', ShowTranWith, {tranType: 5});
    

    // Delete Ajax
    DeleteAjax('inventory/users/usertype', ShowTranWith);


    // Pagination Ajax
    PaginationAjax(ShowTranWith);


    // Search Ajax
    SearchAjax('inventory/users/usertype', ShowTranWith, {type: 5, method: { selector: "#methods"}, role: { selector: "#roles"}});


    // Search By Methods, Roles, Types
    SearchBySelect('inventory/users/usertype', ShowTranWith, '#methods, #roles', {type: 5, method: { selector: "#methods"}, role: { selector: "#roles"}} );


    // Additional Edit Functionality
    function EditFormInputValue(res){
        $('#id').val(res.tranwith.id);
        $('#updateName').val(res.tranwith.tran_with_name);

        // Create options dynamically
        $('#updateRole').html('');
        $('#updateRole').append(`<option value="4" ${res.tranwith.user_role == '4' ? 'selected' : ''}>Client</option>
                                    <option value="5" ${res.tranwith.user_role == '5' ? 'selected' : ''}>Supplier</option>`);

        $('#updateTranMethod').html('');
        $('#updateTranMethod').append(`<option value="Receive" ${res.tranwith.tran_method === 'Receive' ? 'selected' : ''}>Receive</option>
                                    <option value="Payment" ${res.tranwith.tran_method === 'Payment' ? 'selected' : ''}>Payment</option>
                                    <option value="Both" ${res.tranwith.tran_method === 'Both' ? 'selected' : ''}>Both</option>`);
        $('#updateName').focus();
    }; // End Method
});