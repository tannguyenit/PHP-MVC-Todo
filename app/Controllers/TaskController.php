<?php

namespace App\Controllers;

use App\App\App;
use App\Models\Task;

class TaskController
{
    public static function index()
    {
        $tasks = App::get('db')->selectAll('tasks', Task::class);

        return json_response(200, ['status' => true, 'message' => 'FETCH_SUCCESS', 'data' => $tasks ]);
    }

    public static function store()
    {
        $data = [
            'name' => $_POST['name'],
            'start_date' => $_POST['start_date'] ? $_POST['start_date'] : null,
            'end_date' => $_POST['end_date'] ? $_POST['end_date'] : null,
            'status' => $_POST['status'] ? $_POST['status'] : 'PLANNING',
        ];

        try {
            App::get('db')->insert('tasks', $data);
        } catch (Exception $e) {
            return json_response(500, ['status' => false, 'message' => 'STORE_FAILED' ]);
        }

        return json_response(200, ['status' => true, 'message' => 'STORE_SUCCESS' ]);

    }

    public static function update(int $id)
    {  
        try {
            $task = App::get('db')->findById('tasks', $id, Task::class);

            if ($task) {
                $data = [];

                $_POST['name'] && $data['name'] = $_POST['name'];
                $_POST['start_date'] && $data['start_date'] = $_POST['start_date'];
                $_POST['end_date'] && $data['end_date'] = $_POST['end_date'];
                $_POST['status'] && $data['status'] = $_POST['status'];

                App::get('db')->update('tasks', $id, $data);
            }
        } catch (Exception $e) {
            return json_response(500, ['status' => false, 'message' => 'UPDATE_FAILED' ]);

        }

        return json_response(200, ['status' => true, 'message' => 'UPDATE_SUCCESS' ]);

    }

    public static function delete(int $id)
    {  
        try {
            $task = App::get('db')->delete('tasks', $id);
        } catch (Exception $e) {
            return json_response(500, ['status' => false, 'message' => 'DELETE_FAILED' ]);
        }

        return json_response(200, ['status' => true, 'message' => 'DELETE_SUCCESS' ]);
    }

    public function getTaskById(int $id) {
        return App::get('db')->findById('tasks', $id, Task::class);
    }
}
