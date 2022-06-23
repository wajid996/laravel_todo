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

Route::post('/save_task', [App\Http\Controllers\TaskController::class, 'store']);

Route::get('/list', [App\Http\Controllers\TaskController::class, 'list']);

Route::get('/edit/{id}', [App\Http\Controllers\TaskController::class, 'edit']);

Route::post('/update/{id}', [App\Http\Controllers\TaskController::class, 'update']);

Route::get('/delete/{id}', [App\Http\Controllers\TaskController::class, 'delete']);
