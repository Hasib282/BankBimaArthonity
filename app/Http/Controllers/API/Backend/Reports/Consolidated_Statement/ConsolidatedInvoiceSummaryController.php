<?php

namespace App\Http\Controllers\API\Backend\Reports\Consolidated_Statement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Transaction_Main;

class ConsolidatedInvoiceSummaryController extends Controller
{
    // Show All Consolidated Summary Report
    public function Show(Request $req){
        $receive = Transaction_Main::on('mysql_second')
        ->whereRaw("DATE(tran_date) < ?", [date('Y-m-d')])
        ->get()
        ->sum('receive');
        
        $payment = Transaction_Main::on('mysql_second')
        ->whereRaw("DATE(tran_date) < ?", [date('Y-m-d')])
        ->get()
        ->sum('payment');

        $opening = $receive - $payment;

        $data = Transaction_Main::on('mysql_second')
        ->with('User','Bank')
        ->select(
            'tran_user',
            DB::raw('SUM(bill_amount) as total_bill_amount'),
            DB::raw('SUM(discount) as total_discount'),
            DB::raw('SUM(net_amount) as total_net_amount'),
            DB::raw('SUM(receive) as total_receive'),
            DB::raw('SUM(payment) as total_payment'),
            DB::raw('SUM(due_col) as total_due_col'),
            DB::raw('SUM(due_disc) as total_due_disc'),
            DB::raw('SUM(due) as total_due'),
        )
        ->where(function ($query) {
            $query->where('receive', '>', 0)
                  ->orWhere('payment', '>', 0);
        })
        ->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])
        ->groupBy('tran_user')
        ->orderBy('tran_user')
        ->get();
        
        return response()->json([
            'status'=> true,
            'data' => $data,
            'opening' => $opening,
        ], 200);
    } // End Method
    
    
    // Search All Consolidated Summary Report
    public function Search(Request $req){
        $receive = Transaction_Main::on('mysql_second')
        ->whereRaw("DATE(tran_date) < ?", [$req->startDate])
        ->get()
        ->sum('receive');
        
        $payment = Transaction_Main::on('mysql_second')
        ->whereRaw("DATE(tran_date) < ?", [$req->startDate])
        ->get()
        ->sum('payment');

        $opening = $receive - $payment;

        $data = Transaction_Main::on('mysql_second')
        ->with('User','Bank')
        ->select(
            'tran_user',
            DB::raw('SUM(bill_amount) as total_bill_amount'),
            DB::raw('SUM(discount) as total_discount'),
            DB::raw('SUM(net_amount) as total_net_amount'),
            DB::raw('SUM(receive) as total_receive'),
            DB::raw('SUM(payment) as total_payment'),
            DB::raw('SUM(due_col) as total_due_col'),
            DB::raw('SUM(due_disc) as total_due_disc'),
            DB::raw('SUM(due) as total_due'),
        )
        ->where(function ($query) {
            $query->where('receive', '>', 0)
                  ->orWhere('payment', '>', 0);
        })
        // ->where('tran_type', $req->type)
        ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
        ->groupBy('tran_user')
        ->orderBy('tran_user')
        ->get();
        
        return response()->json([
            'status'=> true,
            'data' => $data,
            'opening' => $opening,
        ], 200);
    } // End Method
}
