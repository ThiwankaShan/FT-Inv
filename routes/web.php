<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/user', 'UserController');

//Dashboard Sort by,Show parts
Route::get('/dashboard/show/{id}','ItemController@ShowItems')->name('dashBoard.show');
//Add serial number after item saved
Route::post('/serial_number/store','ItemController@SerialNumber')->name('serial.show');

Route::resource('/item', 'ItemController');
Route::get('/item/edit/{item?}', 'ItemController@edit')->where('item','(.*)')->name('item.editForm');
Route::post('/item/update/{item?}', 'ItemController@update')->where('item','(.*)');
Route::post('/item/delete/{item?}', 'ItemController@destroy')->where('item', '(.*)')->name('item.destroy');

Route::post('/home', 'LiveSearchController@autofill')->name('liveSearch');
Route::post('/search', 'SearchController@search')->name('search');

// Route::post('/ajax/division', 'AjaxController@getSubLocation')->name('ajax.getSubdivision');
// Route::post('/ajax/category', 'AjaxController@getSubCategory')->name('ajax.getSubcategory');

Route::post('/ajax/division', 'FilterController@getSubLocation')->name('ajax.getSubLocation');
Route::post('/ajax/category', 'FilterController@getSubCategory')->name('ajax.getSubCategory');
Route::post('/ajax/roman', 'FilterController@getRomanNumber');
Route::post('/ajax/filter', 'FilterController@getFilter')->name('ajax.filter');


Route::get('location', 'locationController@index')->name('location.insert');
Route::get('location/index', 'locationController@index')->name('location.index');
Route::get('location/create', 'locationController@create')->name('location.create');
Route::post('location/store', 'locationController@storeLocation')->name('location.store');

Route::resource('/category', 'CategoryController');
Route::resource('sublocation', 'subLocationController');
Route::resource('/subcategory', 'SubCategoryController');
Route::resource('grn', 'GRNController');


//suppliers
Route::get('/supplier/create', 'SupplierController@create')->name('supplier.create');
Route::post('/supplier/store', 'SupplierController@store')->name('supplier.store');

Route::get('/reports/download', 'reportsController@pdfDownload')->name('reports.download');
Route::get('/reports', 'reportsController@create')->name('reports.create');


