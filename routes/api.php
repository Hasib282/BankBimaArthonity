<?php

use App\Http\Middleware\ApiValidUser;
use App\Http\Middleware\SuperAdminAccess;
use App\Http\Middleware\CheckPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Auth Controllers
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Auth\ForgetPasswordController;




/////////////////////////////////////// Users Controlles Part Start /////////////////////////////////////
// Users Setup Controllers
use App\Http\Controllers\API\Backend\Users\Setup\RoleController;
use App\Http\Controllers\API\Backend\Users\Setup\TranWithController;
use App\Http\Controllers\API\Backend\Users\Setup\DepartmentController;
use App\Http\Controllers\API\Backend\Users\Setup\DesignationController;


// Users Controllers
use App\Http\Controllers\API\Backend\Users\AdminController;
use App\Http\Controllers\API\Backend\Users\SuperAdminController;
use App\Http\Controllers\API\Backend\Users\ClientController;
use App\Http\Controllers\API\Backend\Users\SupplierController;
use App\Http\Controllers\API\Backend\Users\DoctorController;
use App\Http\Controllers\API\Backend\Users\PatientController;


// Users Employee Controllers
use App\Http\Controllers\API\Backend\Users\Employee\EmployeeController;
use App\Http\Controllers\API\Backend\Users\Employee\PersonalDetailsController;
use App\Http\Controllers\API\Backend\Users\Employee\EducationDetailsController;
use App\Http\Controllers\API\Backend\Users\Employee\ExperienceDetailsController;
use App\Http\Controllers\API\Backend\Users\Employee\OrganizationDetailsController;
use App\Http\Controllers\API\Backend\Users\Employee\TrainingDetailsController;
use App\Http\Controllers\API\Backend\Users\Employee\AttendenceController;





/////////////////////////////////////// Setup Controlles Part Start /////////////////////////////////////
// Super Admin Setup Controllers
use App\Http\Controllers\API\Backend\Setup\Company\CompanyTypeController;
use App\Http\Controllers\API\Backend\Setup\Company\CompanyController;
use App\Http\Controllers\API\Backend\Setup\MainHeadController;
use App\Http\Controllers\API\Backend\Setup\LocationController;
use App\Http\Controllers\API\Backend\Setup\BankController;


// Permissions Controllers
use App\Http\Controllers\API\Backend\Setup\Permission\PermissionMainHeadController;
use App\Http\Controllers\API\Backend\Setup\Permission\PermissionHeadController;
use App\Http\Controllers\API\Backend\Setup\Permission\CompanyTypePermissionController;
use App\Http\Controllers\API\Backend\Setup\Permission\CompanyPermissionController;
use App\Http\Controllers\API\Backend\Setup\Permission\UserPermissionController;


// Admin Setup Controllers
use App\Http\Controllers\API\Backend\Setup\StoreController;


// Products Setup Controllers
use App\Http\Controllers\API\Backend\Setup\Products\ManufacturerController;
use App\Http\Controllers\API\Backend\Setup\Products\CategoryController;
use App\Http\Controllers\API\Backend\Setup\Products\FormController;
use App\Http\Controllers\API\Backend\Setup\Products\UnitController;
use App\Http\Controllers\API\Backend\Setup\Products\TranGroupController;
use App\Http\Controllers\API\Backend\Setup\Products\TranHeadController;
use App\Http\Controllers\API\Backend\Setup\Products\ProductsController;


// HR Setup Payroll Controllers
use App\Http\Controllers\API\Backend\Setup\Payroll\PayrollSetupController;
use App\Http\Controllers\API\Backend\Setup\Payroll\PayrollMiddlewireController;



/////////////////////////////////////// Transaction Controlles Part Start /////////////////////////////////////
// Transactions Controllers
use App\Http\Controllers\API\Backend\Transactions\GeneralTransactionController;
use App\Http\Controllers\API\Backend\Transactions\BankTransactionController;
use App\Http\Controllers\API\Backend\Transactions\PartyTransactionController;
use App\Http\Controllers\API\Backend\Transactions\PurchaseController;
use App\Http\Controllers\API\Backend\Transactions\IssueController;
use App\Http\Controllers\API\Backend\Transactions\ClientReturnController;
use App\Http\Controllers\API\Backend\Transactions\SupplierReturnController;
use App\Http\Controllers\API\Backend\Transactions\AdjustmentController;
use App\Http\Controllers\API\Backend\Transactions\PayrollProcessController;

// Hospital Transactions
use App\Http\Controllers\API\Backend\Transactions\AdmissionFeeController;
use App\Http\Controllers\API\Backend\Transactions\DepositController;
use App\Http\Controllers\API\Backend\Transactions\DepositRefundController;
use App\Http\Controllers\API\Backend\Transactions\ServicesController;





/////////////////////////////////////// Report Controlles Part Start /////////////////////////////////////
// Salary Report Controllers
use App\Http\Controllers\API\Backend\Reports\Salary_Statement\SalarySummaryController;
use App\Http\Controllers\API\Backend\Reports\Salary_Statement\SalaryDetailController;


// Report Account Statement Controllers
use App\Http\Controllers\API\Backend\Reports\Account_Statement\AccountDetailsController;
use App\Http\Controllers\API\Backend\Reports\Account_Statement\AccountSummaryByGroupController;
use App\Http\Controllers\API\Backend\Reports\Account_Statement\AccountSummaryController;


// Report Party Statement Controllers
use App\Http\Controllers\API\Backend\Reports\Party_Statement\PartyDetailsController;
use App\Http\Controllers\API\Backend\Reports\Party_Statement\PartySummaryController;


// Product Report Controllers
use App\Http\Controllers\API\Backend\Reports\ItemFlowStatementController;
use App\Http\Controllers\API\Backend\Reports\Purchase_Statement\PurchaseDetailController;
use App\Http\Controllers\API\Backend\Reports\Purchase_Statement\PurchaseSummaryController;
use App\Http\Controllers\API\Backend\Reports\Issue_Statement\IssueDetailController;
use App\Http\Controllers\API\Backend\Reports\Issue_Statement\IssueSummaryController;
use App\Http\Controllers\API\Backend\Reports\Return_Statement\ClientReturnDetailController;
use App\Http\Controllers\API\Backend\Reports\Return_Statement\ClientReturnSummaryController;
use App\Http\Controllers\API\Backend\Reports\Return_Statement\SupplierReturnDetailController;
use App\Http\Controllers\API\Backend\Reports\Return_Statement\SupplierReturnSummaryController;
use App\Http\Controllers\API\Backend\Reports\Stock_Statement\StockDetailController;
use App\Http\Controllers\API\Backend\Reports\Stock_Statement\StockSummaryController;
use App\Http\Controllers\API\Backend\Reports\ProfitabilityStatementController;
use App\Http\Controllers\API\Backend\Reports\ExpiryStatementController;




// *************************************** Forget Password Controller Routes Start *************************************** //
Route::controller(ForgetPasswordController::class)->group(function () {
    Route::post('/forgotpassword', 'ForgotPassword');
    Route::post('/resetpassword',  'ResetPassword');
});

Route::post('/login', [AuthController::class, 'Login'])->middleware(['web']);

// Route::middleware(['auth:sanctum'])->group(function () {
Route::middleware(['auth:sanctum', ApiValidUser::class, CheckPermission::class])->group(function () {
    Route::post('/logout', [AuthController::class, 'Logout'])->middleware(['web'])->withoutMiddleware(CheckPermission::class);


    /////-----/////-----/////-----/////-----/////-----///// Admin Setup Routes Start /////-----/////-----/////-----/////-----/////-----/////
    
    Route::prefix('/admin')->group(function () {
        Route::middleware([SuperAdminAccess::class])->group(function () {
            // *************************************** Company Type Routes Start *************************************** //
            Route::controller(CompanyTypeController::class)->group(function () {
                Route::get('/companytype', 'ShowAll');
                Route::post('/companytype', 'Insert');
                Route::get('/companytype/edit', 'Edit');
                Route::put('/companytype', 'Update');
                Route::delete('/companytype', 'Delete');
                Route::get('/companytype/search', 'Search');
                Route::get('/companytype/get', 'Get')->withoutMiddleware(CheckPermission::class);
            });



            // *************************************** Company Controller Start *************************************** //
            Route::controller(CompanyController::class)->group(function () {
                Route::get('/companies', 'ShowAll');
                Route::post('/companies', 'Insert');
                Route::get('/companies/edit', 'Edit');
                Route::put('/companies', 'Update');
                Route::delete('/companies', 'Delete');
                Route::get('/companies/search', 'Search');
                Route::get('/companies/get', 'Get')->withoutMiddleware([CheckPermission::class, SuperAdminAccess::class]);
                Route::get('/companies/details', 'Details');
            });
        });



        // *************************************** User Routes Start *************************************** //
        Route::prefix('/users')->group(function () {
            Route::middleware([SuperAdminAccess::class])->group(function () {
                ///////////// --------------- Role Routes ----------- ///////////////////
                Route::controller(RoleController::class)->group(function () {
                    Route::get('/roles', 'ShowAll');
                    Route::post('/roles', 'Insert');
                    Route::get('/roles/edit', 'Edit');
                    Route::put('/roles', 'Update');
                    Route::delete('/roles', 'Delete');
                    Route::get('/roles/search', 'Search');
                    Route::get('/roles/get', 'Get')->withoutMiddleware([CheckPermission::class, SuperAdminAccess::class]);
                });



                ///////////// --------------- Super Admin Routes ----------- ///////////////////
                Route::controller(SuperAdminController::class)->group(function () {
                    Route::get('/superadmins', 'ShowAll');
                    Route::post('/superadmins', 'Insert');
                    Route::get('/superadmins/edit', 'Edit');
                    Route::put('/superadmins', 'Update');
                    Route::delete('/superadmins', 'Delete');
                    Route::get('/superadmins/search', 'Search');
                });
            });
            

            ///////////// --------------- Admin Routes ----------- ///////////////////
            Route::controller(AdminController::class)->group(function () {
                Route::get('/admins', 'ShowAll');
                Route::post('/admins', 'Insert');
                Route::get('/admins/edit', 'Edit');
                Route::put('/admins', 'Update');
                Route::delete('/admins', 'Delete');
                Route::get('/admins/search', 'Search');
                Route::get('/admins/details', 'Details');
            });
        }); // End User Routes



        // *************************************** Permission Routes Start *************************************** //
        Route::prefix('/permission')->group(function () {
            Route::middleware([SuperAdminAccess::class])->group(function () {
                ///////////// --------------- Permission Main Heads Routes ----------- ///////////////////
                Route::controller(PermissionMainHeadController::class)->group(function () {
                    Route::get('/mainhead', 'ShowAll');
                    Route::post('/mainhead', 'Insert');
                    Route::get('/mainhead/edit', 'Edit');
                    Route::put('/mainhead', 'Update');
                    Route::delete('/mainhead', 'Delete');
                    Route::get('/mainhead/search', 'Search');
                    Route::get('/mainhead/get', 'Get')->withoutMiddleware([CheckPermission::class, SuperAdminAccess::class]);
                });
                
                
                
                ///////////// --------------- Permission Heads Routes ----------- ///////////////////
                Route::controller(PermissionHeadController::class)->group(function () {
                    Route::get('/heads', 'ShowAll');
                    Route::post('/heads', 'Insert');
                    Route::get('/heads/edit', 'Edit');
                    Route::put('/heads', 'Update');
                    Route::delete('/heads', 'Delete');
                    Route::get('/heads/search', 'Search');
                    Route::get('/heads/get', 'Get')->withoutMiddleware([CheckPermission::class, SuperAdminAccess::class]);
                });
                
                
                
                ///////////// --------------- Company Type Permissions Routes ----------- ///////////////////
                Route::controller(CompanyTypePermissionController::class)->group(function () {
                    Route::get('/company_type_permissions', 'ShowAll');
                    Route::get('/company_type_permissions/edit', 'Edit');
                    Route::put('/company_type_permissions', 'Update');
                    Route::get('/company_type_permissions/search', 'Search');
                });
                
                
                
                ///////////// --------------- Company Permissions Routes ----------- ///////////////////
                Route::controller(CompanyPermissionController::class)->group(function () {
                    Route::get('/company_permissions', 'ShowAll');
                    Route::get('/company_permissions/edit', 'Edit');
                    Route::put('/company_permissions', 'Update');
                    Route::get('/company_permissions/search', 'Search');
                    // Copy Permission
                    Route::put('/company_permissions/copy', 'Copy');
                    Route::get('/company_permissions/from', 'UserFrom');
                    Route::get('/company_permissions/to', 'UserTo');
                });
            });
            
            
            
            ///////////// --------------- User Permission Routes ----------- ///////////////////
            Route::controller(UserPermissionController::class)->group(function () {
                Route::get('/userpermissions', 'ShowAll');
                Route::get('/userpermissions/edit', 'Edit');
                Route::put('/userpermissions', 'Update');
                Route::get('/userpermissions/search', 'Search');
                // Copy Permission
                Route::put('/userpermissions/copy', 'Copy');
                Route::get('/userpermissions/from', 'UserFrom');
                Route::get('/userpermissions/to', 'UserTo');
            });
        }); // End Permission Routes



        // *************************************** Bank Controller Start *************************************** //
        Route::controller(BankController::class)->group(function () {
            Route::get('/banks', 'ShowAll');
            Route::post('/banks', 'Insert')->middleware(SuperAdminAccess::class);
            Route::get('/banks/edit', 'Edit')->middleware(SuperAdminAccess::class);
            Route::put('/banks', 'Update')->middleware(SuperAdminAccess::class);
            Route::delete('/banks', 'Delete')->middleware(SuperAdminAccess::class);
            Route::get('/banks/search', 'Search');
            Route::get('/banks/get', 'Get')->withoutMiddleware(CheckPermission::class);
            Route::get('/banks/details', 'Details');
        });



        // *************************************** Location Controller Start *************************************** //
        Route::controller(LocationController::class)->group(function () {
            Route::get('/locations', 'ShowAll');
            Route::post('/locations', 'Insert')->middleware(SuperAdminAccess::class);
            Route::get('/locations/edit', 'Edit')->middleware(SuperAdminAccess::class);
            Route::put('/locations', 'Update')->middleware(SuperAdminAccess::class);
            Route::delete('/locations', 'Delete')->middleware(SuperAdminAccess::class);
            Route::get('/locations/search', 'Search');
            Route::get('/locations/get', 'Get')->withoutMiddleware(CheckPermission::class);
        });
        

        // *************************************** Store Routes Start *************************************** //
        Route::controller(StoreController::class)->group(function () {
            Route::get('/stores', 'ShowAll');
            Route::post('/stores', 'Insert');
            Route::get('/stores/edit', 'Edit');
            Route::put('/stores', 'Update');
            Route::delete('/stores', 'Delete');
            Route::get('/stores/search', 'Search');
            Route::get('/stores/get', 'Get')->withoutMiddleware(CheckPermission::class);
        });
        


        Route::middleware([SuperAdminAccess::class])->group(function () {
            // *************************************** Main Head Routes Start *************************************** //
            Route::controller(MainHeadController::class)->group(function () {
                Route::get('/mainheads', 'ShowAll');
                Route::post('/mainheads', 'Insert');
                Route::get('/mainheads/edit', 'Edit');
                Route::put('/mainheads', 'Update');
                Route::delete('/mainheads', 'Delete');
                Route::get('/mainheads/search', 'Search');
                Route::get('/mainheads/get', 'Get')->withoutMiddleware([CheckPermission::class, SuperAdminAccess::class]);
            });



            // *************************************** Tranwith Routes Start *************************************** //
            Route::controller(TranWithController::class)->group(function () {
                Route::get('/tranwith/get', 'Get')->withoutMiddleware([CheckPermission::class, SuperAdminAccess::class]);
            });



            // *************************************** TranGroupe Routes Start *************************************** //
            Route::controller(TranGroupController::class)->group(function () {
                Route::get('/trangroupes', 'ShowAll');
                Route::post('/trangroupes', 'Insert');
                Route::get('/trangroupes/edit', 'Edit');
                Route::put('/trangroupes', 'Update');
                Route::delete('/trangroupes', 'Delete');
                Route::get('/trangroupes/search', 'Search');
                Route::get('/trangroupes/get', 'Get')->withoutMiddleware([CheckPermission::class, SuperAdminAccess::class]);
                Route::get('/trangroupes/get/type', 'GetByType')->withoutMiddleware([CheckPermission::class, SuperAdminAccess::class]);
            });
            


            // *************************************** TranHead Routes Start *************************************** //
            Route::controller(TranHeadController::class)->group(function () {
                Route::get('/tranheads', 'ShowAll');
                Route::post('/tranheads', 'Insert');
                Route::get('/tranheads/edit', 'Edit');
                Route::put('/tranheads', 'Update');
                Route::delete('/tranheads', 'Delete');
                Route::get('/tranheads/search', 'Search');
                Route::get('/tranheads/get', 'Get')->withoutMiddleware([CheckPermission::class, SuperAdminAccess::class]);
            });
        });
    });

    /////-----/////-----/////-----/////-----/////-----///// Admin Setup Routes End /////-----/////-----/////-----/////-----/////-----/////





    /////-----/////-----/////-----/////-----/////-----///// Transaction Routes Start /////-----/////-----/////-----/////-----/////-----/////

    Route::prefix('/transaction')->group(function () {
        Route::prefix('/setup')->group(function () {
            // *************************************** Transaction Groupe Routes Start *************************************** //
            Route::controller(TranGroupController::class)->group(function () {
                Route::get('/groupes', 'ShowAll');
                Route::post('/groupes', 'Insert');
                Route::get('/groupes/edit', 'Edit');
                Route::put('/groupes', 'Update');
                Route::delete('/groupes', 'Delete');
                Route::get('/groupes/search', 'Search');
            });



            // *************************************** Transaction Head Routes Start *************************************** //
            Route::controller(TranHeadController::class)->group(function () {
                Route::get('/heads', 'ShowAll');
                Route::post('/heads', 'Insert');
                Route::get('/heads/edit', 'Edit');
                Route::put('/heads', 'Update');
                Route::delete('/heads', 'Delete');
                Route::get('/heads/search', 'Search');
            });
        });


        Route::prefix('/users')->group(function () {
            // *************************************** Transaction User Type Routes Start *************************************** //
            Route::controller(TranWithController::class)->group(function () {
                Route::get('/usertype', 'ShowAll');
                Route::post('/usertype', 'Insert');
                Route::get('/usertype/edit', 'Edit');
                Route::put('/usertype', 'Update');
                Route::delete('/usertype', 'Delete');
                Route::get('/usertype/search', 'Search');
            });



            ///////////// --------------- Client Routes ----------- ///////////////////
            Route::controller(ClientController::class)->group(function () {
                Route::get('/clients', 'ShowAll');
                Route::post('/clients', 'Insert');
                Route::get('/clients/edit', 'Edit');
                Route::put('/clients', 'Update');
                Route::delete('/clients', 'Delete');
                Route::get('/clients/search', 'Search');
                Route::get('/clients/details', 'Details');
            });
            
            

            ///////////// --------------- Supplier Routes ----------- ///////////////////
            Route::controller(SupplierController::class)->group(function () {
                Route::get('/suppliers', 'ShowAll');
                Route::post('/suppliers', 'Insert');
                Route::get('/suppliers/edit', 'Edit');
                Route::put('/suppliers', 'Update');
                Route::delete('/suppliers', 'Delete');
                Route::get('/suppliers/search', 'Search');
                Route::get('/suppliers/details', 'Details');
            });
        });



        // *************************************** General Transaction Routes Start *************************************** //
        Route::controller(GeneralTransactionController::class)->group(function () {
            ///////////// --------------- Transaction Receive Routes ----------- ///////////////////
            Route::get('/receive', 'ShowAllReceive');
            Route::post('/receive', 'Insert');
            Route::get('/receive/edit', 'Edit');
            Route::put('/receive', 'Update');
            Route::delete('/receive', 'Delete');
            Route::get('/receive/search', 'Search');



            ///////////// --------------- Transaction Payment Routes ----------- ///////////////////
            Route::get('/payment', 'ShowAllPayment');
            Route::post('/payment', 'Insert');
            Route::get('/payment/edit', 'Edit');
            Route::put('/payment', 'Update');
            Route::delete('/payment', 'Delete');
            Route::get('/payment/search', 'Search');


            // Common Transaction Related Routes
            Route::get('/get/user', 'GetUser')->withoutMiddleware(CheckPermission::class);
            Route::get('/get/transactiongrid', 'GetTransactionGrid')->withoutMiddleware(CheckPermission::class);
            Route::get('/get/batch', 'GetBatch')->withoutMiddleware(CheckPermission::class);
            Route::get('/get/productbatch', 'GetProductBatch')->withoutMiddleware(CheckPermission::class);
            Route::get('/get/batch/details', 'GetBatchDetails')->withoutMiddleware(CheckPermission::class);
            Route::get('/get/product/stock', 'GetProductStock')->withoutMiddleware(CheckPermission::class);
        }); // End GeneralTransactionController  



        // *************************************** Party Transaction Routes Start *************************************** //
        Route::controller(PartyTransactionController::class)->group(function () {
            Route::prefix('/party')->group(function () {
                ///////////// --------------- Receive From Client Routes ----------- ///////////////////
                Route::get('/receive', 'ShowAll');
                Route::post('/receive', 'Insert');
                Route::get('/receive/edit', 'Edit');
                // Route::put('/receive', 'Update');
                // Route::delete('/receive', 'Delete');
                Route::get('/receive/search', 'Search');


                ///////////// --------------- Payment To Supplier Routes ----------- ///////////////////
                Route::get('/payment', 'ShowAll');
                Route::post('/payment', 'Insert');
                Route::get('/payment/edit', 'Edit');
                // Route::put('/payment', 'Update');
                // Route::delete('/payment', 'Delete');
                Route::get('/payment/search', 'Search');

                // Common Routes
                Route::get('/get/due', 'GetDueList')->withoutMiddleware(CheckPermission::class);
            });
        }); // End PartyTransactionController



        // *************************************** Bank Transaction Routes Start *************************************** //
        Route::controller(BankTransactionController::class)->group(function () {
            Route::prefix('/bank')->group(function () {
                ///////////// --------------- Bank Withdraw Routes ----------- ///////////////////
                Route::get('/withdraw', 'ShowAllWithdraws');
                Route::post('/withdraw', 'Insert');
                Route::get('/withdraw/edit', 'Edit');
                Route::put('/withdraw', 'Update');
                Route::delete('/withdraw', 'Delete');
                Route::get('/withdraw/search', 'Search');



                ///////////// --------------- Bank Deposit Routes ----------- ///////////////////
                Route::get('/deposit', 'ShowAllDeposits');
                Route::post('/deposit', 'Insert');
                Route::get('/deposit/edit', 'Edit');
                Route::put('/deposit', 'Update');
                Route::delete('/deposit', 'Delete');
                Route::get('/deposit/search', 'Search');
            });
        }); // End BankTransactionController
    }); // End Transaction Routes

    /////-----/////-----/////-----/////-----/////-----///// Transaction Routes End /////-----/////-----/////-----/////-----/////-----/////





    /////-----/////-----/////-----/////-----/////-----///// HR Routes Starts /////-----/////-----/////-----/////-----/////-----/////
    
    Route::prefix('/hr')->group(function () {
        Route::prefix('/setup')->group(function () {
            // *************************************** Department Routes Start *************************************** //
            Route::controller(DepartmentController::class)->group(function () {
                Route::get('/departments', 'ShowAll');
                Route::post('/departments', 'Insert');
                Route::get('/departments/edit', 'Edit');
                Route::put('/departments', 'Update');
                Route::delete('/departments', 'Delete');
                Route::get('/departments/search', 'Search');
                Route::get('/department/get', 'Get')->withoutMiddleware(CheckPermission::class);
            });



            // *************************************** Designation Routes Start *************************************** //
            Route::controller(DesignationController::class)->group(function () {
                Route::get('/designations', 'ShowAll');
                Route::post('/designations', 'Insert');
                Route::get('/designations/edit', 'Edit');
                Route::put('/designations', 'Update');
                Route::delete('/designations', 'Delete');
                Route::get('/designations/search', 'Search');
                Route::get('/designation/get', 'Get')->withoutMiddleware(CheckPermission::class);
            });
        });



        // *************************************** Employee Routes Start *************************************** //
        Route::prefix('/employee')->group(function () {
            // *************************************** Employee Type Routes Start *************************************** //
            Route::controller(TranWithController::class)->group(function () {
                Route::get('/usertype', 'ShowAll');
                Route::post('/usertype', 'Insert');
                Route::get('/usertype/edit', 'Edit');
                Route::put('/usertype', 'Update');
                Route::delete('/usertype', 'Delete');
                Route::get('/usertype/search', 'Search');
            });



            ///////////// --------------- All Employeee Routes ----------- ///////////////////
            Route::controller(EmployeeController::class)->group(function () {
                Route::get('/all', 'ShowAll');
                // Route::post('/all', 'Insert');
                // Route::get('/all/edit', 'Edit');
                // Route::put('/all', 'Update');
                Route::delete('/all', 'Delete');
                Route::get('/all/search', 'Search');
                Route::get('/all/details', 'Details');
                Route::get('/personal/details', 'Details');
                Route::get('/education/details', 'Details');
                Route::get('/training/details', 'Details');
                Route::get('/experience/details', 'Details');
                Route::get('/organization/details', 'Details');
            });


            
            ///////////// --------------- Employee Personal Details Routes ----------- ///////////////////
            Route::controller(PersonalDetailsController::class)->group(function () {
                Route::get('/personal', 'ShowAll');
                Route::post('/personal', 'Insert');
                Route::get('/personal/edit', 'Edit');
                Route::put('/personal', 'Update');
                Route::delete('/personal', 'Delete');
                Route::get('/personal/search', 'Search');
                // Route::get('/personal/details', 'Details');
            });



            ///////////// --------------- Employee Education Details Routes ----------- ///////////////////
            Route::controller(EducationDetailsController::class)->group(function () {
                Route::get('/education', 'ShowAll');
                Route::post('/education', 'Insert');
                Route::get('/education/edit', 'Edit');
                Route::put('/education', 'Update');
                Route::delete('/education', 'Delete');
                Route::get('/education/search', 'Search');
                // Route::get('/education/details', 'Details');
                Route::get('/education/grid', 'Grid');
            });



            ///////////// --------------- Employee Training Details Routes ----------- ///////////////////
            Route::controller(TrainingDetailsController::class)->group(function () {
                Route::get('/training', 'ShowAll');
                Route::post('/training', 'Insert');
                Route::get('/training/edit', 'Edit');
                Route::put('/training', 'Update');
                Route::delete('/training', 'Delete');
                Route::get('/training/search', 'Search');
                // Route::get('/training/details', 'Details');
                Route::get('/training/grid', 'Grid');
            });



            ///////////// --------------- Employee Experience Details Routes ----------- ///////////////////
            Route::controller(ExperienceDetailsController::class)->group(function () {
                Route::get('/experience', 'ShowAll');
                Route::post('/experience', 'Insert');
                Route::get('/experience/edit', 'Edit');
                Route::put('/experience', 'Update');
                Route::delete('/experience', 'Delete');
                Route::get('/experience/search', 'Search');
                // Route::get('/experience/details', 'Details');
                Route::get('/experience/grid', 'Grid');
            });



            ///////////// --------------- Employee Organization Details Routes ----------- ///////////////////
            Route::controller(OrganizationDetailsController::class)->group(function () {
                Route::get('/organization', 'ShowAll');
                Route::post('/organization', 'Insert');
                Route::get('/organization/edit', 'Edit');
                Route::put('/organization', 'Update');
                Route::delete('/organization', 'Delete');
                Route::get('/organization/search', 'Search');
                // Route::get('/organization/details', 'Details');
                Route::get('/organization/grid', 'Grid');
            });
            
            
            

            ///////////// --------------- Employee Attendence Details Routes ----------- ///////////////////
            Route::controller(AttendenceController::class)->group(function () {
                Route::get('/attendence', 'ShowAll');
                Route::post('/attendence', 'Insert');
                Route::get('/attendence/edit', 'Edit');
                Route::put('/attendence', 'Update');
                // Route::delete('/attendence', 'Delete');
                Route::get('/attendence/search', 'Search');
            });
        }); // End Hr Employee Routes



        // *************************************** Payroll Routes Start *************************************** //
        Route::prefix('/payroll')->group(function () {
            // *************************************** HR Head Routes Start *************************************** //
            Route::controller(TranHeadController::class)->group(function () {
                Route::get('/heads', 'ShowAll');
                Route::post('/heads', 'Insert');
                Route::get('/heads/edit', 'Edit');
                Route::put('/heads', 'Update');
                Route::delete('/heads', 'Delete');
                Route::get('/heads/search', 'Search');
            });


            
            ///////////// --------------- Payroll Setup Routes ----------- ///////////////////
            Route::controller(PayrollSetupController::class)->group(function () {
                Route::get('/setup', 'ShowAll');
                Route::post('/setup', 'Insert');
                Route::get('/setup/edit', 'Edit');
                Route::put('/setup', 'Update');
                Route::delete('/setup', 'Delete');
                Route::get('/setup/search', 'Search');
            });



            ///////////// --------------- Payroll Middlewire Routes ----------- ///////////////////
            Route::controller(PayrollMiddlewireController::class)->group(function () {
                Route::get('/middlewire', 'ShowAll');
                Route::post('/middlewire', 'Insert');
                Route::get('/middlewire/edit', 'Edit');
                Route::put('/middlewire', 'Update');
                Route::delete('/middlewire', 'Delete');
                Route::get('/middlewire/search', 'Search');
            });



            ///////////// --------------- Payroll Process Routes ----------- ///////////////////
            Route::controller(PayrollProcessController::class)->group(function () {
                Route::get('/process', 'ShowAll');
                Route::post('/process', 'Insert');
                Route::get('/process/edit', 'Edit');
                // Route::put('/process', 'Update');
                // Route::delete('/process', 'Delete');
                Route::get('/process/search', 'Search');
                Route::get('/get', 'Get')->withoutMiddleware(CheckPermission::class);
                // Route::get('/get/data', 'GetByDate');
            });
        }); // End HR Payroll Routes



        // *************************************** Hr Report Routes Start *************************************** //
        Route::prefix('/report/salary')->group(function () {
            ///////////// --------------- Salary Summary Report Routes ----------- ///////////////////
            Route::controller(SalarySummaryController::class)->group(function () {
                Route::get('/summary', 'ShowAll');
                Route::get('/summary/search', 'Search');
            });



            ///////////// --------------- Salary Details Report Routes ----------- ///////////////////
            Route::controller(SalaryDetailController::class)->group(function () {
                Route::get('/details', 'ShowAll');
                Route::get('/details/search', 'Search');
            });
        }); // End Hr Report Routes
    }); // HR Routes End 

    /////-----/////-----/////-----/////-----/////-----///// HR Routes End /////-----/////-----/////-----/////-----/////-----/////

    



    /////-----/////-----/////-----/////-----/////-----///// Inventory Routes Start /////-----/////-----/////-----/////-----/////-----/////
    
    Route::prefix('/inventory')->group(function () {
        // *************************************** Inventory Setup Routes Start *************************************** //
        Route::prefix('/setup')->group(function () {
            ///////////// --------------- Inventory Manufacturer Routes ----------- ///////////////////
            Route::controller(ManufacturerController::class)->group(function () {
                Route::get('/manufacturer', 'ShowAll');
                Route::post('/manufacturer', 'Insert');
                Route::get('/manufacturer/edit', 'Edit');
                Route::put('/manufacturer', 'Update');
                Route::delete('/manufacturer', 'Delete');
                Route::get('/manufacturer/search', 'Search');
                Route::get('/manufacturer/get',  'Get')->withoutMiddleware(CheckPermission::class);
            });
    
    

            ///////////// --------------- Inventory Category Routes ----------- ///////////////////
            Route::controller(CategoryController::class)->group(function () {
                Route::get('/category', 'ShowAll');
                Route::post('/category', 'Insert');
                Route::get('/category/edit', 'Edit');
                Route::put('/category', 'Update');
                Route::delete('/category', 'Delete');
                Route::get('/category/search', 'Search');
                Route::get('/category/get', 'Get')->withoutMiddleware(CheckPermission::class);
            });
    
    

            ///////////// --------------- Inventory Unit Routes ----------- ///////////////////
            Route::controller(UnitController::class)->group(function () {
                Route::get('/unit', 'ShowAll');
                Route::post('/unit', 'Insert');
                Route::get('/unit/edit', 'Edit');
                Route::put('/unit', 'Update');
                Route::delete('/unit', 'Delete');
                Route::get('/unit/search', 'Search');
                Route::get('/unit/get', 'Get')->withoutMiddleware(CheckPermission::class);
            });
    
    

            ///////////// --------------- Inventory Form Routes ----------- ///////////////////
            Route::controller(FormController::class)->group(function () {
                Route::get('/form', 'ShowAll');
                Route::post('/form', 'Insert');
                Route::get('/form/edit', 'Edit');
                Route::put('/form', 'Update');
                Route::delete('/form', 'Delete');
                Route::get('/form/search', 'Search');
                Route::get('/form/get', 'Get')->withoutMiddleware(CheckPermission::class);
            });
    
    

            // *************************************** Item Groupe Routes Start *************************************** //
            Route::controller(TranGroupController::class)->group(function () {
                Route::get('/groupes', 'ShowAll');
                Route::post('/groupes', 'Insert');
                Route::get('/groupes/edit', 'Edit');
                Route::put('/groupes', 'Update');
                Route::delete('/groupes', 'Delete');
                Route::get('/groupes/search', 'Search');
            });



            ///////////// --------------- Inventory Products Routes ----------- ///////////////////
            Route::controller(ProductsController::class)->group(function () {
                Route::get('/product', 'ShowAll');
                Route::post('/product', 'Insert');
                Route::get('/product/edit', 'Edit');
                Route::put('/product', 'Update');
                Route::delete('/product', 'Delete');
                Route::get('/product/search', 'Search');
                Route::get('/product/get', 'Get')->withoutMiddleware(CheckPermission::class);
                Route::get('/product/get/list', 'GetProductList')->withoutMiddleware(CheckPermission::class);
            });
        }); // End Inventory Setup Routes




        Route::prefix('/users')->group(function () {
            // *************************************** Transaction User Type Routes Start *************************************** //
            Route::controller(TranWithController::class)->group(function () {
                Route::get('/usertype', 'ShowAll');
                Route::post('/usertype', 'Insert');
                Route::get('/usertype/edit', 'Edit');
                Route::put('/usertype', 'Update');
                Route::delete('/usertype', 'Delete');
                Route::get('/usertype/search', 'Search');
            });



            ///////////// --------------- Client Routes ----------- ///////////////////
            Route::controller(ClientController::class)->group(function () {
                Route::get('/clients', 'ShowAll');
                Route::post('/clients', 'Insert');
                Route::get('/clients/edit', 'Edit');
                Route::put('/clients', 'Update');
                Route::delete('/clients', 'Delete');
                Route::get('/clients/search', 'Search');
                Route::get('/clients/details', 'Details');
            });
            
            

            ///////////// --------------- Supplier Routes ----------- ///////////////////
            Route::controller(SupplierController::class)->group(function () {
                Route::get('/suppliers', 'ShowAll');
                Route::post('/suppliers', 'Insert');
                Route::get('/suppliers/edit', 'Edit');
                Route::put('/suppliers', 'Update');
                Route::delete('/suppliers', 'Delete');
                Route::get('/suppliers/search', 'Search');
                Route::get('/suppliers/details', 'Details');
            });
        });



        // *************************************** Inventory Transaction Routes Start *************************************** //
        Route::prefix('/transaction')->group(function () {
            ///////////// --------------- Inventory Purchase Routes ----------- ///////////////////
            Route::controller(PurchaseController::class)->group(function () {
                Route::get('/purchase', 'ShowAll');
                Route::post('/purchase', 'Insert');
                Route::get('/purchase/edit', 'Edit');
                Route::put('/purchase', 'Update');
                Route::delete('/purchase', 'Delete');
                Route::get('/purchase/search', 'Search');
                Route::delete('/purchase/verify', 'Verify');
            });



            ///////////// --------------- Inventory Issue Routes ----------- ///////////////////
            Route::controller(IssueController::class)->group(function () {
                Route::get('/issue', 'ShowAll');
                Route::post('/issue', 'Insert');
                Route::get('/issue/edit', 'Edit');
                Route::put('/issue', 'Update');
                Route::delete('/issue', 'Delete');
                Route::get('/issue/search', 'Search');
            });


            
            ///////////// --------------- Inventory Return Routes ----------- ///////////////////
            Route::prefix('/return')->group(function () {
                // *************** Inventory Supplier Return Routes *************** //
                Route::controller(SupplierReturnController::class)->group(function () {
                    Route::get('/supplier', 'ShowAll');
                    Route::post('/supplier', 'Insert');
                    // Route::get('/supplier/edit', 'Edit');
                    // Route::put('/supplier', 'Update');
                    Route::delete('/supplier', 'Delete');
                    Route::get('/supplier/search', 'Search');
                });
                
                
                
                // *************** Inventory Client Return Routes *************** //
                Route::controller(ClientReturnController::class)->group(function () {
                    Route::get('/client', 'ShowAll');
                    Route::post('/client', 'Insert');
                    // Route::get('/client/edit', 'Edit');
                    // Route::put('/client', 'Update');
                    Route::delete('/client', 'Delete');
                    Route::get('/client/search', 'Search');
                });
            }); // End Inventory Transaction Return Routes
        }); // End Inventory Transaction Routes



        // *************************************** Inventory Adjustment Routes Start *************************************** //
        Route::prefix('/adjustment')->group(function () {
            Route::controller(AdjustmentController::class)->group(function () {
                ///////////// --------------- Inventory Positive Adjustment Routes ----------- ///////////////////
                Route::get('/positive', 'ShowAll');
                Route::post('/positive', 'Insert');
                Route::get('/positive/edit', 'Edit');
                Route::put('/positive', 'Update');
                Route::delete('/positive', 'Delete');
                Route::get('/positive/search', 'Search');



                ///////////// --------------- Inventory Negative Adjustment Routes ----------- ///////////////////
                Route::get('/negative', 'ShowAll');
                Route::post('/negative', 'Insert');
                Route::get('/negative/edit', 'Edit');
                Route::put('/negative', 'Update');
                Route::delete('/negative', 'Delete');
                Route::get('/negative/search', 'Search');
            });
        }); // End Inventory Adjustment Routes



        // *************************************** Party Transaction Routes Start *************************************** //
        Route::controller(PartyTransactionController::class)->group(function () {
            Route::prefix('/party')->group(function () {
                ///////////// --------------- Receive From Client Routes ----------- ///////////////////
                Route::get('/receive', 'ShowAll');
                Route::post('/receive', 'Insert');
                Route::get('/receive/edit', 'Edit');
                // Route::put('/receive', 'Update');
                // Route::delete('/receive', 'Delete');
                Route::get('/receive/search', 'Search');


                ///////////// --------------- Payment To Supplier Routes ----------- ///////////////////
                Route::get('/payment', 'ShowAll');
                Route::post('/payment', 'Insert');
                Route::get('/payment/edit', 'Edit');
                // Route::put('/payment', 'Update');
                // Route::delete('/payment', 'Delete');
                Route::get('/payment/search', 'Search');

                // Common Routes
                Route::get('/get/due', 'GetDueList')->withoutMiddleware(CheckPermission::class);
            });
        }); // End PartyTransactionController



        // *************************************** Inventory Report Routes Start *************************************** //
        Route::prefix('/report')->group(function () {
            ///////////// --------------- Inventory Item Flow Statement Routes ----------- ///////////////////
            Route::controller(ItemFlowStatementController::class)->group(function () {
                Route::get('/item/flow', 'ShowAll');
                Route::get('/item/flow/search', 'Search');
            });
    
    

            ///////////// --------------- Inventory Purchase Statement Routes ----------- ///////////////////
            Route::prefix('/purchase')->group(function () {
                // *************** Inventory Purchase Summary Statement Routes *************** //
                Route::controller(PurchaseSummaryController::class)->group(function () {
                    Route::get('/summary', 'ShowAll');
                    Route::get('/summary/search', 'Search');
                });
                
                
                
                // *************** Inventory Purchase Detail Statement Routes *************** //
                Route::controller(PurchaseDetailController::class)->group(function () {
                    Route::get('/details', 'ShowAll');
                    Route::get('/details/search', 'Search');
                });
            });


            
            ///////////// --------------- Inventory Issue Statement Routes ----------- ///////////////////
            Route::prefix('/issue')->group(function () {
                // *************** Inventory Issue Summary Statement Routes *************** //
                Route::controller(IssueSummaryController::class)->group(function () {
                    Route::get('/summary', 'ShowAll');
                    Route::get('/summary/search', 'Search');
                });
                
                
                
                // *************** Inventory Issue Detail Statement Routes *************** //
                Route::controller(IssueDetailController::class)->group(function () {
                    Route::get('/details', 'ShowAll');
                    Route::get('/details/search', 'Search');
                });
            });



            ///////////// --------------- Inventory Return Statement Routes ----------- ///////////////////
            Route::prefix('/return')->group(function () {
                // *************** Inventory Client Return Summary Statement Routes *************** //
                Route::controller(ClientReturnSummaryController::class)->group(function () {
                    Route::get('/client/summary', 'ShowAll');
                    Route::get('/client/summary/search', 'Search');
                });
                
                
                
                // *************** Inventory Client Return Detail Statement Routes *************** //
                Route::controller(ClientReturnDetailController::class)->group(function () {
                    Route::get('/client/details', 'ShowAll');
                    Route::get('/client/details/search', 'Search');
                });



                // *************** Inventory Supplier Return Summary Statement Routes *************** //
                Route::controller(SupplierReturnSummaryController::class)->group(function () {
                    Route::get('/supplier/summary', 'ShowAll');
                    Route::get('/supplier/summary/search', 'Search');
                });
                
                
                
                // *************** Inventory Supplier Return Detail Statement Routes *************** //
                Route::controller(SupplierReturnDetailController::class)->group(function () {
                    Route::get('/supplier/details', 'ShowAll');
                    Route::get('/supplier/details/search', 'Search');
                });
            });



            ///////////// --------------- Inventory Stock Statement Routes ----------- ///////////////////
            Route::prefix('/stock')->group(function () {
                // *************** Inventory Stock Summary Statement Routes *************** //
                Route::controller(StockSummaryController::class)->group(function () {
                    Route::get('/summary', 'ShowAll');
                    Route::get('/summary/search', 'Search');
                });
                
                
                
                // *************** Inventory Stock Detail Statement Routes *************** //
                Route::controller(StockDetailController::class)->group(function () {
                    Route::get('/details', 'ShowAll');
                    Route::get('/details/search', 'Search');
                });
            });



            ///////////// --------------- Inventory Profitability Statement Routes ----------- ///////////////////
            Route::controller(ProfitabilityStatementController::class)->group(function () {
                Route::get('/profitability/statement', 'ShowAll');
                Route::get('/profitability/statement/search', 'Search');
            });



            ///////////// --------------- Inventory Expiry Statement Routes ----------- ///////////////////
            Route::controller(ExpiryStatementController::class)->group(function () {
                Route::get('/expiry/statement', 'ShowAll');
                Route::get('/expiry/statement/search', 'Search');
            });
        }); // End Inventory Report Routes
    }); // End Inventory Routes

    /////-----/////-----/////-----/////-----/////-----///// Inventory Routes End /////-----/////-----/////-----/////-----/////-----/////
    
    



    /////-----/////-----/////-----/////-----/////-----///// Report Routes Start /////-----/////-----/////-----/////-----/////-----/////
    
    Route::prefix('/report')->group(function () {
        // *************************************** Account Statement Routes Start *************************************** //
        Route::prefix('/account')->group(function () {
            ///////////// --------------- Account Summary Statement Routes ----------- ///////////////////
            Route::controller(AccountSummaryController::class)->group(function () {
                Route::get('/summary', 'ShowAll');
                Route::get('/summary/search', 'Search');
            });
            
            
            
            ///////////// --------------- Account Summary(By Groupe) Statement Routes ----------- ///////////////////
            Route::controller(AccountSummaryByGroupController::class)->group(function () {
                Route::get('/summarygroupe', 'ShowAll');
                Route::get('/summarygroupe/search', 'Search');
            });
            
            
            
            ///////////// --------------- Account Details Statement Routes ----------- ///////////////////
            Route::controller(AccountDetailsController::class)->group(function () {
                Route::get('/details', 'ShowAll');
                Route::get('/details/search', 'Search');
            });
        }); // End Account Statement Routes
        
        
        
        // *************************************** Party Statement Routes Start *************************************** //
        Route::prefix('/party')->group(function () {
            ///////////// --------------- Party Summary Statement Routes ----------- ///////////////////
            Route::controller(PartySummaryController::class)->group(function () {
                Route::get('/summary', 'ShowAll');
                Route::get('/summary/search', 'Search');
            });
            
            
            
            ///////////// --------------- Party Detail Statement Routes ----------- ///////////////////
            Route::controller(PartyDetailsController::class)->group(function () {
                Route::get('/details', 'ShowAll');
                Route::get('/details/search', 'Search');
            });
        }); // End Party Statement Routes
    }); // End Report Routes 
    
    /////-----/////-----/////-----/////-----/////-----///// Report Routes End /////-----/////-----/////-----/////-----/////-----/////
});





Route::middleware(['web'])->group(function () {
    Route::get('/get/invoice', [GeneralTransactionController::class, 'Invoice']);

    Route::get('/hr/report/salary/summary/print', [SalarySummaryController::class, 'Print']);
    Route::get('/hr/report/salary/details/print', [SalaryDetailController::class, 'Print']);


    Route::get('/inventory/report/item/flow/print', [ItemFlowStatementController::class, 'Print']);
    Route::get('/inventory/report/stock/details/print', [StockDetailController::class, 'Print']);
    Route::get('/inventory/report/stock/summary/print', [StockSummaryController::class, 'Print']);
    Route::get('/inventory/report/profitability/statement/print', [ProfitabilityStatementController::class, 'Print']);
    Route::get('/inventory/report/expiry/statement/print', [ExpiryStatementController::class, 'Print']);
    Route::get('/inventory/report/purchase/details/print', [PurchaseDetailController::class, 'Print']);
    Route::get('/inventory/report/purchase/summary/print', [PurchaseSummaryController::class, 'Print']);
    Route::get('/inventory/report/issue/details/print', [IssueDetailController::class, 'Print']);
    Route::get('/inventory/report/issue/summary/print', [IssueSummaryController::class, 'Print']);
    Route::get('/inventory/report/return/client/details/print', [ClientReturnDetailController::class, 'Print']);
    Route::get('/inventory/report/return/client/summary/print', [ClientReturnSummaryController::class, 'Print']);
    Route::get('/inventory/report/return/supplier/details/print', [SupplierReturnDetailController::class, 'Print']);
    Route::get('/inventory/report/return/supplier/summary/print', [SupplierReturnSummaryController::class, 'Print']);
    

    Route::get('/report/account/summary/print', [AccountSummaryController::class, 'Print']);
    Route::get('/report/account/summarygroupe/print', [AccountSummaryByGroupController::class, 'Print']);
    Route::get('/report/account/details/print', [AccountDetailsController::class, 'Print']);
    
    Route::get('/report/party/details/print', [PartyDetailsController::class, 'Print']);
    Route::get('/report/party/summary/print', [PartySummaryController::class, 'Print']);

});