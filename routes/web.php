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

Auth::routes(['register' => false, 'reset' => false]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('', [JsonDataController::class, 'index'])->name('json.index');
    Route::match(['GET', 'POST'],'json/create', [JsonDataController::class, 'create'])->name('json.create');
    Route::match(['GET', 'POST'],'json/update', [JsonDataController::class, 'update'])->name('json.update');
    Route::get('json/show/{code}', [JsonDataController::class, 'show'])->name('json.show');
    Route::delete('json/delete/{code}', [JsonDataController::class, 'destroy'])->name('json.destroy');
    Route::get('logs', [JsonDataController::class, 'logs'])->name('json.logs');

    Route::get('profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('work-plan', [HomeController::class, 'workPlan']);
});