<?php

namespace App\Http\Controllers\API\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Payment_Method;

class PaymentMethodController extends Controller
{
    // Show All Payment Method
    public function Show(Request $req){
        $data = Payment_Method::on('mysql_second')->get();
        return response()->json([
            'status'=> true,
            'data' => $data,
        ], 200);
    } // End Method



    // Insert Payment Method
    public function Insert(Request $req){
        $req->validate([
            "name" => 'required|unique:mysql_second.payment__methods,name',
        ]);

        $insert = Payment_Method::on('mysql_second')->create([
            "name" => $req->name,
        ]);

        $data = Payment_Method::on('mysql_second')->findOrFail($insert->id);
        
        return response()->json([
            'status'=> true,
            'message' => 'MainHead Added Successfully',
            "data" => $data,
        ], 200);  
    } // End Method



    // Update Payment Method
    public function Update(Request $req){
        $data = Payment_Method::on('mysql_second')->findOrFail($req->id);
        
        $req->validate([
            "name" => ['required',Rule::unique('mysql_second.payment__methods', 'name')->ignore($data->id)],
        ]);

        $update = $data->update([
            "name" => $req->name,
            "updated_at" => now()
        ]);

        $updatedData = Payment_Method::on('mysql_second')->findOrFail($req->id);

        if($update){
            return response()->json([
                'status'=>true,
                'message' => 'MainHead Updated Successfully',
                "updatedData" => $updatedData,
            ], 200); 
        }
    } // End Method



    // Delete Payment Method
    public function Delete(Request $req){
        Payment_Method::on('mysql_second')->findOrFail($req->id)->delete();
        return response()->json([
            'status'=> true,
            'message' => 'MainHead Deleted Successfully',
        ], 200);
    } // End Method



    // Delete Payment Method Status
    public function DeleteStatus(Request $req){
        $data = Payment_Method::on('mysql_second')->findOrFail($req->id);
        $data->update(['status' => $data->status == 0 ? 1 : 0]);
        
        $updatedData = Payment_Method::on('mysql_second')->findOrFail($req->id);
        
        return response()->json([
            'status'=> true,
            'message' => 'Payment Method Deleted Successfully',
            'updatedData' => $updatedData
        ], 200);
    } // End Method



    // Get Transaction Main Head
    public function Get(){
        $data = Payment_Method::on('mysql_second')->select('id','name')->get();
        return response()->json([
            'status' => true,
            'data'=> $data,
        ],200);
    } // End Method
}
