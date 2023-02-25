<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function workPlan()
    {
        $tasks = [
            [
                'task' => 'Настройка окружения',
                'estimate' => '30 минут',
                'logged' => '20 минут',
                'comments' => 'Установка Xampp с PHP 8'
            ],
            [
                'task' => 'Установка фреймворка',
                'estimate' => '20 минут',
                'logged' => '15 минут',
                'comments' => ''
            ],
            [
                'task' => 'Создание пользователей через сидер',
                'estimate' => '15 минут',
                'logged' => '15 минут',
                'comments' => ''
            ],
            [
                'task' => 'Создание комманды для генерации токена',
                'estimate' => '3 часа',
                'logged' => '3 часа',
                'comments' => ''
            ],
            [
                'task' => 'Логин',
                'estimate' => '40 минут',
                'logged' => '40 минут',
                'comments' => ''
            ],
            [
                'task' => 'CRUD',
                'estimate' => '3 часа',
                'logged' => '3 часа',
                'comments' => 'Основная страница, форма для создания и обновления'
            ]
        ];
        return view('work-plan', compact('tasks'));
    }
}
