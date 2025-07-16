function ShowClients(res) {
    tableInstance = new GenerateTable({
        tableId: '#data-table',
        data: res.data,
        tbody: ['user_id','user_name','withs.tran_with_name','user_email', 'user_phone','location.upazila','address',{key:'image', type: 'image'}],
        
        actions: (row) => {
            let buttons = '';

            buttons += `
                <button class="open-modal" data-modal-id="detailsModal" id="details" data-id="${row.user_id}"><i class="fa-solid fa-circle-info"></i></button>
            `;
        
            if (userPermissions.includes(27) || role == 1) {
                buttons += `
                    <button data-modal-id="editModal" id="edit" data-id="${row.id}"><i class="fas fa-edit"></i></button>
                `;
            }

            if (userPermissions.includes(28) || role == 1) {
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
        { label: 'Id', key: 'user_id' },
        { label: 'Name', key: 'user_name' },
        { label: 'Client Type', type:"select", key: 'tran_user_type', method:"fetch", link:"admin/tranwith/get", data:{type:1,user:4}, name:"tran_with_name" },
        { label: 'Email', key: 'user_email' },
        { label: 'Phone', key: 'user_phone' },
        { label: 'Location', key: 'location.upazila' },
        { label: 'Address', key: 'address' },
        { label: 'Image' },
        { label: 'Action', type: 'button' }
    ]);
    
    
    // Load Data on Hard Reload
    ReloadData('admin/users/clients', ShowClients);


    // Get User Type
    GetTransactionWith(2, null, 4, 'Ok');
    

    // Add Modal Open Functionality
    AddModalFunctionality("#type");


    // Insert Ajax
    InsertAjax('admin/users/clients', {location: { selector: '#location', attribute: 'data-id' }, company: { selector: '#company', attribute: 'data-id' }}, function() {
        $('#type').focus();
        $('#location').removeAttr('data-id');
    });


    // Edit Ajax
    EditAjax(EditFormInputValue);


    // Update Ajax
    UpdateAjax('admin/users/clients', {location: { selector: '#updateLocation', attribute: 'data-id' }});
    

    // Delete Ajax
    DeleteAjax('admin/users/clients');
    

    // Delete status Ajax
    DeleteStatusAjax('admin/users/clients');


    // Additional Edit Functionality
    function EditFormInputValue(item){
        $('#EditForm')[0].reset();
        $('#updateLocation').removeAttr('data-id');
        
        $('#id').val(item.id);
        $('#updateType').val(item.tran_user_type);
        $('#updateName').val(item.user_name);
        $('#updatePhone').val(item.user_phone);
        $('#updateEmail').val(item.user_email);
        $('#updateDivision').val(item.location.division);
        $('#updateGender').val(item.gender);
        $('#updateLocation').val(item.location.upazila);
        $('#updateLocation').attr('data-id',item.loc_id);
        $('#updateAddress').val(item.address);
        $('#updatePreviewImage').attr('src',`${apiUrl.replace('/api', '')}/storage/${item.image ? item.image : (item.gender == 'female' ? 'female.png' : 'male.png')}?${new Date().getTime()} `).show();
        $('#updateType').focus();
    }; // End Method


    // Show Detals Ajax
    DetailsAjax('admin/users/clients');
});