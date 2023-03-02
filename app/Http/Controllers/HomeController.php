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

    public function workflow()
    {
        $tasks = [
            [
                'task' => 'Setting up of the environment',
                'estimate' => '30 minutes',
                'logged' => '20 minutes',
                'comments' => 'Install Xampp with PHP 8'
            ],
            [
                'task' => 'Install Laravel Framework',
                'estimate' => '20 minutes',
                'logged' => '15 minutes',
                'comments' => ''
            ],
            [
                'task' => 'Generate users with seeders',
                'estimate' => '15 minutes',
                'logged' => '15 minutes',
                'comments' => ''
            ],
            [
                'task' => 'Create command for the token generation',
                'estimate' => '3 hours',
                'logged' => '3 hours',
                'comments' => ''
            ],
            [
                'task' => 'Login',
                'estimate' => '40 minutes',
                'logged' => '40 minutes',
                'comments' => ''
            ],
            [
                'task' => 'CRUD',
                'estimate' => '3 hours',
                'logged' => '3 hours 40 minutes',
                'comments' => 'Home page, create and update forms'
            ],
            [
                'task' => 'CRUD',
                'estimate' => '10 hours',
                'logged' => '11 hours',
                'comments' => 'Create, Update, Read, All data, Delete'
            ],
            [
                'task' => 'Unit tests',
                'estimate' => '2 hours',
                'logged' => '4 hours',
                'comments' => 'I am writing Unit tests for the first time'
            ],
            [
                'task' => 'Rate limit',
                'estimate' => '1 hour',
                'logged' => '1 hour',
                'comments' => ''
            ],
            [
                'task' => 'Logs',
                'estimate' => '2 hours',
                'logged' => '2 hours',
                'comments' => ''
            ],
            [
                'task' => 'Other',
                'estimate' => '',
                'logged' => '2-4 hours',
                'comments' => 'Code refactoring'
            ]
        ];
        return view('work-plan', compact('tasks'));
    }
}
