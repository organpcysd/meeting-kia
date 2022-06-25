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

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginform']);

// Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin');

Route::get('/foo', function () {
    Artisan::call('storage:link');
});

// Auth::routes();
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginform']);
Route::post('login', [App\Http\Controllers\Auth\LoginController::class,'login'])->name('login');
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class,'logout']);

Route::prefix('admin')->group(function(){
    Route::group(['middleware' => ['IsActive']],function(){
        Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin');
        Route::get('getData/{btnvalue}', [App\Http\Controllers\Admin\HomeController::class,'getData']);
        Route::get('getDataDaily', [App\Http\Controllers\Admin\HomeController::class,'getDataDaily']);
        Route::get('getDataMonthly', [App\Http\Controllers\Admin\HomeController::class,'getDataMonthly']);
        Route::get('getDataYearly', [App\Http\Controllers\Admin\HomeController::class,'getDataYearly']);

        Route::resource('/user', App\Http\Controllers\Admin\UserController::class);
        Route::post('/user/multidel', [App\Http\Controllers\Admin\UserController::class,'multidel'])->name('user.multidel');
        Route::resource('/userprefix', App\Http\Controllers\Admin\UserPrefixController::class);
        Route::post('/userprefix/multidel', [App\Http\Controllers\Admin\UserPrefixController::class,'multidel'])->name('userprefix.multidel');
        Route::get('/user/status/{id}',[App\Http\Controllers\Admin\UserController::class, 'status']);

        Route::resource('/position', App\Http\Controllers\Admin\PositionController::class);
        Route::post('/position/multidel', [App\Http\Controllers\Admin\PositionController::class,'multidel'])->name('position.multidel');
        Route::get('/position/publish/{id}',[App\Http\Controllers\Admin\PositionController::class, 'publish']);

        Route::resource('/role', App\Http\Controllers\Admin\RoleController::class);
        Route::resource('/permission', App\Http\Controllers\Admin\PermissionController::class);
        Route::resource('/setting', App\Http\Controllers\Admin\SettingController::class);

        Route::resource('/car', App\Http\Controllers\Admin\CarController::class)->except(['show']);
        Route::post('/car/multidel', [App\Http\Controllers\Admin\CarController::class,'multidel'])->name('car.multidel');
        Route::post('/car/getmodel',[App\Http\Controllers\Admin\CarController::class,'getDataCarmodel'])->name('car.getmodel');

        Route::resource('/carmodel', App\Http\Controllers\Admin\CarModelController::class);
        Route::post('/carmodel/multidel', [App\Http\Controllers\Admin\CarModelController::class,'multidel'])->name('carmodel.multidel');
        Route::resource('/cartype', App\Http\Controllers\Admin\CarTypeController::class);
        Route::post('/cartype/multidel', [App\Http\Controllers\Admin\CarTypeController::class,'multidel'])->name('cartype.multidel');
        Route::resource('/carcolor', App\Http\Controllers\Admin\CarColorController::class);
        Route::post('/carcolor/multidel', [App\Http\Controllers\Admin\CarColorController::class,'multidel'])->name('carcolor.multidel');
        Route::resource('/carlevel', App\Http\Controllers\Admin\CarLevelController::class);
        Route::post('/carlevel/multidel', [App\Http\Controllers\Admin\CarLevelController::class,'multidel'])->name('carlevel.multidel');
        Route::resource('/cargift', App\Http\Controllers\Admin\CarGiftController::class);
        Route::post('/cargift/multidel', [App\Http\Controllers\Admin\CarGiftController::class,'multidel'])->name('cargift.multidel');
        Route::resource('/car/stock', App\Http\Controllers\Admin\CarStockController::class);
        Route::post('/car/stock/multidel', [App\Http\Controllers\Admin\CarStockController::class,'multidel'])->name('stock.multidel');
        Route::get('/car/stock/data/{car}',[App\Http\Controllers\Admin\CarStockController::class,'getData'])->name('stock.getData');

        Route::resource('/customer', App\Http\Controllers\Admin\CustomerController::class);
        Route::post('/customer/multidel', [App\Http\Controllers\Admin\CustomerController::class,'multidel'])->name('customer.multidel');
        Route::resource('/customer/follow', App\Http\Controllers\Admin\CustomerFollowController::class);
        Route::post('/customer/follow/multidel', [App\Http\Controllers\Admin\CustomerFollowController::class,'multidel'])->name('follow.multidel');
        Route::get('/customer/follow/data/{customer}',[App\Http\Controllers\Admin\CustomerFollowController::class,'getData'])->name('follow.getData');
        Route::post('/customer/follow/data/changestatus',[App\Http\Controllers\Admin\CustomerFollowController::class,'changestatus'])->name('follow.changestatus');

        Route::post('/customer/getprovinces',[App\Http\Controllers\Admin\CustomerController::class,'getDataProvinces'])->name('customer.getprovinces');
        Route::post('/customer/getdistricts',[App\Http\Controllers\Admin\CustomerController::class,'getDataDistricts'])->name('customer.getdistricts');
        Route::post('/customer/getcanton',[App\Http\Controllers\Admin\CustomerController::class,'getDataCanton'])->name('customer.getcanton');
        Route::post('/customer/getzipcode',[App\Http\Controllers\Admin\CustomerController::class,'getDataZipcode'])->name('customer.getzipcode');

        Route::resource('traffic', App\Http\Controllers\Admin\TrafficController::class)->except(['show']);
        Route::post('/traffic/multidel', [App\Http\Controllers\Admin\TrafficController::class,'multidel'])->name('traffic.multidel');
        Route::prefix('traffic/')->group(function () {
            Route::resource('channel', App\Http\Controllers\Admin\TrafficChannelController::class);
            Route::post('channel/multidel', [App\Http\Controllers\Admin\TrafficChannelController::class,'multidel'])->name('channel.multidel');
            Route::resource('source', App\Http\Controllers\Admin\TrafficSourceController::class);
            Route::post('source/multidel', [App\Http\Controllers\Admin\TrafficSourceController::class,'multidel'])->name('source.multidel');
            Route::post('getcarlevel',[App\Http\Controllers\Admin\TrafficController::class,'getDataCarlevels'])->name('traffic.getcarlevel');
            Route::post('getcarcolor',[App\Http\Controllers\Admin\TrafficController::class,'getDataCarcolors'])->name('traffic.getcarcolor');
            Route::get('gettraffic/{traffic}',[App\Http\Controllers\Admin\TrafficController::class,'getDataTraffic'])->name('traffic.gettraffic');
        });

        Route::resource('/quotation', App\Http\Controllers\Admin\QuotationController::class);
        Route::post('/quotation/multidel', [App\Http\Controllers\Admin\QuotationController::class,'multidel'])->name('quotation.multidel');
        Route::post('/quotation/getDataCar',[App\Http\Controllers\Admin\QuotationController::class,'getDataCar'])->name('quotation.car');
        Route::get('/quotation/print/{quotation}',[App\Http\Controllers\Admin\QuotationController::class,'pdf'])->name('quotation.pdf');

        Route::resource('/reserved', App\Http\Controllers\Admin\ReservedController::class);
        Route::post('/reserved/multidel', [App\Http\Controllers\Admin\ReservedController::class,'multidel'])->name('reserved.multidel');
        Route::get('/reserved/getcustomeraddress/{customer}',[App\Http\Controllers\Admin\ReservedController::class,'getDataCustomeraddress']);
        Route::get('/reserved/quotation/{quotation}',[App\Http\Controllers\Admin\ReservedController::class,'getDataQuotation'])->name('reserved.quotation');
        Route::get('/reserved/print/{reserved}',[App\Http\Controllers\Admin\ReservedController::class,'pdf'])->name('reserved.pdf');

        Route::resource('/received', App\Http\Controllers\Admin\ReceivedController::class);
        Route::post('/received/multidel', [App\Http\Controllers\Admin\ReceivedController::class,'multidel'])->name('received.multidel');
        Route::get('/received/reserved/{reserved}',[App\Http\Controllers\Admin\ReceivedController::class,'getDataReserved']);
        Route::get('/received/getcustomeraddress/{customer}',[App\Http\Controllers\Admin\ReceivedController::class,'getDataCustomeraddress']);
        Route::get('/received/getcarstock/{car}',[App\Http\Controllers\Admin\ReceivedController::class,'getDataCarstock']);
        Route::get('/received/getengine/{carstock}',[App\Http\Controllers\Admin\ReceivedController::class,'getDataEngine']);

        Route::resource('/receivedfollow', App\Http\Controllers\Admin\ReceivedFollowController::class);
        Route::post('/receivedfollow/multidel', [App\Http\Controllers\Admin\ReceivedFollowController::class,'multidel'])->name('receivedfollow.multidel');
        Route::get('/receivedfollow/getreceivedfollow/{receivedfollow}', [App\Http\Controllers\Admin\ReceivedFollowController::class,'getDataReceivedfollow']);

    });
});
