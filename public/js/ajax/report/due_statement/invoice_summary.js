
function ShowSummaryReports(res) {
    tableInstance = new GenerateTable({
        tableId: '#data-table',
        data: res.data,
        tbody: [
            'user.user_name',
            {key:'total_bill_amount', type: 'number', footerType:'sum'},
            {key:'total_discount', type: 'number', footerType:'sum'},
            {key:'total_net_amount', type: 'number', footerType:'sum'},
            {key:'total_receive', type: 'number', footerType:'sum'},
            {key:'total_due_col', type: 'number', footerType:'sum'},
            {key:'total_due_disc', type: 'number', footerType:'sum'},
            {key:'total_due', type: 'number', footerType:'sum'},
        ],
        rowsPerPage: res.data.length,
    });

    UpdateUrl('/api/report/due/invoice_summary/print', {method: $("#methodOption").val(),startDate: $('#startDate').val(), endDate: $('#endDate').val() });
}

$(document).ready(function () {
    // Render The Table Heads
    renderTableHead([
        { label: 'SL:', type: 'rowsPerPage', options: [15, 30, 50, 100, 500] },
        { label: 'Client/Supplier', key: 'user.user_name' },
        { label: 'Bill Amount' },
        { label: 'Discount' },
        { label: 'Net Amount' },
        { label: 'Advance Receive' },
        { label: 'Due Receive' },
        { label: 'Due Discount' },
        { label: 'Balance/Due' },
    ]);

    // Load Data on Hard Reload
    ReloadData('report/due/invoice_summary', ShowSummaryReports);


    // Search By Date
    SearchByDateAjax('report/due/invoice_summary/search', ShowSummaryReports, {type: $("#typeOption").val()});


    // Search by Type
    SearchBySelect('report/due/invoice_summary/search', ShowSummaryReports, "#typeOption", {type: $("#typeOption").val()});


    // Get Trantype
    GetSelectInputList('admin/mainheads/get', function (res) {
        CreateSelectOptions('#typeOption', "Select Tran Type", res.data, 'type_name');
    })
});