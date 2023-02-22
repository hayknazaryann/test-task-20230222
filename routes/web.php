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

Route::get('work-plan', function () {
    $tasks = [
        [
            'task' => 'Настройка окружения',
            'estimate' => '1 час',
            'logged' => '30 минут',
            'comments' => ''
        ],
        [
            'task' => 'Установка фреймворка',
            'estimate' => '1 час',
            'logged' => '30 минут',
            'comments' => ''
        ]
    ];
    return view('work-plan', compact('tasks'));

});