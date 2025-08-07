<?php

namespace App\Http\Controllers\Frontend\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Attendence; 
use App\Models\User_Info; 
use App\Models\Transaction_With; 
use App\Models\Transaction_Head; 
use App\Models\Transaction_Main; 
use App\Models\Transaction_Detail; 
use App\Models\Pay_Roll_Setup; 
use App\Models\Pay_Roll_Middlewire; 
use App\Models\Pay_Roll_Setup_Additional; 


class PayRollController extends Controller
{
    /////////////// ----------------------- Payroll Setup Part Start Here ------------------- ////////////////
    // Show Payroll Setup
    public function ShowPayrollSetup(Request $req){
        $name = "Payroll Setup";
        if ($req->ajax()) {
            return view('hr.payroll.payroll_setup.ajaxBlade', compact('name'));
        }
        else{
            return view('hr.payroll.payroll_setup.main', compact('name'));
        }
    } // End Method





    /////////////// ----------------------- Payroll Middlewire Part Start Here ------------------- ////////////////
    // Show Payroll Miiddlewire
    public function ShowPayrollMiddlewire(Request $req){
        $name = "Payroll Middlewire";
        if ($req->ajax()) {
            return view('hr.payroll.payroll_middlewire.ajaxBlade', compact('name'));
        }
        else{
            return view('hr.payroll.payroll_middlewire.main', compact('name'));
        }
    } // End Method





    /////////////// ----------------------- Advance Salary Part Start Here ------------------- ////////////////
    // Show Advance Salary
    public function ShowAdvanceSalary(Request $req){
        $name = "Advance Salary";
        if ($req->ajax()) {
            return view('hr.payroll.advance_salary.ajaxBlade', compact('name'));
        }
        else{
            return view('hr.payroll.advance_salary.main', compact('name'));
        }
    } // End Method
    




    ////////////// ------------------------ Payroll Process Part Start Here --------------------- ////////////////////////////
    // Show Payroll
    public function ShowPayroll(Request $req){
        $name = "Salary Process";
        if ($req->ajax()) {
            return view('hr.payroll.payroll_installment.ajaxBlade', compact('name'));
        }
        else{
            return view('hr.payroll.payroll_installment.main', compact('name'));
        }
    } // End Method
}
