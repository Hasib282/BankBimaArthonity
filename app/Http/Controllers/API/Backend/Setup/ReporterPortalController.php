<?php

namespace App\Http\Controllers\API\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\Reporter_Portal;
use App\Models\Employee_Personal_Detail;
use Illuminate\Http\Request;



class ReporterPortalController extends Controller
{
    /////////////////////// -----------------reporter Portal Start ----------------- //////////////////////


    public function Show(Request $req){
       /* $data = Reporter_Portal::on('mysql_second')->orderBy('added_at','asc')->get();*/
       $data = Reporter_Portal::on('mysql_second')
        ->with('Reporterinfo') // Load related Employee_Personal_Detail
        ->orderBy('added_at', 'asc')
        ->get();
        
        return response()->json([
            'status'=> true,
            'data' => $data,
        ], 200);
    } // End Method



    // Show Reporter Portal Statement

    // Insert
    public function Insert(Request $req){
        $type = GetTranType($req->segment(2));
        $req->validate([
            'reporter' => 'required',
            
        ]);

        $insert = Reporter_Portal::on('mysql_second')->create([
            'reporter_id' => $req->reporter,
            'title' => $req->title,
            'description'=> $req->description,
            'file_upload'=> $req->upload_file,
        ]);

        $data = Reporter_Portal::on('mysql_second')->with('Reporterinfo')->findOrFail($insert->id);
        
        return response()->json([
            'status'=> true,
            'message' => ' Added Successfully',
            "data" => $data,
        ], 200);  
    } // End Method



    // Update 
 /*  public function Update(Request $req){
        $req->validate([
                'reporter_id' => 'required',
                'title' => 'required',
                
                // optionally validate 'upload_file' based on your needs
            ]);

        $update = Reporter_Portal::on('mysql_second')->findOrFail($req->id)->update([
            'reporter_id' => $req->reporter_id,
            'title' => $req->title,
            'description'=> $req->description,
            'file_upload'=> $req->upload_file,
        ]);

        $updatedData = Reporter_Portal::on('mysql_second')->findOrFail($req->id);

        if($update){
            return response()->json([
                'status'=>true,
                'message' => ' Updated Successfully',
                "data" => $updatedData,
            ], 200); 
        }
    } // End <Method></Method>
     
*/

public function Update(Request $req)
{
    // Validate required fields
    $req->validate([
        
        'reporter_id' => 'required',
        'title' => 'required',
        'description' => 'required',
        'upload_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // optional, max 5MB
    ]);

    // Find the record
    $reporterPortal = Reporter_Portal::on('mysql_second')->findOrFail($req->id);

    // Prepare data for update
    $updateData = [
        'reporter_id' => $req->reporter_id,
        'title' => $req->title,
        'description' => $req->description,
    ];

    // Handle file upload if present
    if ($req->hasFile('upload_file')) {
        $file = $req->file('upload_file');
        $path = $file->store('uploads', 'mysql_second'); // adjust disk as needed
        $updateData['file_upload'] = $path;
    }

    // Perform update
    $reporterPortal->update($updateData);

    // Fetch updated data to return
    $updatedData = Reporter_Portal::on('mysql_second')->with('Reporterinfo')->findOrFail($req->id);

    return response()->json([
        'status' => true,
        'message' => 'Updated Successfully',
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