<?php

namespace App\Http\Controllers\API\Backend\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertisement_Info;

class AdvertisementPublishController extends Controller{
      // Show All Advertise
    public function Show(Request $req){
        $data = Advertisement_Info::on('mysql_second')->orderBy('added_at','asc')->get();
        return response()->json([
            'status'=> true,
            'data' => $data,
        ], 200);
    } // End Method


       // Insert Advertise
   public function Insert(Request $req){
    // 1. Validation rules
    $req->validate([
        "tran_id"           => 'nullable|numeric',
        "publication_date"  => 'required|date', // better to use date instead of numeric
        "client_id"         => 'nullable',
        "title"             => 'required|string',
        "caption"           => 'nullable|string',
        "category"          => 'required|string',
        "page_no"           => 'nullable|string',
        "column_inch"       => 'nullable|string',
        "document"          => 'nullable|string',
        "type"              => 'required|string',
        "discount"          => 'nullable|numeric',
    ]);

    // 2. Insert into DB
    Advertisement_Info::create([
        "tran_id"           => $req->tran_id,
        "publication_date"  => $req->publication_date,
        "client_id"         => $req->client_id,
        "title"             => $req->title,
        "caption"           => $req->caption,
        "category"          => $req->category,
        "page_no"           => $req->page_no,
        "column_inch"       => $req->column_inch,
        "document"          => $req->document,
        "type"              => $req->type,
        "discount"          => $req->discount,
    ]);

    return response()->json([
            'status'=> true,
            'message' => 'Bank Details Added Successfully',
           
        ], 200); 
}


    // Update Advertise
    public function Update(Request $req)
    {
        // 1. Validate input
        $req->validate([
            "publication_date"  => 'required|date',
            "client_id"         => 'nullable',
            "title"             => 'required|string',
            "caption"           => 'nullable|string',
            "category"          => 'required|string',
            "page_no"           => 'nullable|string',
            "column_inch"       => 'nullable|string',
            "type"              => 'required|string',
            "discount"          => 'nullable|numeric',
        ]);

        // 2. Find and update
        $update = Advertisement_Info::on('mysql_second')->findOrFail($req->id)->update([
            "publication_date"  => $req->publication_date,
            "client_id"         => $req->client_id,
            "title"             => $req->title,
            "caption"           => $req->caption,
            "category"          => $req->category,
            "page_no"           => $req->page_no,
            "column_inch"       => $req->column_inch,
            "type"              => $req->type,
            "discount"          => $req->discount,
        ]);
        
        $updatedData = Advertisement_Info::on('mysql_second')->findOrFail($req->id);

        if($update){
            return response()->json([
                'status'=>true,
                'message' => 'Category Updated Successfully',
                "updatedData" => $updatedData,
            ], 200); 
        }
    }




     // Delete 
    public function Delete(Request $req){
        $data = Advertisement_Info::on('mysql_second')->findOrFail($req->id)->delete();
        return response()->json([
            'status'=> true,
            'message' => ' Deleted Successfully',
        ], 200);
    } // End Method


    


   // Delete I Status
    public function DeleteStatus(Request $req){
        $data = Advertisement_Info::on('mysql_second')->findOrFail($req->id);
        $data->update(['status' => $data->status == 0 ? 1 : 0]);
        
        $updatedData = Advertisement_Info::on('mysql_second')->findOrFail($req->id);
        
        return response()->json([
            'status'=> true,
            'message' => ' Deleted Successfully',
            'updatedData' => $updatedData
        ], 200);
    } // End Method
}
