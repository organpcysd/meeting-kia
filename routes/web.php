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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('admin')->group(function(){
    Route::group(['middleware' => ['IsActive']],function(){
        Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index']);

        Route::resource('/user', App\Http\Controllers\Admin\UserController::class);
        Route::resource('/userprefix', App\Http\Controllers\Admin\UserPrefixController::class);
        Route::resource('/profile', App\Http\Controllers\Admin\ProfileController::class);
        Route::get('/user/status/{id}',[App\Http\Controllers\Admin\UserController::class, 'status']);

        Route::resource('/position', App\Http\Controllers\Admin\PositionController::class);
        Route::get('/position/publish/{id}',[App\Http\Controllers\Admin\PositionController::class, 'publish']);

        Route::resource('/role', App\Http\Controllers\Admin\RoleController::class);
        Route::resource('/permission', App\Http\Controllers\Admin\PermissionController::class);
        Route::resource('/setting', App\Http\Controllers\Admin\SettingController::class);

        Route::resource('/car', App\Http\Controllers\Admin\CarController::class);
        Route::post('/car/getmodel',[App\Http\Controllers\Admin\CarController::class,'getDataCarmodel'])->name('car.getmodel');

        Route::resource('/carmodel', App\Http\Controllers\Admin\CarModelController::class);
        Route::resource('/cartype', App\Http\Controllers\Admin\CarTypeController::class);
        Route::resource('/carcolor', App\Http\Controllers\Admin\CarColorController::class);
        Route::resource('/carlevel', App\Http\Controllers\Admin\CarLevelController::class);
        Route::resource('/cargift', App\Http\Controllers\Admin\CarGiftController::class);

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

        Route::resource('traffic/channel', App\Http\Controllers\Admin\TrafficChannelController::class);
        Route::resource('traffic/source', App\Http\Controllers\Admin\TrafficSourceController::class);

    });
});
