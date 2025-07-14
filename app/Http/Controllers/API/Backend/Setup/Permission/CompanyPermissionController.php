<?php

namespace App\Http\Controllers\API\Backend\Setup\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\Company_Type;
use App\Models\Company_Details;
use App\Models\Permission_Company;
use App\Models\Permission_Company_Type;
use App\Models\Permission_Head;

class CompanyPermissionController extends Controller
{
    // Show All Company Permissions
    public function Show(Request $req){
        $types = Company_Type::on('mysql')->get();
        $data = Company_Details::on('mysql')->with('permissions')->orderBy('company_id')->get();
        return response()->json([
            'status'=> true,
            'data' => $data,
            'types' => $types,
        ], 200);
    } // End Method



    // Edit Company Permissions
    public function Edit(Request $req){
        $company = Company_Details::on('mysql')->where('company_id',$req->id)->first();
        $companypermission = Permission_Company::on('mysql')->where('company_id', $req->id)->pluck('permission_id')->toArray();
        $companyTypePermission = Company_Type::on('mysql')->with('permissions')->where('id', $company->company_type)->first()->permissions->pluck('id')->toArray();

        $permissions = Permission_Head::on('mysql')
        ->with('mainhead')
        ->whereIn('id', $companyTypePermission)
        ->orderBy('permission_mainhead')
        ->get()
        ->groupBy('permission_mainhead');

        $groupedPermissions = [];

        foreach ($permissions as $mainheadId => $group) {
            foreach ($group as $permission) {
                // dd($permission->name);
                $name = $permission->name;
                $groupKey = 'Other';

                // Custom grouping logic
                if (str_contains($name, ' Admin')) $groupKey = 'Admin';
                elseif (str_contains($name, 'Roles')) $groupKey = 'Roles';
                elseif (str_contains($name, 'Permissions')) $groupKey = 'Permissions';
                elseif (str_contains($name, 'Banks')) $groupKey = 'Banks';
                elseif (str_contains($name, 'Locations')) $groupKey = 'Locations';
                elseif (str_contains($name, 'Stores')) $groupKey = 'Stores';
                elseif (str_contains($name, 'Payment Methods')) $groupKey = 'Payment Methods';
                elseif (str_contains($name, 'Corporate')) $groupKey = 'Corporate';

                elseif (str_contains($name, 'Groupes')) $groupKey = 'Groupes';
                elseif (str_contains($name, 'Service / Product')) $groupKey = 'Service / Product';
                elseif (str_contains($name, 'Client/Supplier')) $groupKey = 'Client/Supplier';
                elseif (str_contains($name, 'Clients')) $groupKey = 'Clients';
                elseif (str_contains($name, 'Suppliers')) $groupKey = 'Suppliers';
                elseif (str_contains($name, 'Transaction With Client')) $groupKey = 'Transaction With Client';
                elseif (str_contains($name, 'Transaction With Supplier')) $groupKey = 'Transaction With Supplier';
                elseif (str_contains($name, 'From Client')) $groupKey = 'From-Client';
                elseif (str_contains($name, 'To Supplier')) $groupKey = 'To-Supplier';

                elseif (str_contains($name, 'Bank Withdraw')) $groupKey = 'Bank-Withdraws';
                elseif (str_contains($name, 'Bank Deposit')) $groupKey = 'Bank-Deposits';

                elseif (str_contains($name, 'Employee Type')) $groupKey = 'Employee Type';
                elseif (str_contains($name, 'All Employee')) $groupKey = 'All-Employee';
                elseif (str_contains($name, 'Personal')) $groupKey = 'Employee-Personal-Details';
                elseif (str_contains($name, 'Education')) $groupKey = 'Employee-Education-Details';
                elseif (str_contains($name, 'Trainning')) $groupKey = 'Employee-Trainning-Details';
                elseif (str_contains($name, 'Experience')) $groupKey = 'Employee-Experience-Details';
                elseif (str_contains($name, 'Organization')) $groupKey = 'Employee-Organization-Details';
                elseif (str_contains($name, 'Attandence')) $groupKey = 'Attendance';
                elseif (str_contains($name, 'Payroll Setup')) $groupKey = 'Payroll-Setup';
                elseif (str_contains($name, 'Middleware')) $groupKey = 'Payroll-Middleware';
                elseif (str_contains($name, 'Process')) $groupKey = 'Payroll-Process';
                elseif (str_contains($name, 'Department')) $groupKey = 'Department';
                elseif (str_contains($name, 'Designation')) $groupKey = 'Designation';
                elseif (str_contains($name, 'Salary') && str_contains($name, 'Report')) $groupKey = 'Salary-Report';

                elseif (str_contains($name, 'Manufacturer')) $groupKey = 'Manufacturer';
                elseif (str_contains($name, 'Category')) $groupKey = 'Category';
                elseif (str_contains($name, 'Unit')) $groupKey = 'Unit';
                elseif (str_contains($name, 'Form')) $groupKey = 'Form';
                elseif (str_contains($name, 'Product')) $groupKey = 'Product';
                elseif (str_contains($name, 'Purchase') && str_contains($name, 'Transaction')) $groupKey = 'Purchase-Transaction';
                elseif (str_contains($name, 'Issue') && str_contains($name, 'Transaction')) $groupKey = 'Issue-Transaction';
                elseif (str_contains($name, 'Client Return') && str_contains($name, 'Transaction')) $groupKey = 'Client-Return-Transaction';
                elseif (str_contains($name, 'Supplier Return') && str_contains($name, 'Transaction')) $groupKey = 'Supplier-Return-Transaction';
                elseif (str_contains($name, 'Positive')) $groupKey = 'Positive';
                elseif (str_contains($name, 'Negative')) $groupKey = 'Negative';

                

                elseif (str_contains($name, 'Balance Sheet')) $groupKey = 'Balance-Sheet';
                elseif (str_contains($name, 'Account Statement')) $groupKey = 'Account-Statement';
                elseif (str_contains($name, 'Party Statement')) $groupKey = 'Party-Statement';

                $groupedPermissions[$permission->mainhead->name.'-'.$permission->permission_mainhead ?? 'Uncategorized'][$groupKey][] = [
                    'id' => $permission->id,
                    'name' => $permission->name,
                    'checked' => in_array($permission->id, $companypermission),
                    'permission_mainhead' => $permission->permission_mainhead,
                ];
            }
        }
        
        return response()->json([
            'status'=> true,
            'permissions'=>$permissions,
            'companypermission'=>$companypermission,
            'company'=>$company,
            'groupedPermissions'=>$groupedPermissions
        ], 200);





        
        // return response()->json([
        //     'status'=> true,
        //     'permissions'=>$permissions,
        //     'companypermission'=>$companypermission,
        //     'company'=>$company
        // ], 200);
    } // End Method



    // Update Company Permissions
    public function Update(Request $req){
        $req->validate([
            'company' => 'required|exists:mysql.company__details,company_id',
            'permissions' => 'array',
            'permissions.*' => 'integer|exists:mysql.permission__heads,id',
        ]);

        $company = Company_Details::on('mysql')->where('company_id', $req->company)->first();

        $company->permissions()->sync($req->permissions);


        // Update Company Pemissions Cache
        $updatedData = Company_Details::on('mysql')->with('permissions')->where('company_id', $req->company)->first();

        Cache::forget("permission_mainheads_{$req->company}");
        Cache::forget("permission_ids_{$req->company}");

        Cache::rememberForever("permission_mainheads_{$req->company}", function () use ($updatedData) {
            return $updatedData->permissions->pluck('permission_mainhead')->unique()->toArray();
        });
        
        Cache::rememberForever("permission_ids_{$req->company}", function () use ($updatedData) {
            return $updatedData->permissions->pluck('id')->unique()->toArray();
        });
        
        return response()->json([
            'status'=> true,
            'message' => 'Company Permissions Added Successfully',
            "updatedData" => $updatedData,
        ], 200);  
    } // End Method



    // Search Company Permissions
    public function Search(Request $req){
        $data = Company_Details::on('mysql')
        ->where('company_name', 'like', $req->search.'%')
        ->where('company_type', 'like', '%'.$req->type.'%')
        ->with('permissions')
        ->orderBy('company_name')
        ->paginate(15);
        
        return response()->json([
            'status' => true,
            'data' => $data,
        ], 200);
    } // End Method
    
    
    
    // Get The User From whom you get the permission
    public function UserFrom(Request $req){
        $data = Company_Details::on('mysql')
        ->select('company_name','company_id')
        ->where('company_name', 'like', $req->from.'%')
        ->orderBy('company_name')
        ->take(10)
        ->get();


        $list = "<ul>";
            if($data->count() > 0){
                foreach($data as $index => $item) {
                    $list .= '<li tabindex="' . ($index + 1) . '" data-id="'.$item->company_id.'">'.$item->company_name.'('.$item->company_id.')'.'</li>';
                }
            }
            else{
                $list .= '<li>No Data Found</li>';
            }
        $list .= "</ul>";

        return $list;
    } // End Method
    
    
    
    // Get The User To whom you assing the permission
    public function UserTo(Request $req){
        $data = Company_Details::on('mysql')
        ->select('company_name','company_id')
        ->where('company_name', 'like', $req->to.'%')
        ->orderBy('company_name')
        ->take(10)
        ->get();

        $list = "<ul>";
            if($data->count() > 0){
                foreach($data as $index => $item) {
                    $list .= '<li tabindex="' . ($index + 1) . '" data-id="'.$item->company_id.'">'.$item->company_name.'('.$item->company_id.')'.'</li>';
                }
            }
            else{
                $list .= '<li>No Data Found</li>';
            }
        $list .= "</ul>";

        return $list;
    } // End Method
    
    
    
    // Copy User Permissions
    public function Copy(Request $req){
        $req->validate([
            'from' => 'required|exists:mysql.company__details,company_id',
            'to' => 'required|exists:mysql.company__details,company_id',
        ]);

        $from = Company_Details::on('mysql')->where('company_id', $req->from)->first();
        $to = Company_Details::on('mysql')->where('company_id', $req->to)->first();

        $fromPermissions = $from->permissions->pluck('id')->toArray();

        $to->permissions()->sync($fromPermissions);
        
        return response()->json([
            'status' => true,
            'message' => 'Company Permissions Copied Successfully'
        ], 200);
    } // End Method
}
