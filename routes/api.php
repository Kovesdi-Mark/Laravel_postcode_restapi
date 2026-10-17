<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CountyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post('/users/login', [UserController::class, 'login']);
Route::get('/users', [UserController::class, 'index']);

Route::get('/counties', [CountyController::class, 'index']);
Route::post('/counties', [CountyController::class, 'store'])
    ->middleware('auth:sanctum');
Route::get('/counties/{id}', [CountyController::class, 'show']);
Route::put('/counties/{id}', [CountyController::class, 'update'])
    ->middleware('auth:sanctum');
Route::delete('/counties/{id}', [CountyController::class, 'destroy'])
    ->middleware('auth:sanctum');

Route::get('/cities', [CityController::class, 'index']);
Route::get('/counties/{countyId}/cities', [CityController::class, 'indexByCounty']);
Route::post('/cities', [CityController::class, 'store'])
    ->middleware('auth:sanctum');
Route::get('/cities/{id}', [CityController::class, 'show']);
Route::put('/cities/{id}', [CityController::class, 'update'])
    ->middleware('auth:sanctum');
Route::delete('/cities/{id}', [CityController::class, 'destroy'])
    ->middleware('auth:sanctum');
