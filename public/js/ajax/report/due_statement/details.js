
function ShowDetailsReports(res) {
    tableInstance = new GenerateTable({
        tableId: '#data-table',
        data: res.data,
        tbody: [
            {key:'tran_date', type:'date'},
            'tran_id',
            'user.user_name',
            'type.type_name',
            'groupe.tran_groupe_name',
            'head.tran_head_name',
            {key:'due', type: 'number', footerType:'sum'},
        ],
        rowsPerPage: res.data.length,
    });

    UpdateUrl('/api/report/due/details/print', {method: $("#methodOption").val(),startDate: $('#startDate').val(), endDate: $('#endDate').val() });

    
}

$(document).ready(function () {
    // Render The Table Heads
    renderTableHead([
        { label: 'SL:', type: 'rowsPerPage', options: [15, 30, 50, 100, 500] },
        { label: 'Date', key: 'tran_date', type:"date" },
        { label: 'Tran Id', key: 'tran_id' },
        { label: 'Client/Supplier', key: 'user.user_name' },
        { label: 'Main Head', type:"select", key: 'tran_type', method:"fetch", link:'admin/mainheads/get', name:'type_name' },
        { label: 'Groupe', key: 'groupe.tran_groupe_name' },
        { label: 'Product/Service', key:'head.tran_head_name' },
        { label: 'Due' },
    ]);


    // Load Data on Hard Reload
    ReloadData('report/due/details', ShowDetailsReports);


    // Search By Date
    SearchByDateAjax('report/due/details/search', ShowDetailsReports, {type: $("#typeOption").val()});


    // Search by Type
    SearchBySelect('report/due/details/search', ShowDetailsReports, "#typeOption", {type: $("#typeOption").val()});


    // Get Trantype
    GetSelectInputList('admin/mainheads/get', function (res) {
        CreateSelectOptions('#typeOption', "Select Tran Type", res.data, 'type_name');
    })
});