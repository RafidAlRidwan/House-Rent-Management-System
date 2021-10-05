<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Login Page
// Route::get('admin.login', [App\Http\Controllers\Admin\LoginPageController::class, 'index'])->name('adminLogin');
Route::get('/', [App\Http\Controllers\Admin\LoginPageController::class, 'index_new']);

Route::get('admin_login', [App\Http\Controllers\Admin\LoginPageController::class, 'index_new'])->name('admin_Login');

// User List
Route::get('admin.home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
Route::get('userlist' , [App\Http\Controllers\Admin\HomeController::class, 'view_user'])->name('user_list');
Route::post('adduser' , [App\Http\Controllers\Admin\HomeController::class, 'store_user']);
Route::post('edituser', [App\Http\Controllers\Admin\HomeController::class, 'update_user']);
Route::post('userdata' , [App\Http\Controllers\Admin\HomeController::class, 'data_datatable']);
Route::post('deleteuser', [App\Http\Controllers\Admin\HomeController::class, 'delete_user']);


// Apartment
Route::get('aplist', [App\Http\Controllers\Admin\ApartmentController::class, 'view_apartment'])->name('ap_list');
Route::get('apcreate' , [App\Http\Controllers\Admin\ApartmentController::class, 'create']);
Route::post('get-district', [App\Http\Controllers\Admin\ApartmentController::class, 'get_district']);
Route::post('get-thana', [App\Http\Controllers\Admin\ApartmentController::class, 'get_thana']);
Route::post('apstore' , [App\Http\Controllers\Admin\ApartmentController::class, 'store']);
Route::post('apdata' , [App\Http\Controllers\Admin\ApartmentController::class, 'data_datatable']);
Route::post('get-flat-list', [App\Http\Controllers\Admin\ApartmentController::class, 'get_flat_list']);
Route::get('apedit/{id}' , [App\Http\Controllers\Admin\ApartmentController::class, 'edit']);
Route::post('apupdate' , [App\Http\Controllers\Admin\ApartmentController::class, 'update']);
Route::post('apdelete' , [App\Http\Controllers\Admin\ApartmentController::class, 'delete']);
Route::get('apartmentdetails/{id}' , [App\Http\Controllers\Admin\ApartmentController::class, 'apartment_show']);
Route::post('apartmentdata' , [App\Http\Controllers\Admin\ApartmentController::class, 'apartment_data']);
Route::post('flatupdate', [App\Http\Controllers\Admin\ApartmentController::class, 'flat_update']);
Route::post('flatadd', [App\Http\Controllers\Admin\ApartmentController::class, 'flat_add']);
Route::post('flatdelete', [App\Http\Controllers\Admin\ApartmentController::class, 'flat_delete']);
Route::post('flooradd', [App\Http\Controllers\Admin\ApartmentController::class, 'floor_add']);
Route::get('flatutilitybill/{id}', [App\Http\Controllers\Admin\ApartmentController::class, 'flat_utility_bill']);
Route::post('utilitydatatable' , [App\Http\Controllers\Admin\ApartmentController::class, 'utility_dataTable']);
Route::get('flatpayhistory/{id}' , [App\Http\Controllers\Admin\ApartmentController::class, 'flat_payment_history']);
Route::post('flatpaymentdata' , [App\Http\Controllers\Admin\ApartmentController::class, 'flat_payment_datatable']);

// Renter
Route::get('renterlist' , [App\Http\Controllers\Admin\RenterController::class, 'view_renter'])->name('rent_list');
Route::get('rencreate' , [App\Http\Controllers\Admin\RenterController::class, 'create']);
Route::post('get-flat', [App\Http\Controllers\Admin\RenterController::class, 'get_flat']);
Route::post('get-rent-amount', [App\Http\Controllers\Admin\RenterController::class, 'get_rent_amount']);
Route::post('flatstore', [App\Http\Controllers\Admin\RenterController::class, 'store']);
Route::post('redata', [App\Http\Controllers\Admin\RenterController::class, 'data_dataTable']);
Route::get('reedit/{id}', [App\Http\Controllers\Admin\RenterController::class, 'edit']);
Route::post('deleterenter', [App\Http\Controllers\Admin\RenterController::class, 'delete_renter']);
Route::post('renterupdate' , [App\Http\Controllers\Admin\RenterController::class, 'update']);
Route::post('utility_bill' , [App\Http\Controllers\Admin\RenterController::class, 'utility_bill_store'] );
Route::post('utility_bill_update' , [App\Http\Controllers\Admin\RenterController::class, 'utility_bill_update']);
Route::post('deleteutilitybill' , [App\Http\Controllers\Admin\RenterController::class, 'utility_bill_delete']);
Route::get('utilitybillhistory/{id}' , [App\Http\Controllers\Admin\RenterController::class, 'utility_bill_history']);
Route::post('utilitybilldatatable' , [App\Http\Controllers\Admin\RenterController::class, 'bill_dataTable'] );
Route::post('RentPay' , [App\Http\Controllers\Admin\RenterController::class, 'rent_payment']);
Route::get('rentpaidhistory' , [App\Http\Controllers\Admin\RenterController::class, 'rent_paid_history_index'])->name('rentpaidlist');
Route::post('paiddata' , [App\Http\Controllers\Admin\RenterController::class, 'rent_paid_history_data']);
Route::post('get-all-flat', [App\Http\Controllers\Admin\RenterController::class, 'get_all_flat']);
Route::get('rentdetails/{id}', [App\Http\Controllers\Admin\RenterController::class, 'rent_details']);
Route::get('print-preview/{id}', [App\Http\Controllers\Admin\RenterController::class, 'print_preview']);
Route::post('paydelete' , [App\Http\Controllers\Admin\RenterController::class, 'pay_delete']);

// Expenses
Route::get('costsector', [App\Http\Controllers\Admin\ExpensesController::class, 'index'])->name('cost_list');
Route::post('addcostsector', [App\Http\Controllers\Admin\ExpensesController::class, 'store_cost_sector']);
Route::post('costdata', [App\Http\Controllers\Admin\ExpensesController::class, 'data_datatable']);
Route::post('editcost', [App\Http\Controllers\Admin\ExpensesController::class, 'update_cost_sector']);
Route::post('delcost', [App\Http\Controllers\Admin\ExpensesController::class, 'delete_cost']);
Route::get('expense', [App\Http\Controllers\Admin\ExpensesController::class, 'expense_index'])->name('expense');
Route::post('get-flat-list', [App\Http\Controllers\Admin\ExpensesController::class, 'get_flat']);
Route::post('get-renter', [App\Http\Controllers\Admin\ExpensesController::class, 'get_renter']);
Route::post('expenseadd', [App\Http\Controllers\Admin\ExpensesController::class, 'store_expense']);
Route::post('expensedata', [App\Http\Controllers\Admin\ExpensesController::class, 'data_datatable_expense']);
Route::post('exdelete' , [App\Http\Controllers\Admin\ExpensesController::class, 'ex_delete']);


