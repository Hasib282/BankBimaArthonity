<?php

namespace App\Http\Controllers\API\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\Reporter_Portal;
use Illuminate\Http\Request;



class ReporterPortalController extends Controller
{
    /////////////////////// -----------------reporter Portal Start ----------------- //////////////////////


      public function Show(Request $req){
        $data = Reporter_Portal::on('mysql_second')->orderBy('added_at','asc')->get();
        return response()->json([
            'status'=> true,
            'data' => $data,
        ], 200);
    } // End Method

    // Show Reporter Portal Statement
   
}