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

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::get('logout', 'UserController@logout')->name('logout');
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

	Route::resource('pedidos', 'DemandController')->names('demand')->parameters(['pedidos' => 'demand']);
	
	Route::resource('clientes', 'ClientController')->names('client')->parameters(['clientes' => 'client']);
	Route::get('clientautocomplete', 'ClientController@autocomplete')->name('client.autocomplete');
	
	Route::resource('categorias', 'CategoryController')->names('category')->parameters(['categorias' => 'category']);
	
	Route::resource('produtos', 'ProductController')->names('product')->parameters(['produtos' => 'product']);
	Route::get('productautocomplete', 'ProductController@autocomplete')->name('product.autocomplete');

	Route::resource('unidadesmedida', 'UMController')->names('um')->parameters(['unidadesmedida' => 'um']);

	Route::get('/home', 'DemandController@demands')->name('home');
});
