<style>
    table tr,td{
        border: 1px solid gray;
        padding: 2px 5px;
    }

    table{
        border-collapse: collapse;
        font-size: 12px;
    }
</style>


{{-- company Details Part --}}
<div style="text-align: center; width: 100%; margin: 0 auto;">
    <p style="margin-bottom: 10px;font-size:25px;">
        <strong>{{ auth()->user()->company ? auth()->user()->company->company_name : 'Team-Solutions-Bangladesh' }}</strong>
    </p>
    <p style="margin: 0 auto; max-width: 35%;">
        {{ auth()->user()->company ? auth()->user()->company->address : '12th floor, 28 Kazi Nazrul Islam Ave, Banglamotor, Dhaka 1000' }} <br>
        Phone no: {{ auth()->user()->company ? auth()->user()->company->company_phone : '01314353560' }}
    </p>
    <p style="margin-top: 10px;">
        <strong style="font-size: 22px;">Retail Invoice</strong> <br>
        {{-- {{$transactionMain->store->store_name}} --}}
    </p>
</div>

<div style="padding: 0 20px; box-sizing: border-box;">
    <table style="width: 100%;">
        <tbody>
            <tr>
                <td>INVOICE NO:</td>
                <td>INVOICE DATE:</td>
            </tr>
        </tbody>
    </table>

    <br>

    {{-- Customer Details Part --}}
    <table style="width: 100%;">
        <tbody>
            <tr>
                <td style="width: 15%;"><strong>INVOICE TO:</strong></td>
                <td></td>
            </tr>
            <tr>
                <td>CUSTOMER ID</td>
                <td>CU00000001</td>
            </tr>
            <tr>
                <td>NAME</td>
                <td>Hasibur Rahaman</td>
            </tr>
            <tr>
                <td>PHONE</td>
                <td>Hasibur Rahaman</td>
            </tr>
            <tr>
                <td>ADDRESS</td>
                <td>Bashundhara, Dhaka</td>
            </tr>
            <tr>
                <td>ADVERTISEMENT NAME:</td>
                <td></td>
            </tr>
            <tr>
                <td>CAPTION</td>
                <td>CU00000001</td>
            </tr>
            <tr>
                <td>CATEGORY</td>
                <td>Hasibur Rahaman</td>
            </tr>
        </tbody>
    </table>

    <br>


    <table style="width: 100%;">
        <thead style="text-align: center;">
            <tr>
                <td>PARTICULARS</td>
                <td style="width: 5%;">QTY</td>
                <td style="width: 10%;">RATE</td>
                <td style="width: 10%;">AMOUNT</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding: 0">
                    <table style="width: 100%;">
                        <tr>
                            <td colspan="2" style="text-align: center;">Advertisement Printing Fee</td>
                        </tr>
                        <tr>
                            <td style="width: 15%;">Publication Date</td>
                            <td>01 July 2025</td>
                        </tr>
                        <tr>
                            <td>Page No</td>
                            <td>01</td>
                        </tr>
                        <tr>
                            <td>Columns, Inches</td>
                            <td>Front Page Ad Placement - Main Newspaper</td>
                        </tr>
                        <tr>
                            <td>Type</td>
                            <td>Colour</td>
                        </tr>
                        <tr>
                            <td>Less / Discount</td>
                            <td>Fixed</td>
                        </tr>
                    </table>
                </td>
                <td>1</td>
                <td>Fixed</td>
                <td style="text-align: right;">15,0000</td>
            </tr>
            <tr>
                <td colspan="2">
                    <p>Thank You for your bussiness?</p>
                </td>
                <td style="padding: 0;">
                    <table style="width: 100%;">
                        <tr>
                            <td>SUBTOTAL</td>
                        </tr>
                        <tr>
                            <td>VAT(15%)</td>
                        </tr>
                        <tr>
                            <td>TOTAL</td>
                        </tr>
                        <tr>
                            <td>ADVANCE</td>
                        </tr>
                    </table>
                </td>
                <td style="padding: 0;">
                    <table style="width: 100%;">
                        <tr>
                            <td style="text-align: right;">15,000</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">2,250</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">17,250</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">0000</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">In word: Seventeen Thousand two hundred Fifty Only </td>
                <td>GRAND TOTAL:</td>
                <td style="text-align: right;">17,250</td>
            </tr>
        </tbody>
    </table>
</div>