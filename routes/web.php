<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\RequisitoController;
use App\Http\Controllers\CasoController;
use App\Http\Controllers\ListaRequisitoController;


Route::resource('casos', CasoController::class);
Route::resource('tareas', TareaController::class);
Route::resource('listas_requisitos', ListaRequisitoController::class);


Route::get('requisitos/search', [RequisitoController::class, 'search'])->name('requisitos.search');
Route::get('requisitos/create/{lista_requisito?}', [RequisitoController::class, 'create'])->name('requisitos.create');
Route::resource('requisitos', RequisitoController::class)->except(['create']);






/* Route::prefix('casos/{lista_tarea}')->group(function () {
    Route::resource('tareas', TareaController::class);
}); */

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
