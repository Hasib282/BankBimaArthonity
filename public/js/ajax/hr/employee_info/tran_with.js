function ShowTranWith(data, startIndex) {
    let tableRows = '';
    
    if(data.length > 0){
        $.each(data, function(key, item) {
            tableRows += `
                <tr>
                    <td>${startIndex + key + 1}</td>
                    <td>${item.tran_with_name}</td>
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
    // Load Data on Hard Reload
    ReloadData('hr/employee/usertype', ShowTranWith);
    

    // Add Modal Open Functionality
    AddModalFunctionality("#name");


    // Insert Ajax
    InsertAjax('hr/employee/usertype', ShowTranWith, {tranType: 3, tranMethod: 'Both', role: 3}, function() {
        $('#name').focus();
        $('#company').removeAttr('data-id');
    });


    //Edit Ajax
    EditAjax('hr/employee/usertype', EditFormInputValue);


    // Update Ajax
    UpdateAjax('hr/employee/usertype', ShowTranWith, {tranType: 3, tranMethod: 'Both', role: 3});
    

    // Delete Ajax
    DeleteAjax('hr/employee/usertype', ShowTranWith);


    // Pagination Ajax
    PaginationAjax(ShowTranWith);


    // Search Ajax
    SearchAjax('hr/employee/usertype', ShowTranWith, {type: 3, method: 'Both', role: 3});


    // Additional Edit Functionality
    function EditFormInputValue(res){
        $('#id').val(res.tranwith.id);
        $('#updateName').val(res.tranwith.tran_with_name);

        $('#updateName').focus();
    }; // End Method
});