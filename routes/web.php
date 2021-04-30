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

Route::get('/', 'App\Http\Controllers\HomeController@index')->name("home.index");
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

// User routes
Route::get('/user/show/{id}', 'App\Http\Controllers\UserController@show')->name('user.show');
Route::get('/user/list', 'App\Http\Controllers\UserController@list')->name('user.list');
Route::get('/user/update', 'App\Http\Controllers\UserController@update')->name('user.update');
Route::post('/user/update_save', 'App\Http\Controllers\UserController@updateSave')->name('user.update_save');
Route::post('/user/delete', 'App\Http\Controllers\UserController@delete')->name('user.delete');

// Company routes
Route::get('/company/show/{id}', 'App\Http\Controllers\CompanyController@show')->name('company.show');
Route::get('/company/list', 'App\Http\Controllers\CompanyController@list')->name('company.list');
Route::get('/company/create', 'App\Http\Controllers\CompanyController@create')->name('company.create');
Route::get('/company/update', 'App\Http\Controllers\CompanyController@update')->name('company.update');
Route::post('/company/update_save', 'App\Http\Controllers\CompanyController@updateSave')->name('company.update_save');
Route::post('/company/save', 'App\Http\Controllers\CompanyController@save')->name('company.save');
Route::post('/company/delete', 'App\Http\Controllers\CompanyController@delete')->name('company.delete');

// Warehouse routes
Route::get('/warehouse/show/{id}', 'App\Http\Controllers\WarehouseController@show')->name('warehouse.show');
Route::get('/warehouse/list', 'App\http\Controllers\WarehouseController@list')->name('warehouse.list');
Route::get('/warehouse/create', 'App\Http\Controllers\WarehouseController@create')->name('warehouse.create');
Route::get('/warehouse/update', 'App\Http\Controllers\WarehouseController@update')->name('warehouse.update');
Route::post('/warehouse/update_save', 'App\Http\Controllers\WarehouseController@updateSave')->name('warehouse.update_save');
Route::post('/warehouse/save', 'App\Http\Controllers\WarehouseController@save')->name('warehouse.save');
Route::post('/warehouse/delete', 'App\Http\Controllers\WarehouseController@delete')->name('warehouse.delete');

// DeliveryRoutes routes
Route::get('/delivery_route/show/{id}', 'App\Http\Controllers\DeliveryRouteController@show')->name('delivery_route.show');
Route::get('/delivery_route/list', 'App\http\Controllers\DeliveryRouteController@list')->name('delivery_route.list');
Route::get('/delivery_route/create', 'App\Http\Controllers\DeliveryRouteController@create')->name('delivery_route.create');
Route::get('/delivery_route/update', 'App\Http\Controllers\DeliveryRouteController@update')->name('delivery_route.update');
Route::post('/delivery_route/update_save', 'App\Http\Controllers\DeliveryRouteController@updateSave')->name('delivery_route.update_save');
Route::post('/delivery_route/save', 'App\Http\Controllers\DeliveryRouteController@save')->name('delivery_route.save');
Route::post('/delivery_route/delete', 'App\Http\Controllers\DeliveryRouteController@delete')->name('delivery_route.delete');

// Vehicle routes
Route::get('/vehicle/show/{id}', 'App\Http\Controllers\VehicleController@show')->name('vehicle.show');
Route::get('/vehicle/list', 'App\http\Controllers\VehicleController@list')->name('vehicle.list');
Route::get('/vehicle/create', 'App\Http\Controllers\VehicleController@create')->name('vehicle.create');
Route::get('/vehicle/update', 'App\Http\Controllers\VehicleController@update')->name('vehicle.update');
Route::post('/vehicle/update_save', 'App\Http\Controllers\VehicleController@updateSave')->name('vehicle.update_save');
Route::post('/vehicle/save', 'App\Http\Controllers\VehicleController@save')->name('vehicle.save');
Route::post('/vehicle/delete', 'App\Http\Controllers\VehicleController@delete')->name('vehicle.delete');
Route::get('/vehicle/import_export', 'App\Http\Controllers\VehicleController@importExport')->name('vehicle.import_export');
Route::post('/vehicle/import_file', 'App\Http\Controllers\VehicleController@importFile')->name('vehicle.import_file');
Route::get('/vehicle/export_file', 'App\Http\Controllers\VehicleController@exportFile')->name('vehicle.export_file');

// VehicleType routes
Route::get('/vehicle_type/show/{id}', 'App\Http\Controllers\VehicleTypeController@show')->name('vehicle_type.show');
Route::get('/vehicle_type/list', 'App\http\Controllers\VehicleTypeController@list')->name('vehicle_type.list');
Route::get('/vehicle_type/create', 'App\Http\Controllers\VehicleTypeController@create')->name('vehicle_type.create');
Route::get('/vehicle_type/update', 'App\Http\Controllers\VehicleTypeController@update')->name('vehicle_type.update');
Route::post('/vehicle_type/update_save', 'App\Http\Controllers\VehicleTypeController@updateSave')->name('vehicle_type.update_save');
Route::post('/vehicle_type/save', 'App\Http\Controllers\VehicleTypeController@save')->name('vehicle_type.save');
Route::post('/vehicle_type/delete', 'App\Http\Controllers\VehicleTypeController@delete')->name('vehicle_type.delete');
