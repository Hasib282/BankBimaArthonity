<?php

namespace App\Http\Controllers\API\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Transaction_Main;
use App\Models\Bank;

class BankController extends Controller
{
    // Show All Banks
    public function ShowAll(Request $req){
        $bank = Bank::on('mysql')->with('Location')->orderBy('added_at','asc')->paginate(15);
        return response()->json([
            'status'=> true,
            'data' => $bank,
        ], 200);
    } // End Method



    // Insert Banks
    public function Insert(Request $req){
        $req->validate([
            "name" => 'required',
            "phone" => 'required|numeric|unique:mysql.banks,phone',
            "email" => 'required|email|unique:mysql.banks,email',
            "address" => 'required',
            "location" => 'required|exists:mysql.location__infos,id',
        ]);


        // Generates Auto Increment Bank Id
        $latestId = Bank::on('mysql')->orderBy('user_id','desc')->first();
        $id = ($latestId) ? 'B' . str_pad((intval(substr($latestId->user_id, 1)) + 1), 9, '0', STR_PAD_LEFT) : 'B000000001';


        Bank::insert([
            "user_id" => $id,
            "name" => $req->name,
            "phone" => $req->phone,
            "email" => $req->email,
            "loc_id" => $req->location,
            "address" => $req->address,
        ]);
        
        return response()->json([
            'status'=> true,
            'message' => 'Bank Details Added Successfully'
        ], 200);  
    } // End Method



    // Edit Banks
    public function Edit(Request $req){
        $bank = Bank::on('mysql')->with('Location')->findOrFail($req->id);
        return response()->json([
            'status'=> true,
            'bank'=> $bank,
        ], 200);
    } // End Method



    // Update Banks
    public function Update(Request $req){
        $bank = Bank::on('mysql')->findOrFail($req->id);

        $req->validate([
            "name" => 'required',
            "phone" => ['required','numeric',Rule::unique('mysql.banks', 'phone')->ignore($bank->id)],
            "email" => ['required','email',Rule::unique('mysql.banks', 'email')->ignore($bank->id)],
            "address" => 'required',
            "location" => 'required|exists:mysql.location__infos,id',
        ]);


        $update = Bank::on('mysql')->findOrFail($req->id)->update([
            "name" => $req->name,
            "phone" => $req->phone,
            "email" => $req->email,
            "loc_id" => $req->location,
            "address" => $req->address,
            "updated_at" => now(),
        ]);

        if($update){
            return response()->json([
                'status'=>true,
                'message' => 'Bank Details Updated Successfully',
            ], 200); 
        }
    } // End Method



    // Delete Banks
    public function Delete(Request $req){
        Bank::on('mysql')->findOrFail($req->id)->delete();
        return response()->json([
            'status'=> true,
            'message' => 'Bank Details Deleted Successfully',
        ], 200); 
    } // End Method



    // Search Banks
    public function Search(Request $req){
        if($req->searchOption == 1){ // Search By Name
            $bank = Bank::on('mysql')->with('Location')
            ->where('name', 'like', '%'.$req->search.'%')
            ->orderBy('name','asc')
            ->paginate(15);
        }
        else if($req->searchOption == 2){ // Search By Email
            $bank = Bank::on('mysql')->with('Location')
            ->where('email', 'like', '%'.$req->search.'%')
            ->orderBy('email','asc')
            ->paginate(15);
        }
        else if($req->searchOption == 3){ // Search By Phone
            $bank = Bank::on('mysql')->with('Location')
            ->where('phone', 'like', '%'.$req->search.'%')
            ->orderBy('phone','asc')
            ->paginate(15);
        }
        else if($req->searchOption == 4){ // Search By Location
            $bank = Bank::on('mysql')->with('Location')
            ->whereHas('Location', function ($query) use ($req) {
                $query->where('upazila', 'like', '%'.$req->search.'%');
                $query->orderBy('upazila','asc');
            })
            ->paginate(15);
        }
        else if($req->searchOption == 5){ // Search By Address
            $bank = Bank::on('mysql')->with('Location')
            ->where('address', 'like', '%'.$req->search.'%')
            ->orderBy('address','asc')
            ->paginate(15);
        }
        
        return response()->json([
            'status' => true,
            'data' => $bank,
        ], 200);
    } // End Method



    // Get Banks
    public function Get(Request $req){
        $banks = Bank::on('mysql')
        ->select('name','user_id')
        ->where('name', 'like', $req->bank.'%')
        ->orderBy('name')
        ->take(10)
        ->get();


        if($banks->count() > 0){
            $list = "";
            foreach($banks as $index => $bank) {
                $list .= '<li tabindex="' . ($index + 1) . '" data-id="'.$bank->user_id.'">'.$bank->name.'</li>';
            }
        }
        else{
            $list = '<li>No Data Found</li>';
        }
        return $list;
    } // End Method



    // Show Full Bank Details
    public function Details(Request $req){
        $bank = Bank::on('mysql')->with('Location')->where('user_id', $req->id)->first();
        $transaction = Transaction_Main::on('mysql_second')->where('tran_bank', $req->id)->get();
        return response()->json([
            'status' => true,
            'data'=>view('admin_setup.bank.details', compact('bank','transaction'))->render(),
        ]);
    } // End Method
}
