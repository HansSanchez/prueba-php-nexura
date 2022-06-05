<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function () {

    Route::group(['prefix' => 'areas'], function () {
        Route::get('/getAreas', [\App\Http\Controllers\AreaController::class, 'getAreas']);
    });

    Route::group(['prefix' => 'roles'], function () {
        Route::get('/getRoles', [\App\Http\Controllers\RoleController::class, 'getRoles']);
    });

    Route::group(['prefix' => 'employees'], function () {
        Route::get('/getEmployees', [\App\Http\Controllers\EmployeeController::class, 'getEmployees']);
        Route::post('/store', [\App\Http\Controllers\EmployeeController::class, 'store']);
        Route::post('/{employee}/update', [\App\Http\Controllers\EmployeeController::class, 'update']);
        Route::delete('/{employee}/destroy', [\App\Http\Controllers\EmployeeController::class, 'destroy']);
    });
});


Route::get('/v/{any?}/{any1?}/{any2?}/{any3?}/{any4?}', function ($any = null, $any1 = null, $any2 = null, $any3 = null, $any4 = null) {
    return view('layouts.dashboard');
})->where('vue', '.*')->name('rutas.vue');
