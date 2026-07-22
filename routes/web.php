<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmpleadoController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/usuarios', [UserController::class, 'index']);

//nueva ruta para mostrar los empleados
// Esta única línea genera las 7 rutas necesarias para tu CRUD automáticamente
Route::resource('empleados', EmpleadoController::class);
