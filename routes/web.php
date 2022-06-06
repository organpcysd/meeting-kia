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

Route::get('/', function () {
    return view('auth.login');
});

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

        Route::resource('/user', App\Http\Controllers\Admin\UserController::class);
        Route::resource('/userprefix', App\Http\Controllers\Admin\UserPrefixController::class);
        Route::post('/userprefix/multidel', [App\Http\Controllers\Admin\UserPrefixController::class,'multidel'])->name('userprefix.multidel');
        Route::get('/user/status/{id}',[App\Http\Controllers\Admin\UserController::class, 'status']);

        Route::resource('/position', App\Http\Controllers\Admin\PositionController::class);
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
        Route::resource('/customer/follow', App\Http\Controllers\Admin\CustomerFollowController::class);
        Route::get('/customer/follow/data/{customer}',[App\Http\Controllers\Admin\CustomerFollowController::class,'getData'])->name('follow.getData');
        Route::post('/customer/follow/data/changestatus',[App\Http\Controllers\Admin\CustomerFollowController::class,'changestatus'])->name('follow.changestatus');

        Route::post('/customer/getprovinces',[App\Http\Controllers\Admin\CustomerController::class,'getDataProvinces'])->name('customer.getprovinces');
        Route::post('/customer/getdistricts',[App\Http\Controllers\Admin\CustomerController::class,'getDataDistricts'])->name('customer.getdistricts');
        Route::post('/customer/getcanton',[App\Http\Controllers\Admin\CustomerController::class,'getDataCanton'])->name('customer.getcanton');
        Route::post('/customer/getzipcode',[App\Http\Controllers\Admin\CustomerController::class,'getDataZipcode'])->name('customer.getzipcode');

        Route::resource('/quotation', App\Http\Controllers\Admin\QuotationController::class);
        Route::post('/quotation/getDataCar',[App\Http\Controllers\Admin\QuotationController::class,'getDataCar'])->name('quotation.car');


        Route::resource('traffic', App\Http\Controllers\Admin\TrafficController::class)->except(['show']);
        Route::prefix('traffic/')->group(function () {
            Route::resource('channel', App\Http\Controllers\Admin\TrafficChannelController::class);
            Route::post('channel_multidel', [App\Http\Controllers\Admin\TrafficChannelController::class,'multidel'])->name('channel.multidel');
            Route::resource('source', App\Http\Controllers\Admin\TrafficSourceController::class);
            Route::post('source_multidel', [App\Http\Controllers\Admin\TrafficSourceController::class,'multidel'])->name('source.multidel');
            Route::post('getcarlevel',[App\Http\Controllers\Admin\TrafficController::class,'getDataCarlevels'])->name('traffic.getcarlevel');
            Route::post('getcarcolor',[App\Http\Controllers\Admin\TrafficController::class,'getDataCarcolors'])->name('traffic.getcarcolor');

        });

        Route::resource('/reserved', App\Http\Controllers\Admin\ReservedController::class);
        Route::get('/reserved/quotation/{quotation}',[App\Http\Controllers\Admin\ReservedController::class,'getDataQuotation'])->name('reserved.quotation');

        Route::resource('/received', App\Http\Controllers\Admin\ReceivedController::class);
        Route::get('/received/reserved/{reserved}',[App\Http\Controllers\Admin\ReceivedController::class,'getDataReserved']);
        Route::get('/received/getcarstock/{car}',[App\Http\Controllers\Admin\ReceivedController::class,'getDataCarstock']);
        Route::get('/received/getengine/{carstock}',[App\Http\Controllers\Admin\ReceivedController::class,'getDataEngine']);

        Route::resource('/receivedfollow', App\Http\Controllers\Admin\ReceivedFollowController::class);
        Route::get('/receivedfollow/getreceivedfollow/{receivedfollow}', [App\Http\Controllers\Admin\ReceivedFollowController::class,'getDataReceivedfollow']);

    });
});
