<?php

namespace App\Http\Controllers\API\Backend\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

use App\Models\Transaction_Detail;
use App\Models\Transaction_Main;
use App\Models\Transaction_Details_Temp;
use App\Models\Transaction_Mains_Temp;
use App\Models\User_Info;

class GeneralTransactionController extends Controller
{
    // Show All General Transaction Receives
    public function ShowAllReceive(Request $req){
        $data = Transaction_Main::on('mysql_second')->with('User')->where('tran_method','Receive')->where('tran_type','1')->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','asc')->get();
        return response()->json([
            'status'=> true,
            'data' => $data,
        ], 200);
    } // End Method
    
    
    
    // Show All General Transaction Payment
    public function ShowAllPayment(Request $req){
        $data = Transaction_Main::on('mysql_second')->with('User')->where('tran_method','Payment')->where('tran_type','1')->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','asc')->get();
        return response()->json([
            'status'=> true,
            'data' => $data,
        ], 200);
    } // End Method



    // Insert General Transaction
    public function Insert(Request $req){
        $req->validate([
            "method" => 'required',
            "type" => 'required|exists:mysql.transaction__main__heads,id',
            "withs" => 'required|exists:mysql_second.transaction__withs,id',
            "user" => 'required|exists:mysql_second.user__infos,user_id',
            "amountRP" => 'required',
            "discount" => 'required',
            "netAmount" => 'required',
            "advance" => 'required',
            "balance" => 'required',
        ]);


        if($req->discount > $req->amountRP){
            return response()->json([
                'errors' => [
                    'message' => ["Discount amount can't be bigger than total amount"]
                ]
            ], 422);
        }
        if($req->discount < 0){
            return response()->json([
                'errors' => [
                    'message' => ["Discount amount can't be negative"]
                ]
            ], 422);
        }
        else if($req->advance  < 0){
            return response()->json([
                'errors' => [
                    'message' => ["Advance amount can't be negative"]
                ]
            ], 422);
        }
        else if($req->advance  > $req->netAmount){
            return response()->json([
                'errors' => [
                    'message' => ["Advance amount can't be bigger than Net amount"]
                ]
            ], 422);
        }

        // Generates Auto Increment Purchase Id
        // $transaction = Transaction_Main::on('mysql_second')->where('tran_type', 1)->where('tran_method', $req->method)->latest('tran_id')->first();
        if($req->method === 'Receive'){
            // $id = ($transaction) ? 'REC' . str_pad((intval(substr($transaction->tran_id, 3)) + 1), 9, '0', STR_PAD_LEFT) :  'REC000000001';
            $id = GenerateTranId(1, 'Receive', 'REC');
        }
        else if($req->method === 'Payment'){
            // $id = ($transaction) ? 'PAY' . str_pad((intval(substr($transaction->tran_id, 3)) + 1), 9, '0', STR_PAD_LEFT) :  'PAY000000001';
            $id = GenerateTranId(1, 'Payment', 'PAY');
        }
        
        $data = null;

        DB::transaction(function () use ($req, $id, &$data) {
            $receive = $req->method === 'Receive' ? $req->advance : null;
            $payment = $req->method === 'Payment' ? $req->advance : null;
            $insert = Transaction_Main::on('mysql_second')->create([
                "tran_id" => $id,
                "tran_type" => 1,
                "tran_method" => $req->method,
                "tran_type_with" => $req->withs,
                "tran_user" => $req->user,
                "bill_amount" => $req->amountRP,
                "discount" => $req->discount,
                "net_amount" => $req->netAmount,
                "receive" => $receive,
                "payment" => $payment,
                "due" => $req->balance,
            ]);


            $billDiscount = $req->discount;
            $billAmount = $req->amountRP;
            $billNet = $req->netAmount;
            $billAdvance = $req->advance;
            $products = json_decode($req->products, true);
            foreach($products as $product){
                $totalAmount = $product['totAmount'];
                // Calculate Discount 
                $discount = round( ($billDiscount * $totalAmount) / $billAmount);

                $amount = $totalAmount - $discount;
                $advance = round( ($billAdvance * $amount) / $billNet );
                $due = $amount - $advance;

                $receive = $req->method === 'Receive' ? $advance : null;
                $payment = $req->method === 'Payment' ? $advance : null;

                Transaction_Detail::on('mysql_second')->create([
                    "tran_id" => $id,
                    "loc_id" => $req->location,
                    "tran_type" => 1,
                    "tran_method" => $req->method,
                    "tran_type_with" => $req->withs,
                    "tran_user" => $req->user,
                    "tran_groupe_id" => $product['groupe'],
                    "tran_head_id" => $product['product'],
                    "amount" => $product['amount'],
                    "quantity_actual" => $product['quantity'],
                    "quantity" => $product['quantity'],
                    "tot_amount" => $product['totAmount'],
                    "discount" => $discount,
                    "receive" => $receive,
                    "payment" => $payment,
                    "due" => $due,
                    "expiry_date" => $req->expiry == null ? null :$req->expiry,
                ]);

                $billDiscount -= $discount;
                $billAmount -= $totalAmount;
                $billAdvance -= $advance;
                $billNet -= $amount;
            }

            $data = Transaction_Main::on('mysql_second')->with('User')->findOrFail($insert->id);
        });

        
        return response()->json([
            'status'=> true,
            'message' => 'Transaction Added Successfully',
            "data" => $data,
        ], 200);  
    } // End Method



    // Update General Transaction
    public function Update(Request $req){
        $req->validate([
            "amountRP"  => 'required|numeric',
            "totalDiscount"  => 'required|numeric',
            "netAmount"  => 'required|numeric',
            "advance"  => 'required|numeric',
            "balance"  => 'required|numeric',
        ]);


        if($req->totalDiscount > $req->amountRP){
            return response()->json([
                'errors' => [
                    'message' => ["Discount amount can't be bigger than total amount"]
                ]
            ], 422);
        }
        if($req->totalDiscount < 0){
            return response()->json([
                'errors' => [
                    'message' => ["Discount amount can't be negative"]
                ]
            ], 422);
        }
        else if($req->advance  < 0){
            return response()->json([
                'errors' => [
                    'message' => ["Advance amount can't be negative"]
                ]
            ], 422);
        }
        else if($req->advance  > $req->netAmount){
            return response()->json([
                'errors' => [
                    'message' => ["Advance amount can't be bigger than Net amount"]
                ]
            ], 422);
        }

        $transaction = Transaction_Main::on('mysql_second')->findOrFail($req->id);

        

        DB::transaction(function () use ($req, $transaction) {
            $receive = $req->method == 'Receive' ? $req->advance : null;
            $payment = $req->method == 'Payment' ? $req->advance : null;

            $transaction->update([
                "bill_amount" => $req->amountRP,
                "discount" => $req->totalDiscount,
                "net_amount" => $req->netAmount,
                "receive" => $receive,
                "payment" => $payment,
                "due" => $req->balance,
                "updated_at" => now()
            ]);


            // Delete the previous transaction details
            Transaction_Detail::on('mysql_second')->where('tran_id', $transaction->tran_id)->delete();


            $billDiscount = $req->totalDiscount;
            $billAmount = $req->amountRP;
            $billNet = $req->netAmount;
            $billAdvance = $req->advance;
            $products = json_decode($req->products, true);
            foreach($products as $product){
                $totalAmount = $product['totAmount'];
                // Calculate Discount 
                $discount = round( ($billDiscount * $totalAmount) / $billAmount);

                $amount = $totalAmount - $discount;
                $advance = round( ($billAdvance * $amount) / $billNet );
                $due = $amount - $advance;

                $receive = $req->method == 'Receive' ? $advance : null;
                $payment = $req->method == 'Payment' ? $advance : null;

                $update = Transaction_Detail::on('mysql_second')->create([
                    "tran_id" => $req->tranid,
                    "tran_type" => 1,
                    "tran_method" => $req->method,
                    "tran_type_with" => $req->withs,
                    "tran_user" => $req->user,
                    "tran_groupe_id" => $product['groupe'],
                    "tran_head_id" => $product['product'],
                    "amount" => $product['amount'],
                    "quantity_actual" => $product['quantity'],
                    "quantity" => $product['quantity'],
                    "tot_amount" => $product['totAmount'],
                    "discount" => $discount,
                    "receive" => $receive,
                    "payment" => $payment,
                    "due" => $due,
                    "tran_date" => $transaction->tran_date,
                ]);

                $billDiscount -= $discount;
                $billAmount -= $totalAmount;
                $billAdvance -= $advance;
                $billNet -= $amount;
            }
        });

        $updatedData = Transaction_Main::on('mysql_second')->with('User')->findOrFail($req->id);

        return response()->json([
            'status'=>true,
            'message' => 'Transaction Updated Successfully',
            "updatedData" => $updatedData,
        ], 200); 
    } // End Method



    // Delete General Transaction
    public function Delete(Request $req){
        $data = Transaction_Main::on('mysql_second')->findOrFail($req->id);
        Transaction_Detail::on('mysql_second')->where("tran_id", $data->tran_id)->delete();
        $data->delete();
        return response()->json([
            'status'=> true,
            'message' => 'Transaction Deleted Successfully',
        ], 200); 
    } // End Method



    // Delete General Transaction Status
    public function DeleteStatus(Request $req){
        $data = Transaction_Main::on('mysql_second')->findOrFail($req->id);
        $data->update(['status' => $data->status == 0 ? 1 : 0]);
        Transaction_Detail::on('mysql_second')->where("tran_id", $data->tran_id)->update(['status' => $data->status == 0 ? 1 : 0]);
        
        $updatedData = Transaction_Main::on('mysql_second')->with('User')->findOrFail($req->id);
        
        return response()->json([
            'status'=> true,
            'message' => 'General Transaction Details Deleted Successfully',
            'updatedData' => $updatedData
        ], 200);
    } // End Method



    // Search General Transaction
    public function Search(Request $req){
        if($req->status == 1){
            $data = Transaction_Main::on('mysql_second')
            ->with('User')
            ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
            ->where('tran_method',$req->method)
            ->where('tran_type', $req->type)
            ->orderBy('tran_id','asc')
            ->get();
        }
        else if($req->status == 2){
            $data = Transaction_Mains_Temp::on('mysql_second')
            ->with('User')
            ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
            ->where('tran_method',$req->method)
            ->where('tran_type', $req->type)
            ->orderBy('tran_id','asc')
            ->get();
        }
        
        return response()->json([
            'status' => true,
            'data' => $data,
        ], 200);
    } // End Method



    // Show Transaction Invoice/Receipt
    public function Invoice(Request $req)
    {
        if($req->status == 1){
            $transactionMain = Transaction_Main::on('mysql_second')->where('tran_id', $req->id)->first();
            $transDetailsInvoice = Transaction_Detail::on('mysql_second')->
            select(
                'tran_head_id', 
                'amount', 
                DB::raw('SUM(quantity) as sum_quantity'), 
                DB::raw('SUM(quantity_actual) as sum_quantity_actual'), 
                DB::raw('SUM(tot_amount) as sum_tot_amount'), 
                DB::raw('COUNT(*) as count')
            )
            ->where('tran_id', $req->id)
            ->groupBy('tran_head_id','amount')
            ->get();
        }
        else if($req->status == 2){
            $transactionMain = Transaction_Mains_Temp::on('mysql_second')->where('tran_id', $req->id)->first();
            $transDetailsInvoice = Transaction_Details_Temp::on('mysql_second')->
            select(
                'tran_head_id', 
                'amount', 
                DB::raw('SUM(quantity) as sum_quantity'), 
                DB::raw('SUM(quantity_actual) as sum_quantity_actual'), 
                DB::raw('SUM(tot_amount) as sum_tot_amount'), 
                DB::raw('COUNT(*) as count')
            )
            ->where('tran_id', $req->id)
            ->groupBy('tran_head_id','amount')
            ->get();
        }
        
        $pdf = Pdf::loadView('common_modals.invoice', compact('transactionMain', 'transDetailsInvoice'));
        return $pdf->stream();
    } // End Method




    // Get Inserted Transacetion Grid By Transaction Id
    public function GetTransactionGrid(Request $request){
        if($request->status == 1){
            $data = Transaction_Detail::on('mysql_second')->with('Head')
            ->select(
                'tran_head_id',
                'mrp',
                'cp',
                'unit_id',
                'amount',
                'quantity_actual',
                DB::raw('SUM(tot_amount) as total_amount'),
                'tran_groupe_id',
                'expiry_date'
            )
            ->where('tran_id', 'like', $request->tranId)
            ->groupBy('tran_head_id', 'tran_groupe_id', 'amount', 'quantity_actual', 'mrp', 'cp', 'unit_id', 'expiry_date')
            ->orderBy('tran_id','asc')
            ->get();
        }
        else if($request->status == 2){
            $data = Transaction_Details_Temp::on('mysql_second')->with('Head')
            ->select(
                'tran_head_id',
                'mrp',
                'cp',
                'unit_id',
                'amount',
                'quantity_actual',
                DB::raw('SUM(tot_amount) as total_amount'),
                'tran_groupe_id',
                'expiry_date'
            )
            ->where('tran_id', 'like', $request->tranId)
            ->groupBy('tran_head_id', 'tran_groupe_id', 'amount', 'quantity_actual', 'mrp', 'cp', 'unit_id', 'expiry_date')
            ->orderBy('tran_id','asc')
            ->get();
        }


        return response()->json([
            'status' => true,
            'data' => $data
        ]);
        // if ($transaction->isNotEmpty()) {
        //     return response()->json([
        //         'status' => true,
        //         'transaction' => $transaction
        //     ]);
        // } else {
        //     return response()->json([
        //         'status' => false
        //     ]); 
        // }
    } // End Method



    // Get User By User Type
    public function GetUser(Request $req){
        if($req->within == "1"){
            $data = User_Info::on('mysql_second')->where('user_name', 'like', '%'.$req->tranUser.'%')
            ->whereIn('tran_user_type', $req->tranUserType)
            ->orderBy('user_name','asc')
            ->take(10)
            ->get();
        }
        else{
            if($req->tranUserType == ""){
                $list = '<li>Setect Type first</li>';
                return $list;
            }
            else{
                $data = User_Info::on('mysql_second')->where('user_name', 'like', '%'.$req->tranUser.'%')
                ->where('tran_user_type', $req->tranUserType)
                ->orderBy('user_name','asc')
                ->take(10)
                ->get();
            }
        }

        $list = "<ul>";
            if($data->count() > 0){
                foreach($data as $index => $item) {
                    $list .= '<li tabindex="' . ($index + 1) . '" data-id="'.$item->user_id.'"  data-with="'.$item->tran_user_type.'" data-name="'.$item->user_name.'" data-phone="'.$item->user_phone.'" data-address="'.$item->address.'">'.$item->user_name.'</li>';
                }
            }
            else{
                $list .= '<li>No Data Found</li>';
            }
        $list .= "</ul>";

        return $list;
    } // End Method




    // Get Batch Id
    public function GetBatch(Request $req){  
        $data = Transaction_Detail::on('mysql_second')->select('tran_id')
        ->where('tran_id', 'like', '%'.$req->batch.'%')
        ->where('tran_type', $req->type)
        ->where('tran_method', $req->method)
        ->orderBy('tran_id','asc')
        ->groupby('tran_id')
        ->take(10)
        ->get();

        $list = "<ul>";
            if($data->count() > 0){
                foreach($data as $index => $item) {
                    $list .= '<li tabindex="' . ($index + 1) . '" data-id="'.$item->tran_id.'">'.$item->tran_id.'</li>';
                }
            }
            else{
                $list .= '<li>No Data Found</li>';
            }
        $list .= "</ul>";

        return $list;
    } // End Method



    // Get Batch Details
    public function GetBatchDetails(Request $req){  
        $batches = Transaction_Detail::on('mysql_second')
        ->with('Head')
        ->where('tran_id', $req->batch)
        ->orderBy('tran_id','asc')
        ->get();
        
        if($batches->count() > 0){
            $list = "";
            foreach($batches as $index => $batch) {
                $amount = '';
                if ($batch->tran_method === 'Issue') {
                    $amount = $batch->mrp;
                } elseif ($batch->tran_method === 'Purchase') {
                    $amount = $batch->cp;
                }

                $list .= '
                <tr data-id="' . htmlspecialchars($batch->tran_head_id) . '" data-name="' . htmlspecialchars($batch->head->tran_head_name) . '" data-groupe="' . htmlspecialchars($batch->tran_groupe_id) . '" data-quantity="' . htmlspecialchars($batch->quantity) . '" data-amount="' . htmlspecialchars($amount) . '" data-tot="' . htmlspecialchars($batch->tot_amount) . '" data-batch="' . htmlspecialchars($batch->batch_id) . '">
                    <td>' . htmlspecialchars($batch->head->tran_head_name) . '</td>
                    <td style="text-align: center">' . htmlspecialchars($batch->quantity) . '</td>
                    <td style="text-align: right">' . $amount . '</td>
                    <td style="text-align: right">' . htmlspecialchars($batch->quantity * $amount) . '</td>
                    <td style="text-align: center">' . htmlspecialchars($batch->batch_id) . '</td>
                </tr>';
            }
        }
        else{
            $list = '<tr>
                        <td>No Data Found</td>
                    </tr>';
        }
        return $list;
    } // End Method



    // Get Product Batch Id
    public function GetProductBatch(Request $req){  
        $data = Transaction_Detail::on('mysql_second')
        ->select('tran_id','tran_date','quantity')
        ->where('tran_id', 'like', '%'.$req->batch.'%')
        // ->where('tran_type', $req->type)
        ->where('tran_head_id', $req->product)
        ->where('tran_method', "Purchase")
        ->where('quantity', '>', 0)
        ->orderBy('tran_id','asc')
        ->groupby('tran_id','tran_date','quantity')
        ->take(10)
        ->get();

        $list = "<ul>";
            if($data->count() > 0){
                foreach($data as $index => $item) {
                    $list .= '<li tabindex="' . ($index + 1) . '" data-id="'.$item->tran_id.'">'.$item->tran_id. " | Qty: " . $item->quantity .  " | " . Carbon::parse($item->tran_date)->format('Y-m-d'). '</li>';
                }
            }
            else{
                if ($req->product) {
                    $list .= '<li>No Data Found</li>';
                }
                else{
                    $list .= '<li>Select Product First</li>';
                }
            }
        $list .= "</ul>";
        
        return $list;
    } // End Method



    // Get Product Stock 
    public function GetProductStock(Request $req){
        if($req->batch){
            $data = Transaction_Detail::on('mysql_second')->where('tran_head_id', $req->product)
            ->where('quantity', '>', 0)
            // ->whereIn('tran_method', ["Purchase","Positive"])
            ->where('tran_id', $req->batch)
            ->get();
        }
        else{
            $data = Transaction_Detail::on('mysql_second')->where('tran_head_id', $req->product)
            ->where('quantity', '>', 0)
            ->whereIn('tran_method', ["Purchase","Positive"])
            ->get();
        }
        

        $totQuantity = 0;
        foreach($data as $index => $pro) {
            $totQuantity = $totQuantity + $pro->quantity;
        }

        $result = $totQuantity < $req->quantity;
        
        return response()->json([
            'status' => 'success',
            'result' => $result,
            "totQuantity" => $totQuantity
        ]);
    } // End Method
}
