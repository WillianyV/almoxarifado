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
Route::get('funcao/pdf/{search?}','App\Http\Controllers\RoleController@exportToPdf')->name('funcao.pdf');
Route::get('setor/pdf/{search?}','App\Http\Controllers\DepartmentController@exportToPdf')->name('setor.pdf');
Route::get('categoria/pdf/{search?}','App\Http\Controllers\CategoryController@exportToPdf')->name('categoria.pdf');
Route::get('fornecedor/pdf/{search?}','App\Http\Controllers\ProviderController@exportToPdf')->name('fornecedor.pdf');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('funcao','App\Http\Controllers\RoleController')->except('show');
Route::resource('setor','App\Http\Controllers\DepartmentController')->except('show');
Route::resource('categoria','App\Http\Controllers\CategoryController')->except('show');
Route::resource('fornecedor','App\Http\Controllers\ProviderController')->except('show');