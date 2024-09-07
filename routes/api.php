<?php

use App\Http\Controllers\ContactosController;
use App\Http\Controllers\TelefonosController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post('usuarios', [UsuariosController::class, 'create']);
Route::put('usuarios/{id}', [UsuariosController::class, 'updated']);
Route::delete('usuarios/{id}', [UsuariosController::class, 'delete']);
Route::get('usuarios/{id}', [UsuariosController::class, 'edit']);
Route::get('usuarios', [UsuariosController::class, 'list']);

Route::post('contactos', [ContactosController::class, 'create']);
Route::put('contactos/{id}', [ContactosController::class, 'updated']);
Route::delete('contactos/{id}', [ContactosController::class, 'delete']);
Route::get('contactos/{id}', [ContactosController::class, 'edit']);
Route::get('contactos', [ContactosController::class, 'list']);

Route::post('telefonos', [TelefonosController::class, 'create']);
Route::put('telefonos/{id}', [TelefonosController::class, 'updated']);
Route::delete('telefonos/{id}', [TelefonosController::class, 'delete']);
Route::get('telefonos/{id}', [TelefonosController::class, 'edit']);
Route::get('telefonos', [TelefonosController::class, 'list']);
