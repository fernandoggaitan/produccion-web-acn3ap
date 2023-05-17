<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaController;

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

Route::get('test', function() {
    
    /*
    Categoria::create([
        'nombre' => 'Consolas',
        'descripcion' => 'Consolas como Nintendo, Xbox y Playstation'
    ]);

    Categoria::create([
        'nombre' => 'Celulares',
        'descripcion' => 'Con sistema operativo Android y iPhone'
    ]);

    Categoria::create([
        'nombre' => 'Televisores',
        'descripcion' => 'Smart TV'
    ]);    

    return 'Se crearon tres categorías';
    */

});

Route::get('categorias', [
    CategoriaController::class, 'index'
])->name('categorias.index');

Route::get('categorias/{categoria}', [
    CategoriaController::class, 'show'
])->name('categorias.show');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
