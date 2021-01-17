<?php

namespace App\Controllers;

use App\App\App;
use App\Models\Task;

class HomeController
{
    public static function index()
    {
        $tasks = App::get('db')->selectAll('tasks', Task::class);

        return view('home.index', compact('tasks'));
    }
}
