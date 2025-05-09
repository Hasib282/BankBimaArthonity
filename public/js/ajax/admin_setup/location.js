function ShowLocations(data, startIndex) {
    let tableRows = '';
    
    if(data.length > 0){
        $.each(data, function(key, item) {
            tableRows += `
                <tr>
                    <td>${startIndex + key + 1}</td>
                    <td>${item.division}</td>
                    <td>${item.district}</td>
                    <td>${item.upazila}</td>
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
    ReloadData('admin/locations', ShowLocations);
    

    // Add Modal Open Functionality
    AddModalFunctionality("#division");


    // Insert Ajax
    InsertAjax('admin/locations', ShowLocations, {}, function() {
        $('#division').focus();
    });


    //Edit Ajax
    EditAjax('admin/locations', EditFormInputValue);


    // Update Ajax
    UpdateAjax('admin/locations', ShowLocations);
    

    // Delete Ajax
    DeleteAjax('admin/locations', ShowLocations);


    // Pagination Ajax
    PaginationAjax(ShowLocations);


    // Search Ajax
    SearchAjax('admin/locations', ShowLocations);


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
});