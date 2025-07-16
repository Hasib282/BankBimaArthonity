// function ShowSuppliers(data, startIndex) {
//     let tableRows = '';
    
//     if(data.length > 0){
//         $.each(data, function(key, item) {
//             tableRows += `
//                 <tr>
//                     <td>${startIndex + key + 1}</td>
//                     <td>${item.user_id}</td>
//                     <td>${item.user_name}</td>
//                     <td>${item.withs.tran_with_name}</td>
//                     <td>${item.user_email}</td>
//                     <td>${item.user_phone}</td>
//                     <td>${item.loc_id ? item.location.upazila : ""}</td>
//                     <td>${item.address ? item.address : "" }</td>
//                     <td><img src="${apiUrl.replace('/api', '')}/storage/${item.image ? item.image : (item.gender == 'female' ? 'female.png' : 'male.png')}?${new Date().getTime()}" alt="" height="50px" width="50px"></td>
//                     <td>
//                         <div style="display: flex;gap:5px;">
                            
//                             <button class="open-modal" data-modal-id="detailsModal" id="details" data-id="${item.user_id}"><i class="fa-solid fa-circle-info"></i></button>

//                             <button class="open-modal" data-modal-id="editModal" id="edit" data-id="${item.id}"><i class="fas fa-edit"></i></button>
                                    
//                             <button data-id="${item.id}" id="delete"><i class="fas fa-trash"></i></button>
                            
//                         </div>
//                     </td>
//                 </tr>
//             `;
//         });

//         // Inject the generated rows into the table body
//         $('.load-data .show-table tbody').html(tableRows);
//         $('.load-data .show-table tfoot').html('')
//     }
//     else{
//         $('.load-data .show-table tbody').html('');
//         $('.load-data .show-table tfoot').html('<tr><td colspan="11" style="text-align:center;">No Data Found</td></tr>')
//     }
// }; // End Function

function ShowSuppliers(res) {
    tableInstance = new GenerateTable({
        tableId: '#data-table',
        data: res.data,
        tbody: ['user_id','user_name','withs.tran_with_name','user_email', 'user_phone','location.upazila','address',{key:'image', type: 'image'}],
         actions: (row) => {
            let buttons = '';

            buttons += `
                   <button class="open-modal" data-modal-id="detailsModal" id="details" data-id="${row.user_id}"><i class="fa-solid fa-circle-info"></i></button>
                `;
        
            if (userPermissions.includes(31) || role == 1) {
                buttons += `
                    <button data-modal-id="editModal" id="edit" data-id="${row.id}"><i class="fas fa-edit"></i></button>
                `;
            }

            if (userPermissions.includes(32) || role == 1) {
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
        { label: 'Supplier Type', type:"select", key: 'tran_user_type', method:"fetch", link:"admin/tranwith/get", data:{type:1, user:5}, name:"tran_with_name" },
        { label: 'Email', key: 'user_email' },
        { label: 'Phone', key: 'user_phone' },
        { label: 'Location', key: 'location.upazila' },
        { label: 'Address', key: 'address' },
        { label: 'Image' },
        { label: 'Action', type: 'button' }
    ]);


    // Load Data on Hard Reload
    ReloadData('admin/users/suppliers', ShowSuppliers);


    // Get User Type
    GetTransactionWith(2, null, 5, 'Ok');
    

    // Add Modal Open Functionality
    AddModalFunctionality("#type");


    // Insert Ajax
    InsertAjax('admin/users/suppliers', {location: { selector: '#location', attribute: 'data-id' }, company: { selector: '#company', attribute: 'data-id' }}, function() {
        $('#type').focus();
        $('#location').removeAttr('data-id');
    });


    // Edit Ajax
    EditAjax(EditFormInputValue);


    // Update Ajax
    UpdateAjax('admin/users/suppliers', {location: { selector: '#updateLocation', attribute: 'data-id' }});
    

    // Delete Ajax
    DeleteAjax('admin/users/suppliers');
    

    // Delete status Ajax
    DeleteStatusAjax('admin/users/suppliers');


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
    DetailsAjax('admin/users/suppliers');
});