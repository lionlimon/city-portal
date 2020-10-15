<?php

use Illuminate\Database\Console\Migrations\StatusCommand;
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
Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'can:admin'], function () {
    Route::get('/', 'AdminController@index')->name('admin');
    Route::get('/category', 'AdminController@category')->name('admin.category');
    Route::get('/application', 'AdminController@application')->name('admin.application');
    Route::put('/application/resolve/{application}', 'AdminController@applicationResolve')->name('admin.applicationResolve');
    Route::put('/application/reject/{application}', 'AdminController@applicationReject')->name('admin.applicationReject');
    Route::get('/status', 'AdminController@status')->name('admin.status');
});

Route::group(['middleware' => 'auth'], function() {
    Route::resource('/category', CategoryController::class)->except(['edit', 'show', 'index']);
    Route::resource('/application', ApplicationController::class);
    Route::resource('/status', StatusController::class)->except(['edit', 'show', 'index']);
});

Route::get('/', 'HomeController@index');
Route::get('/counters', 'HomeController@counters');




