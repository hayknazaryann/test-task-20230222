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
    Route::prefix('json')->name('json.')->group(function () {
        Route::match(['GET', 'POST'],'create', [JsonDataController::class, 'create'])->middleware('throttle:create')->name('create');
        Route::match(['GET', 'POST'],'update', [JsonDataController::class, 'update'])->middleware('throttle:update')->name('update');
        Route::get('show/{code}', [JsonDataController::class, 'show'])->name('show');
        Route::delete('delete/{code}', [JsonDataController::class, 'destroy'])->middleware('throttle:delete')->name('destroy');
        Route::get('logs', [JsonDataController::class, 'logs'])->name('logs');
    });


    Route::get('profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('workflow', [HomeController::class, 'workflow']);
});