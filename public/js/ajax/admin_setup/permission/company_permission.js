// function ShowCompanyPermissions(data, startIndex) {
//     let tableRows = '';

//     if(data.length > 0){
//         $.each(data, function(key, item) {
//             let permissionNames = '';
            
//             // Loop through item.routes and concatenate the route names
//             $.each(item.permissions, function (key, permission) {
//                 permissionNames += `${permission.name}, `;
//             });

//             // Remove the trailing comma and space if there are route names
//             permissionNames = permissionNames.slice(0, -2);
//             tableRows += `
//                 <tr>
//                     <td style="width: 4%;">${startIndex + key + 1}</td>
//                     <td style="width: 10%;">${item.company_id}</td>
//                     <td style="width: 20%;">${item.company_name}</td>
//                     <td class="truncate-text">
//                         ${permissionNames}
//                     </td>
//                     <td style="width: 10%;">
//                         <div style="display: flex;gap:5px;">
//                             <button class="open-modal" data-modal-id="editModal" id="edit"
//                                     data-id="${item.company_id}"><i class="fas fa-edit"></i></button>
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
//         $('.load-data .show-table tfoot').html('<tr><td colspan="8" style="text-align:center;">No Data Found</td></tr>')
//     }
// }; // End Function


function ShowCompanyPermissions(res) {
    tableInstance = new GenerateTable({
        tableId: '#data-table',
        data: res.data,
        tbody: ['company_id','company_name',{ type:'multi-data', key:'permissions' }],
        actions: (row) => `
                <button data-modal-id="editModal" id="edit" data-id="${row.company_id}"><i class="fas fa-edit"></i></button>
                `,
    });
}



$(document).ready(function () {
    $(document).off(`.${'SearchBySelect'}`);
    
    // Render The Table Heads
    renderTableHead([
        { label: 'SL:', type: 'rowsPerPage', options: [15, 30, 50, 100, 500] },
        { label: 'Company Id', key: 'company_id' },
        { label: 'Company Name', key: 'company_name' },
        { label: 'Permissions' },
        { label: 'Action', type: 'button' }
    ]);


    // Creating Select Options Dynamically
    $.ajax({
        url: `${apiUrl}/admin/permission/company_permissions`,
        method: "GET",
        success: function (res) {
            let queryParams = GetQueryParams();
            CreateSelectOptions('#type', 'All', res.types, queryParams['type'], 'name');
        },
    });


    // Load Data on Hard Reload
    ReloadData('admin/permission/company_permissions', ShowCompanyPermissions);


    // Edit By Ajax Call
    EditAjaxCall('admin/permission/company_permissions', EditFormInputValue);


    // Update Ajax
    UpdateAjax('admin/permission/company_permissions', ShowCompanyPermissions, {}, function() {
        $('#select-all').prop('checked', false);
    });


    // Pagination Ajax
    // PaginationAjax(ShowCompanyPermissions);


    // Search Ajax
    // SearchAjax('admin/permission/company_permissions', ShowCompanyPermissions, {type: { selector: "#type"}});


    // Search By Methods, Roles, Types
    // SearchBySelect('admin/permission/company_permissions', ShowCompanyPermissions, '#type', {type: { selector: "#type"}});


    // Additional Edit Functionality
    function EditFormInputValue(res){
        $('#id').val(res.company.id)
        $('#companyid').text(`Company Name: ${res.company.company_name} (${res.company.company_id})`);
        $('#company').val(res.company.company_id);

        // $('#permission-container').html('');
        // $.each(res.permissions, function (mainhead, permissions) {
        //     let counter = 0;
        //     // Append the main head with 'Select All' option
            

        //     let groupedPermissions = {
        //         //Admin
        //         'Admin': '', 'Clients': '', 'Suppliers': '', 'Roles': '', 'Permissions': '', 'Banks': '', 
        //         'Locations': '', 'Stores': '', 'Tran-With': '', 'Tran-Groupe': '', 'Tran-Head': '',
        //         // General
        //         'Transaction-Receive': '', 'Transaction-Payment': '', 
        //         // Bank
        //         'Bank-Withdraws': '', 'Bank-Deposits': '',
        //         // HR
        //         'All-Employee': '', 'Employee-Personal-Details': '', 'Employee-Education-Details': '', 
        //         'Employee-Trainning-Details': '', 'Employee-Experience-Details': '', 'Employee-Organization-Details': '', 
        //         'Attendance': '',  'Payroll-Setup': '', 'Payroll-Middleware': '', 'Payroll-Process': '', 
        //         'Department': '', 'Designation': '', 'Salary-Report': '',
        //         // Pharmacy and Inventory
        //         'Manufacturer': '', 'Category': '', 'Unit': '', 'Form': '', 'Product': '', 'Purchase-Transaction': '', 
        //         'Issue-Transaction': '', 'Client-Return-Transaction': '', 'Supplier-Return-Transaction': '', 'Positive': '', 'Negative': '',
        //         // Party
        //         'From-Client': '', 'To-Supplier': '',
        //         // Report
        //         'Balance-Sheet': '', 'Account-Statement': '', 'Party-Statement': '',
        //         // Other
        //         'Other': ''
        //     };
            
        //     $.each(permissions, function(index, item) {
        //         if(counter === 0){
        //             $('#permission-container').append(`
        //                 <div class="rows">
        //                     <div class="c-8">
        //                         <h3>${item.mainhead.name}:</h3>
        //                     </div>
        //                     <div class="c-4" style="display:flex; aling-items:center; justify-content: flex-end;">
        //                         <label>
        //                             <input type="checkbox" id="select-all-${item.permission_mainhead}" class="select-all"> Select All
        //                         </label>
        //                     </div>
        //                 </div>
        //             `);
        //             counter++;
        //         }


        //         let groupKey = 'Other';
        //         let name = item.name;

        //         if (name.includes(' Admin')) groupKey = 'Admin';
        //         else if (name.includes('Clients')) groupKey = 'Clients';
        //         else if (name.includes('Suppliers')) groupKey = 'Suppliers';
        //         else if (name.includes('Roles')) groupKey = 'Roles';
        //         else if (name.includes('Permissions')) groupKey = 'Permissions';
        //         else if (name.includes('Banks')) groupKey = 'Banks';
        //         else if (name.includes('Locations')) groupKey = 'Locations';
        //         else if (name.includes('Stores')) groupKey = 'Stores';
        //         else if (name.includes('TranWith')) groupKey = 'Tran-With';
        //         else if (name.includes('Tran Groupe')) groupKey = 'Tran-Groupe';
        //         else if (name.includes('Tran Head')) groupKey = 'Tran-Head';

        //         else if (name.includes('Transaction Receive')) groupKey = 'Transaction-Receive';
        //         else if (name.includes('Transaction Payment')) groupKey = 'Transaction-Payment';
                
        //         else if (name.includes('Withdraws')) groupKey = 'Bank-Withdraws';
        //         else if (name.includes('Deposits')) groupKey = 'Bank-Deposits';

        //         else if (name.includes('All Employee')) groupKey = 'All-Employee';
        //         else if (name.includes('Personal')) groupKey = 'Employee-Personal-Details';
        //         else if (name.includes('Education')) groupKey = 'Employee-Education-Details';
        //         else if (name.includes('Trainning')) groupKey = 'Employee-Trainning-Details';
        //         else if (name.includes('Experience')) groupKey = 'Employee-Experience-Details';
        //         else if (name.includes('Organization')) groupKey = 'Employee-Organization-Details';
        //         else if (name.includes('Attandence')) groupKey = 'Attendance';
        //         else if (name.includes('Payroll Setup')) groupKey = 'Payroll-Setup';
        //         else if (name.includes('Middleware')) groupKey = 'Payroll-Middleware';
        //         else if (name.includes('Process')) groupKey = 'Payroll-Process';
        //         else if (name.includes('Department')) groupKey = 'Department';
        //         else if (name.includes('Designation')) groupKey = 'Designation';
        //         else if (name.includes('Salary') && name.includes('Report')) groupKey = 'Salary-Report';
                
        //         else if (name.includes('Manufacturer')) groupKey = 'Manufacturer';
        //         else if (name.includes('Category')) groupKey = 'Category';
        //         else if (name.includes('Unit')) groupKey = 'Unit';
        //         else if (name.includes('Form')) groupKey = 'Form';
        //         else if (name.includes('Product')) groupKey = 'Product';
        //         else if (name.includes('Purchase') && name.includes('Transaction')) groupKey = 'Purchase-Transaction';
        //         else if (name.includes('Issue') && name.includes('Transaction')) groupKey = 'Issue-Transaction';
        //         else if (name.includes('Client Return') && name.includes('Transaction')) groupKey = 'Client-Return-Transaction';
        //         else if (name.includes('Supplier Return') && name.includes('Transaction')) groupKey = 'Supplier-Return-Transaction';
        //         else if (name.includes('Positive')) groupKey = 'Positive';
        //         else if (name.includes('Negative')) groupKey = 'Negative';
        //         // else if (name.includes('From Client')) groupKey = 'From-Client';


        //         else if (name.includes('From Client')) groupKey = 'From-Client';
        //         else if (name.includes('To Supplier')) groupKey = 'To-Supplier';

        //         else if (name.includes('Balance Sheet')) groupKey = 'Balance-Sheet';
        //         else if (name.includes('Account Statement')) groupKey = 'Account-Statement';
        //         else if (name.includes('Party Statement')) groupKey = 'Party-Statement';

        //         // Append the permission to the appropriate group
        //         groupedPermissions[groupKey] += `
        //                 <div class="c-3">
        //                     <label for="permissions-${item.id}" style="font-weight: normal;">
        //                         <input type="checkbox" id="permissions-${item.id}" class="permission permission-${item.permission_mainhead}" name="permissions[]" value="${item.id}" ${res.companypermission.includes(item.id) ? 'checked' : ''} />
        //                         ${item.name}
        //                     </label>
        //                 </div>
        //             `;
        //     });
        //     $('#permission-container').append(`<hr>`);
        //     $.each(groupedPermissions, function (groupKey, permissionsHtml) {
        //         if (permissionsHtml) { // Append only non-empty groups
        //             $('#permission-container').append(`
        //                 <div id="group-${groupKey}">
        //                     <span class="sub-name" style="padding: 4px 6px; font-weight: 600;">${groupKey}</span>
        //                     <div class="rows">${permissionsHtml}</div>
        //                 </div>
        //             `);
        //         }
        //     });
        //     $('#permission-container').append(`<hr>`);
        // });

        $('#permission-container').html('');

        $.each(res.groupedPermissions, function (mainheadName, group) {
            $('#permission-container').append(`
                <br>
                <br>
                <div class="rows" style="border: 1px solid #80808069;align-items:center;">
                    <div class="c-8">
                        <h3>${mainheadName.split('-')[0]}:</h3>
                    </div>
                    <div class="c-4" style="display:flex; justify-content:flex-end;">
                        <label><input type="checkbox" id="select-all-${mainheadName.split('-')[1]}" class="select-all"> Select All</label>
                    </div>
                </div>
                <hr>
            `);

            $.each(group, function (groupName, permissions) {
                let permissionsHtml = '';

                $.each(permissions, function (_, item) {
                    permissionsHtml += `
                        <div class="c-3">
                            <label style="font-weight: normal;">
                                <input type="checkbox" class="permission permission-${item.permission_mainhead}" 
                                    name="permissions[]" 
                                    value="${item.id}" 
                                    ${item.checked ? 'checked' : ''} />
                                ${item.name}
                            </label>
                        </div>
                    `;
                });

                $('#permission-container').append(`
                    <div id="group-${groupName}" style="padding: 6px 0px;">
                        <span class="sub-name" style="padding: 4px 6px; font-weight: 600;padding-left:12px;">${groupName}</span>
                        <div class="rows">${permissionsHtml}</div>
                    </div>
                `);
            });
        });
    }



    $(document).off('click', '#select-all').on('click', '#select-all', function() {
        $('.permission').prop('checked', this.checked);
        $('[id^=select-all-]').prop('checked', this.checked);
    });
    


    // Individual checkboxes click handler
    $(document).off('click', '.permission').on('click', '.permission', function() {
        if ($('.permission:checked').length === $('.permission').length) {
            $('#select-all').prop('checked', true);
        } else {
            $('#select-all').prop('checked', false);
        }
    });




    $(document).off('click', '[id^=select-all-]').on('click', '[id^=select-all-]', function() {
        // Extract the mainhead part from the id (after 'select-all-')
        let mainhead = this.id.split('-').pop();
    
        // Check/uncheck all checkboxes with the class 'permission-mainhead'
        $(`.permission-${mainhead}`).prop('checked', this.checked);

        if ($('[id^=select-all-]:checked').length === $('[id^=select-all-]').length) {
            $('#select-all').prop('checked', true);
        } else {
            $('#select-all').prop('checked', false);
        }
    });


    // Individual checkboxes click handler
    $(document).off('click', '[class^=permission-]').on('click', '[class^=permission-]', function() {
        let mainhead = this.id.split('-').pop();

        if ($(`.permission-${mainhead}:checked`).length === $(`.permission-${mainhead}`).length) {
            $(`#select-all-${mainhead}`).prop('checked', true);
        } else {
            $(`#select-all-${mainhead}`).prop('checked', false);
        }
    });
});