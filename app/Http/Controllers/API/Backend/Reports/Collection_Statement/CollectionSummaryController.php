<?php

namespace App\Http\Controllers\API\Backend\Reports\Collection_Statement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Transaction_Main;

class CollectionSummaryController extends Controller
{
     // Show All Collection Details Statement
    public function Show(Request $req){
        $data = Transaction_Main::on('mysql_second')
        ->with('User','Bank')
        ->select(
            'tran_user',
            DB::raw('SUM(receive) as total_receive'),
        )
        ->where('receive','>',0)
        ->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])
        ->groupBy('tran_user')
        ->orderBy('tran_user')
        ->get();

        return response()->json([
            'status'=> true,
            'data' => $data,
        ], 200);
    } // End Method


        // Search Collection Details Statement
    public function Search(Request $req){
        $data = Transaction_Main::on('mysql_second')
        ->with('User','Bank')
        ->select(
            'tran_user',
            DB::raw('SUM(receive) as total_receive'),
        )
        ->where('receive','>',0)
        // ->where('tran_type', $req->type)
        ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
        ->groupBy('tran_user')
        ->orderBy('tran_user')
        ->get();
        
        return response()->json([
            'status' => true,
            'data' => $data,
        ], 200);
    } // End Method
}
