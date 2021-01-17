<?php

namespace App\Tests;

use App\Controllers\TaskController;

final class TaskTest extends TestCase
{
    private $controller;

    public function __construct()
    {
        parent::__construct();
        $this->controller = new TaskController();
    }

    public function testFetchTask()
    {
        $taskController = new TaskController();
        $result = $taskController->index();
        $this->assertNotEmpty($result['data'], 'Empty task');
    }

    public function testDeleteTask()
    {
        $task = $this->controller->getTaskById(1);
        if ($task['id']) {
            $result = $this->controller->delete($task['id']);
            $this->assertTrue($result, 'Delete task');
        } else {
            $this->assertTrue(false);
        }
    }
}