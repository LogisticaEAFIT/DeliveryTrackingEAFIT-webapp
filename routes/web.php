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
Route::post('/user/reactivate', 'App\Http\Controllers\UserController@reactivate')->name('user.reactivate');
Route::get('/user/import_export', 'App\Http\Controllers\UserController@importExport')->name('user.import_export');
Route::post('/user/import_file', 'App\Http\Controllers\UserController@importFile')->name('user.import_file');
Route::get('/user/export_file', 'App\Http\Controllers\UserController@exportFile')->name('user.export_file');
Route::get('/user/download_format', 'App\Http\Controllers\UserController@downloadFormat')->name('user.download_format');

// Company routes
Route::get('/company/show/{id}', 'App\Http\Controllers\CompanyController@show')->name('company.show');
Route::get('/company/list', 'App\Http\Controllers\CompanyController@list')->name('company.list');
Route::get('/company/create', 'App\Http\Controllers\CompanyController@create')->name('company.create');
Route::get('/company/update', 'App\Http\Controllers\CompanyController@update')->name('company.update');
Route::post('/company/update_save', 'App\Http\Controllers\CompanyController@updateSave')->name('company.update_save');
Route::post('/company/save', 'App\Http\Controllers\CompanyController@save')->name('company.save');
Route::post('/company/delete', 'App\Http\Controllers\CompanyController@delete')->name('company.delete');
Route::post('/company/reactivate', 'App\Http\Controllers\CompanyController@reactivate')->name('company.reactivate');
Route::get('/company/import_export', 'App\Http\Controllers\CompanyController@importExport')->name('company.import_export');
Route::post('/company/import_file', 'App\Http\Controllers\CompanyController@importFile')->name('company.import_file');
Route::get('/company/export_file', 'App\Http\Controllers\CompanyController@exportFile')->name('company.export_file');
Route::get('/company/download_format', 'App\Http\Controllers\CompanyController@downloadFormat')->name('company.download_format');

// Warehouse routes
Route::get('/warehouse/show/{id}', 'App\Http\Controllers\WarehouseController@show')->name('warehouse.show');
Route::get('/warehouse/list', 'App\Http\Controllers\WarehouseController@list')->name('warehouse.list');
Route::get('/warehouse/create', 'App\Http\Controllers\WarehouseController@create')->name('warehouse.create');
Route::get('/warehouse/update', 'App\Http\Controllers\WarehouseController@update')->name('warehouse.update');
Route::post('/warehouse/update_save', 'App\Http\Controllers\WarehouseController@updateSave')->name('warehouse.update_save');
Route::post('/warehouse/save', 'App\Http\Controllers\WarehouseController@save')->name('warehouse.save');
Route::post('/warehouse/delete', 'App\Http\Controllers\WarehouseController@delete')->name('warehouse.delete');
Route::post('/warehouse/reactivate', 'App\Http\Controllers\WarehouseController@reactivate')->name('warehouse.reactivate');
Route::get('/warehouse/import_export', 'App\Http\Controllers\WarehouseController@importExport')->name('warehouse.import_export');
Route::post('/warehouse/import_file', 'App\Http\Controllers\WarehouseController@importFile')->name('warehouse.import_file');
Route::get('/warehouse/export_file', 'App\Http\Controllers\WarehouseController@exportFile')->name('warehouse.export_file');
Route::get('/warehouse/download_format', 'App\Http\Controllers\WarehouseController@downloadFormat')->name('warehouse.download_format');

// DeliveryRoutes routes
Route::get('/delivery_route/show/{id}', 'App\Http\Controllers\DeliveryRouteController@show')->name('delivery_route.show');
Route::get('/delivery_route/list', 'App\Http\Controllers\DeliveryRouteController@list')->name('delivery_route.list');
Route::get('/delivery_route/create', 'App\Http\Controllers\DeliveryRouteController@create')->name('delivery_route.create');
Route::get('/delivery_route/update', 'App\Http\Controllers\DeliveryRouteController@update')->name('delivery_route.update');
Route::post('/delivery_route/update_save', 'App\Http\Controllers\DeliveryRouteController@updateSave')->name('delivery_route.update_save');
Route::post('/delivery_route/save', 'App\Http\Controllers\DeliveryRouteController@save')->name('delivery_route.save');
Route::post('/delivery_route/delete', 'App\Http\Controllers\DeliveryRouteController@delete')->name('delivery_route.delete');
//Route::post('/delivery_route/reactivate', 'App\Http\Controllers\DeliveryRouteController@reactivate')->name('delivery_route.reactivate');
Route::get('/delivery_route/import_export', 'App\Http\Controllers\DeliveryRouteController@importExport')->name('delivery_route.import_export');
Route::post('/delivery_route/import_file', 'App\Http\Controllers\DeliveryRouteController@importFile')->name('delivery_route.import_file');
Route::post('/delivery_route/import_file_delivery_service_bill', 'App\Http\Controllers\DeliveryRouteController@importFileDeliveryServiceBill')->name('delivery_route.import_file_delivery_service_bill');
Route::get('/delivery_route/export_file', 'App\Http\Controllers\DeliveryRouteController@exportFile')->name('delivery_route.export_file');
Route::get('/delivery_route/download_format', 'App\Http\Controllers\DeliveryRouteController@downloadFormat')->name('delivery_route.download_format');

// Vehicle routes
Route::get('/vehicle/show/{id}', 'App\Http\Controllers\VehicleController@show')->name('vehicle.show');
Route::get('/vehicle/list', 'App\Http\Controllers\VehicleController@list')->name('vehicle.list');
Route::get('/vehicle/create', 'App\Http\Controllers\VehicleController@create')->name('vehicle.create');
Route::get('/vehicle/update', 'App\Http\Controllers\VehicleController@update')->name('vehicle.update');
Route::post('/vehicle/update_save', 'App\Http\Controllers\VehicleController@updateSave')->name('vehicle.update_save');
Route::post('/vehicle/save', 'App\Http\Controllers\VehicleController@save')->name('vehicle.save');
Route::post('/vehicle/delete', 'App\Http\Controllers\VehicleController@delete')->name('vehicle.delete');
Route::post('/vehicle/reactivate', 'App\Http\Controllers\VehicleController@reactivate')->name('vehicle.reactivate');
Route::get('/vehicle/import_export', 'App\Http\Controllers\VehicleController@importExport')->name('vehicle.import_export');
Route::post('/vehicle/import_file', 'App\Http\Controllers\VehicleController@importFile')->name('vehicle.import_file');
Route::get('/vehicle/export_file', 'App\Http\Controllers\VehicleController@exportFile')->name('vehicle.export_file');
Route::get('/vehicle/download_format', 'App\Http\Controllers\VehicleController@downloadFormat')->name('vehicle.download_format');

// VehicleType routes
Route::get('/vehicle_type/show/{id}', 'App\Http\Controllers\VehicleTypeController@show')->name('vehicle_type.show');
Route::get('/vehicle_type/list', 'App\Http\Controllers\VehicleTypeController@list')->name('vehicle_type.list');
Route::get('/vehicle_type/create', 'App\Http\Controllers\VehicleTypeController@create')->name('vehicle_type.create');
Route::get('/vehicle_type/update', 'App\Http\Controllers\VehicleTypeController@update')->name('vehicle_type.update');
Route::post('/vehicle_type/update_save', 'App\Http\Controllers\VehicleTypeController@updateSave')->name('vehicle_type.update_save');
Route::post('/vehicle_type/save', 'App\Http\Controllers\VehicleTypeController@save')->name('vehicle_type.save');
Route::post('/vehicle_type/delete', 'App\Http\Controllers\VehicleTypeController@delete')->name('vehicle_type.delete');
Route::post('/vehicle_type/reactivate', 'App\Http\Controllers\VehicleTypeController@reactivate')->name('vehicle_type.reactivate');
Route::get('/vehicle_type/import_export', 'App\Http\Controllers\VehicleTypeController@importExport')->name('vehicle_type.import_export');
Route::post('/vehicle_type/import_file', 'App\Http\Controllers\VehicleTypeController@importFile')->name('vehicle_type.import_file');
Route::get('/vehicle_type/export_file', 'App\Http\Controllers\VehicleTypeController@exportFile')->name('vehicle_type.export_file');
Route::get('/vehicle_type/download_format', 'App\Http\Controllers\VehicleTypeController@downloadFormat')->name('vehicle_type.download_format');

// Customer routes
Route::get('/customer/show/{id}', 'App\Http\Controllers\CustomerController@show')->name('customer.show');
Route::get('/customer/list', 'App\Http\Controllers\CustomerController@list')->name('customer.list');
Route::get('/customer/create', 'App\Http\Controllers\CustomerController@create')->name('customer.create');
Route::get('/customer/update', 'App\Http\Controllers\CustomerController@update')->name('customer.update');
Route::post('/customer/update_save', 'App\Http\Controllers\CustomerController@updateSave')->name('customer.update_save');
Route::post('/customer/save', 'App\Http\Controllers\CustomerController@save')->name('customer.save');
Route::post('/customer/delete', 'App\Http\Controllers\CustomerController@delete')->name('customer.delete');
Route::post('/customer/reactivate', 'App\Http\Controllers\CustomerController@reactivate')->name('customer.reactivate');
Route::get('/customer/import_export', 'App\Http\Controllers\CustomerController@importExport')->name('customer.import_export');
Route::post('/customer/import_file', 'App\Http\Controllers\CustomerController@importFile')->name('customer.import_file');
Route::get('/customer/export_file', 'App\Http\Controllers\CustomerController@exportFile')->name('customer.export_file');
Route::get('/customer/download_format', 'App\Http\Controllers\CustomerController@downloadFormat')->name('customer.download_format');

// Service routes
Route::get('/service/show/{id}', 'App\Http\Controllers\ServiceController@show')->name('service.show');
Route::get('/service/list', 'App\Http\Controllers\ServiceController@list')->name('service.list');
Route::get('/service/create', 'App\Http\Controllers\ServiceController@create')->name('service.create');
Route::get('/service/update', 'App\Http\Controllers\ServiceController@update')->name('service.update');
Route::post('/service/update_save', 'App\Http\Controllers\ServiceController@updateSave')->name('service.update_save');
Route::post('/service/save', 'App\Http\Controllers\ServiceController@save')->name('service.save');
Route::post('/service/delete', 'App\Http\Controllers\ServiceController@delete')->name('service.delete');
Route::post('/service/reactivate', 'App\Http\Controllers\ServiceController@reactivate')->name('service.reactivate');
Route::get('/service/import_export', 'App\Http\Controllers\ServiceController@importExport')->name('service.import_export');
Route::post('/service/import_file', 'App\Http\Controllers\ServiceController@importFile')->name('service.import_file');
Route::get('/service/export_file', 'App\Http\Controllers\ServiceController@exportFile')->name('service.export_file');
Route::get('/service/download_format', 'App\Http\Controllers\ServiceController@downloadFormat')->name('service.download_format');

// Vendor routes
Route::get('/vendor/show/{id}', 'App\Http\Controllers\VendorController@show')->name('vendor.show');
Route::get('/vendor/list', 'App\Http\Controllers\VendorController@list')->name('vendor.list');
Route::get('/vendor/create', 'App\Http\Controllers\VendorController@create')->name('vendor.create');
Route::get('/vendor/update', 'App\Http\Controllers\VendorController@update')->name('vendor.update');
Route::post('/vendor/update_save', 'App\Http\Controllers\VendorController@updateSave')->name('vendor.update_save');
Route::post('/vendor/save', 'App\Http\Controllers\VendorController@save')->name('vendor.save');
Route::post('/vendor/delete', 'App\Http\Controllers\VendorController@delete')->name('vendor.delete');
Route::post('/vendor/reactivate', 'App\Http\Controllers\VendorController@reactivate')->name('vendor.reactivate');
Route::get('/vendor/import_export', 'App\Http\Controllers\VendorController@importExport')->name('vendor.import_export');
Route::post('/vendor/import_file', 'App\Http\Controllers\VendorController@importFile')->name('vendor.import_file');
Route::get('/vendor/export_file', 'App\Http\Controllers\VendorController@exportFile')->name('vendor.export_file');
Route::get('/vendor/download_format', 'App\Http\Controllers\VendorController@downloadFormat')->name('vendor.download_format');

// Bill routes
Route::get('/bill/show/{id}', 'App\Http\Controllers\BillController@show')->name('bill.show');
Route::get('/bill/list', 'App\Http\Controllers\BillController@list')->name('bill.list');
Route::get('/bill/create', 'App\Http\Controllers\BillController@create')->name('bill.create');
Route::get('/bill/update', 'App\Http\Controllers\BillController@update')->name('bill.update');
Route::post('/bill/update_save', 'App\Http\Controllers\BillController@updateSave')->name('bill.update_save');
Route::post('/bill/save', 'App\Http\Controllers\BillController@save')->name('bill.save');
Route::post('/bill/delete', 'App\Http\Controllers\BillController@delete')->name('bill.delete');
Route::post('/bill/reactivate', 'App\Http\Controllers\BillController@reactivate')->name('bill.reactivate');
Route::get('/bill/import_export', 'App\Http\Controllers\BillController@importExport')->name('bill.import_export');
Route::post('/bill/import_file', 'App\Http\Controllers\BillController@importFile')->name('bill.import_file');
Route::get('/bill/export_file', 'App\Http\Controllers\BillController@exportFile')->name('bill.export_file');
Route::get('/bill/download_format', 'App\Http\Controllers\BillController@downloadFormat')->name('bill.download_format');
