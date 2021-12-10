<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\BarCodeController;
use App\Http\Controllers\FuncionalController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('person/ShowDays/{id}', [PersonController::class, 'ShowDays'])->name('ShowDays');
Route::get('person/ShowClasses/{dia_id}/{teacher_id}', [PersonController::class, 'ShowClasses'])->name('ShowClasses');
Route::get('paseLista/{matricula}', [FuncionalController::class, 'paseLista'])->name('paseLista');
Route::get('paseListaT/{matricula}', [FuncionalController::class, 'paseListaTeacher'])->name('paseListaTeacher');
Route::get('verifyDay/{day}', [FuncionalController::class, 'verifyDay'])->name('verifyDay');
Route::get('getFirstHour', [FuncionalController::class, 'getFirstHour'])->name('getFirstHour');
Route::get('ListaClases/{valorHora}', [FuncionalController::class, 'ListaClases'])->name('ListaClases');

//PDF

Route::get('QuincenalPersons', [PdfController::class, 'ReporterQuincenal'])->name('Quincenal');
Route::get('ReporteFechas/{forma_pago}/{fecha_inicial}/{fecha_final}', [PdfController::class, 'ReporteFechas'])->name('ReporteFechas');
// Route::get('ReporteFechas/{tipo}/{fechaInicio}/{fechaFinal}', [PdfController::class, 'prueba'])->name('prueba');


//Barcode
Route::get('credencial/{id}', [BarcodeController::class, 'index'])->name('credencial');
Route::get('credencialT/{id}', [BarcodeController::class, 'credencialT'])->name('credencialT');



Route::get('{any}', function () {
    return view('app');
})->where('any', '.*');




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');