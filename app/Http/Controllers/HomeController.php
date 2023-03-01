<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function profile()
    {
        $view = view('profile')->render();
        if (\request()->ajax()) {
            return $view;
        }
        return view('json.index', compact('view'));
    }

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
                'logged' => '3 часа 40 минут',
                'comments' => 'Основная страница, форма для создания и обновления'
            ],
            [
                'task' => 'CRUD',
                'estimate' => '10 часа',
                'logged' => '11 часа',
                'comments' => 'Создание, обновление, просмотр, все данные, удаление'
            ],
            [
                'task' => 'Unit тесты',
                'estimate' => '2 часа',
                'logged' => '4 часа',
                'comments' => 'В первый раз пишу'
            ],
        ];
        return view('work-plan', compact('tasks'));
    }
}
