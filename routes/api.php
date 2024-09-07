<?php

use App\Http\Controllers\ContactosController;
use App\Http\Controllers\CorreosController;
use App\Http\Controllers\DireccionesController;
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

Route::post('correos', [CorreosController::class, 'create']);
Route::put('correos/{id}', [CorreosController::class, 'updated']);
Route::delete('correos/{id}', [CorreosController::class, 'delete']);
Route::get('correos/{id}', [CorreosController::class, 'edit']);
Route::get('correos', [CorreosController::class, 'list']);

Route::post('direcciones', [DireccionesController::class, 'create']);
Route::put('direcciones/{id}', [DireccionesController::class, 'updated']);
Route::delete('direcciones/{id}', [DireccionesController::class, 'delete']);
Route::get('direcciones/{id}', [DireccionesController::class, 'edit']);
Route::get('direcciones', [DireccionesController::class, 'list']);
Route::get('direcciones/pais/{pais}', [DireccionesController::class, 'getPais']);
