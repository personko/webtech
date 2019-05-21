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
//Route::get('/', 'SiteController@index')->name('site');
Route::get('/', function () {
    return redirect('admin');
})->name('site');

Auth::routes();

// Example
Route::get('example','SiteController@example');

// Admin
Route::group(['middleware' => ['auth']], function() {

	// Example
	Route::get('admin/example','Admin\ExampleController@example');

	// Uloha 1
	Route::get('admin/uloha1','Admin\Uloha1Controller@index')->name('uloha1.index');
	Route::get('admin/uloha1/create','Admin\Uloha1Controller@create')->name('uloha1.create');
	Route::get('admin/uloha1/show','Admin\Uloha1Controller@show')->name('uloha1.show');

	// Uloha 1 - data manipulations by POST/DELETE methods
	Route::post('admin/uloha1/store','Admin\Uloha1Controller@store')->name('uloha1.store');
	Route::delete('admin/uloha1/destroy','Admin\Uloha1Controller@destroy')->name('uloha1.destroy');

    // Uloha 2
    Route::get('admin/uloha2','Admin\Uloha2Controller@index')->name('uloha2.index');
    Route::post('admin/uloha2/index','Admin\Uloha2Controller@index')->name('uloha2.index');
    Route::get('admin/uloha2/index','Admin\Uloha2Controller@index')->name('uloha2.index');
    Route::post('admin/uloha2/store','Admin\Uloha2Controller@store')->name('uloha2.store');
    Route::get('admin/uloha2/store','Admin\Uloha2Controller@store')->name('uloha2.store');
    
	// Modules
    Route::resource('admin/roles','Admin\RoleController');
    Route::resource('admin/users','Admin\UserController');
    Route::resource('admin/products','Admin\ProductController');

    // Fallback form "/admin" URL
    Route::resource('admin','Admin\DashboardController');
});