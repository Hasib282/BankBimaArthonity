function ShowLocations(res) {
    tableInstance = new GenerateTable({
        tableId: '#data-table',
        data: res.data,
        tbody: ['division','district','upazila'],
   
        actions: (row) => {
            let buttons = '';
        
            if (userPermissions.includes(282) || role == 1) {
                buttons += `
                    <button data-modal-id="editModal" id="edit" data-id="${row.id}"><i class="fas fa-edit"></i></button>
                `;
            }
            
           if (userPermissions.includes(283) || role == 1) {
                buttons += `
                
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
        { label: 'Division', key: 'division' },
        { label: 'District', key: 'district' },
        { label: 'Upazila', key: 'upazila' },
        { label: 'Action', type: 'button' }
    ]);


    // Load Data on Hard Reload
    ReloadData('admin/locations', ShowLocations);
    

    // Add Modal Open Functionality
    AddModalFunctionality("#division");


    // Insert Ajax
    InsertAjax('admin/locations', {}, function() {
        $('#division').focus();
    });


    //Edit Ajax
    EditAjax(EditFormInputValue);


    // Update Ajax
    UpdateAjax('admin/locations');
    

    // Delete Ajax
    DeleteAjax('admin/locations');
    

    // Delete status Ajax
    DeleteStatusAjax('admin/locations');
    

    // Additional Edit Functionality
    function EditFormInputValue(item){
        $('#id').val(item.id);
        $('#updateDivision').val(item.division);
        $('#updateDistrict').val(item.district);
        $('#updateUpazila').val(item.upazila);
        $('#updateDivision').focus();
    }
});