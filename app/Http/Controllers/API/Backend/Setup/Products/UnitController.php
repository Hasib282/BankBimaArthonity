<?php

namespace App\Http\Controllers\API\Backend\Setup\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Item_Unit;

class UnitController extends Controller
{
    // Show All Item/Product Unit
    public function ShowAll(Request $req){
        $type = GetTranType($req->segment(2));
        $unit = filterByCompany(Item_Unit::on('mysql')->where('type_id', $type))->orderBy('added_at','asc')->paginate(15);
        return response()->json([
            'status'=> true,
            'data' => $unit,
        ], 200);
    } // End Method



    // Insert Item/Product Unit
    public function Insert(Request $req){
        $type = GetTranType($req->segment(2));
        $req->validate([
            'name' => 'required',
        ]);

        Item_Unit::on('mysql')->insert([
            'unit_name' => $req->name,
            'company_id' => $req->company,
            'type_id'=> $type,
        ]);
        
        return response()->json([
            'status'=> true,
            'message' => 'Unit Added Successfully'
        ], 200);  
    } // End Method



    // Edit Item/Product Unit
    public function Edit(Request $req){
        $unit = Item_Unit::on('mysql')->where('id', $req->id)->first();
        return response()->json([
            'status'=> true,
            'unit'=> $unit,
        ], 200);
    } // End Method



    // Update Item/Product Unit
    public function Update(Request $req){
        $req->validate([
            'name' => 'required',
        ]);

        $update = Item_Unit::on('mysql')->findOrFail($req->id)->update([
            'unit_name' => $req->name,
            "updated_at" => now()
        ]);

        if($update){
            return response()->json([
                'status'=>true,
                'message' => 'Unit Updated Successfully',
            ], 200); 
        }
    } // End Method



    // Delete Item/Product Unit
    public function Delete(Request $req){
        Item_Unit::on('mysql')->findOrFail($req->id)->delete();
        return response()->json([
            'status'=> true,
            'message' => 'Unit Deleted Successfully',
        ], 200); 
    } // End Method



    // Search Item/Product Unit
    public function Search(Request $req){
        $type = GetTranType($req->segment(2));
        $unit = filterByCompany(
                    Item_Unit::on('mysql')
                    ->where('type_id', $type)
                    ->where('unit_name', 'like', '%'.$req->search.'%')
                )
                ->orderBy('unit_name','asc')
                ->paginate(15);
        
        return response()->json([
            'status' => true,
            'data' => $unit,
        ], 200);
    } // End Method



    // Get Unit
    public function Get(Request $req){
        $type = GetTranType($req->segment(2));
        $units = filterByCompany(
                    Item_Unit::on('mysql')
                    ->where('type_id', $type)
                    ->where('unit_name', 'like', '%'.$req->unit.'%')
                )
                ->orderBy('unit_name','asc')
                ->take(10)
                ->get();


        if($units->count() > 0){
            $list = "";
            foreach($units as $index => $unit) {
                $list .= '<li tabindex="' . ($index + 1) . '" data-id="'.$unit->id.'">'.$unit->unit_name.'</li>';
            }
        }
        else{
            $list = '<li>No Data Found</li>';
        }
        return $list;
    } // End Method
}
