function ShowPermissions(res) {
    tableInstance = new GenerateTable({
        tableId: '#data-table',
        data: res.data,
        tbody: ['mainhead.name','name'],
        actions: (row) => `
                <button data-modal-id="editModal" id="edit" data-id="${row.id}"><i class="fas fa-edit"></i></button>
                        
                <button data-id="${row.id}" id="delete"><i class="fas fa-trash"></i></button>
                `,
    });
}



$(document).ready(function () {
    // Render The Table Heads
    renderTableHead([
        { label: 'SL:', type: 'rowsPerPage', options: [15, 30, 50, 100, 500] },
        { label: 'Main Head', type:"select", key: 'permission_mainhead', method:"fetch", link:'admin/permission/mainhead/get', name:"name" },
        { label: 'Permission Name', key: 'name' },
        { label: 'Action', type: 'button' }
    ]);


    // Load Data on Hard Reload
    ReloadData('admin/permission/heads', ShowPermissions);
    

    // Add Modal Open Functionality
    AddModalFunctionality("#mainhead");


    // Insert Ajax
    InsertAjax('admin/permission/heads', {}, function() {
        $('#mainhead').focus();
    });


    //Edit Ajax
    EditAjax(EditFormInputValue);


    // Update Ajax
    UpdateAjax('admin/permission/heads');
    

    // Delete Ajax
    DeleteAjax('admin/permission/heads');
    
    
    // Delete Status Ajax
    DeleteStatusAjax('admin/permission/heads');


    // Additional Edit Functionality
    function EditFormInputValue(item){
        $('#id').val(item.id);
        $('#updateMainhead').val(item.permission_mainhead);
        $('#updateName').val(item.name);
        $('#updateName').focus();
    }


    // Get Permission Main Head
    GetSelectInputList('admin/permission/mainhead/get', function (res) {
        CreateSelectOptions('#mainhead', 'Select Mainhead', res.data, 'name');
        CreateSelectOptions('#updateMainhead', 'Select Mainhead', res.data, 'name');
    })
});