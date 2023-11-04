<?php

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

Route::get('/projects', [\App\Http\Controllers\ProjectsController::class, 'index'])->middleware('cacheResponse:300');;
Route::get('/project/{id}', [\App\Http\Controllers\ProjectsController::class, 'info'])->middleware('cacheResponse:300');;
