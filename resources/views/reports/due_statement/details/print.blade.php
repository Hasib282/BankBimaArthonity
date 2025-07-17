{{----------------------------------------------------- Common Part Of The Report Starts From Here -------------------------------------}}
<style>
    .show-table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        font-size: 13px;
    }

    .show-table td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 2px 4px;
    }
</style>

<div style="text-align: center; width: 100%; margin: 0 auto;">
    <p style="margin-bottom: 10px;font-size:25px;">
        <strong>{{ auth()->user()->company ? auth()->user()->company->company_name : 'Team-Solutions-Bangladesh' }}</strong>
    </p>
    <p style="margin: 0 auto; max-width: 35%;">
        {{ auth()->user()->company ? auth()->user()->company->address : '12th floor, 28 Kazi Nazrul Islam Ave, Banglamotor, Dhaka 1000' }} <br>
        Phone no: {{ auth()->user()->company ? auth()->user()->company->company_phone : '01314353560' }}
    </p>
    <p style="margin-top: 10px;">
        <strong style="font-size: 25px;">{{ $report_name }}</strong> <br>
    </p>
    <p>
        <strong>As on:</strong>
        @if($start_date == $end_date)
             {{ $start_date }}
        @else
            {{ $start_date }} - {{ $end_date }}
        @endif
    </p>
</div>

{{----------------------------------------------------- Common Part Of The Report Ends At Here -----------------------------------------}}



{{----------------------------------------------------- Dynamic Part Of The Report Starts From Here ------------------------------------}}
{{-- <table class="show-table">
    <thead>
        <tr>
            <th style="width:4%">SL:</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $key => $item)

        @endforeach
    </tbody>
    <tfoot></tfoot>
</table> --}}


<table class="show-table">
    <thead>
        <tr>
            <th style="text-align: right;">Opening Balance</th>
            <th></th>
            <th style="text-align: right; width:14%;" id="opening">{{ number_format($data['opening']['total_receive'] - $data['opening']['total_payment'], 2) }}</th>
        </tr>
    </thead>
    <tbody>
        @php
            $grandReceive = 0;
            $grandPayment = 0;
        @endphp

        @foreach ($data as $title => $datas)
            @if ($title != 'opening' && $title != 'status' && !$datas->isEmpty())
                @php
                    $totalReceive = 0;
                    $totalPayment = 0;
                    $lastGroupeId = null;
                    $lastTranId = null;
                @endphp

                <tr>
                    <td colspan="3">
                        <table class="show-table" style="margin:20px 0;">
                            <caption style="text-align: left;font-size:18px;"><strong>{{ $title }} Transaction</strong></caption>
                            <thead>
                                <tr>
                                    <th style="width: 5%;">SL:</th>
                                    <th style="width: 10%;">Tran Id</th>
                                    <th style="text-align: center; width:20%;">Groupe</th>
                                    <th style="text-align: center; width:40%;">Product/Service</th>
                                    <th style="text-align: center; width:12%;">Receive</th>
                                    <th style="text-align: center; width:12%;">Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $key => $item)
                                    @php
                                        $totalReceive += $item->receive;
                                        $totalPayment += $item->payment;
                                    @endphp

                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->tran_id != $lastTranId ? $item->tran_id : '' }}</td>
                                        <td>{{ $item->tran_id != $lastTranId && $item->tran_groupe_id != $lastGroupeId ? $item->groupe->tran_groupe_name : '' }}</td>
                                        <td>{{ $item->head->tran_head_name }}</td>
                                        <td style="text-align: right">{{ number_format($item->receive, 2) }}</td>
                                        <td style="text-align: right">{{ number_format($item->payment, 2) }}</td>
                                    </tr>

                                    @php
                                        $lastTranId = $item->tran_id;
                                        $lastGroupeId = $item->tran_groupe_id;
                                    @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" style="text-align: right">Sub Total:</td>
                                    <td style="text-align: right;">{{ number_format($totalReceive, 2) }}</td>
                                    <td style="text-align: right;">{{ number_format($totalPayment, 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </td>
                </tr>

                @php
                    $grandReceive += $totalReceive;
                    $grandPayment += $totalPayment;
                @endphp
            @endif
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td style="text-align: right;">Grand Total:</td>
            <td style="text-align: right; width:14%;" id="grandReceive">{{ number_format($grandReceive, 2) }}</td>
            <td style="text-align: right; width:14%;" id="grandPayment">{{ number_format($grandPayment, 2) }}</td>
        </tr>
        <tr>
            <td style="text-align: right;">Closing Balance</td>
            <td></td>
            <td style="text-align: right; width:14%;" id="closing">{{ number_format($data['opening']['total_receive'] - $data['opening']['total_payment'] - ($grandReceive - $grandPayment), 2) }}</td>
        </tr>
    </tfoot>
</table>
{{----------------------------------------------------- Dynamic Part Of The Report Ends At Here ----------------------------------------}}