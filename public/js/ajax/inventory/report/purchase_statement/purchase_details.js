function ShowInventoryPurchaseDetails(data, startIndex) {
    let tableRows = '';
    let totalQuantity = 0;
    let totalCostPrice = 0;
    let totalDiscount = 0;
    let totalTotalAmount = 0;
    let totalPayment = 0;
    let totalDue = 0;
    
    if(data.length > 0){
        $.each(data, function(key, item) {
            tableRows += `
                <tr>
                    <td>${startIndex + key + 1}</td>
                    <td>${item.tran_id}</td>
                    <td>${item.user.user_name}</td>
                    <td>${item.head.tran_head_name}</td>
                    <td style="text-align: right">${(item.quantity + item.quantity_issue + item.quantity_return).toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
                    <td style="text-align: right">${item.cp.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
                    <td style="text-align: right">${((item.quantity + item.quantity_issue + item.quantity_return) * item.cp).toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
                    <td style="text-align: right">${item.discount.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
                    <td style="text-align: right">${(item.tot_amount - item.discount).toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
                    <td style="text-align: right">${item.payment.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
                    <td style="text-align: right">${item.due.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
                    <td>${new Date(item.tran_date).toLocaleDateString('en-CA')}</td>
                </tr>
            `;

            totalQuantity += (item.quantity + item.quantity_issue + item.quantity_return);
            totalCostPrice += ((item.quantity + item.quantity_issue + item.quantity_return) * item.cp);
            totalDiscount += item.discount;
            totalTotalAmount += item.tot_amount - item.discount;
            totalPayment += item.payment;
            totalDue += item.due;
        });

        // Inject the generated rows into the table body
        $('.load-data .show-table tbody').html(tableRows);
        $('.load-data .show-table tfoot').html(`
            <tr>
                <td colspan="4">Total:</td>
                <td style="text-align: right">${totalQuantity.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
                <td style="text-align: right"></td>
                <td style="text-align: right">${totalCostPrice.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
                <td style="text-align: right">${totalDiscount.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
                <td style="text-align: right">${totalTotalAmount.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
                <td style="text-align: right">${totalPayment.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
                <td style="text-align: right">${totalDue.toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>
                <td></td>
            </tr>`
        );
    }
    else{
        $('.load-data .show-table tbody').html('');
        $('.load-data .show-table tfoot').html('<tr><td colspan="13" style="text-align:center;">No Data Found</td></tr>')
    }
}; // End Function



$(document).ready(function () {
    // Load Data on Hard Reload
    ReloadData('inventory/report/purchase/details', ShowInventoryPurchaseDetails);
    

    // Pagination Ajax
    PaginationAjax(ShowInventoryPurchaseDetails);


    // Search Ajax
    SearchAjax('inventory/report/purchase/details', ShowInventoryPurchaseDetails, { type:'5', method:'Purchase' });


    // Search By Month or Year
    SearchByDateAjax('inventory/report/purchase/details', ShowInventoryPurchaseDetails, { type:'5', method:'Purchase' })
});