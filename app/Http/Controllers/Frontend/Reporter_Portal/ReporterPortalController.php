<?php

namespace App\Http\Controllers\Frontend\Reporter_Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class ReporterPortalController extends Controller
{
    /////////////////////// -----------------reporter Portal Start ----------------- //////////////////////

    // Show Reporter Portal Statement
    public function ShowReporterPortal(Request $req)
    {
        $name = "Reporter Portal";
        $js = 'reporter_portal/reporter_portal';

        if ($req->ajax()) {
            return view('reporter_portal.ajaxBlade', compact('name', 'js'));
        } else {
            return view('reporter_portal.main', compact('name', 'js'));
        }
    } // End Method

    // Reporter Portal Statement Search
    public function SearchReporterPortal(Request $req)
    {
        $name = "Reporter Portal";
        $js = 'reporter_portal/reporter_portal';

        return view('reporter_portal.main', compact('name', 'js'));
    } // End Method
}