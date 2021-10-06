<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('schedule', App\Http\Controllers\SchedulesController::class)->only(['index','store','show','update','destroy']);;
Route::resource('person', App\Http\Controllers\PersonController::class)->only(['index','store','show','update','destroy']);;
Route::resource('teacher', App\Http\Controllers\TeacherController::class)->only(['index','create','store','show','update','destroy']);;