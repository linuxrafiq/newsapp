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

// Route::get('/', function () {
//     return view('/cats.index');
// });

Route::get('/', 'CategoryController@index')->name('cats.index');
Route::get('/app', 'CategoryController@indexApp')->name('cats.app');
Route::get('/cat', 'CategoryController@indexCat')->name('cats.cat');
Route::get('/sub', 'CategoryController@indexSub')->name('cats.sub');

Route::post('/storeapp', 'CategoryController@storeapp')->name('cats.storeapp');

Route::post('/storecat', 'CategoryController@storecat')->name('cats.storecat');
Route::post('/storesubcat', 'CategoryController@storesubcat')->name('cats.storesubcat');
Route::post('/storecontent', 'CategoryController@storecontent')->name('storecontent');

Auth::routes();
Route::post('/fetch', 'CategoryController@fetch')->name('cats.fetch');
Route::resource('cats', 'CategoryController');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
