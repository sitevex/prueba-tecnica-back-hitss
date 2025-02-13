<?php

use App\Http\Controllers\Api\CargoController;
use App\Http\Controllers\Api\DepartamentoController;
use App\Http\Controllers\Api\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

# Departments
Route::get('/departments', [DepartamentoController::class, 'departmentsList'])->name('api.hitss.departments');
# Cargos
Route::get('/cargos', [CargoController::class, 'cargosList'])->name('api.hitss.cargos');
# Users
Route::get('/user-lists', [UsuarioController::class, 'userList'])->name('api.hitss.users');
Route::put('/user/update', [UsuarioController::class, 'updateUsuario'])->name('api.hitss.user');
Route::post('/user/store', [UsuarioController::class, 'storeUsuario'])->name('api.hitss.user');
Route::delete('/user/delete', [UsuarioController::class, 'deleteUsuario'])->name('api.hitss.user.delete');


