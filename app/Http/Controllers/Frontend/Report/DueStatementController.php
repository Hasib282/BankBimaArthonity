<?php

namespace App\Http\Controllers\Frontend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DueStatementController extends Controller
{
    ///////////////////////// --------------------------- Due Invoice Statement Summary Report Part Start -------------------- /////////////////////////
    // Show Due Summary Statement
    public function DueSummary(Request $req) {
        $name = "Due Statement Summary";
        $js = 'due_statement/summary';
        if ($req->ajax()) {
            return view('reports.due_statement.summary.ajaxBlade', compact('name', 'js'));
        }
        else{
            return view('reports.due_statement.summary.main', compact('name', 'js'));
        }
    } // End Method


    // Search Due Details Statement
    public function DueDetails(Request $req) {
        $name = "Due Statement Details";
        $js = 'due_statement/details';
        if ($req->ajax()) {
            return view('reports.due_statement.details.ajaxBlade', compact('name', 'js'));
        }
        else{
            return view('reports.due_statement.details.main', compact('name', 'js'));
        }
    } // End Method
    
    



    ///////////////////////// --------------------------- Due Invoice Statement Summary Report Part Start -------------------- /////////////////////////
    // Show Invoice Due Summary Statement
    public function DueInvoiceSummary(Request $req) {
        $name = "Due Invoice Statement Summary";
        $js = 'due_statement/invoice_summary';
        if ($req->ajax()) {
            return view('reports.due_statement.summary.ajaxBlade', compact('name', 'js'));
        }
        else{
            return view('reports.due_statement.summary.main', compact('name', 'js'));
        }
    } // End Method


    // Search Invoice Due Details Statement
    public function DueInvoiceDetails(Request $req) {
        $name = "Due Invoice Statement Details";
        $js = 'due_statement/invoice_details';
        if ($req->ajax()) {
            return view('reports.due_statement.details.ajaxBlade', compact('name', 'js'));
        }
        else{
            return view('reports.due_statement.details.main', compact('name', 'js'));
        }
    } // End Method

}
