<?php

namespace App\Http\Controllers\API\Backend\Reports\Payment_Statement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Transaction_Main;

class PaymentInvoiceSummaryController extends Controller
{
    // Show All Payment Summary Report
    public function Show(Request $req){
        $data = Transaction_Main::on('mysql_second')
        ->with('User','Bank')
        ->select(
            'tran_user',
            DB::raw('SUM(bill_amount) as total_bill_amount'),
            DB::raw('SUM(discount) as total_discount'),
            DB::raw('SUM(net_amount) as total_net_amount'),
            DB::raw('SUM(payment) as total_payment'),
            DB::raw('SUM(due_col) as total_due_col'),
            DB::raw('SUM(due_disc) as total_due_disc'),
            DB::raw('SUM(due) as total_due'),
        )
        ->where('payment','>',0)
        ->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])
        ->groupBy('tran_user')
        ->orderBy('tran_user')
        ->get();
        
        return response()->json([
            'status'=> true,
            'data' => $data,
        ], 200);
    } // End Method
    
    
    
    // Search All Payment Summary Report
    public function Search(Request $req){
        $data = Transaction_Main::on('mysql_second')
        ->with('User','Bank')
        ->select(
            'tran_user',
            DB::raw('SUM(bill_amount) as total_bill_amount'),
            DB::raw('SUM(discount) as total_discount'),
            DB::raw('SUM(net_amount) as total_net_amount'),
            DB::raw('SUM(payment) as total_payment'),
            DB::raw('SUM(due_col) as total_due_col'),
            DB::raw('SUM(due_disc) as total_due_disc'),
            DB::raw('SUM(due) as total_due'),
        )
        ->where('payment','>',0)
        // ->where('tran_type', $req->type)
        ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
        ->groupBy('tran_user')
        ->orderBy('tran_user')
        ->get();
        
        return response()->json([
            'status'=> true,
            'data' => $data,
        ], 200);
    } // End Method
}
