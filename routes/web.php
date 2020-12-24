<?php

use App\Models\FormEntry;
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
    return view('dashboard');
})->name('dashboard');

Route::get('/imprint', function () {
    return view('imprint');
})->name('imprint');

Route::get('/orders', function () {
    return view('orders');
})->name('orders');

Route::get('/productsAndServices', function () {
    return view('productsAndServices');
})->name('productsAndServices');

Route::get('/manageDataStructure', function () {
    $content = new stdClass();
    $content->title = "Create your Company"; //or Edit
    $content->method = "POST"; //or Edit
    $content->url = route('orders');

    $entry1 = new FormEntry("Company Name", "companyName", "text","asdf");
    $content->elements = array($entry1);

    return view('manageDataStructure')->with('formStructure',$content);
})->name('manageDataStructure');
