<?php

use App\Http\Controllers\ProductController;
use App\Models\Company;
use App\Models\FormEntry;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
    return view('dashboard')->with('companyData', Company::first());
})->name('dashboard');

Route::get('/imprint', function () {
    return view('imprint');
})->name('imprint');

Route::post('/product/addService', [ProductController::class, 'addService'])->name('product.addService');
Route::resource('company','App\Http\Controllers\CompanyController')->except(['index','show']);
Route::resource('order','App\Http\Controllers\OrderController')->except(['show']);
Route::resource('product','App\Http\Controllers\ProductController')->except(['show']);
Route::resource('product.service','App\Http\Controllers\ServiceController')->except(['create, show']);
