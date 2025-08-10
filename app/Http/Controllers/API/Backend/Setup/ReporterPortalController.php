<?php

namespace App\Http\Controllers\API\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Reporter_Portal;


class ReporterPortalController extends Controller
{
    /////////////////////// -----------------reporter Portal Start ----------------- //////////////////////


   public function Show(Request $req)
{
    $user = Auth::user();

   if (in_array($user->user_role, [1, 2])) {
       
        $data = Reporter_Portal::on('mysql_second')
            ->whereRaw("DATE(added_at) = ?", [date('Y-m-d')])
            ->orderBy('added_at', 'asc')
            ->get();
    } else {
        
        $data = Reporter_Portal::on('mysql_second')
            ->where('reporter_id', $user->user_id)
            ->whereRaw("DATE(added_at) = ?", [date('Y-m-d')])
            ->orderBy('added_at', 'asc')
            ->get();
    }
    return response()->json([
        'status'=> true,
        'data' => $data,
    ], 200);
}


 // Insert Reporter_Portal
    public function Insert(Request $req){
        $req->validate([
            "reporter_id" => 'required||exists:mysql.user__infos,user_id',
            "title"       => 'required|string',
            "description" => 'required|string',
        ]);

        $insert = Reporter_Portal::on('mysql_second')->create([
            "reporter_id" => $req->reporter_id,
            "title"       => $req->title,
            "description" => $req->description,
            "file_upload" => $req->file_upload ?? '',
        ]);

        $data = Reporter_Portal::on('mysql_second')->findOrFail($insert->id);
        
        return response()->json([
            'status'=> true,
            'message' => 'Reporter Portal Entry Added Successfully',
            "data" => $data,
        ], 200);  
    } // End Method

    // Update Payment Method
    public function Update(Request $req){
        $data = Reporter_Portal::on('mysql_second')->findOrFail($req->id);
        
        $req->validate([
            "reporter_id" => 'required|exists:mysql.user__infos,user_id',
            "title"       => 'required|string',
            "description" => 'required|string',
        ]);

        $update = $data->update([
            "reporter_id" => $req->reporter_id,
            "title"       => $req->title,
            "description" => $req->description,
            "file_upload" => $req->file_upload ?? $data->file_upload,
            "updated_at"  => now(),
        ]);

        $updatedData = Reporter_Portal::on('mysql_second')->findOrFail($req->id);

        return response()->json([
            'status'      => true,
            'message'     => 'Reporter Portal Entry Updated Successfully',
            'updatedData' => $updatedData,
        ], 200);
    }

    //  Delete Reporter Portal
    public function Delete(Request $req)
    {
        Reporter_Portal::on('mysql_second')->findOrFail($req->id)->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Reporter Portal Entry Deleted Successfully',
        ], 200);
    }

}
