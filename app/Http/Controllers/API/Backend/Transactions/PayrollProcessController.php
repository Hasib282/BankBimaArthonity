<?php

namespace App\Http\Controllers\API\Backend\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\User_Info; 
use App\Models\Transaction_With;
use App\Models\Transaction_Main; 
use App\Models\Transaction_Detail; 
use App\Models\Payroll_Setup; 
use App\Models\Payroll_Middlewire;
use App\Models\Transaction_Head;
use App\Models\Advance_Salary;

class PayrollProcessController extends Controller
{
    // Show All Payroll Process
    public function Show(Request $req){
        $currentYear = Carbon::now()->year; 
        $currentMonth = Carbon::now()->month;
        $data = Payroll_Setup::on('mysql_second')->with('Employee')
        ->select('emp_id', 'amount', \DB::raw('NULL as date'))
        ->unionall(
            Payroll_Middlewire::on('mysql_second')->select('emp_id', 'amount', 'date')
                ->whereYear('date', $currentYear)
                ->whereMonth('date', $currentMonth)
                ->orWhereNull('date')
        )
        ->orderBy('emp_id')
        ->get()
        ->groupBy('emp_id')
        ->map(function ($group) {
            return [
                'emp_id' => $group->first()->emp_id,
                'emp_name' => $group->first()->employee->user_name,
                'salary' => $group->sum('amount')
            ];
        })
        ->values();
        
        $tranwith = Transaction_With::on('mysql_second')->where('user_role', 3)->get();

        return response()->json([
            'status'=> true,
            'data' => $data,
            'tranwith' => $tranwith,
        ], 200);
    } // End Method



    // Insert Payroll Process
    public function Insert(Request $req){
        $employees = User_Info::on('mysql_second')->select('user_id','user_name','tran_user_type')->where('user_role', 3)->orderBy('added_at','asc')->get();

        if(!$employees->isEmpty()){
            $currentYear = $req->year;
            $currentMonth = $req->month;

            $details = Transaction_Detail::on('mysql_second')
            ->where('tran_type', '3')
            ->whereNotIn('tran_head_id','7')
            ->where(function ($query) use ($currentYear, $currentMonth) {
                $query->whereYear('tran_date', $currentYear)
                    ->whereMonth('tran_date', $currentMonth)
                    ->orWhereNull('tran_date');
            })
            ->first();

            if($details){
                return response()->json([
                    'status' => false,
                    'message' => "You have already process the salary process the salary",
                ]);
            }

            foreach ($employees as $employee) {
                $payrolls = Payroll_Setup::on('mysql_second')->select('emp_id','head_id','amount',\DB::raw('0 as date'))
                ->where('emp_id', $employee->user_id)
                ->unionall(
                    Payroll_Middlewire::on('mysql_second')->select('emp_id','head_id','amount','date')
                    ->where('emp_id', $employee->user_id)
                    ->where(function ($query) use ($currentYear, $currentMonth) {
                        $query->whereYear('date', $currentYear)
                            ->whereMonth('date', $currentMonth)
                            ->orWhereNull('date');
                    })
                )
                ->orderBy('emp_id')
                ->get();

                $id = GenerateTranId(3, 'Payment', 'PRP');

                if($payrolls->count() > 0){
                    $salary = 0;
                    $transactionDetails = [];
                    
                    foreach ($payrolls as $payroll) {
                        $salary += $payroll->amount; 
                        
                        $transactionDetails[] = [
                            'tran_id'=>$id,
                            'tran_type'=> '3',
                            'tran_method'=> 'Payment',
                            'tran_type_with'=> $employee->tran_user_type,
                            'tran_user'=> $employee->user_id,
                            'tran_groupe_id'=> '1',
                            'tran_head_id'=> $payroll->head_id,
                            'quantity'=> '1',
                            'amount'=> $payroll->amount,
                            'tot_amount'=> $payroll->amount,
                            'payment'=> $payroll->amount,
                        ];
                    }

                    Transaction_Detail::on('mysql_second')->insert($transactionDetails);

                    Transaction_Main::on('mysql_second')->create([
                        'tran_id'=>$id,
                        'tran_type'=> '3',
                        'tran_method'=> 'Payment',
                        'tran_type_with'=> $employee->tran_user_type,
                        'tran_user'=> $employee->user_id,
                        'bill_amount'=> $salary,
                        'discount'=> 0,
                        'net_amount'=> $salary,
                        'payment'=> $salary,
                        'due'=> 0,
                    ]);

                    $advance = Advance_Salary::on('mysql_second')
                    ->where('emp_id',$employee->user_id)
                    ->where('due','>',0)
                    ->get();

                    if($advance->count() > 0 && $salary > 0){
                        
                        foreach ($advance as $item) {
                            $id = GenerateTranId(3, 'Receive', 'PRR');
                            
                            if ($salary <= 0) break;

                            $repayAmount = 0;

                            if ($item->repayment_method == "Full") {
                                $repayAmount = min($salary, $item->due);
                            }
                            elseif ($item->repayment_method == "Installment") {
                                if ($item->installment_amount > $salary) {
                                    $repayAmount = min($salary, $item->due);
                                } else {
                                    $repayAmount = min($item->installment_amount, $item->due);
                                }
                            }


                            if ($repayAmount > 0) {
                                ProcessRepayment($id, $employee, $repayAmount, $item);
                                $salary -= $repayAmount;
                            }


                            // Process Advance Salary Repayment for repayment method Full 
                            // if($item->repayment_method == "Full" && $salary > 0){
                            //     if($item->due > $salary){
                            //         Transaction_Detail::on('mysql_second')->insert([
                            //             'tran_id'=>$id,
                            //             'tran_type'=> '3',
                            //             'tran_method'=> 'Receive',
                            //             'tran_type_with'=> $employee->tran_user_type,
                            //             'tran_user'=> $employee->user_id,
                            //             'tran_groupe_id'=> '1',
                            //             'tran_head_id'=> '8',
                            //             'quantity'=> '1',
                            //             'amount'=> $salary,
                            //             'tot_amount'=> $salary,
                            //             'receive'=> $salary,
                            //         ]);

                            //         Transaction_Main::on('mysql_second')->create([
                            //             'tran_id'=>$id,
                            //             'tran_type'=> '3',
                            //             'tran_method'=> 'Receive',
                            //             'tran_type_with'=> $employee->tran_user_type,
                            //             'tran_user'=> $employee->user_id,
                            //             'bill_amount'=> $salary,
                            //             'discount'=> 0,
                            //             'net_amount'=> $salary,
                            //             'receive'=> $salary,
                            //             'due'=> 0,
                            //         ]);

                            //         Advance_Salary::on('mysql_second')->findOrFail($item->id)->update([
                            //             'due' => $item->due - $salary,
                            //             'updated_at' => now()
                            //         ]);

                            //         $salary = 0;
                            //     }
                            //     else{
                            //         Transaction_Detail::on('mysql_second')->insert([
                            //             'tran_id'=>$id,
                            //             'tran_type'=> '3',
                            //             'tran_method'=> 'Receive',
                            //             'tran_type_with'=> $employee->tran_user_type,
                            //             'tran_user'=> $employee->user_id,
                            //             'tran_groupe_id'=> '1',
                            //             'tran_head_id'=> '8',
                            //             'quantity'=> '1',
                            //             'amount'=> $item->due,
                            //             'tot_amount'=> $item->due,
                            //             'receive'=> $item->due,
                            //         ]);

                            //         Transaction_Main::on('mysql_second')->create([
                            //             'tran_id'=>$id,
                            //             'tran_type'=> '3',
                            //             'tran_method'=> 'Receive',
                            //             'tran_type_with'=> $employee->tran_user_type,
                            //             'tran_user'=> $employee->user_id,
                            //             'bill_amount'=> $item->due,
                            //             'discount'=> 0,
                            //             'net_amount'=> $item->due,
                            //             'receive'=> $item->due,
                            //             'due'=> 0,
                            //         ]);

                            //         Advance_Salary::on('mysql_second')->findOrFail($item->id)->update([
                            //             'due' => 0,
                            //             'updated_at' => now()
                            //         ]);

                            //         $salary -= $item->due;
                            //     }
                            // }



                            // Process Advance Salary Repayment for repayment method Installment 
                            // else if($item->repayment_method == "Installment" && $salary > 0){
                            //     // if installment amount is greater than salary
                            //     if($item->installment_amount > $salary){
                            //         // if installment amount is less than due
                            //         if($item->installment_amount < $item->due){
                            //             Transaction_Detail::on('mysql_second')->insert([
                            //                 'tran_id'=>$id,
                            //                 'tran_type'=> '3',
                            //                 'tran_method'=> 'Receive',
                            //                 'tran_type_with'=> $employee->tran_user_type,
                            //                 'tran_user'=> $employee->user_id,
                            //                 'tran_groupe_id'=> '1',
                            //                 'tran_head_id'=> '8',
                            //                 'quantity'=> '1',
                            //                 'amount'=> $salary,
                            //                 'tot_amount'=> $salary,
                            //                 'receive'=> $salary,
                            //             ]);

                            //             Transaction_Main::on('mysql_second')->create([
                            //                 'tran_id'=>$id,
                            //                 'tran_type'=> '3',
                            //                 'tran_method'=> 'Receive',
                            //                 'tran_type_with'=> $employee->tran_user_type,
                            //                 'tran_user'=> $employee->user_id,
                            //                 'bill_amount'=> $salary,
                            //                 'discount'=> 0,
                            //                 'net_amount'=> $salary,
                            //                 'receive'=> $salary,
                            //                 'due'=> 0,
                            //             ]);

                            //             Advance_Salary::on('mysql_second')->findOrFail($item->id)->update([
                            //                 'due' => $item->due - $salary,
                            //                 'updated_at' => now()
                            //             ]);

                            //             $salary = 0;
                            //         }
                            //         // if installment amount is greater than due
                            //         if($item->installment_amount > $item->due){
                            //             // if due amount is greater than salary
                            //             if($item->due > $salary){
                            //                 Transaction_Detail::on('mysql_second')->insert([
                            //                     'tran_id'=>$id,
                            //                     'tran_type'=> '3',
                            //                     'tran_method'=> 'Receive',
                            //                     'tran_type_with'=> $employee->tran_user_type,
                            //                     'tran_user'=> $employee->user_id,
                            //                     'tran_groupe_id'=> '1',
                            //                     'tran_head_id'=> '8',
                            //                     'quantity'=> '1',
                            //                     'amount'=> $salary,
                            //                     'tot_amount'=> $salary,
                            //                     'receive'=> $salary,
                            //                 ]);

                            //                 Transaction_Main::on('mysql_second')->create([
                            //                     'tran_id'=>$id,
                            //                     'tran_type'=> '3',
                            //                     'tran_method'=> 'Receive',
                            //                     'tran_type_with'=> $employee->tran_user_type,
                            //                     'tran_user'=> $employee->user_id,
                            //                     'bill_amount'=> $salary,
                            //                     'discount'=> 0,
                            //                     'net_amount'=> $salary,
                            //                     'receive'=> $salary,
                            //                     'due'=> 0,
                            //                 ]);

                            //                 Advance_Salary::on('mysql_second')->findOrFail($item->id)->update([
                            //                     'due' => $item->due - $salary,
                            //                     'updated_at' => now()
                            //                 ]);

                            //                 $salary = 0;
                            //             }
                            //             // if due amount is less than salary
                            //             else if($item->due < $salary){
                            //                 Transaction_Detail::on('mysql_second')->insert([
                            //                     'tran_id'=>$id,
                            //                     'tran_type'=> '3',
                            //                     'tran_method'=> 'Receive',
                            //                     'tran_type_with'=> $employee->tran_user_type,
                            //                     'tran_user'=> $employee->user_id,
                            //                     'tran_groupe_id'=> '1',
                            //                     'tran_head_id'=> '8',
                            //                     'quantity'=> '1',
                            //                     'amount'=> $item->due,
                            //                     'tot_amount'=> $item->due,
                            //                     'receive'=> $item->due,
                            //                 ]);

                            //                 Transaction_Main::on('mysql_second')->create([
                            //                     'tran_id'=>$id,
                            //                     'tran_type'=> '3',
                            //                     'tran_method'=> 'Receive',
                            //                     'tran_type_with'=> $employee->tran_user_type,
                            //                     'tran_user'=> $employee->user_id,
                            //                     'bill_amount'=> $item->due,
                            //                     'discount'=> 0,
                            //                     'net_amount'=> $item->due,
                            //                     'receive'=> $item->due,
                            //                     'due'=> 0,
                            //                 ]);

                            //                 Advance_Salary::on('mysql_second')->findOrFail($item->id)->update([
                            //                     'due' => 0,
                            //                     'updated_at' => now()
                            //                 ]);

                            //                 $salary -= $item->due;
                            //             }
                            //         }
                            //     }
                                // // if installment amount is less than salary
                                // else if($item->installment_amount < $salary){
                                //     // if installment amount is greater than due
                                //     if($item->installment_amount > $item->due){
                                //         Transaction_Detail::on('mysql_second')->insert([
                                //             'tran_id'=>$id,
                                //             'tran_type'=> '3',
                                //             'tran_method'=> 'Receive',
                                //             'tran_type_with'=> $employee->tran_user_type,
                                //             'tran_user'=> $employee->user_id,
                                //             'tran_groupe_id'=> '1',
                                //             'tran_head_id'=> '8',
                                //             'quantity'=> '1',
                                //             'amount'=> $item->due,
                                //             'tot_amount'=> $item->due,
                                //             'receive'=> $item->due,
                                //         ]);

                                //         Transaction_Main::on('mysql_second')->create([
                                //             'tran_id'=>$id,
                                //             'tran_type'=> '3',
                                //             'tran_method'=> 'Receive',
                                //             'tran_type_with'=> $employee->tran_user_type,
                                //             'tran_user'=> $employee->user_id,
                                //             'bill_amount'=> $item->due,
                                //             'discount'=> 0,
                                //             'net_amount'=> $item->due,
                                //             'receive'=> $item->due,
                                //             'due'=> 0,
                                //         ]);

                                //         Advance_Salary::on('mysql_second')->findOrFail($item->id)->update([
                                //             'due' => 0,
                                //             'updated_at' => now()
                                //         ]);

                                //         $salary -= $item->due;
                                //     }
                                //     // if installment amount is less than due
                                //     else if($item->installment_amount < $item->due){
                                //         Transaction_Detail::on('mysql_second')->insert([
                                //             'tran_id'=>$id,
                                //             'tran_type'=> '3',
                                //             'tran_method'=> 'Receive',
                                //             'tran_type_with'=> $employee->tran_user_type,
                                //             'tran_user'=> $employee->user_id,
                                //             'tran_groupe_id'=> '1',
                                //             'tran_head_id'=> '8',
                                //             'quantity'=> '1',
                                //             'amount'=> $item->installment_amount,
                                //             'tot_amount'=> $item->installment_amount,
                                //             'receive'=> $item->installment_amount,
                                //         ]);

                                //         Transaction_Main::on('mysql_second')->create([
                                //             'tran_id'=>$id,
                                //             'tran_type'=> '3',
                                //             'tran_method'=> 'Receive',
                                //             'tran_type_with'=> $employee->tran_user_type,
                                //             'tran_user'=> $employee->user_id,
                                //             'bill_amount'=> $item->installment_amount,
                                //             'discount'=> 0,
                                //             'net_amount'=> $item->installment_amount,
                                //             'receive'=> $item->installment_amount,
                                //             'due'=> 0,
                                //         ]);

                                //         Advance_Salary::on('mysql_second')->findOrFail($item->id)->update([
                                //             'due' => $item->due - $item->installment_amount,
                                //             'updated_at' => now()
                                //         ]);

                                //         $salary -= $item->installment_amount;
                                //     }
                                // }
                            // }
                        }
                    }
                }
            }
            
            return response()->json([
                'status'=> true,
                'message' => 'Payroll Processed Successfully'
            ], 200);
        }
        else {
            return response()->json([
                'status' => false,
                'message' => 'Enter Employee Details First',
            ]);
        }
    } // End Method



    function ProcessRepayment($id, $employee, $amount, $item) {
        Transaction_Detail::on('mysql_second')->insert([
            'tran_id'        => $id,
            'tran_type'      => '3',
            'tran_method'    => 'Receive',
            'tran_type_with' => $employee->tran_user_type,
            'tran_user'      => $employee->user_id,
            'tran_groupe_id' => '1',
            'tran_head_id'   => '8',
            'quantity'       => '1',
            'amount'         => $amount,
            'tot_amount'     => $amount,
            'receive'        => $amount,
        ]);

        Transaction_Main::on('mysql_second')->create([
            'tran_id'        => $id,
            'tran_type'      => '3',
            'tran_method'    => 'Receive',
            'tran_type_with' => $employee->tran_user_type,
            'tran_user'      => $employee->user_id,
            'bill_amount'    => $amount,
            'discount'       => 0,
            'net_amount'     => $amount,
            'receive'        => $amount,
            'due'            => 0,
        ]);

        Advance_Salary::on('mysql_second')->findOrFail($item->id)->update([
            'due'        => $item->due - $amount,
            'updated_at' => now()
        ]);
    }


    // // Edit Payroll Process
    // public function Edit(Request $req){
    //     $currentYear = Carbon::now()->year;
    //     $currentMonth = Carbon::now()->month;
    //     $payrolls = Payroll_Setup::on('mysql_second')->with('Employee')->select(
    //         'emp_id',
    //         'head_id',
    //         'amount',
    //         \DB::raw('0 as date'),
    //     )
    //     ->where('emp_id', $req->id)
    //     ->union(
    //         Payroll_Middlewire::on('mysql_second')->select(
    //             'emp_id',
    //             'head_id',
    //             'amount',
    //             'date',
    //         )
    //         ->where('emp_id', $req->id)
    //         ->where(function ($query) use ($currentYear, $currentMonth) {
    //             $query->whereYear('date', $currentYear)
    //                 ->whereMonth('date', $currentMonth)
    //                 ->orWhereNull('date');
    //         })
    //     )
    //     ->orderBy('emp_id')
    //     ->get();
        
    //     $heads = Transaction_Head::on('mysql_second')->where('groupe_id','1')->get();
    //     return response()->json([
    //         'status'=> 'success',
    //         'data'=> view('hr.payroll.details',compact('payrolls'))->render(),
    //         'payrolls'=> $payrolls,
    //         'heads' => $heads
    //     ]);
    // } // End Method



    // // Update Payroll Process
    // public function Update(Request $req){
    //     $req->validate([
    //         "division" => 'required',
    //         "district"  => 'required',
    //         "upazila"  => 'required',
    //     ]);

    //     $update = Location_Info::findOrFail($req->id)->update([
    //         "district" => $req->district,
    //         "division" => $req->division,
    //         "upazila" => $req->upazila,
    //         "updated_at" => now()
    //     ]);

    //     $updatedData = Location_Info::findOrFail($req->id);
    
    //     if($update){
    //         return response()->json([
    //             'status'=>true,
    //             'message' => 'Location Updated Successfully',
    //             "updatedData" => $updatedData,
    //         ], 200); 
    //     }
    // } // End Method



    // // Delete Payroll Process
    // public function Delete(Request $req){
    //     Location_Info::findOrFail($req->id)->delete();
    //     return response()->json([
    //         'status'=> true,
    //         'message' => 'Location Deleted Successfully',
    //     ], 200); 
    // } // End Method



    // Search Payroll Process
    public function Search(Request $req){
        $currentYear = $req->year;
        $currentMonth = $req->month;
        $payroll = Payroll_Setup::on('mysql_second')->with('Employee')
        ->whereHas('Employee', function ($query) use ($req) {
            $query->where('user_name', 'like', '%'.$req->search.'%');
            $query->orWhere('user_id', 'like', '%'.$req->search.'%');
        })
        ->select('emp_id', 'amount', \DB::raw('NULL as date')) 
        ->unionall(
            Payroll_Middlewire::on('mysql_second')->select('emp_id', 'amount', 'date')
                ->whereYear('date', $currentYear)
                ->whereMonth('date', $currentMonth)
                ->orWhereNull('date')
        )
        ->orderBy('emp_id')
        ->get()
        ->groupBy('emp_id')
        ->map(function ($group) {
            return [
                'emp_id' => $group->first()->emp_id,
                'emp_name' => $group->first()->employee->user_name,
                'salary' => $group->sum('amount')
            ];
        })
        ->values();
        
        return response()->json([
            'status' => true,
            'data' => $payroll,
        ], 200);
    } // End Method



    // Get Payroll By User Id
    public function Get(Request $req){
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $payrolls = Payroll_Setup::on('mysql_second')->with('Head')
        ->select(
            'emp_id',
            'head_id',
            'amount',
            \DB::raw('0 as date'),
        )
        ->where('emp_id', $req->id)
        ->union(
            Payroll_Middlewire::on('mysql_second')->with('Head')
            ->select(
                'emp_id',
                'head_id',
                'amount',
                'date',
            )
            ->where('emp_id', $req->id)
            ->where(function ($query) use ($currentYear, $currentMonth) {
                $query->whereYear('date', $currentYear)
                    ->whereMonth('date', $currentMonth)
                    ->orWhereNull('date');
            })
        )
        ->orderBy('head_id')
        ->get();
        
        return response()->json([
            'status'=> true,
            'data'=> $payrolls,
        ]);
    } // End Method 




    // // Get Payroll By User And Date
    // public function GetByDate(Request $req){
    //     $currentYear = $req->year;
    //     $currentMonth = $req->month;
    //     $payrolls = Payroll_Setup::on('mysql_second')->with('Employee')->select(
    //         'emp_id',
    //         'head_id',
    //         'amount',
    //         \DB::raw('0 as date'),
    //     )
    //     ->where('emp_id', $req->id)
    //     ->union(
    //         Payroll_Middlewire::on('mysql_second')->select(
    //             'emp_id',
    //             'head_id',
    //             'amount',
    //             'date',
    //         )
    //         ->where('emp_id', $req->id)
    //         ->where(function ($query) use ($currentYear, $currentMonth) {
    //             $query->whereYear('date', $currentYear)
    //                 ->whereMonth('date', $currentMonth)
    //                 ->orWhereNull('date');
    //         })
    //     )
    //     ->orderBy('emp_id')
    //     ->get();
        
    //     $heads = Transaction_Head::on('mysql_second')->where('groupe_id','1')->get();
    //     return response()->json([
    //         'status'=> 'success',
    //         'data'=> view('hr.payroll.details',compact('payrolls'))->render(),
    //         'payrolls'=> $payrolls,
    //         'heads' => $heads
    //     ]);
    // } // End Method
}
