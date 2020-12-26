<?php

use App\Models\Company;
use App\Models\FormEntry;
use Illuminate\Support\Facades\DB;
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
    return view('dashboard')->with('companyData', Company::first());
})->name('dashboard');

Route::get('/imprint', function () {
    return view('imprint');
})->name('imprint');


//TODO: Update routing exceptions
Route::resource('company','App\Http\Controllers\CompanyController')->except(['index']);
Route::resource('order','App\Http\Controllers\OrderController');
Route::resource('product','App\Http\Controllers\ProductController');
Route::resource('product.service','App\Http\Controllers\ServiceController')->except(['index']);


//TODO: Remove Demos

Route::get('/manageDataStructureDemo', function () {
    $content = new stdClass();
    $content->title = "Create your Company"; //or Edit
    $content->method = "POST"; //or Edit
    $content->url = route('orders');

    $entry1 = new FormEntry("Company Name", "companyName", "text","asdf");
    $content->elements = array($entry1);

    return view('manageDataStructure')->with('formStructure',$content);
})->name('manageDataStructure');
