<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionalController;

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
Route::get('listado', [FuncionalController::class, 'listado_clases'])->name('listado_clases');
Route::get('listado_teacher/{id}', [FuncionalController::class, 'listado_teacher'])->name('listado_teacher');


Route::resource('schedule', App\Http\Controllers\SchedulesController::class)->only(['index','create','store','show','update','destroy']);;

//Routes person
Route::resource('person', App\Http\Controllers\PersonController::class)->only(['index','create','store','show','update','destroy']);;

Route::resource('teacher', App\Http\Controllers\TeacherController::class)->only(['index','create','store','show','update','destroy']);;