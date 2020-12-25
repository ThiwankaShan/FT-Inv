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

Route::get('/', function () { return view('welcome'); });
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'LiveSearchController@autofill')->name('liveSearch');
Route::post('/search', 'SearchController@search')->name('search');
Route::get('/dashboard/show/{id}','ItemController@ShowItems')->name('dashBoard.show');

Route::resource('/user', 'UserController');
Route::resource('grn', 'GRNController');
Route::post('/grn/delete/{grn_number?}','GRNController@destroy')->name('grn.delete');

//=======================SUB CATEGORY ==============================================================================================================
Route::resource('/subcategory', 'SubCategoryController');
Route::get('/subCategory/edit/{subCategory?}/{category?}','subCategoryController@edit')->name('subCategory.edit');
Route::post('/subCategory/update','subCategoryController@update')->name('subCategory.update');
Route::post('/subCategory/delete/{subCategory?}/{category?}','subCategoryController@destroy')->name('subCategory.delete');

//======================= CATEGORY ==============================================================================================================
Route::resource('/category', 'CategoryController');
Route::post('category/delete/{category?}', 'CategoryController@destroy')->name('category.delete');

//======================= ITEM ==============================================================================================================
Route::resource('/item', 'ItemController');
Route::get('/item/edit/{item?}', 'ItemController@edit')->where('item','(.*)')->name('item.editForm');
Route::post('/item/update/{item?}', 'ItemController@update')->where('item','(.*)');
Route::post('/item/delete/{item?}', 'ItemController@destroy')->where('item', '(.*)')->name('item.destroy');
Route::post('/serial_number/store','ItemController@SerialNumber')->name('serial.show');


//======================= FILTER ==============================================================================================================
Route::post('/ajax/division', 'FilterController@getSubLocation')->name('ajax.getSubLocation');
Route::post('/ajax/category', 'FilterController@getSubCategory')->name('ajax.getSubCategory');
Route::post('/ajax/roman', 'FilterController@getRomanNumber');
Route::post('/ajax/filter', 'FilterController@getFilter')->name('ajax.filter');

//======================= LOCATION ==============================================================================================================
Route::get('location', 'locationController@index')->name('location.insert');
Route::get('location/index', 'locationController@index')->name('location.index');
Route::get('location/create', 'locationController@create')->name('location.create');
Route::post('location/store', 'locationController@storeLocation')->name('location.store');
Route::post('location/delete/{location?}', 'locationController@delete')->name('location.delete');
Route::get('location/edit/{location?}', 'locationController@edit')->name('location.edit');
Route::post('location/update/{location?}', 'locationController@update')->name('location.update');

//======================= SUB LOCATION ==============================================================================================================
Route::resource('/subLocation', 'subLocationController');
Route::get('/subLocation/edit/{subLocation?}/{location?}','subLocationController@edit')->name('subLocation.edit');
Route::post('/subLocation/update','subLocationController@update')->name('subLocation.update');
Route::post('/subLocation/delete/{subLocation?}/{location?}','subLocationController@delete')->name('subLocation.delete');

//======================= SUPPLIER ==============================================================================================================
Route::get('/supplier', 'SupplierController@index')->name('supplier.index');
Route::get('/supplier/edit/{supplier?}', 'SupplierController@edit')->name('supplier.edit');
Route::post('/supplier/update', 'SupplierController@update')->name('supplier.update');
Route::post('/supplier/delete/{supplier?}', 'SupplierController@delete')->name('supplier.delete');
Route::get('/supplier/create', 'SupplierController@create')->name('supplier.create');
Route::post('/supplier/store', 'SupplierController@store')->name('supplier.store');

//======================= REPORT ==============================================================================================================
Route::get('/reports/download', 'reportsController@pdfDownload')->name('reports.download');
Route::get('/reports/create', 'reportsController@create')->name('reports.create');
Route::post('/reports/preview', 'reportsController@preview')->name('reports.preview');



