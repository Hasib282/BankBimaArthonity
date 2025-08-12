function ShowBanks(res) {
    tableInstance = new GenerateTable({
        tableId: '#data-table',
        data: res.data,
        tbody: ['user_id','name','email', 'phone','location.upazila','address'],
        actions: (row) => {
            let buttons = '';
            
            buttons += `
                <button class="open-modal" data-modal-id="detailsModal" id="details" data-id="${row.user_id}"><i class="fa-solid fa-circle-info"></i></button>
            `;

            if (userPermissions.includes(285) || role == 1) {
                buttons += `
                    <button data-modal-id="editModal" id="edit" data-id="${row.id}"><i class="fas fa-edit"></i></button>
                `;
            }

            if (userPermissions.includes(286) || role == 1) {
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
        { label: 'Bank Id', key: 'user_id' },
        { label: 'Name', key: 'name' },
        { label: 'Email', key: 'email' },
        { label: 'Phone', key: 'phone' },
        { label: 'Location	', key: 'location.upazila' },
        { label: 'Address	', key: 'address' },
        { label: 'Action', type: 'button' }
    ]);


    // Load Data on Hard Reload
    ReloadData('admin/banks', ShowBanks);
    

    // Add Modal Open Functionality
    AddModalFunctionality("#name");


    // Insert Ajax
    InsertAjax('admin/banks', {location: { selector: '#location', attribute: 'data-id' }}, function() {
        $('#name').focus();
        $('#location').removeAttr('data-id');
    });


    // Edit Ajax
    EditAjax(EditFormInputValue);


    // Update Ajax
    UpdateAjax('admin/banks', {location: { selector: '#updateLocation', attribute: 'data-id' }});
    

    // Delete Ajax
    DeleteAjax('admin/banks');
    

    // Delete Status Ajax
    DeleteStatusAjax('admin/banks');


    // Additional Edit Functionality
    function EditFormInputValue(item){
        $('#id').val(item.id);
        $('#updateName').val(item.name);
        $('#updatePhone').val(item.phone);
        $('#updateEmail').val(item.email);
        $('#updateDivision').val(item.location.division)
        
        $('#updateLocation').val(item.location.upazila);
        $('#updateLocation').attr('data-id',item.loc_id);
        $('#updateAddress').val(item.address);
        $('#updateName').focus();
    }; // End Method


    // Show Detals Ajax
    DetailsAjax('admin/banks');
});