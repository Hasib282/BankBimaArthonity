<?php

namespace App\Http\Controllers\Frontend\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InventoryTransactionsController extends Controller
{
    /////////////////////////// --------------- Inventory Purchase Methods start ---------- //////////////////////////
    // Show All Purchase Details
    public function ShowInventoryPurchase(Request $req){
        $name = "Inventory Purchase";
        $js = 'inventory/inventory_transaction/inv_purchase';
        if ($req->ajax()) {
            return view('transaction.purchase.ajaxBlade', compact('name', 'js'));
        }
        else{
            return view('transaction.purchase.purchase', compact('name', 'js'));
        }
    } // End Method



    // Search Inventory Purchase
    public function SearchInventoryPurchase(Request $req){
        $name = "Inventory Purchase";
        $js = 'inventory/inventory_transaction/inv_purchase';
        return view('transaction.purchase.purchase', compact('name', 'js'));
    } // End Method
    




    /////////////////////////// --------------- Inventory Issue Methods start ---------- //////////////////////////
    // Show All Issue Details
    public function ShowInventoryIssue(Request $req){
        $name = "Inventory Issue";
        $js = 'inventory/inventory_transaction/inv_issue';
        if ($req->ajax()) {
            return view('transaction.issue.ajaxBlade', compact('name', 'js'));
        }
        else{
            return view('transaction.issue.issue', compact('name', 'js'));
        }
    } // End Method



    // Search Inventory Issue
    public function SearchInventoryIssue(Request $req){
        $name = "Inventory Issue";
        $js = 'inventory/inventory_transaction/inv_issue';
        return view('transaction.issue.issue', compact('name', 'js'));
    } // End Method
}
