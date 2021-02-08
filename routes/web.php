<?php

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

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('artisan/{command}/{param}', 'ArtisanCommandController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//super admin route group..
Route::group(['middleware'=>['auth','admin']], function (){
    //this route only for resource controller..................
    Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin',], function (){
        Route::resource('group', 'GroupController');
        Route::resource('passport-stock', 'PassportStock');
        Route::resource('agent', 'AgentController');
        Route::resource('supplier', 'SupplierController');
        Route::resource('visa-stock', 'VisaStockController');
        Route::resource('users', 'UsersController');
        Route::resource('expense-category', 'ExpenseCategoryController');
        Route::resource('expense-manage', 'ExpenseManageController');
    });
    Route::get('admin/dashboard','Admin\DashboardController@index')->name('admin.dashboard');

    Route::get('admin/order/index','Admin\OrderController@index')->name('admin.order.index');
    Route::get('admin/order/create','Admin\OrderController@showOrderForm')->name('admin.order.create');
    Route::post('admin/order/store','Admin\OrderController@store')->name('admin.order.store');
    Route::get('admin/visa-stamped','Admin\OrderController@visaStamped')->name('admin.order.visa.stamped');
    Route::post('admin/passport-status/{id}','Admin\OrderController@PassportStatusChange')->name('admin.passport.status.change');

    Route::get('admin/order-invoice/{order_id}','Admin\OrderController@showOrderInvoice')->name('admin.order.invoice');
    Route::post('admin/order-invoice-store','Admin\OrderController@orderInvoiceStore')->name('admin.order.invoice_store');
    Route::get('admin/order-invoice-view/{order_id}','Admin\OrderController@orderInvoiceView')->name('admin.order.invoice.view');
    Route::get('admin/supplier_wise_passport/{id}','Admin\OrderController@supplierWisePassportList')->name('admin.order.supplier.wise.passport');

    Route::get('admin/training-card/index','Admin\TrainingCardController@index')->name('admin.training_card.index');
    Route::post('admin/training-card/{order_id}','Admin\TrainingCardController@orderTcChange')->name('admin.training_card.status.change');

    Route::get('admin/manpower/index','Admin\ManpowerController@index')->name('admin.manpower.index');
    Route::post('admin/manpower/visa-issue','Admin\ManpowerController@visaIssue')->name('admin.manpower.visa.issue');
    Route::post('admin/manpower/status-issue','Admin\ManpowerController@statusIssue')->name('admin.manpower.status.issue');

    Route::get('admin/ready-for-fly/index','Admin\ReadyForFlyController@index')->name('admin.ready.for.fly.index');

    Route::get('admin/stamping-passport/{id}','Admin\SupplierController@stampingPassport')->name('admin.stamping-passport');
    Route::get('admin/all-stamping-passport','Admin\SupplierController@AllStampingPassport')->name('admin.all-stamping-passport');
    Route::get('admin/available-passport/{id}','Admin\SupplierController@availablePassport')->name('admin.available-passport');
    Route::get('admin/passport-stock/supplier/{id}','Admin\PassportStock@SupplierPassports')->name('admin.passport-stock.supplier');
    Route::get('admin/visa-stock/divided/{id}','Admin\VisaStockController@VisaDivided')->name('admin.visa-stock.visa_divided');
    Route::post('admin/visa-stock/visa-divided-group','Admin\VisaStockController@VisaDividedGroup')->name('admin.visa-stock.visa_divided_group');
    Route::get('admin/visa-stock/group-wise-visa-edit/{id}','Admin\VisaStockController@GroupWiseVisaEdit')->name('admin.visa-stock.group_wise_visa_edit');
    Route::put('admin/visa-stock/group-wise-visa-edit-update/{id}','Admin\VisaStockController@GroupWiseVisaUpdate')->name('admin.visa-stock.group_wise_visa_edit_update');

    Route::get('admin/accounts/account','Admin\AccountController@index')->name('admin.accounts');
    Route::get('admin/accounts/take-payment/{order_id}','Admin\AccountController@TakePayment')->name('admin.accounts.invoice.take.payment');
    Route::post('admin/accounts/take-payment-store', 'Admin\AccountController@store')->name('admin.accounts.take.payment.store');

    Route::get('admin/accounts/income-statement', 'Admin\AccountController@IncomeStatement')->name('admin.accounts.income.statement');

    Route::get('admin/accounts/cash-receive', 'Admin\AccountController@CashReceive')->name('admin.accounts.cash.receive');
    Route::get('admin/accounts/bank-receive', 'Admin\AccountController@BankReceive')->name('admin.accounts.bank.receive');
    Route::get('admin/accounts/agent-payment', 'Admin\AccountController@AgentPayment')->name('admin.accounts.agent.payment');
    Route::get('admin/accounts/agent-payment-history/{agent_id}', 'Admin\AccountController@AgentPaymentHistory')->name('admin.accounts.agent.payment.history');
    Route::post('admin/accounts/agent-payment-create', 'Admin\AccountController@AgentPaymentCreate')->name('admin.accounts.agent.payment.create');
    Route::get('admin/accounts/balance-sheet', 'Admin\AccountController@BalanceSheet')->name('admin.accounts.balance.sheet');

    //need to store Take Payments Data.....
    Route::get('admin/accounts/invoice-view/{order_id}','Admin\AccountController@orderInvoiceView')->name('admin.accounts.invoice.view');
    Route::get('admin/accounts/pay-slip/{payment_id}','Admin\AccountController@TakePaymentSlip')->name('admin.accounts.pay.slip');

});

//executive one route group..
Route::group(['middleware'=>['auth','executiveOne']], function (){
    Route::get('executive/one/dashboard','ExecutiveOne\DashboardController@index')->name('executive.one.dashboard');
    //Route::get('executive/one/customer-entry','ExecutiveOne\CustomerEntryForm@getEntryForm')->name('executive.one.customer-entry-form');

    Route::group(['as'=>'executive_one.','prefix'=>'executive/one','namespace'=>'ExecutiveOne',], function () {
        Route::resource('group', 'GroupController');
        Route::resource('agent', 'AgentController');
        Route::resource('visa-stock', 'VisaStockController');
        Route::resource('supplier', 'SupplierController');
        Route::resource('passport-stock', 'PassportStockController');

    });

    Route::get('executive/one/stamping-passport/{id}','ExecutiveOne\SupplierController@stampingPassport')->name('executive.one.stamping-passport');
    Route::get('executive/one/all-stamping-passport','ExecutiveOne\SupplierController@AllStampingPassport')->name('executive.one.all-stamping-passport');
    Route::get('executive/one/available-passport/{id}','ExecutiveOne\SupplierController@availablePassport')->name('executive.one.available-passport');

    Route::get('executive/one/passport-stock/supplier/{id}','ExecutiveOne\PassportStockController@SupplierPassports')->name('executive_one.passport-stock.supplier');


});

//executive two route group..
Route::group(['middleware'=>['auth','executiveTwo']], function (){
    Route::get('executive/two/dashboard','ExecutiveTwo\DashboardController@index')->name('executive.two.dashboard');

    Route::get('executive/two/order/index','ExecutiveTwo\OrderController@index')->name('executive.two.order.index');
    Route::get('executive/two/order/create','ExecutiveTwo\OrderController@showOrderForm')->name('executive.two.order.create');
    Route::get('executive/two/supplier_wise_passport/{id}','ExecutiveTwo\OrderController@supplierWisePassportList')->name('executive.two.order.supplier.wise.passport');
    Route::post('executive/two/order/store','ExecutiveTwo\OrderController@store')->name('executive.two.order.store');
    Route::get('executive/two/order-invoice/{order_id}','ExecutiveTwo\OrderController@showOrderInvoice')->name('executive.two.order.invoice');
    Route::post('executive/two/order-invoice-store','ExecutiveTwo\OrderController@orderInvoiceStore')->name('executive.two.order.invoice_store');
    Route::get('executive/two/order-invoice-view/{order_id}','ExecutiveTwo\OrderController@orderInvoiceView')->name('executive.two.order.invoice.view');

});

//executive three route group..
Route::group(['middleware'=>['auth','executiveThree']], function (){
    Route::get('executive/three/dashboard','ExecutiveThree\DashboardController@index')->name('executive.three.dashboard');

    Route::get('executive/three/training-card/index','ExecutiveThree\TrainingCardController@index')->name('executive.three.training_card.index');
    Route::post('executive/three/training-card/{order_id}','ExecutiveThree\TrainingCardController@orderTcChange')->name('executive.three.training_card.status.change');

    Route::get('executive/three/manpower/index','ExecutiveThree\ManpowerController@index')->name('executive.three.manpower.index');
    Route::post('executive/three/manpower/visa-issue','ExecutiveThree\ManpowerController@visaIssue')->name('executive.three.manpower.visa.issue');


});

//executive four route group..
Route::group(['middleware'=>['auth','executiveFour']], function (){
    Route::get('executive/four/dashboard','ExecutiveFour\DashboardController@index')->name('executive.four.dashboard');

    Route::get('executive/four/ready-for-fly/index','ExecutiveFour\ReadyForFlyController@index')->name('executive.four.ready.for.fly.index');

    Route::get('executive/four/accounts','ExecutiveFour\AccountController@index')->name('executive.four.accounts');
    Route::get('admin/accounts/take-payment/{order_id}','Admin\AccountController@TakePayment')->name('admin.accounts.invoice.take.payment');
    Route::post('admin/accounts/take-payment-store', 'Admin\AccountController@store')->name('admin.accounts.take.payment.store');
    //need to store Take Payments Data.....
    Route::get('admin/accounts/invoice-view/{order_id}','Admin\AccountController@orderInvoiceView')->name('admin.accounts.invoice.view');
    Route::get('admin/accounts/pay-slip/{payment_id}','Admin\AccountController@TakePaymentSlip')->name('admin.accounts.pay.slip');

});
