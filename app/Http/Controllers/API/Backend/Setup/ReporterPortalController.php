<?php

namespace App\Http\Controllers\API\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Reporter_Portal;
use App\Models\Employee_Personal_Detail;

class ReporterPortalController extends Controller
{
    // Show All Reporter_Portal Data
    public function Show(Request $req)
    {
        $user = Auth::user();

        if (in_array($user->user_role, [1, 2])) {
            $data = Reporter_Portal::on('mysql_second')
            ->with('Reporterinfo')
            ->whereRaw("DATE(added_at) = ?", [date('Y-m-d')])
            ->orderBy('added_at', 'asc')
            ->get();
        } 
        else {
            $data = Reporter_Portal::on('mysql_second')
            ->with('Reporterinfo')
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
            "reporter"    => 'required||exists:mysql.user__infos,user_id',
            "title"       => 'required|string',
            "description" => 'required|string',
            'upload_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        // Prepare data for update
        $updateData = [
            'reporter_id' => $req->reporter_id,
            'title' => $req->title,
            'description' => $req->description,
        ];

        $insert = Reporter_Portal::on('mysql_second')->create([
            "reporter_id" => $req->reporter,
            "title"       => $req->title,
            "description" => $req->description,
            "file_upload" => $req->file_upload ?? '',
        ]);

        $data = Reporter_Portal::on('mysql_second')->with('Reporterinfo')->findOrFail($insert->id);
        
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
            "reporter" => 'required|exists:mysql.user__infos,user_id',
            "title"       => 'required|string',
            "description" => 'required|string',
            'upload_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $update = $data->update([
            "reporter_id" => $req->reporter,
            "title"       => $req->title,
            "description" => $req->description,
            "file_upload" => $req->file_upload ?? $data->file_upload,
            "updated_at"  => now(),
        ]);

        $updatedData = Reporter_Portal::on('mysql_second')->with('Reporterinfo')->findOrFail($req->id);

        return response()->json([
            'status'      => true,
            'message'     => 'Reporter Portal Entry Updated Successfully',
            'updatedData' => $updatedData,
        ], 200);
    }


    
    // Delete 
    public function Delete(Request $req){
        Reporter_Portal::on('mysql_second')->findOrFail($req->id)->delete();
        return response()->json([
            'status'=> true,
            'message' => ' Deleted Successfully',
        ], 200); 
    } // End Method



    // Delete Item/Product Category Status
    public function DeleteStatus(Request $req){
        $data = Reporter_Portal::on('mysql_second')->findOrFail($req->id);
        $data->update(['status' => $data->status == 0 ? 1 : 0]);
        
        $updatedData = Reporter_Portal::on('mysql_second')->findOrFail($req->id);
        
        return response()->json([
            'status'=> true,
            'message' => ' Deleted Successfully',
            'data' => $updatedData
        ], 200);
    } // End Method



    // Get  By Name
    public function Get(Request $req){
        $data = Employee_Personal_Detail::on("mysql_second")
        ->where('tran_user_type',1)
        // ->where('tran_user_type','like', $req->type.'%')
        ->where('employee_id','like', $req->search.'%')
        ->orWhere('name','like', $req->search.'%')
        ->orderBy('name')
        ->take(15)
        ->get();


        $list = "<ul>";
            if($data->count() > 0){
                foreach($data as $index => $item) {
                    $list .= '<li tabindex="' . ($index + 1) . '" data-id="'.$item->employee_id.'">'.$item->name.'</li>';
                }
            }
            else{
                $list .= '<li>No Data Found</li>';
            }
        $list .= "</ul>";
        return $list;
    } // End Method

}