<?php

namespace App\Http\Controllers\API\Backend\Users\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Transaction_With;
use App\Models\Role;

class TranWithController extends Controller
{
    // Show All Tranwith
    public function Show(Request $req){
        $type = GetTranType($req->segment(2));
        // dd($type);
        $tranwith = Transaction_With::on('mysql_second')
        ->with('Role','Type')
        ->when($type, function ($query) use ($type) { // when $type is not null
            $query->where('tran_type', $type);
        })
        ->orderBy('added_at')
        ->get();

        return response()->json([
            'status'=> true,
            'data' => $tranwith,
        ], 200);
    } // End Method



    // Insert Tranwith
    public function Insert(Request $req){
        $type = GetTranType($req->segment(2));

        $req->validate([
            "name" => 'required|unique:mysql_second.transaction__withs,tran_with_name',
            "role" => 'required|exists:mysql.roles,id',
            "tranMethod" => 'required|in:Receive,Payment,Both',
        ]);

        $insert = Transaction_With::on('mysql_second')->create([
            "tran_with_name" => $req->name,
            "user_role" => $req->role,
            "tran_type" => $type,
            "tran_method" => $req->tranMethod,
        ]);

        $data = Transaction_With::on('mysql_second')->with('Role','Type')->findOrFail($insert->id);
        
        return response()->json([
            'status'=> true,
            'message' => 'Transaction With Added Successfully',
            "data" => $data,
        ], 200);  
    } // End Method



    // Update Tranwith
    public function Update(Request $req){
        $data = Transaction_With::on('mysql_second')->findOrFail($req->id);
        $req->validate([
            "name" => ['required', Rule::unique('mysql_second.transaction__withs', 'tran_with_name')->ignore($data->id)],
            "role"  => 'required|exists:mysql.roles,id',
            "tranMethod" => 'required|in:Receive,Payment,Both',
        ]);

        $update = $data->update([
            "tran_with_name" => $req->name,
            "user_role" => $req->role,
            "tran_method" => $req->tranMethod,
            "updated_at" => now()
        ]);

        $updatedData = Transaction_With::on('mysql_second')->with('Role','Type')->findOrFail($req->id);

        if($update){
            return response()->json([
                'status'=>true,
                'message' => 'Transaction With Updated Successfully',
                "updatedData" => $updatedData,
            ], 200); 
        }
    } // End Method



    // Delete Tranwith
    public function Delete(Request $req){
        Transaction_With::on('mysql_second')->findOrFail($req->id)->delete();
        return response()->json([
            'status'=> true,
            'message' => 'Transaction With Deleted Successfully',
        ], 200); 
    } // End Method



    // Delete Tranwith Status
    public function DeleteStatus(Request $req){
        $data = Transaction_With::on('mysql_second')->findOrFail($req->id);
        $data->update(['status' => $data->status == 0 ? 1 : 0]);
        
        $updatedData = Transaction_With::on('mysql_second')->with('Role','Type')->findOrFail($req->id);
        
        return response()->json([
            'status'=> true,
            'message' => 'Tranwith Deleted Successfully',
            'updatedData' => $updatedData
        ], 200);
    } // End Method



    // Get Tran With By Transaction Method And Type
    public function Get(Request $req){
        if ($req->type == null && $req->method != null) { // Find Transaction With For Party Payment
            $data = Transaction_With::on('mysql_second')->whereIn('tran_method', [$req->method, 'Both'])->where('user_role', $req->user)->get();
        }
        else if ($req->type == null && $req->method == null) { // Find Transaction With For User Entry
            $data = Transaction_With::on('mysql_second')->where('user_role', $req->user)->get();
        }
        else if ($req->type != null && $req->method == null) { // Find Transaction With For User Entry
            $data = Transaction_With::on('mysql_second')->where('tran_type',$req->type)->where('user_role', $req->user)->get();
        }
        else {  // Find Transaction With For Transactions
            $data = Transaction_With::on('mysql_second')->whereIn('tran_method', [$req->method, 'Both'])->where('tran_type',$req->type)->get();
        }
        
        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    } // End Method
}
