<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionalController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\ReportesController;

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
Route::get('pago/{id}', [PersonController::class, 'consult_pay'])->name('consult_pay');
Route::get('realizarPago/{id}/{forma}/{tarjeta}/{cantidad}', [PersonController::class, 'save_pay'])->name('realizarPago');

Route::get('pay', [PayController::class, 'listar_pago'])->name('listar_pago');
Route::get('clasesMonth', [ReportesController::class, 'consult_month'])->name('clasesMonth');



Route::resource('schedule', App\Http\Controllers\SchedulesController::class)->only(['index','create','store','show','update','destroy']);;

//Routes person
Route::resource('person', App\Http\Controllers\PersonController::class)->only(['index','create','store','show','update','destroy']);;

Route::resource('teacher', App\Http\Controllers\TeacherController::class)->only(['index','create','store','show','update','destroy']);;