<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('funcao/pdf/{search?}'                ,'App\Http\Controllers\RoleController@exportToPdf')->name('funcao.pdf');
Route::get('setor/pdf/{search?}'                 ,'App\Http\Controllers\DepartmentController@exportToPdf')->name('setor.pdf');
Route::get('categoria/pdf/{search?}'             ,'App\Http\Controllers\CategoryController@exportToPdf')->name('categoria.pdf');
Route::get('fornecedor/pdf/{search?}'            ,'App\Http\Controllers\ProviderController@exportToPdf')->name('fornecedor.pdf');
Route::get('almoxarifado/pdf/{search?}'          ,'App\Http\Controllers\WarehouseController@exportToPdf')->name('almoxarifado.pdf');
Route::get('usuario/pdf/{search?}'               ,'App\Http\Controllers\UserController@exportToPdf')->name('usuario.pdf');
Route::get('empresa/pdf/{search?}'               ,'App\Http\Controllers\CompanyController@exportToPdf')->name('empresa.pdf');
Route::get('funcionario/pdf/{search?}'           ,'App\Http\Controllers\EmployeeController@exportToPdf')->name('funcionario.pdf');
Route::get('produtos/pdf/{search?}'              ,'App\Http\Controllers\ProductController@exportToPdf')->name('produtos.pdf');

Route::get('/', function () { return view('home'); });

Auth::routes(['register' => false, 'reset' => false, 'verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('funcao'                ,'App\Http\Controllers\RoleController')->except('show');
Route::resource('setor'                 ,'App\Http\Controllers\DepartmentController')->except('show');
Route::resource('categoria'             ,'App\Http\Controllers\CategoryController')->except('show');
Route::resource('fornecedor'            ,'App\Http\Controllers\ProviderController')->except('show');
Route::resource('almoxarifado'          ,'App\Http\Controllers\WarehouseController');
Route::resource('usuario'               ,'App\Http\Controllers\UserController');
Route::resource('empresa'               ,'App\Http\Controllers\CompanyController');
Route::resource('funcionario'           ,'App\Http\Controllers\EmployeeController');
Route::resource('produtos'              ,'App\Http\Controllers\ProductController');
Route::resource('entrada-de-mercadorias','App\Http\Controllers\GoodsReceiptController')->except('show');
