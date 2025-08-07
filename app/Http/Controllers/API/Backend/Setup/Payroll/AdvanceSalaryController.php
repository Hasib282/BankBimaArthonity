<?php

namespace App\Http\Controllers\API\Backend\Setup\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Transaction_Detail; 
use App\Models\Transaction_Main;
use App\Models\Advance_Salary;

class AdvanceSalaryController extends Controller
{
    // Show All AdvanceSalary
    public function Show(Request $req){
        $data = Advance_Salary::on('mysql_second')
        ->with('Employee')
        ->where('payment_date', 'like', date('Y-m-d') .'%')
        ->orderBy('payment_date')
        ->get();

        return response()->json([
            'status'=> true,
            'data' => $data,
        ], 200);
    } // End Method



    // Insert AdvanceSalary
    public function Insert(Request $req){
        $req->validate([
            "emp_id" => 'required|exists:mysql_second.employee__personal__details,employee_id',
            "amount" => 'required|numeric',
            "months" => 'required|array',
            "month" => 'required',
            "method" => 'required|in:Full,Installment',
            "installment_amount" => 'nullable|numeric|lte:amount',
            "payment_date" => 'required|date',
        ]);

        // dd($req->months);
        $id = GenerateTranId(3, 'Payment', 'PRP');

        $insert = Advance_Salary::on('mysql_second')->create([
            "emp_id" => $req->emp_id,
            "amount" => $req->amount,
            "months" => json_encode($req->months),
            "start_month" => $req->month,
            "reason" => $req->reason,
            "repayment_method" => $req->method,
            "installment_amount" => $req->method == 'Full' ? 0 : $req->installment_amount,
            "due" => $req->amount,
            "approved_by" => $req->approved_by,
            "payment_date" => $req->payment_date,
            "tran_id" => $id,
        ]);

        Transaction_Detail::on('mysql_second')->insert([
            'tran_id'=>$id,
            'tran_type'=> '3',
            'tran_method'=> 'Payment',
            'tran_type_with'=> $req->type,
            'tran_user'=> $req->emp_id,
            'tran_groupe_id'=> '1',
            'tran_head_id'=> 7,
            'quantity'=> 1,
            'amount'=> $req->amount,
            'tot_amount'=> $req->amount,
            'payment'=> $req->amount,
        ]);

        Transaction_Main::on('mysql_second')->create([
            'tran_id'=>$id,
            'tran_type'=> '3',
            'tran_method'=> 'Payment',
            'tran_type_with'=> $req->type,
            'tran_user'=> $req->emp_id,
            'bill_amount'=> $req->amount,
            'discount'=> 0,
            'net_amount'=> $req->amount,
            'payment'=> $req->amount,
            'due'=> 0,
        ]);

        $data = Advance_Salary::on('mysql_second')->with('Employee')->findOrFail($insert->id);

        return response()->json([
            'status'=> true,
            'message' => 'Advance Salary Added Successfully',
            "data" => $data,
        ], 200);
    } // End Method



    // Update Payroll Setup
    public function Update(Request $req){
        $req->validate([
            "emp_id" => 'required|exists:mysql_second.employee__personal__details,employee_id',
            "amount" => 'required|numeric',
            "months.*" => 'required',
            "month" => 'required',
            "method" => 'required|in:Full,Installment',
            "installment_amount" => 'required|numeric',
            "payment_date" => 'required|date',
        ]);

        $data = Advance_Salary::on('mysql_second')->findOrFail($req->id);

        $update = $data->update([
            "emp_id" => $req->emp_id,
            "amount" => $req->amount,
            "months" => json_encode($req->months),
            "start_month" => $req->month,
            "reason" => $req->reason,
            "repayment_method" => $req->method,
            "installment_amount" => $req->installment_amount,
            "due" => $req->amount,
            "approved_by" => $req->approved_by,
            "payment_date" => $req->payment_date,
        ]);

        Transaction_Detail::on('mysql_second')->where('tran_id',$data->tran_id)->update([
            'tran_type_with'=> $req->type,
            'tran_user'=> $req->emp_id,
            'amount'=> $req->amount,
            'tot_amount'=> $req->amount,
            'payment'=> $req->amount,
        ]);

        Transaction_Main::on('mysql_second')->where('tran_id',$data->tran_id)->update([
            'tran_type_with'=> $req->type,
            'tran_user'=> $req->emp_id,
            'bill_amount'=> $req->amount,
            'net_amount'=> $req->amount,
            'payment'=> $req->amount,
        ]);


        $updatedData = Advance_Salary::on('mysql_second')->with('Employee')->findOrFail($req->id);

        if($update){
            return response()->json([
                'status'=>true,
                'message' => 'Advance Salary Updated Successfully',
                "updatedData" => $updatedData,
            ], 200);
        }
    } // End Method



    // Delete Payroll Setup
    public function Delete(Request $req){
        $data = Advance_Salary::on('mysql_second')->findOrFail($req->id);
        $details = Transaction_Detail::on('mysql_second')->where('tran_id',$data->tran_id)->delete();
        $main = Transaction_Main::on('mysql_second')->where('tran_id',$data->tran_id)->delete();

        $data->delete();
        return response()->json([
            'status'=> true,
            'message' => 'Advance Salary Deleted Successfully',
        ], 200); 
    } // End Method



    // Delete Payroll Setup Status
    public function DeleteStatus(Request $req){
        $data = Advance_Salary::on('mysql_second')->findOrFail($req->id);
        $details = Transaction_Detail::on('mysql_second')->where('tran_id',$data->tran_id);
        $main = Transaction_Main::on('mysql_second')->where('tran_id',$data->tran_id);

        $details->update(['status' => $data->status == 0 ? 1 : 0]);
        $main->update(['status' => $data->status == 0 ? 1 : 0]);
        $data->update(['status' => $data->status == 0 ? 1 : 0]);
        
        $updatedData = Advance_Salary::on('mysql_second')->with('Employee')->findOrFail($req->id);
        
        return response()->json([
            'status'=> true,
            'message' => 'Advance Salary Deleted Successfully',
            'updatedData' => $updatedData
        ], 200);
    } // End Method



    // Search Advance Salary
    public function Search(Request $req){
        $data = Advance_Salary::on('mysql_second')
        ->with('Employee')
        ->whereRaw("DATE(payment_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
        ->orderBy('payment_date')
        ->get();
        
        return response()->json([
            'status' => true,
            'data' => $data,
        ], 200);
    } // End Method



    // // Get Payroll Category
    // public function Get(){
    //     $data = Transaction_Head::on('mysql_second')->where('groupe_id','1')->select('id','tran_head_name')->get();
    //     return response()->json([
    //         'status' => true,
    //         'data'=> $data,
    //     ],200);
    // } // End Method
}
