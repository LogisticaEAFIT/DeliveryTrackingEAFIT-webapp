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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name("home.index");
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Company routes
Route::get('/company/show/{id}', [App\Http\Controllers\CompanyController::class, 'show'])->name('company.show');
Route::get('/company/list', [App\Http\Controllers\CompanyController::class, 'list'])->name('company.list');
Route::get('/company/create', [App\Http\Controllers\CompanyController::class, 'create'])->name('company.create');
Route::get('/company/update', [App\Http\Controllers\CompanyController::class, 'update'])->name('company.update');
Route::post('/company/update_save', [App\Http\Controllers\CompanyController::class, 'updateSave'])->name('company.update_save');
Route::post('/company/save', [App\Http\Controllers\CompanyController::class, 'save'])->name('company.save');
Route::post('/company/delete', [App\Http\Controllers\CompanyController::class, 'delete'])->name('company.delete');

// Warehouse routes
Route::get('/warehouse/show/{id}', [App\Http\Controllers\WarehouseController::class, 'show'])->name('warehouse.show');
Route::get('/warehouse/list', [App\Http\Controllers\WarehouseController::class, 'list'])->name('warehouse.list');
Route::get('/warehouse/create', [App\Http\Controllers\WarehouseController::class, 'create'])->name('warehouse.create');
Route::get('/warehouse/update', [App\Http\Controllers\WarehouseController::class, 'update'])->name('warehouse.update');
Route::post('/warehouse/update_save', [App\Http\Controllers\WarehouseController::class, 'updateSave'])->name('warehouse.update_save');
Route::post('/warehouse/save', [App\Http\Controllers\WarehouseController::class, 'save'])->name('warehouse.save');
Route::post('/warehouse/delete', [App\Http\Controllers\WarehouseController::class, 'delete'])->name('warehouse.delete');
