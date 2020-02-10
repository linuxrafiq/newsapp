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

Route::get('/applist', 'CategoryController@applist')->name('cats.applist');
Route::get('/catlist', 'CategoryController@catlist')->name('cats.catlist');
Route::get('/subcatlist', 'CategoryController@subcatlist')->name('cats.subcatlist');

//Route::post('/edit', 'CategoryController@edit')->name('cats.edit');
//Route::DELETE('/destory', 'CategoryController@destroy')->name('cats.destroy');
Route::get('/content/list', 'CategoryController@show')->name('content.show');


Route::post('/storecontent', 'CategoryController@storecontent')->name('storecontent');
Route::post('/contenttype', 'ContentController@type')->name('content.type');

Route::post('ckeditor/image_upload', 'CKEditorController@upload')->name('upload');
Auth::routes();
Route::post('/fetch', 'CategoryController@fetch')->name('cats.fetch');
Route::resource('cats', 'CategoryController');
Route::resource('contents', 'ContentController');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
