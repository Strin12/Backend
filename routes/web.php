<?php

use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::post('usuarios', [UsuariosController::class, 'create']);
Route::put('usuarios/{id}', [UsuariosController::class, 'updated']);
Route::delete('usuarios/{id}', [UsuariosController::class, 'delete']);
Route::get('usuarios/{id}', [UsuariosController::class, 'edit']);
Route::get('usuarios', [UsuariosController::class, 'list']);
