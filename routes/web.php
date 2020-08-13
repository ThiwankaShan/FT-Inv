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
Route::resource('/item', 'ItemController');
Route::post('/home', 'LiveSearchController@autofill')->name('liveSearch');
Route::post('/search', 'SearchController@search')->name('search');
Route::post('/ajax/division','AjaxController@getSubDivision')->name('ajax.getSubdivision');
Route::post('/ajax/category','AjaxController@getSubCategory')->name('ajax.getSubcategory');
Route::post('/ajax/filter','AjaxController@getFilter')->name('ajax.filter');

