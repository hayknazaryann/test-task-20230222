<?php

use App\Http\Controllers\JsonDataController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('', [JsonDataController::class, 'index'])->name('json.index');
    Route::any('create', [JsonDataController::class, 'create'])->name('json.create');
    Route::any('update', [JsonDataController::class, 'edit'])->name('json.edit');
    Route::delete('delete/{code}', [JsonDataController::class, 'destroy'])->name('json.destroy');

    Route::get('work-plan', [HomeController::class, 'workPlan']);
});