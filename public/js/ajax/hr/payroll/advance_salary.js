function ShowAdvanceSalary(res) {
    tableInstance = new GenerateTable({
        tableId: '#data-table',
        data: res.data,
        tbody: ['emp_id','employee.user_name','amount','months','month','repayment_method','installment_amount','due',{key:'payment_date',type:'date'}],
       
        actions: (row) => {
            let buttons = '';
        
            if (userPermissions.includes(102) || role == 1) {
                buttons += `
                    <button data-modal-id="editModal" id="edit" data-id="${row.id}"><i class="fas fa-edit"></i></button>
                `;
            }
            
            if (userPermissions.includes(103) || role == 1) {
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
        { label: 'Employee Id', key: 'emp_id' },
        { label: 'Employee Name', key: 'employee.user_name' },
        { label: 'Amount' },
        { label: 'For Month' },
        { label: 'Start' },
        { label: 'Repayment' },
        { label: 'Installment' },
        { label: 'Due' },
        { label: 'Date' },
        { label: 'Action', type: 'button' }
    ]);


    // Get Transaction With / User Type 
    GetTransactionWith(3, null, 3, 'Ok');


    // Load Data on Hard Reload
    ReloadData('hr/payroll/advance', ShowAdvanceSalary);
    

    // Add Modal Open Functionality
    AddModalFunctionality("#type", function () {
        $('#user').removeAttr('data-id');
        $('#user').val('');
    });


    // Insert Ajax
    InsertAjax('hr/payroll/advance', {emp_id: { selector: '#user', attribute: 'data-id' }}, function() {
        $('#type').focus();
    });


    //Edit Ajax
    EditAjax(EditFormInputValue);


    // Update Ajax
    UpdateAjax('hr/payroll/advance', {emp_id: { selector: '#updateUser', attribute: 'data-id' }});
    

    // Delete Ajax
    DeleteAjax('hr/payroll/advance');
    

    // Delete status Ajax
    DeleteStatusAjax('hr/payroll/advance');


    // Additional Edit Functionality
    function EditFormInputValue(item){
        $('#id').val(item.id);
        $('#updateType').val(item?.employee?.tran_user_type);
        $('#updateUser').val(item?.employee?.user_name);
        $('#updateUser').attr('data-id', item.emp_id);
        $('#updateAmount').val(item.amount);
        $('#updateMonth').val(item.start_month);
        $('#updateMethod').val(item.repayment_method);
        $('#updateInstallment_amount').val(item.installment_amount);
        $('#updateDue').val(item.due);
        $('#updateApproved_by').val(item.approved_by);
        const fullTimestamp = item.payment_date;
        const onlyDate = fullTimestamp.split('T')[0].split(' ')[0]; // handles both formats

        $('#updatePayment_date').val(onlyDate);
        $('#updateReason').val(item.reason);

        let selectedMonths = JSON.parse(item.months);

        selectedMonths.forEach(function(month) {
            $('input[name="months[]"][value="' + month + '"]').prop('checked', true);
        });
        // $('#updatePayment_date').val(item.payment_date);
        $('#updateType').focus();
    }


    // Get Payroll Category
    GetSelectInputList('hr/payroll/setup/get', function (res) {
        CreateSelectOptions('#head', "Select Payroll Category", res.data, 'tran_head_name');
        CreateSelectOptions('#updateHead', "Select Payroll Category", res.data, 'tran_head_name');
    })
});