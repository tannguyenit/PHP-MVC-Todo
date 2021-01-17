<?php

$router->get('', 'HomeController@index');
$router->get('tasks', 'TaskController@index');
$router->post('tasks', 'TaskController@store');
$router->post('tasks/{id}', 'TaskController@update');
$router->delete('tasks/{id}', 'TaskController@delete');
