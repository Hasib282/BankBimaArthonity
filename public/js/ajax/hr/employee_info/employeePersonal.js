// function ShowEmployeePersonalDetails(data, startIndex) {
//     let tableRows = '';
    
//     if(data.length > 0){
//         $.each(data, function(key, item) {
//             tableRows += `
//                 <tr>
//                     <td>${startIndex + key + 1}</td>
//                     <td>${item.user_id}</td>
//                     <td>${item.user_name}</td>
//                     <td>${item.dob}</td>
//                     <td>${item.gender}</td>
//                     <td>${item.user_email}</td>
//                     <td>${item.user_phone}</td>
//                     <td>${item.address}</td>
//                     <td><img src="${apiUrl.replace('/api', '')}/storage/${item.image ? item.image : (item.gender == 'female' ? 'female.png' : 'male.png')}?${new Date().getTime()}" alt="" height="50px" width="50px"></td>
//                     <td>
//                         ${item.status == 1 ?
//                             `<button class="btn btn-success btn-sm toggle-status" data-id="{{$item.id}}" data-table="Inv_Client_Info" data-status="${item.status}" data-target=".client">Active</button>`
//                         :
//                             `<button class="btn btn-danger btn-sm toggle-status" data-id="{{$item.id}}" data-table="Inv_Client_Info" data-status="${item.status}" data-target=".client">Inactive</button>`
//                         }
//                     </td>
//                     <td>
//                         <div style="display: flex;gap:5px;">
//                             <button class="open-modal" data-modal-id="detailsModal" id="details"
//                                 data-id="${item.user_id}"><i class="fa-solid fa-circle-info"></i></button>
                            
//                             <button class="open-modal" data-modal-id="editModal" id="edit"
//                                 data-id="${item.user_id}"><i class="fas fa-edit"></i></button>
                            
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

function ShowEmployeePersonalDetails(res) {
    tableInstance = new GenerateTable({
        tableId: '#data-table',
        data: res.data,
        tbody: ['user_id','user_name','withs.tran_with_name',{key:'dob', type: 'date'},'gender','user_email', 'user_phone','address',{key:'image', type: 'image'},{key:'status', type: 'status'}],
        actions: (row) => {
            let buttons = '';

            buttons += `
                    <button class="open-modal" data-modal-id="detailsModal" id="details" data-id="${row.user_id}"><i class="fa-solid fa-circle-info"></i></button>
                `;
        
            if (userPermissions.includes(75)) {
                buttons += `
                    <button class="open-modal" data-modal-id="editModal" id="edit" data-id="${row.id}"><i class="fas fa-edit"></i></button>
                `;
            }

            if (userPermissions.includes(76) || role == 1) {
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
        { label: 'Id', key: 'user_id' },
        { label: 'Name', key: 'user_name' },
        { label: 'Employee Type', key: 'withs.tran_with_name' },
        { label: 'DOB', key: 'dob', type:"date" },
        { label: 'Gender', type:"select", key: 'gender', method:"custom", options:['Male','Female','Others'] },
        { label: 'Email', key: 'user_email' },
        { label: 'Phone', key: 'user_phone' },
        { label: 'Address', key: 'address' },
        { label: 'Image' },
        { label: 'Status', status: [{key:1, label:'Active' }, { key:0, label:'Inactive'}] },
        { label: 'Action', type: 'button' }
    ]);


    // Get Transaction With / User Type 
    GetTransactionWith(3, '', 3, 'Ok');


    // Load Data on Hard Reload
    ReloadData('hr/employee/personal', ShowEmployeePersonalDetails);
    

    // Add Modal Open Functionality
    AddModalFunctionality("#name");


    // Insert Ajax
    InsertAjax('hr/employee/personal', {location: { selector: '#location', attribute: 'data-id' }, company: { selector: '#company', attribute: 'data-id' }}, function() {
        $('#name').focus();
        $('#location').removeAttr('data-id');
        $('#previewImage').attr('src',`#`);
    });


    //Edit Ajax
    EditAjax(EditFormInputValue);


    // Update Ajax
    UpdateAjax('hr/employee/personal', {location: { selector: '#updateLocation', attribute: 'data-id' }});
    

    // Delete status Ajax
    DeleteStatusAjax('hr/employee/personal');


    // Additional Edit Functionality
    function EditFormInputValue(item){
        $('#id').val(item.id);
        $('#employee_id').val(item.user_id);
        $('#updateType').focus();
        $('#updateType').val(item.personal_detail.tran_user_type);
        $('#updateName').val(item.personal_detail.name);
        $('#update_fathers_name').val(item.personal_detail.fathers_name);
        $('#update_mothers_name').val(item.personal_detail.mothers_name);
        $('#update_dob').val(item.personal_detail.dob);

        // Create options dynamically
        $('#update_gender').val(item.personal_detail.gender);
        $('#update_religion').val(item.personal_detail.religion);
        $('#update_marital_status').val(item.personal_detail.marital_status);
        $('#update_nationality').val(item.personal_detail.nationality);
        $('#update_nid_no').val(item.personal_detail.nid_no);
        $('#update_phn_no').val(item.personal_detail.phn_no);
        $('#update_blood_group').val(item.personal_detail.blood_group);
        $('#update_email').val(item.personal_detail.email);

        // Create options dynamically
        $('#updateDivision').val(item.location.division);
        
        $('#updateLocation').val(item.location.upazila);
        $('#updateLocation').attr('data-id',item.loc_id);

        $('#update_address').val(item.personal_detail.address);
        $('#updatePreviewImage').attr('src',`${apiUrl.replace('/api', '')}/storage/${item.personal_detail.image ? item.personal_detail.image : (item.personal_detail.gender == 'female' ? 'female.png' : 'male.png')}?${new Date().getTime()} `).show();
    }

    
    // Show Detals Ajax
    DetailsAjax('hr/employee/personal');


    // Get Store 
    GetSelectInputList('admin/stores/get', function (res) {
        CreateSelectOptions('#store', 'Select Store', res.data, 'store_name');
        CreateSelectOptions('#updateStore', 'Select Store', res.data, 'store_name');
    })
});