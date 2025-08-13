<?php

namespace App\Http\Controllers\API\Backend\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertisement_Info;
use App\Models\Transaction_Main;
use App\Models\Transaction_Detail;

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
        $req->validate([
            "publication_date"  => 'required|date',
            "client"            => 'required|exists:user__infos,user_id',
            'title'             => 'required',
            'head'              => 'required',
            'page_no'           => 'required',
            'quantity'          => 'required',
            'price'             => 'required',
        ]);

        $id = GenerateTranId(1, 'Receive', 'REC');

        $insert = Advertisement_Info::create([
            "tran_id"           => $id,
            "publication_date"  => $req->publication_date,
            "client_id"         => $req->client,
            "title"             => $req->title,
            "caption"           => $req->caption,
            "category"          => $req->category,
            "page_no"           => $req->page_no,
            "column_inch"       => $req->column_inch,
            "document"          => $req->document,
            "type"              => $req->type,
        ]);


        Transaction_Main::on('mysql_second')->create([
            "tran_id"       => $id,
            "tran_type"     => 1,
            "tran_method"   => 'Receive',
            "tran_user"     => $req->client,
            "bill_amount"   => $req->total,
            "discount"      => $req->discount,
            "net_amount"    => $req->total - $req->discount,
            "receive"       => $req->advance,
            "due"           => $req->total - $req->discount - $req->advance,
            'payment_mode'  => $req->payment_method,
            'note'          => $req->note,
        ]);


        Transaction_Detail::on('mysql_second')->create([
            "tran_id" => $id,
            "tran_type" => 1,
            "tran_method" => 'Receive',
            "tran_user" => $req->client,
            "tran_groupe_id" => $req->groupe,
            "tran_head_id" => $req->head,
            "amount" => $req->price,
            "quantity" => $req->quantity,
            "tot_amount" => $req->total,
            "discount" => $req->discount,
            "receive" => $req->advance,
            "due" => $req->total - $req->discount - $req->advance,
            'payment_mode' => $req->payment_method,
        ]);

        $data = Advertisement_Info::on('mysql_second')->findOrFail($insert->id);

        return response()->json([
            'status'=> true,
            'message' => 'Added Successfully',
            'data' => $data
        ], 200); 
    }



    // Update Advertise
    public function Update(Request $req)
    {
        $req->validate([
            "publication_date"  => 'required|date',
            "user"              => 'required|exists:user__infos,user_id',
        ]);
        
        $update = Advertisement_Info::on('mysql_second')->findOrFail($req->id)->update([
            "publication_date"  => $req->publication_date,
            "client_id"         => $req->user,
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
                'message' => 'Updated Successfully',
                "updatedData" => $updatedData,
            ], 200); 
        }
    } // End Method



    // Delete 
    public function Delete(Request $req){
        $data = Advertisement_Info::on('mysql_second')->findOrFail($req->id)->delete();
        return response()->json([
            'status'=> true,
            'message' => ' Deleted Successfully',
        ], 200);
    } // End Method

    

    // Delete Status
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
