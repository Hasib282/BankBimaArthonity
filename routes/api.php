<?php

use App\Http\Middleware\ApiValidUser;
use App\Http\Middleware\SuperAdminAccess;
use App\Http\Middleware\CheckPermission;
use App\Http\Middleware\AdminSuperAdminAccess;
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


//Corporate Controller
use App\Http\Controllers\API\Backend\Setup\CorporateController;


// Admin Setup Controllers
use App\Http\Controllers\API\Backend\Setup\StoreController;
use App\Http\Controllers\API\Backend\Setup\PaymentMethodController;


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


// Report Collection Statement Controllers
use App\Http\Controllers\API\Backend\Reports\Collection_Statement\CollectionDetailsController;
use App\Http\Controllers\API\Backend\Reports\Collection_Statement\CollectionSummaryController;
use App\Http\Controllers\API\Backend\Reports\Collection_Statement\CollectionInvoiceDetailsController;
use App\Http\Controllers\API\Backend\Reports\Collection_Statement\CollectionInvoiceSummaryController;


// Report Payment Statement Controllers
use App\Http\Controllers\API\Backend\Reports\Payment_Statement\PaymentDetailsController;
use App\Http\Controllers\API\Backend\Reports\Payment_Statement\PaymentSummaryController;
use App\Http\Controllers\API\Backend\Reports\Payment_Statement\PaymentInvoiceDetailsController;
use App\Http\Controllers\API\Backend\Reports\Payment_Statement\PaymentInvoiceSummaryController;


// Report Consolidated Statement Controllers
use App\Http\Controllers\API\Backend\Reports\Consolidated_Statement\ConsolidatedDetailsController;
use App\Http\Controllers\API\Backend\Reports\Consolidated_Statement\ConsolidatedSummaryController;
use App\Http\Controllers\API\Backend\Reports\Consolidated_Statement\ConsolidatedInvoiceDetailsController;
use App\Http\Controllers\API\Backend\Reports\Consolidated_Statement\ConsolidatedInvoiceSummaryController;


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
                Route::get('/companytype', 'Show');
                Route::post('/companytype', 'Insert');
                Route::put('/companytype', 'Update');
                Route::delete('/companytype', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/companytype/delete', 'DeleteStatus');
                Route::get('/companytype/get', 'Get')->withoutMiddleware(CheckPermission::class);
            });



            // *************************************** Company Controller Start *************************************** //
            Route::controller(CompanyController::class)->group(function () {
                Route::get('/companies', 'Show');
                Route::post('/companies', 'Insert');
                Route::put('/companies', 'Update');
                Route::delete('/companies', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/companies/delete', 'DeleteStatus');
                Route::get('/companies/details', 'Details');
                Route::get('/companies/get', 'Get')->withoutMiddleware([CheckPermission::class, SuperAdminAccess::class]);
            });
        });



        // *************************************** User Routes Start *************************************** //
        Route::prefix('/users')->group(function () {
            Route::middleware([SuperAdminAccess::class])->group(function () {
                ///////////// --------------- Role Routes ----------- ///////////////////
                Route::controller(RoleController::class)->group(function () {
                    Route::get('/roles', 'Show');
                    Route::post('/roles', 'Insert');
                    Route::put('/roles', 'Update');
                    Route::delete('/roles', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                    Route::delete('/role/delete', 'DeleteStatus');
                    Route::get('/roles/get', 'Get')->withoutMiddleware([CheckPermission::class, SuperAdminAccess::class]);
                });



                ///////////// --------------- Super Admin Routes ----------- ///////////////////
                Route::controller(SuperAdminController::class)->group(function () {
                    Route::get('/superadmins', 'Show');
                    Route::post('/superadmins', 'Insert');
                    Route::put('/superadmins', 'Update');
                    Route::delete('/superadmins', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                    Route::delete('/superadmins/delete', 'DeleteStatus');
                });
            });
            

            ///////////// --------------- Admin Routes ----------- ///////////////////
            Route::controller(AdminController::class)->group(function () {
                Route::get('/admins', 'Show');
                Route::post('/admins', 'Insert');
                Route::put('/admins', 'Update');
                Route::delete('/admins', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/admins/delete', 'DeleteStatus');
            });
        }); // End User Routes



        // *************************************** Permission Routes Start *************************************** //
        Route::prefix('/permission')->group(function () {
            Route::middleware([SuperAdminAccess::class])->group(function () {
                ///////////// --------------- Permission Main Heads Routes ----------- ///////////////////
                Route::controller(PermissionMainHeadController::class)->group(function () {
                    Route::get('/mainhead', 'Show');
                    Route::post('/mainhead', 'Insert');
                    Route::put('/mainhead', 'Update');
                    Route::delete('/mainhead', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                    Route::delete('/mainhead/delete', 'DeleteStatus');
                    Route::get('/mainhead/get', 'Get')->withoutMiddleware([CheckPermission::class, SuperAdminAccess::class]);
                });
                
                
                
                ///////////// --------------- Permission Heads Routes ----------- ///////////////////
                Route::controller(PermissionHeadController::class)->group(function () {
                    Route::get('/heads', 'Show');
                    Route::post('/heads', 'Insert');
                    Route::put('/heads', 'Update');
                    Route::delete('/heads', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                    Route::delete('/heads/delete', 'DeleteStatus');
                    Route::get('/heads/get', 'Get')->withoutMiddleware([CheckPermission::class, SuperAdminAccess::class]);
                });
                
                
                
                
                ///////////// --------------- Company Type Permissions Routes ----------- ///////////////////
                Route::controller(CompanyTypePermissionController::class)->group(function () {
                    Route::get('/company_type_permissions', 'Show');
                    Route::get('/company_type_permissions/edit', 'Edit');
                    Route::put('/company_type_permissions', 'Update');
                    Route::get('/company_type_permissions/search', 'Search');
                });
                
                
                
                ///////////// --------------- Company Permissions Routes ----------- ///////////////////
                Route::controller(CompanyPermissionController::class)->group(function () {
                    Route::get('/company_permissions', 'Show');
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
                Route::get('/userpermissions', 'Show');
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
            Route::get('/banks', 'Show');
            Route::post('/banks', 'Insert');
            Route::put('/banks', 'Update');
            Route::delete('/banks', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
            Route::delete('/banks/delete', 'DeleteStatus');
            Route::get('/banks/details', 'Details');
            Route::get('/banks/get', 'Get')->withoutMiddleware(CheckPermission::class);
        });



        // *************************************** Location Controller Start *************************************** //
        Route::controller(LocationController::class)->group(function () {
            Route::get('/locations', 'Show');
            Route::post('/locations', 'Insert');
            Route::put('/locations', 'Update');
            Route::delete('/locations', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
            Route::delete('/locations/delete', 'DeleteStatus');
            Route::get('/locations/get', 'Get')->withoutMiddleware(CheckPermission::class);
        });


        // *************************************** Store Routes Start *************************************** //
        Route::controller(StoreController::class)->group(function () {
            Route::get('/stores', 'Show');
            Route::post('/stores', 'Insert');
            Route::put('/stores', 'Update');
            Route::delete('/stores', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
            Route::delete('/stores/delete', 'DeleteStatus');
            Route::get('/stores/get', 'Get')->withoutMiddleware(CheckPermission::class);
        });
        
        

        // *************************************** PaymentMethodController Routes Start *************************************** //
        Route::controller(PaymentMethodController::class)->group(function () {
            Route::get('/payment_method', 'Show');
            Route::post('/payment_method', 'Insert');
            Route::put('/payment_method', 'Update');
            Route::delete('/payment_method', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
            Route::delete('/payment_method/delete', 'DeleteStatus');
            Route::get('/payment_method/get', 'Get')->withoutMiddleware(CheckPermission::class);
        });

        
        


        Route::middleware([SuperAdminAccess::class])->group(function () {
            // *************************************** Main Head Routes Start *************************************** //
            Route::controller(MainHeadController::class)->group(function () {
                Route::get('/mainheads', 'Show');
                Route::post('/mainheads', 'Insert');
                Route::put('/mainheads', 'Update');
                Route::delete('/mainheads', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/mainheads/delete', 'DeleteStatus');
                Route::get('/mainheads/get', 'Get')->withoutMiddleware([CheckPermission::class, SuperAdminAccess::class]);
            });



            // *************************************** Tranwith Routes Start *************************************** //
            Route::controller(TranWithController::class)->group(function () {
                Route::get('/tranwith/get', 'Get')->withoutMiddleware([CheckPermission::class, SuperAdminAccess::class]);
            });



            // *************************************** TranGroupe Routes Start *************************************** //
            Route::controller(TranGroupController::class)->group(function () {
                Route::get('/trangroupes', 'Show');
                Route::post('/trangroupes', 'Insert');
                Route::put('/trangroupes', 'Update');
                Route::delete('/trangroupes', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/trangroupes/delete', 'DeleteStatus');
                Route::get('/trangroupes/get', 'Get')->withoutMiddleware([CheckPermission::class, SuperAdminAccess::class]);
            });
            


            // *************************************** TranHead Routes Start *************************************** //
            Route::controller(TranHeadController::class)->group(function () {
                Route::get('/tranheads', 'Show');
                Route::post('/tranheads', 'Insert');
                Route::put('/tranheads', 'Update');
                Route::delete('/tranheads', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/tranheads/delete', 'DeleteStatus');
                Route::get('/tranheads/get', 'Get')->withoutMiddleware([CheckPermission::class, SuperAdminAccess::class]);
            });
        });

        // *************************************** corporate  Routes Start *************************************** //
        Route::controller(CorporateController::class)->group(function () {
            Route::get('/corporate', 'Show');
            Route::post('/corporate', 'Insert');
            Route::put('/corporate', 'Update');
            Route::delete('/corporate', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
            Route::delete('/corporate/delete', 'DeleteStatus');
            Route::get('/corporate/get', 'Get')->withoutMiddleware(CheckPermission::class);
        });
    });

    /////-----/////-----/////-----/////-----/////-----///// Admin Setup Routes End /////-----/////-----/////-----/////-----/////-----/////





    /////-----/////-----/////-----/////-----/////-----///// Transaction Routes Start /////-----/////-----/////-----/////-----/////-----/////

    Route::prefix('/transaction')->group(function () {
        Route::prefix('/setup')->group(function () {
            // *************************************** Transaction Groupe Routes Start *************************************** //
            Route::controller(TranGroupController::class)->group(function () {
                Route::get('/groupes', 'Show');
                Route::post('/groupes', 'Insert');
                Route::put('/groupes', 'Update');
                Route::delete('/groupes', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/groupes/delete', 'DeleteStatus');
            });



            // *************************************** Transaction Head Routes Start *************************************** //
            Route::controller(TranHeadController::class)->group(function () {
                Route::get('/heads', 'Show');
                Route::post('/heads', 'Insert');
                Route::put('/heads', 'Update');
                Route::delete('/heads', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/heads/delete', 'DeleteStatus');
            });
        });


        Route::prefix('/users')->group(function () {
            // *************************************** Transaction User Type Routes Start *************************************** //
            Route::controller(TranWithController::class)->group(function () {
                Route::get('/usertype', 'Show');
                Route::post('/usertype', 'Insert');
                Route::put('/usertype', 'Update');
                Route::delete('/usertype', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/usertype/delete', 'DeleteStatus');
            });



            ///////////// --------------- Client Routes ----------- ///////////////////
            Route::controller(ClientController::class)->group(function () {
                Route::get('/clients', 'Show');
                Route::post('/clients', 'Insert');
                Route::put('/clients', 'Update');
                Route::delete('/clients', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/clients/delete', 'DeleteStatus');
                Route::get('/clients/details', 'Details');
            });
            
            

            ///////////// --------------- Supplier Routes ----------- ///////////////////
            Route::controller(SupplierController::class)->group(function () {
                Route::get('/suppliers', 'Show');
                Route::post('/suppliers', 'Insert');
                Route::put('/suppliers', 'Update');
                Route::delete('/suppliers', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/suppliers/delete', 'DeleteStatus');
                Route::get('/suppliers/details', 'Details');
            });
        });



        // *************************************** General Transaction Routes Start *************************************** //
        Route::controller(GeneralTransactionController::class)->group(function () {
            ///////////// --------------- Transaction Receive Routes ----------- ///////////////////
            Route::get('/receive', 'ShowAllReceive');
            Route::post('/receive', 'Insert');
            Route::put('/receive', 'Update');
            Route::delete('/receive', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
            Route::delete('/receive/delete', 'DeleteStatus');
            Route::get('/receive/search', 'Search');



            ///////////// --------------- Transaction Payment Routes ----------- ///////////////////
            Route::get('/payment', 'ShowAllPayment');
            Route::post('/payment', 'Insert');
            Route::put('/payment', 'Update');
            Route::delete('/payment', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
            Route::delete('/payment/delete', 'DeleteStatus');
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
                Route::get('/receive', 'Show');
                Route::post('/receive', 'Insert');
                // Route::put('/receive', 'Update');
                // Route::delete('/receive', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                //Route::delete('/receive/delete', 'DeleteStatus');

                Route::get('/receive/search', 'Search');


                ///////////// --------------- Payment To Supplier Routes ----------- ///////////////////
                Route::get('/payment', 'Show');
                Route::post('/payment', 'Insert');
                // Route::put('/payment', 'Update');
                // Route::delete('/payment', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                //Route::delete('/payment/delete', 'DeleteStatus');
                
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
                Route::put('/withdraw', 'Update');
                Route::delete('/withdraw', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/withdraw/delete', 'DeleteStatus');
                Route::get('/withdraw/search', 'Search');



                ///////////// --------------- Bank Deposit Routes ----------- ///////////////////
                Route::get('/deposit', 'ShowAllDeposits');
                Route::post('/deposit', 'Insert');
                Route::put('/deposit', 'Update');
                Route::delete('/deposit', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/deposit/delete', 'DeleteStatus');
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
                Route::get('/departments', 'Show');
                Route::post('/departments', 'Insert');
                Route::put('/departments', 'Update');
                Route::delete('/departments', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/departments/delete', 'DeleteStatus');
                Route::get('/department/get', 'Get')->withoutMiddleware(CheckPermission::class);
            });



            // *************************************** Designation Routes Start *************************************** //
            Route::controller(DesignationController::class)->group(function () {
                Route::get('/designations', 'Show');
                Route::post('/designations', 'Insert');
                Route::put('/designations', 'Update');
                Route::delete('/designations', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/designations/delete', 'DeleteStatus');
                Route::get('/designation/get', 'Get')->withoutMiddleware(CheckPermission::class);
            });
        });



        // *************************************** Employee Routes Start *************************************** //
        Route::prefix('/employee')->group(function () {
            // *************************************** Employee Type Routes Start *************************************** //
            Route::controller(TranWithController::class)->group(function () {
                Route::get('/usertype', 'Show');
                Route::post('/usertype', 'Insert');
                Route::put('/usertype', 'Update');
                Route::delete('/usertype', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/usertype/delete', 'DeleteStatus');
            });



            ///////////// --------------- All Employeee Routes ----------- ///////////////////
            Route::controller(EmployeeController::class)->group(function () {
                Route::get('/all', 'Show');
                Route::delete('/all', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::get('/all/details', 'Details');
                Route::get('/personal/details', 'Details');
                Route::get('/education/details', 'Details');
                Route::get('/training/details', 'Details');
                Route::get('/experience/details', 'Details');
                Route::get('/organization/details', 'Details');
            });


            
            ///////////// --------------- Employee Personal Details Routes ----------- ///////////////////
            Route::controller(PersonalDetailsController::class)->group(function () {
                Route::get('/personal', 'Show');
                Route::post('/personal', 'Insert');
                Route::put('/personal', 'Update');
                Route::delete('/personal', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/personal/delete', 'DeleteStatus');
            });



            ///////////// --------------- Employee Education Details Routes ----------- ///////////////////
            Route::controller(EducationDetailsController::class)->group(function () {
                Route::get('/education', 'Show');
                Route::post('/education', 'Insert');
                Route::get('/education/edit', 'Edit');
                Route::put('/education', 'Update');
                Route::delete('/education', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/education/delete', 'DeleteStatus');
                Route::get('/education/grid', 'Grid');
            });



            ///////////// --------------- Employee Training Details Routes ----------- ///////////////////
            Route::controller(TrainingDetailsController::class)->group(function () {
                Route::get('/training', 'Show');
                Route::post('/training', 'Insert');
                Route::get('/training/edit', 'Edit');
                Route::put('/training', 'Update');
                Route::delete('/training', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/training/delete', 'DeleteStatus');
                Route::get('/training/grid', 'Grid');
            });



            ///////////// --------------- Employee Experience Details Routes ----------- ///////////////////
            Route::controller(ExperienceDetailsController::class)->group(function () {
                Route::get('/experience', 'Show');
                Route::post('/experience', 'Insert');
                Route::get('/experience/edit', 'Edit');
                Route::put('/experience', 'Update');
                Route::delete('/experience', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/experience/delete', 'DeleteStatus');
                Route::get('/experience/grid', 'Grid');
            });



            ///////////// --------------- Employee Organization Details Routes ----------- ///////////////////
            Route::controller(OrganizationDetailsController::class)->group(function () {
                Route::get('/organization', 'Show');
                Route::post('/organization', 'Insert');
                Route::get('/organization/edit', 'Edit');
                Route::put('/organization', 'Update');
                Route::delete('/organization', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/organization/delete', 'DeleteStatus');
                Route::get('/organization/grid', 'Grid');
            });
            
            
            

            ///////////// --------------- Employee Attendence Details Routes ----------- ///////////////////
            Route::controller(AttendenceController::class)->group(function () {
                Route::get('/attendence', 'Show');
                Route::post('/attendence', 'Insert');
                Route::put('/attendence', 'Update');
                Route::delete('/attendence', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/attendence/delete', 'DeleteStatus');

            });
        }); // End Hr Employee Routes



        // *************************************** Payroll Routes Start *************************************** //
        Route::prefix('/payroll')->group(function () {
            // *************************************** HR Head Routes Start *************************************** //
            Route::controller(TranHeadController::class)->group(function () {
                Route::get('/heads', 'Show');
                Route::post('/heads', 'Insert');
                Route::put('/heads', 'Update');
                Route::delete('/heads', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/heads/delete', 'DeleteStatus');
            });


            
            ///////////// --------------- Payroll Setup Routes ----------- ///////////////////
            Route::controller(PayrollSetupController::class)->group(function () {
                Route::get('/setup', 'Show');
                Route::post('/setup', 'Insert');
                Route::put('/setup', 'Update');
                Route::delete('/setup', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/setup/delete', 'DeleteStatus');
                Route::get('/setup/get', 'Get')->withoutMiddleware(CheckPermission::class);
            });



            ///////////// --------------- Payroll Middlewire Routes ----------- ///////////////////
            Route::controller(PayrollMiddlewireController::class)->group(function () {
                Route::get('/middlewire', 'Show');
                Route::post('/middlewire', 'Insert');
                Route::put('/middlewire', 'Update');
                Route::delete('/middlewire', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/middlewire/delete', 'DeleteStatus');
            });



            ///////////// --------------- Payroll Process Routes ----------- ///////////////////
            Route::controller(PayrollProcessController::class)->group(function () {
                Route::get('/process', 'Show');
                Route::post('/process', 'Insert');
                Route::get('/process/edit', 'Edit');
                // Route::put('/process', 'Update');
                // Route::delete('/process', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::get('/process/search', 'Search');
                Route::get('/get', 'Get')->withoutMiddleware(CheckPermission::class);
                // Route::get('/get/data', 'GetByDate');
            });
        }); // End HR Payroll Routes



        // *************************************** Hr Report Routes Start *************************************** //
        Route::prefix('/report/salary')->group(function () {
            ///////////// --------------- Salary Summary Report Routes ----------- ///////////////////
            Route::controller(SalarySummaryController::class)->group(function () {
                Route::get('/summary', 'Show');
                Route::get('/summary/search', 'Search');
            });



            ///////////// --------------- Salary Details Report Routes ----------- ///////////////////
            Route::controller(SalaryDetailController::class)->group(function () {
                Route::get('/details', 'Show');
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
                Route::get('/manufacturer', 'Show');
                Route::post('/manufacturer', 'Insert');
                Route::put('/manufacturer', 'Update');
                Route::delete('/manufacturer', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/manufacturer/delete', 'DeleteStatus');
                Route::get('/manufacturer/get',  'Get')->withoutMiddleware(CheckPermission::class);
            });
    
    

            ///////////// --------------- Inventory Category Routes ----------- ///////////////////
            Route::controller(CategoryController::class)->group(function () {
                Route::get('/category', 'Show');
                Route::post('/category', 'Insert');
                Route::put('/category', 'Update');
                Route::delete('/category', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/category/delete', 'DeleteStatus');
                Route::get('/category/get', 'Get')->withoutMiddleware(CheckPermission::class);
            });
    
    

            ///////////// --------------- Inventory Unit Routes ----------- ///////////////////
            Route::controller(UnitController::class)->group(function () {
                Route::get('/unit', 'Show');
                Route::post('/unit', 'Insert');
                Route::put('/unit', 'Update');
                Route::delete('/unit', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/unit/delete', 'DeleteStatus');
                Route::get('/unit/get', 'Get')->withoutMiddleware(CheckPermission::class);
            });
    
    

            ///////////// --------------- Inventory Form Routes ----------- ///////////////////
            Route::controller(FormController::class)->group(function () {
                Route::get('/form', 'Show');
                Route::post('/form', 'Insert');
                Route::put('/form', 'Update');
                Route::delete('/form', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/form/delete', 'DeleteStatus');
                Route::get('/form/get', 'Get')->withoutMiddleware(CheckPermission::class);
            });
    
    

            // *************************************** Item Groupe Routes Start *************************************** //
            Route::controller(TranGroupController::class)->group(function () {
                Route::get('/groupes', 'Show');
                Route::post('/groupes', 'Insert');
                Route::put('/groupes', 'Update');
                Route::delete('/groupes', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/groupes/delete', 'DeleteStatus');
            });



            ///////////// --------------- Inventory Products Routes ----------- ///////////////////
            Route::controller(ProductsController::class)->group(function () {
                Route::get('/product', 'Show');
                Route::post('/product', 'Insert');
                Route::put('/product', 'Update');
                Route::delete('/product', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/product/delete', 'DeleteStatus');
                Route::get('/product/get', 'Get')->withoutMiddleware(CheckPermission::class);
                Route::get('/product/get/list', 'GetProductList')->withoutMiddleware(CheckPermission::class);
            });
        }); // End Inventory Setup Routes




        Route::prefix('/users')->group(function () {
            // *************************************** Transaction User Type Routes Start *************************************** //
            Route::controller(TranWithController::class)->group(function () {
                Route::get('/usertype', 'Show');
                Route::post('/usertype', 'Insert');
                Route::put('/usertype', 'Update');
                Route::delete('/usertype', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/usertype/delete', 'DeleteStatus');
            });



            ///////////// --------------- Client Routes ----------- ///////////////////
            Route::controller(ClientController::class)->group(function () {
                Route::get('/clients', 'Show');
                Route::post('/clients', 'Insert');
                Route::put('/clients', 'Update');
                Route::delete('/clients', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/clients/delete', 'DeleteStatus');
                Route::get('/clients/details', 'Details');
            });
            
            

            ///////////// --------------- Supplier Routes ----------- ///////////////////
            Route::controller(SupplierController::class)->group(function () {
                Route::get('/suppliers', 'Show');
                Route::post('/suppliers', 'Insert');
                Route::put('/suppliers', 'Update');
                Route::delete('/suppliers', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/suppliers/delete', 'DeleteStatus');
                Route::get('/suppliers/details', 'Details');
            });
        });



        // *************************************** Inventory Transaction Routes Start *************************************** //
        Route::prefix('/transaction')->group(function () {
            ///////////// --------------- Inventory Purchase Routes ----------- ///////////////////
            Route::controller(PurchaseController::class)->group(function () {
                Route::get('/purchase', 'Show');
                Route::post('/purchase', 'Insert');
                Route::get('/purchase/edit', 'Edit');
                Route::put('/purchase', 'Update');
                Route::delete('/purchase', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/purchase/delete', 'DeleteStatus');
                Route::get('/purchase/search', 'Search');
                Route::delete('/purchase/verify', 'Verify');
            });



            ///////////// --------------- Inventory Issue Routes ----------- ///////////////////
            Route::controller(IssueController::class)->group(function () {
                Route::get('/issue', 'Show');
                Route::post('/issue', 'Insert');
                Route::get('/issue/edit', 'Edit');
                Route::put('/issue', 'Update');
                Route::delete('/issue', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/issue/delete', 'DeleteStatus');
                Route::get('/issue/search', 'Search');
            });


            
            ///////////// --------------- Inventory Return Routes ----------- ///////////////////
            Route::prefix('/return')->group(function () {
                // *************** Inventory Supplier Return Routes *************** //
                Route::controller(SupplierReturnController::class)->group(function () {
                    Route::get('/supplier', 'Show');
                    Route::post('/supplier', 'Insert');
                    // Route::get('/supplier/edit', 'Edit');
                    // Route::put('/supplier', 'Update');
                    Route::delete('/supplier', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                    Route::delete('/supplier/delete', 'DeleteStatus');
                    Route::get('/supplier/search', 'Search');
                });
                
                
                
                // *************** Inventory Client Return Routes *************** //
                Route::controller(ClientReturnController::class)->group(function () {
                    Route::get('/client', 'Show');
                    Route::post('/client', 'Insert');
                    // Route::get('/client/edit', 'Edit');
                    // Route::put('/client', 'Update');
                    Route::delete('/client', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                    Route::delete('/client/delete', 'DeleteStatus');
                    Route::get('/client/search', 'Search');
                });
            }); // End Inventory Transaction Return Routes
        }); // End Inventory Transaction Routes



        // *************************************** Inventory Adjustment Routes Start *************************************** //
        Route::prefix('/adjustment')->group(function () {
            Route::controller(AdjustmentController::class)->group(function () {
                ///////////// --------------- Inventory Positive Adjustment Routes ----------- ///////////////////
                Route::get('/positive', 'Show');
                Route::post('/positive', 'Insert');
                Route::get('/positive/edit', 'Edit');
                Route::put('/positive', 'Update');
                Route::delete('/positive', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/positive/delete', 'DeleteStatus');
                Route::get('/positive/search', 'Search');



                ///////////// --------------- Inventory Negative Adjustment Routes ----------- ///////////////////
                Route::get('/negative', 'Show');
                Route::post('/negative', 'Insert');
                Route::get('/negative/edit', 'Edit');
                Route::put('/negative', 'Update');
                Route::delete('/negative', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                Route::delete('/negative/delete', 'DeleteStatus');
                Route::get('/negative/search', 'Search');
            });
        }); // End Inventory Adjustment Routes



        // *************************************** Party Transaction Routes Start *************************************** //
        Route::controller(PartyTransactionController::class)->group(function () {
            Route::prefix('/party')->group(function () {
                ///////////// --------------- Receive From Client Routes ----------- ///////////////////
                Route::get('/receive', 'Show');
                Route::post('/receive', 'Insert');
                // Route::put('/receive', 'Update');
                // Route::delete('/receive', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                // Route::delete('/receive/delete', 'DeleteStatus');
                Route::get('/receive/search', 'Search');


                ///////////// --------------- Payment To Supplier Routes ----------- ///////////////////
                Route::get('/payment', 'Show');
                Route::post('/payment', 'Insert');
                // Route::put('/payment', 'Update');
                // Route::delete('/payment', 'Delete')->withoutMiddleware([CheckPermission::class])->middleware(AdminSuperAdminAccess::class);
                // Route::delete('/payment/delete', 'DeleteStatus');
                Route::get('/payment/search', 'Search');

                // Common Routes
                Route::get('/get/due', 'GetDueList')->withoutMiddleware(CheckPermission::class);
            });
        }); // End PartyTransactionController



        // *************************************** Inventory Report Routes Start *************************************** //
        Route::prefix('/report')->group(function () {
            ///////////// --------------- Inventory Item Flow Statement Routes ----------- ///////////////////
            Route::controller(ItemFlowStatementController::class)->group(function () {
                Route::get('/item/flow', 'Show');
                Route::get('/item/flow/search', 'Search');
            });
    
    

            ///////////// --------------- Inventory Purchase Statement Routes ----------- ///////////////////
            Route::prefix('/purchase')->group(function () {
                // *************** Inventory Purchase Summary Statement Routes *************** //
                Route::controller(PurchaseSummaryController::class)->group(function () {
                    Route::get('/summary', 'Show');
                    Route::get('/summary/search', 'Search');
                });
                
                
                
                // *************** Inventory Purchase Detail Statement Routes *************** //
                Route::controller(PurchaseDetailController::class)->group(function () {
                    Route::get('/details', 'Show');
                    Route::get('/details/search', 'Search');
                });
            });


            
            ///////////// --------------- Inventory Issue Statement Routes ----------- ///////////////////
            Route::prefix('/issue')->group(function () {
                // *************** Inventory Issue Summary Statement Routes *************** //
                Route::controller(IssueSummaryController::class)->group(function () {
                    Route::get('/summary', 'Show');
                    Route::get('/summary/search', 'Search');
                });
                
                
                
                // *************** Inventory Issue Detail Statement Routes *************** //
                Route::controller(IssueDetailController::class)->group(function () {
                    Route::get('/details', 'Show');
                    Route::get('/details/search', 'Search');
                });
            });



            ///////////// --------------- Inventory Return Statement Routes ----------- ///////////////////
            Route::prefix('/return')->group(function () {
                // *************** Inventory Client Return Summary Statement Routes *************** //
                Route::controller(ClientReturnSummaryController::class)->group(function () {
                    Route::get('/client/summary', 'Show');
                    Route::get('/client/summary/search', 'Search');
                });
                
                
                
                // *************** Inventory Client Return Detail Statement Routes *************** //
                Route::controller(ClientReturnDetailController::class)->group(function () {
                    Route::get('/client/details', 'Show');
                    Route::get('/client/details/search', 'Search');
                });



                // *************** Inventory Supplier Return Summary Statement Routes *************** //
                Route::controller(SupplierReturnSummaryController::class)->group(function () {
                    Route::get('/supplier/summary', 'Show');
                    Route::get('/supplier/summary/search', 'Search');
                });
                
                
                
                // *************** Inventory Supplier Return Detail Statement Routes *************** //
                Route::controller(SupplierReturnDetailController::class)->group(function () {
                    Route::get('/supplier/details', 'Show');
                    Route::get('/supplier/details/search', 'Search');
                });
            });



            ///////////// --------------- Inventory Stock Statement Routes ----------- ///////////////////
            Route::prefix('/stock')->group(function () {
                // *************** Inventory Stock Summary Statement Routes *************** //
                Route::controller(StockSummaryController::class)->group(function () {
                    Route::get('/summary', 'Show');
                    Route::get('/summary/search', 'Search');
                });
                
                
                
                // *************** Inventory Stock Detail Statement Routes *************** //
                Route::controller(StockDetailController::class)->group(function () {
                    Route::get('/details', 'Show');
                    Route::get('/details/search', 'Search');
                });
            });



            ///////////// --------------- Inventory Profitability Statement Routes ----------- ///////////////////
            Route::controller(ProfitabilityStatementController::class)->group(function () {
                Route::get('/profitability/statement', 'Show');
                Route::get('/profitability/statement/search', 'Search');
            });



            ///////////// --------------- Inventory Expiry Statement Routes ----------- ///////////////////
            Route::controller(ExpiryStatementController::class)->group(function () {
                Route::get('/expiry/statement', 'Show');
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
                Route::get('/summary', 'Show');
                Route::get('/summary/search', 'Search');
            });
            
            
            
            ///////////// --------------- Account Summary(By Groupe) Statement Routes ----------- ///////////////////
            Route::controller(AccountSummaryByGroupController::class)->group(function () {
                Route::get('/summarygroupe', 'Show');
                Route::get('/summarygroupe/search', 'Search');
            });
            
            
            
            ///////////// --------------- Account Details Statement Routes ----------- ///////////////////
            Route::controller(AccountDetailsController::class)->group(function () {
                Route::get('/details', 'Show');
                Route::get('/details/search', 'Search');
            });
        }); // End Account Statement Routes
        
        

        
        
        // *************************************** Party Statement Routes Start *************************************** //
        Route::prefix('/party')->group(function () {
            ///////////// --------------- Party Summary Statement Routes ----------- ///////////////////
            Route::controller(PartySummaryController::class)->group(function () {
                Route::get('/summary', 'Show');
                Route::get('/summary/search', 'Search');
            });
            
            
            
            ///////////// --------------- Party Detail Statement Routes ----------- ///////////////////
            Route::controller(PartyDetailsController::class)->group(function () {
                Route::get('/details', 'Show');
                Route::get('/details/search', 'Search');
            });
        }); // End Party Statement Routes
        
        


        
        // *************************************** Collection Statement Routes Start *************************************** //
        Route::prefix('/collection')->group(function () {
            ///////////// --------------- Collection Summary Statement Routes ----------- ///////////////////
            Route::controller(CollectionSummaryController::class)->group(function () {
                Route::get('/summary', 'Show');
                Route::get('/summary/search', 'Search');
            });
            
            
            
            ///////////// --------------- Collection Detail Statement Routes ----------- ///////////////////
            Route::controller(CollectionDetailsController::class)->group(function () {
                Route::get('/details', 'Show');
                Route::get('/details/search', 'Search');
            });
            
            
            
            ///////////// --------------- Collection Invoice Summary Statement Routes ----------- ///////////////////
            Route::controller(CollectionInvoiceSummaryController::class)->group(function () {
                Route::get('/invoice_summary', 'Show');
                Route::get('/invoice_summary/search', 'Search');
            });
            
            
            
            ///////////// --------------- Collection Invoice Detail Statement Routes ----------- ///////////////////
            Route::controller(CollectionInvoiceDetailsController::class)->group(function () {
                Route::get('/invoice_details', 'Show');
                Route::get('/invoice_details/search', 'Search');
            });
        }); // End Collection Statement Routes
        


        
        
        // *************************************** Payment Statement Routes Start *************************************** //
        Route::prefix('/payment')->group(function () {
            ///////////// --------------- Payment Summary Statement Routes ----------- ///////////////////
            Route::controller(PaymentSummaryController::class)->group(function () {
                Route::get('/summary', 'Show');
                Route::get('/summary/search', 'Search');
            });
            
            
            
            ///////////// --------------- Payment Detail Statement Routes ----------- ///////////////////
            Route::controller(PaymentDetailsController::class)->group(function () {
                Route::get('/details', 'Show');
                Route::get('/details/search', 'Search');
            });
            
            
            
            ///////////// --------------- Payment Invoice Summary Statement Routes ----------- ///////////////////
            Route::controller(PaymentInvoiceSummaryController::class)->group(function () {
                Route::get('/invoice_summary', 'Show');
                Route::get('/invoice_summary/search', 'Search');
            });
            
            
            
            ///////////// --------------- Payment Invoice Detail Statement Routes ----------- ///////////////////
            Route::controller(PaymentInvoiceDetailsController::class)->group(function () {
                Route::get('/invoice_details', 'Show');
                Route::get('/invoice_details/search', 'Search');
            });
        }); // End Payment Statement Routes
        
        


        
        // *************************************** Consolidated Statement Routes Start *************************************** //
        Route::prefix('/consolidated')->group(function () {
            ///////////// --------------- Consolidated Summary Statement Routes ----------- ///////////////////
            Route::controller(ConsolidatedSummaryController::class)->group(function () {
                Route::get('/summary', 'Show');
                Route::get('/summary/search', 'Search');
            });
            
            
            
            ///////////// --------------- Consolidated Detail Statement Routes ----------- ///////////////////
            Route::controller(ConsolidatedDetailsController::class)->group(function () {
                Route::get('/details', 'Show');
                Route::get('/details/search', 'Search');
            });
            
            
            
            ///////////// --------------- Consolidated Invoice Summary Statement Routes ----------- ///////////////////
            Route::controller(ConsolidatedInvoiceSummaryController::class)->group(function () {
                Route::get('/invoice_summary', 'Show');
                Route::get('/invoice_summary/search', 'Search');
            });
            
            
            
            ///////////// --------------- Consolidated Invoice Detail Statement Routes ----------- ///////////////////
            Route::controller(ConsolidatedInvoiceDetailsController::class)->group(function () {
                Route::get('/invoice_details', 'Show');
                Route::get('/invoice_details/search', 'Search');
            });
        }); // End Consolidated Statement Routes
    }); // End Report Routes 
    
    /////-----/////-----/////-----/////-----/////-----///// Report Routes End /////-----/////-----/////-----/////-----/////-----/////
});





Route::middleware(['web'])->group(function () {
    Route::get('/get/invoice', [GeneralTransactionController::class, 'Invoice']);
    Route::get('/get/clearence', [HotelBookingController::class, 'Invoice']);

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