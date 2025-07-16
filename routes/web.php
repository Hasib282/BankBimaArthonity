<?php

use Illuminate\Support\Facades\Route;
// Middlewares
use Illuminate\Support\Facades\Artisan;
use App\Http\Middleware\ValidUser;
use App\Http\Middleware\CheckPermission;
// use App\Http\Middleware\SuperAdminAccess;
use App\Http\Controllers\ProfileController;



// Admin Setup Related Controllers
use App\Http\Controllers\Frontend\Admin_Setup\AdminSetupController;
use App\Http\Controllers\Frontend\Admin_Setup\UsersController;
use App\Http\Controllers\Frontend\Admin_Setup\PermissionController;


// Auth Controllers
use App\Http\Controllers\Frontend\Auth\AuthController;
use App\Http\Controllers\Frontend\Auth\ForgetPasswordController;



// Transaction Controllers
use App\Http\Controllers\Frontend\Transaction\GeneralTransactionController;
use App\Http\Controllers\Frontend\Transaction\BankTransactionController;
use App\Http\Controllers\Frontend\Transaction\PartyTransactionController;


// HR Controllers
use App\Http\Controllers\Frontend\HR\HRSetupController;
use App\Http\Controllers\Frontend\HR\EmployeeInfoController;
use App\Http\Controllers\Frontend\HR\PayRollController;
use App\Http\Controllers\Frontend\HR\HrReportController;



// Inventory Controllers
use App\Http\Controllers\Frontend\Inventory\InventorySetupController;
use App\Http\Controllers\Frontend\Inventory\InventoryTransactionsController;
use App\Http\Controllers\Frontend\Inventory\InventoryReportController;


// Report Controllers
use App\Http\Controllers\Frontend\Report\AccountStatementController;
use App\Http\Controllers\Frontend\Report\PartyStatementController;
use App\Http\Controllers\Frontend\Report\ConsolidatedStatementController;
use App\Http\Controllers\Frontend\Report\PaymentStatementController;
use App\Http\Controllers\Frontend\Report\CollectionStatementController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*---------------------------------- Admin Login -----------------------------------------------*/

Route::get('/link', function(){
    Artisan::call('storage:link');
});


// Don't Give Access to this routes if user is not valid
Route::middleware([ValidUser::class, CheckPermission::class])->group(function () {
    // *************************************** Login Controller Routes Start *************************************** //
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'Login')->name('login')->withoutMiddleware(CheckPermission::class);
        Route::get('/dashboard', 'Dashboard')->name('dashboard')->withoutMiddleware(CheckPermission::class);
    });


    // *************************************** Forget Password Controller Routes Start *************************************** //
    Route::controller(ForgetPasswordController::class)->group(function () {
        Route::get('/forgotpassword', 'ForgotPassord')->name('forgotPassword')->withoutMiddleware(CheckPermission::class);;
        Route::get('/resetpassword', 'ResetPassword')->name('resetPassword')->withoutMiddleware(CheckPermission::class);;
    });


    // *************************************** Profile Controller Routes Start *************************************** //
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile/{id}', 'ShowProfile')->name('show.profile');
        Route::post('/edit/profile', 'EditProfile')->name('edit.profile');
        Route::get('/update/profile', 'UpdateProfile')->name('update.profile');
    });


    


    /////-----/////-----/////-----/////-----/////-----///// Admin Setup Routes Start /////-----/////-----/////-----/////-----/////-----/////

    Route::prefix('/admin')->group(function () {
        // *************************************** User Routes Start *************************************** //
        Route::prefix('/users')->group(function () {
            Route::controller(UsersController::class)->group(function () {
                ///////////// --------------- Role routes ----------- ///////////////////
                Route::get('/roles', 'ShowRoles')->name('show.roles');
                

                ///////////// --------------- Admin Routes ----------- ///////////////////
                Route::get('/admins', 'ShowAdmins')->name('show.admins');



                ///////////// --------------- Super Admin Routes ----------- ///////////////////
                Route::get('/superadmins', 'ShowSuperAdmins')->name('show.superAdmins');



                Route::controller(AdminSetupController::class)->group(function () {
                    // *************************************** Transaction User Type Routes Start *************************************** //
                    Route::get('/usertype', 'ShowTranWith')->name('show.tranUserType');
                });


                Route::controller(UsersController::class)->group(function () {
                    ///////////// --------------- Client Routes ----------- ///////////////////
                    Route::get('/clients', 'ShowClients')->name('show.clients');



                    ///////////// --------------- Supplire Routes ----------- ///////////////////
                    Route::get('/suppliers', 'ShowSuppliers')->name('show.suppliers');
                });
            }); // End Users Controller
        }); // End User Route



        // *************************************** Permission Routes Start *************************************** //
        Route::prefix('/permission')->group(function () {
            Route::controller(PermissionController::class)->group(function () {
                ///////////// --------------- Permission Main Heads routes ----------- ///////////////////
                Route::get('/mainhead', 'ShowPermissionMainheads')->name('show.permissionMainheads');
                
                
                
                ///////////// --------------- Permission Heads routes ----------- ///////////////////
                Route::get('/heads', 'ShowPermissions')->name('show.permissions');



                ///////////// --------------- Company Type Permission routes ----------- ///////////////////
                Route::get('/company_type_permissions', 'ShowCompanyTypePermissions')->name('show.companyTypePermissions');
                
                
                
                ///////////// --------------- Company Permission routes ----------- ///////////////////
                Route::get('/company_permissions', 'ShowCompanyPermissions')->name('show.companyPermissions');
                
                
                
                ///////////// --------------- User Permission routes ----------- ///////////////////
                Route::get('/userpermissions', 'ShowUserPermissions')->name('show.userPermissions');
            }); // End Permission Controller
        }); // End Permission Routes



        


        Route::controller(AdminSetupController::class)->group(function () {
            // *************************************** Main Heads Routes Start *************************************** //
            Route::get('/companytype', 'ShowCompanyType')->name('show.companytype');



            // *************************************** Company Routes Start *************************************** //
            Route::get('/companies', 'ShowCompanies')->name('show.companies');



            // *************************************** Bank Routes Start *************************************** //
            Route::get('/banks', 'ShowBanks')->name('show.banks');
            


            // *************************************** Location Routes Start *************************************** //
            Route::get('/locations', 'ShowLocations')->name('show.locations');
            


            // *************************************** Store Routes Start *************************************** //
            Route::get('/stores', 'ShowStores')->name('show.stores');


            
            // *************************************** Paymentmethod Routes Start *************************************** //
            Route::get('/payment_method', 'ShowPaymentMethod')->name('show.paymentMethod');



            // *************************************** Main Heads Routes Start *************************************** //
            Route::get('/mainheads', 'ShowTransactionMainHead')->name('show.mainhead');
            


            // *************************************** TranWith(User Type) Routes Start *************************************** //
            Route::get('/tranwith', 'ShowTranWith')->name('show.usertype');


            /// *************************************** TranGroupe Routes Start *************************************** //
            Route::get('/trangroupes', 'ShowTransactionGroupes')->name('show.groupes');



            // *************************************** TranHead Routes Start *************************************** //
            Route::get('/tranheads', 'ShowTransactionHeads')->name('show.heads');
        }); // End Admin Setup Controller
    }); // End Admin Routes

    /////-----/////-----/////-----/////-----/////-----///// Admin Setup Routes /////-----/////-----/////-----/////-----/////-----/////





    /////-----/////-----/////-----/////-----/////-----///// Transaction Routes Start /////-----/////-----/////-----/////-----/////-----/////

    Route::prefix('/transaction')->group(function () {
        Route::prefix('/setup')->group(function () {
            Route::controller(AdminSetupController::class)->group(function () {
                // *************************************** TranGroupe Routes Start *************************************** //
                Route::get('/groupes', 'ShowTransactionGroupes')->name('show.tranGroupes');



                // *************************************** TranHead Routes Start *************************************** //
                Route::get('/heads', 'ShowTransactionHeads')->name('show.tranHeads');
            }); // End Admin Setup Controller
        });



        // *************************************** General Transaction Routes Start *************************************** //
        Route::controller(GeneralTransactionController::class)->group(function () {
            Route::get('/receive', 'ShowTransactionReceive')->name('show.transactionReceive');

            Route::get('/payment', 'ShowTransactionPayment')->name('show.transactionPayment');
        }); // End GeneralTransactionController  



        // *************************************** Party Transaction Routes Start *************************************** //
        Route::controller(PartyTransactionController::class)->group(function () {
            Route::prefix('/party')->group(function () {
                Route::get('/receive', 'ShowPartyReceive')->name('show.partyReceive');

                Route::get('/payment', 'ShowPartyPayment')->name('show.partyPayment');
            }); // End Party Transaction Routres
        }); // End PartyTransactionController



        // *************************************** Bank Transaction Routes Start *************************************** //
        Route::controller(BankTransactionController::class)->group(function () {
            Route::prefix('/bank')->group(function () {
                Route::get('/withdraw', 'ShowBankWithdraws')->name('show.withdraws');

                Route::get('/deposit', 'ShowBankDeposits')->name('show.deposits');
            }); // End Bank Transaction Route
        }); // End BankTransactionController
    }); // End Transaction Routes

    /////-----/////-----/////-----/////-----/////-----///// Transaction Controllers End /////-----/////-----/////-----/////-----/////-----/////





    /////-----/////-----/////-----/////-----/////-----///// HR Controllers Start /////-----/////-----/////-----/////-----/////-----/////

    Route::prefix('/hr')->group(function () {
        Route::prefix('/setup')->group(function () {
            // *************************************** HR Setup Routes Start *************************************** //
            Route::controller(HRSetupController::class)->group(function () {
                // *************************************** Department Routes Start *************************************** //
                Route::get('/departments', 'ShowDepartments')->name('show.departments');



                // *************************************** Designations Routes Start *************************************** //
                Route::get('/designations', 'ShowDesignations')->name('show.designations');
            });
        }); // End HR Setup Routes
        





        // *************************************** Hr Employee Routes Start *************************************** //
        Route::prefix('/employee')->group(function () {
            Route::controller(AdminSetupController::class)->group(function () {
                // *************************************** Employee Type Routes Start *************************************** //
                Route::get('/usertype', 'ShowTranWith')->name('show.hrUserType');
            });



            Route::controller(EmployeeInfoController::class)->group(function () {
                ///////////// --------------- Employee Routes ----------- ///////////////////
                Route::get('/all', 'ShowEmployees')->name('show.employees');



                ///////////// --------------- Employee Personal Details Routes ----------- ///////////////////
                Route::get('/personal',  'PersonalDetails')->name('show.employeePersonal');



                ///////////// --------------- Employee Education Details Routes ----------- ///////////////////
                Route::get('/education',  'EducationDetails')->name('show.employeeEducation');
                
                

                ///////////// --------------- Employee Training Details Routes ----------- ///////////////////
                Route::get('/training',  'TrainingDetails')->name('show.employeeTraining');



                ///////////// --------------- Employee Experience Details Routes ----------- ///////////////////
                Route::get('/experience',  'ExperienceDetails')->name('show.employeeExperience');
                


                ///////////// --------------- Employee Organization Routes ----------- ///////////////////
                Route::get('/organization',  'OrganizationDetails')->name('show.employeeOrganization');
                


                ///////////// --------------- Attendence Routes ----------- ///////////////////
                Route::get('/attendence','ShowEmployeeAttendence')->name('show.employeeAttendence');
            });
        }); // End Hr Employee Routes





        // *************************************** HR Payroll Routes Start *************************************** //
        Route::prefix('/payroll')->group(function () {
            Route::controller(AdminSetupController::class)->group(function () {
                // *************************************** TranHead Routes Start *************************************** //
                Route::get('/heads', 'ShowTransactionHeads')->name('show.hrHeads');
            }); // End Admin Setup Controller



            Route::controller(PayRollController::class)->group(function(){
                ///////////// --------------- Payroll Setup Routes ----------- ///////////////////
                Route::get('/setup','ShowPayrollSetup')->name('show.payrollSetup');



                ///////////// --------------- Payroll Middlewire Routes ----------- ///////////////////
                Route::get('/middlewire','ShowPayrollMiddlewire')->name('show.payrollMiddlewire');
                
                
                
                ///////////// --------------- Payroll Installment(Salary Payment) Routes ----------- ///////////////////
                Route::get('/process','ShowPayroll')->name('show.payroll');
                Route::get('/process/search', 'SearchPayroll')->name('search.payroll');

            });
        }); // End Hr Payroll Routes




        // *************************************** Hr Report Routes Start *************************************** //
        Route::prefix('/report')->group(function () {
            Route::controller(HrReportController::class)->group(function () {            
                ///////////// --------------- Salary Summary Routes ----------- ///////////////////
                Route::get('/salary/summary','SalarySummaryReport')->name('show.salarySummaryReport'); 


                
                ///////////// --------------- Salary Detail Routes ----------- ///////////////////
                Route::get('/salary/details','SalaryDetailsReport')->name('show.salaryDetailsReport');
            });
        }); // End Hr Report Routes
    }); // End HR Routes 

    /////-----/////-----/////-----/////-----/////-----///// HR Controllers End /////-----/////-----/////-----/////-----/////-----/////
    
    
    
    

    /////-----/////-----/////-----/////-----/////-----///// Inventory Routes Start /////-----/////-----/////-----/////-----/////-----/////

    Route::prefix('/inventory')->group(function () {
        // *************************************** Inventory Setup Routes Start *************************************** //
        Route::prefix('/setup')->group(function () {
            Route::controller(InventorySetupController::class)->group(function(){
                ///////////////////// ------------------ Item/Product Manufacturer Routes Start ------------------ /////////////////////
                // Crude Routes Start
                Route::get('/manufacturer',  'ShowManufacturer')->name('show.invManufacturer');



                ///////////////////// ------------------ Item/Product Category Routes Start ------------------ /////////////////////
                // Crude Routes Start
                Route::get('/category', 'ShowItemCategory')->name('show.invCategory');



                //////////////// ------------------ Item/Product Form Routes Start ------------------- //////////////////
                // Crude Routes Start
                Route::get('/form', 'ShowForm')->name('show.invForm');



                //////////////// ------------------ Item/Product Unit Routes Start ------------------- //////////////////
                // Crude Routes Start
                Route::get('/unit', 'ShowUnit')->name('show.invUnit');



                //////////////// ------------------ Inventory Product Routes Start ------------------- //////////////////
                // Crud Routes Start
                Route::get('/product', 'ShowInventoryProduct')->name('show.invProduct');
            });


            Route::controller(AdminSetupController::class)->group(function () {
                /// *************************************** Item Groupe Routes Start *************************************** //
                Route::get('/groupes', 'ShowTransactionGroupes')->name('show.invGroupes');
            }); // End Admin Setup Controller
        }); // End Inventory Setup Routes



        // *************************************** Inventory Transaction Routes Start *************************************** //
        Route::prefix('/transaction')->group(function () {
            Route::controller(InventoryTransactionsController::class)->group(function(){
                ///////////// --------------- Inventory Purchase Routes ----------- ///////////////////
                // Crude Routes Start
                Route::get('/purchase', 'ShowInventoryPurchase')->name('show.invPurchase');
                
                
                
                ///////////// --------------- Inventory Issue Routes ----------- ///////////////////
                // Inventory Issue Crude Routes
                Route::get('/issue', 'ShowInventoryIssue')->name('show.invIssue');
            }); // End InventoryTransactionController
        }); // End Inventory Transaction Routes 



        // *************************************** Inventory Report Routes Start *************************************** //
        Route::prefix('/report')->group(function () {
            Route::controller(InventoryReportController::class)->group(function () {
                ///////////// --------------- Inventory Item Flow Statement Routes ----------- ///////////////////
                Route::get('/item/flow','ShowItemFlowStatement')->name('show.invItemFlow');
                
                

                ///////////// --------------- Inventory Purchase Statement Routes ----------- ///////////////////
                Route::prefix('/purchase')->group(function () {
                    // *************** Inventory Purchase Summary Statement Routes *************** //
                    Route::get('/summary','ShowPurchaseSummaryStatement')->name('show.invPurchaseSummary');
                    


                    // *************** Inventory Purchase Detail Statement Routes *************** //
                    Route::get('/details','ShowPurchaseDetailsStatement')->name('show.invPurchaseDetails');
                });



                ///////////// --------------- Inventory Issue Statement Routes ----------- ///////////////////
                Route::prefix('/issue')->group(function () {
                    // *************** Inventory Issue Summary Statement Routes *************** //
                    Route::get('/summary','ShowIssueSummaryStatement')->name('show.invIssueSummary');


                    // *************** Inventory Issue Detail Statement Routes *************** //
                    Route::get('/details','ShowIssueDetailsStatement')->name('show.invIssueDetails');
                });



                ///////////// --------------- Inventory Return Statement Routes ----------- ///////////////////
                Route::prefix('/return')->group(function () {
                    // *************** Inventory Supplier Return Summary Statement Routes *************** //
                    Route::get('/supplier/summary','ShowSupplierReturnSummaryStatement')->name('show.invSupplierReturnSummary');



                    // *************** Inventory Supplier Return Detail Statement Routes *************** //
                    Route::get('/supplier/details','ShowSupplierReturnDetailsStatement')->name('show.invSupplierReturnDetails');



                    // *************** Inventory Client Return Summary Statement Routes *************** //
                    Route::get('/client/summary','ShowClientReturnSummaryStatement')->name('show.invClientReturnSummary');



                    // *************** Inventory Client Return Detail Statement Routes *************** //
                    Route::get('/client/details','ShowClientReturnDetailsStatement')->name('show.invClientReturnDetails');
                });


                
                ///////////// --------------- Inventory Stock Statement Routes ----------- ///////////////////
                Route::prefix('/stock')->group(function () {
                    // *************** Inventory Stock Summary Statement Routes *************** //
                    Route::get('/summary','ShowStockSummaryStatement')->name('show.invStockSummary');
                    


                    // *************** Inventory Stock Detail Statement Routes *************** //
                    Route::get('/details','ShowStockDetailsStatement')->name('show.invStockDetails');
                });



                ///////////// --------------- Inventory Profitability Statement Routes ----------- ///////////////////
                Route::get('/profitability/statement','ShowProfitabilityStatement')->name('show.invProfit');
                


                ///////////// --------------- Inventory Expiry Statement Routes ----------- ///////////////////
                Route::get('/expiry/statement','ShowExpiryStatement')->name('show.invExpiry');
            }); // End InventoryReportController
        }); // End Inventory Report Routes
    }); // End Inventory Routes 

    /////-----/////-----/////-----/////-----/////-----///// Inventory Routes End /////-----/////-----/////-----/////-----/////-----/////
    

    
    

    /////-----/////-----/////-----/////-----/////-----///// Report Routes Start /////-----/////-----/////-----/////-----/////-----/////
    
    Route::prefix('/report')->group(function () {
        // *************************************** Account Statement Routes Start *************************************** //
        Route::prefix('/account')->group(function () {
            Route::controller(AccountStatementController::class)->group(function () {
                ///////////// --------------- Account Summary Statement Routes ----------- ///////////////////
                Route::get('/summary', 'ShowAccountSummaryStatement')->name('show.accountSummary');
            
            
            
                ///////////// --------------- Account Summary(By Groupe) Statement Routes ----------- ///////////////////
                Route::get('/summarygroupe', 'ShowAccountSummaryGroupeStatement')->name('show.accountSummaryByGroupe');
            
            
            
                ///////////// --------------- Account Details Statement Routes ----------- ///////////////////
                Route::get('/details', 'ShowAccountDetailsStatement')->name('show.accountDetails');
            });
        }); // End Account Statement Routes
        
        
        
        // *************************************** Party Statement Routes Start *************************************** //
        Route::prefix('/party')->group(function () {
            Route::controller(PartyStatementController::class)->group(function () {
                ///////////// --------------- Party Summary Statement Routes ----------- ///////////////////
                Route::get('/summary', 'PartySummaryReport')->name('show.partySummary');
            
            
            
                ///////////// --------------- Party Detail Statement Routes ----------- ///////////////////
                Route::get('/details', 'PartyDetailsReport')->name('show.partyDetails');
            });
        }); // End Party Statement Routes
        
        
        
        // *************************************** Consolidated Statement Routes Start *************************************** //
        Route::prefix('/consolidated')->group(function () {
            Route::controller(ConsolidatedStatementController::class)->group(function () {
                ///////////// --------------- Consolidated Summary Statement Routes ----------- ///////////////////
                Route::get('/summary', 'ConsolidatedSummary')->name('show.consolidatedSummary');
            
            
            
                ///////////// --------------- Consolidated Detail Statement Routes ----------- ///////////////////
                Route::get('/details', 'ConsolidatedDetails')->name('show.consolidatedDetails');
                
                
                
                ///////////// --------------- Consolidated Invoice Summary Statement Routes ----------- ///////////////////
                Route::get('/invoice_summary', 'ConsolidatedInvoiceSummary')->name('show.consolidatedInvoiceSummary');
            
            
            
                ///////////// --------------- Consolidated Invoice Detail Statement Routes ----------- ///////////////////
                Route::get('/invoice_details', 'ConsolidatedInvoiceDetails')->name('show.consolidatedInvoiceDetails');
            });
        }); // End Consolidated Statement Routes
        
        
        
        // *************************************** Payment Statement Routes Start *************************************** //
        Route::prefix('/payment')->group(function () {
            Route::controller(PaymentStatementController::class)->group(function () {
                ///////////// --------------- Payment Summary Statement Routes ----------- ///////////////////
                Route::get('/summary', 'PaymentSummary')->name('show.paymentSummary');
            
            
            
                ///////////// --------------- Payment Detail Statement Routes ----------- ///////////////////
                Route::get('/details', 'PaymentDetails')->name('show.paymentDetails');
                
                
                
                ///////////// --------------- Payment Invoice Summary Statement Routes ----------- ///////////////////
                Route::get('/invoice_summary', 'PaymentInvoiceSummary')->name('show.paymentInvoiceSummary');
            
            
            
                ///////////// --------------- Payment Invoice Detail Statement Routes ----------- ///////////////////
                Route::get('/invoice_details', 'PaymentInvoiceDetails')->name('show.paymentInvoiceDetails');
            });
        }); // End Party Statement Routes
        
        
        
        // *************************************** Collection Statement Routes Start *************************************** //
        Route::prefix('/collection')->group(function () {
            Route::controller(CollectionStatementController::class)->group(function () {
                ///////////// --------------- Collection Summary Statement Routes ----------- ///////////////////
                Route::get('/summary', 'CollectionSummary')->name('show.collectionSummary');
            
            
            
                ///////////// --------------- Collection Detail Statement Routes ----------- ///////////////////
                Route::get('/details', 'CollectionDetails')->name('show.collectionDetails');
                
                
                
                ///////////// --------------- Collection Invoice Summary Statement Routes ----------- ///////////////////
                Route::get('/invoice_summary', 'CollectionInvoiceSummary')->name('show.collectionInvoiceSummary');
            
            
            
                ///////////// --------------- Collection Invoice Detail Statement Routes ----------- ///////////////////
                Route::get('/invoice_details', 'CollectionInvoiceDetails')->name('show.collectionInvoiceDetails');
            });
        }); // End Party Statement Routes
    }); // End Report Routes 
    
    /////-----/////-----/////-----/////-----/////-----///// Report Routes End /////-----/////-----/////-----/////-----/////-----/////
});