function ShowEmployeeTrainingDetails(data, startIndex) {
    let tableRows = '';
    
    if(data.length > 0){
        $.each(data, function(key, item) {
            tableRows += `
                <tr>
                    <td>${startIndex + key + 1}</td>
                    <td>${item.user_id}</td>
                    <td>${item.user_name}</td>
                    <td>${item.dob}</td>
                    <td>${item.gender}</td>
                    <td>${item.user_email}</td>
                    <td>${item.user_phone}</td>
                    <td>${item.address}</td>
                    <td><img src="${apiUrl.replace('/api', '')}/storage/${item.image ? item.image : (item.gender == 'female' ? 'female.png' : 'male.png')}?${new Date().getTime()}" alt="" height="50px" width="50px"></td>
                    <td>
                        ${item.status == 1 ?
                            `<button class="btn btn-success btn-sm toggle-status" data-id="${item.id}"
                                data-table="Inv_Client_Info" data-status="${item.status}" data-target=".client">Active</button>`
                            :
                            `<button class="btn btn-danger btn-sm toggle-status" data-id="${item.id}" data-table="Inv_Client_Info"
                                data-status="${item.status}" data-target=".client">Inactive</button>`
                        }
                    </td>
                    <td>
                        <div style="display: flex;gap:5px;">
                            <button class="btn-show" id="showGrid" data-id="${item.user_id}">Show <i class="fa fa-chevron-circle-right"></i></button>
                            <button class="open-modal" data-modal-id="detailsModal" id="details" data-id="${item.user_id}"><i class="fa-solid fa-circle-info"></i></button>
                        </div>
                    </td>
                </tr>
                <tr id = "grid${item.user_id}" style = "display:none"></tr>
            `;
        });

        // Inject the generated rows into the table body
        $('.load-data .show-table tbody').html(tableRows);
        $('.load-data .show-table tfoot').html('')
    }
    else{
        $('.load-data .show-table tbody').html('');
        $('.load-data .show-table tfoot').html('<tr><td colspan="11" style="text-align:center;">No Data Found</td></tr>')
    }
}; // End Function



$(document).ready(function () {
    // Get Transaction With / User Type 
    GetTransactionWith(3, '', '#with', 3, 'Ok');


    // Load Data on Hard Reload
    ReloadData('hr/employee/training', ShowEmployeeTrainingDetails);
    

    // Add Modal Open Functionality
    AddModalFunctionality("#with", function () {
        $('#user').removeAttr('data-id');
        formIndex = 1;
        $('#formContainer').html('');
    });


    // Insert Ajax
    InsertAjax('hr/employee/training', ShowEmployeeTrainingDetails, {user: { selector: '#user', attribute: 'data-id' }}, function() {
        $('#with').focus();
        $('#user').removeAttr('data-id');
        formIndex = 1;
        $('#formContainer').html('');
    }, 'Multi POST');


    //Edit Ajax
    EditAjax('hr/employee/training', EditFormInputValue);


    // Update Ajax
    UpdateAjax('hr/employee/training', ShowEmployeeTrainingDetails);
    

    // Delete Ajax
    DeleteAjax('hr/employee/training', ShowEmployeeTrainingDetails);


    // Pagination Ajax
    PaginationAjax(ShowEmployeeTrainingDetails);


    // Search Ajax
    SearchAjax('hr/employee/training', ShowEmployeeTrainingDetails, {  });


    // Show Detals Ajax
    DetailsAjax('hr/employee/training');


    // Show Grid
    GridAjax('hr/employee/training');


    // Additional Edit Functionality
    function EditFormInputValue(res){
        $('#id').val(res.employee.id);
        $('#empId').val(res.employee.emp_id);
        $('#update_training_title').val(res.employee.training_title);
        $('#update_country').val(res.employee.country);
        $('#update_topic').val(res.employee.topic);
        $('#update_institution_name').val(res.employee.institution_name);
        $('#update_start_date').val(res.employee.start_date);
        $('#update_end_date').val(res.employee.end_date);
        $('#update_training_year').val(res.employee.training_year);
    }
    

    var formIndex = 1;

    $('#addTraining').click(function() {
        let form = `<div class="rows add-form">
                        <div class="c-6">
                            <div class="form-input-group">
                                <label for = "training_title_${formIndex}">Training Title <span class="required" title="Required">*</span></label>
                                <input type="text" name="training_title[]" id="training_title_${formIndex}" class="form-input">
                                <span class="error" id="training_title_${formIndex}_error"></span>
                            </div>
                        </div>
                        <div class="c-6">
                            <div class="form-input-group">
                                <label for = "country_${formIndex}">Country</label>
                                <input type="text" name="country[]" id="country_${formIndex}" class="form-input">
                                <span class="error" id="country_${formIndex}_error"></span>
                            </div>
                        </div>
                        <div class="c-6">
                            <div class="form-input-group">
                                <label for = "topic_${formIndex}">Topic <span class="required" title="Required">*</span></label>
                                <input type="text" name="topic[]" id="topic_${formIndex}" class="form-input">
                                <span class="error" id="topic_${formIndex}_error"></span>
                            </div>
                        </div>
                        <div class="c-6">
                            <div class="form-input-group">
                                <label for = "institution_name_${formIndex}">Institution Name <span class="required" title="Required">*</span></label>
                                <input type="text" name="institution_name[]" id="institution_name_${formIndex}" class="form-input">
                                <span class="error" id="institution_name_${formIndex}_error"></span>
                            </div>
                        </div>
                        <div class="c-6">
                            <div class="form-input-group">
                                <label for="start_date_${formIndex}">Start Date</label>
                                <input type="date" name="start_date[]" id="start_date_${formIndex}" class="form-input">
                                <span class="error" id="start_date_${formIndex}_error"></span>
                            </div>
                        </div>
                        <div class="c-6">
                            <div class="form-input-group">
                                <label for="end_date_${formIndex}">End Date</label>
                                <input type="date" name="end_date[]" id="end_date_${formIndex}" class="form-input">
                                <span class="error" id="end_date_${formIndex}_error"></span>
                            </div>
                        </div>
                        <div class="c-6">
                            <div class="form-input-group">
                                <label for = "training_year_${formIndex}">Training Year <span class="required" title="Required">*</span></label>
                                <input type="integer" name="training_year[]" id="training_year_${formIndex}" class="form-input">
                                <span class="error" id="training_year_${formIndex}_error"></span>
                            </div>
                        </div>
                    </div>`;

        $('#formContainer').append(form);
        formIndex++;
    });
});