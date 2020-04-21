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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('clients', 'ClientController');
Route::resource('units', 'UnitController');
Route::resource('products', 'ProductController');
Route::resource('branches', 'BranchController');

Route::get('create-treatment', 'TreatmentController@create');
Route::get('treatments', 'TreatmentController@index');