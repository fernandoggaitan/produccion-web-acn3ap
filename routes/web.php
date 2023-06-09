<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;

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

Route::group(['middleware' => ['auth']], function () {
    
    Route::get('categorias', [
        CategoriaController::class, 'index'
    ])->name('categorias.index');
    
    Route::get('categorias/{categoria}', [
        CategoriaController::class, 'show'
    ])->name('categorias.show');

    Route::group(['middleware' => ['is_admin']], function () {
        Route::resource('productos', ProductoController::class);
    });

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
