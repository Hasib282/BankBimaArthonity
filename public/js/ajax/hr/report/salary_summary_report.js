function ShowSalarySummary(data, startIndex) {
    let tableRows = '';
    let totalAmount = 0;
    
    if(data.length > 0){
        $.each(data, function(key, item) {
            tableRows += `
                <tr>
                    <td>${startIndex + key + 1}</td>
                    <td>${item.tran_user}</td>
                    <td>${item.user.user_name}</td>
                    <td style="text-align:right;">${item.bill_amount.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
                    <td>${new Date(item.tran_date).toISOString().split('T')[0]}</td>
                </tr>
            `;
            
            totalAmount += item.bill_amount;
        });

        // Inject the generated rows into the table body
        $('.load-data .show-table tbody').html(tableRows);
    
        $('.load-data .show-table tfoot').html(`
                <tr>
                    <td colspan="3">Total:</td>
                    <td style="text-align:right;">${totalAmount.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
                    <td></td>
                </tr>
        `);
    }
    else{
        $('.load-data .show-table tbody').html('');
        $('.load-data .show-table tfoot').html('<tr><td colspan="6" style="text-align:center;">No Transaction Found</td></tr>')
    }
}; // End Function



$(document).ready(function () {
    $(document).off(`.${'SearchBySelect'}`);
    
    // Load Data on Hard Reload
    ReloadData('hr/report/salary/summary', ShowSalarySummary);
    

    // Pagination Ajax
    PaginationAjax(ShowSalarySummary, { month: { selector: '#month'}, year: { selector: '#year'}});


    // Search Ajax
    SearchAjax('hr/report/salary/summary', ShowSalarySummary, { month: { selector: '#month'}, year: { selector: '#year'}});


    // Search By Month or Year
    SearchBySelect('hr/report/salary/summary', ShowSalarySummary, '#month, #year', { month: { selector: '#month'}, year: { selector: '#year'}})
});