<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('password', [AuthController::class, 'showPasswordRequestForm'])->name('password');
Route::post('password', [AuthController::class, 'passwordRequest'])->name('passwordRequest');

Route::get('entradas/pdf', [PDFController::class, 'generarPDF'])->name('entradas.pdf');
Route::get('entradas/listar', [EntradaController::class, 'listar'])->name('entradas.listar');
Route::get('entradas/mostrar/{id}', [EntradaController::class, 'mostrar']);
Route::get('entradas/crear', [EntradaController::class, 'crear']);
Route::post('entradas/guardar', [EntradaController::class, 'guardar'])->name('entradas.guardar');
Route::get('entradas/editar/{id}', [EntradaController::class, 'editar']);
Route::put('entradas/actualizar/{id}', [EntradaController::class, 'actualizar'])->name('entradas.actualizar');
Route::get('entradas/eliminar/{id}', [EntradaController::class, 'eliminar'])->name('entradas.eliminar');
Route::delete('entradas/borrar/{id}', [EntradaController::class, 'borrar'])->name('entradas.borrar');
