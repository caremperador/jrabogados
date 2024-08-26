<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\RequisitoController;
use App\Http\Controllers\CasoController;
use App\Http\Controllers\ListaRequisitoController;



Route::middleware(['role:admin|asistente'])->group(function () {
    Route::resource('casos', CasoController::class)->except(['show,index']);
    Route::resource('tareas', TareaController::class);
    Route::resource('requisitos', RequisitoController::class)->except(['show']);
    Route::resource('listas_requisitos', ListaRequisitoController::class)->except(['show']);
});
 // Ruta abierta para cualquier usuario no registrado
Route::get('casos/{caso}', [CasoController::class, 'show'])->name('casos.show');
Route::put('/tareas/{tarea}/estado', [TareaController::class, 'updateEstado'])->name('tareas.updateEstado');
Route::put('/requisitos/{requisito}/update-estado', [RequisitoController::class, 'updateEstado'])->name('requisitos.updateEstado');


// Ruta abierta para cualquier usuario registrado
Route::middleware(['auth'])->group(function () {
    Route::get('casos', [CasoController::class, 'index'])->name('casos.index');
    Route::get('requisitos/{requisito}', [RequisitoController::class, 'show'])->name('requisitos.show');
    Route::get('listas_requisitos/{listas_requisito}', [ListaRequisitoController::class, 'show'])->name('listas_requisitos.show');
});

Route::get('requisitos/create/{lista_requisito?}', [RequisitoController::class, 'create'])->name('requisitos.create');
Route::get('requisitos/search', [RequisitoController::class, 'search'])->name('requisitos.search');



Route::get('/', function () {
    return view('home');
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
