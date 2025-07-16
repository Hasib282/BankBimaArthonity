function ShowTranWith(res) {
    tableInstance = new GenerateTable({
        tableId: '#data-table',
        data: res.data,
        tbody: ['role.name','tran_with_name','tran_method'],
         actions: (row) => {
            let buttons = '';

            if (userPermissions.includes(23) || role == 1) {
                buttons += `
                    <button data-modal-id="editModal" id="edit" data-id="${row.id}"><i class="fas fa-edit"></i></button>
                `;
            }
            
            if (userPermissions.includes(24) || role == 1) {
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
        { label: 'User Role', type:"select", key: 'user_role', method:"custom", options:[{val:4,text:"Client"}, {val:5,text:'Supplier'}] },
        { label: 'User Type', key: 'tran_with_name' },
        { label: 'Transaction Method', type:"select", key: 'tran_method', method:"custom", options:['Receive','Payment','Both'] },
        { label: 'Action', type: 'button' }
    ]);


    // Load Data on Hard Reload
    ReloadData('admin/users/usertype', ShowTranWith);
    

    // Add Modal Open Functionality
    AddModalFunctionality("#name");


    // Insert Ajax
    InsertAjax('admin/users/usertype', {tranType: 2}, function() {
        $('#name').focus();
    });


    //Edit Ajax
    EditAjax(EditFormInputValue);


    // Update Ajax
    UpdateAjax('admin/users/usertype', {tranType: 2});
    

    // Delete Ajax
    DeleteAjax('admin/users/usertype');
    

    // Delete status Ajax
    DeleteStatusAjax('admin/users/usertype');


    // Additional Edit Functionality
    function EditFormInputValue(item){
        $('#id').val(item.id);
        $('#updateName').val(item.tran_with_name);
        $('#updateRole').val(item.user_role);
        $('#updateTranMethod').val(item.tran_method);
        $('#updateName').focus();
    }; // End Method
});