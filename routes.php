<?php

// $router->get('', 'PageController@index');
// $router->get('about', 'PageController@about');
// $router->get('contact', 'PageController@contact');

$router->get('', 'TaskController@index');
$router->get('tasks', 'TaskController@index');
$router->get('tasks/new', 'TaskController@showCreateForm');
$router->get('tasks/edit', 'TaskController@showUpdateForm');
$router->post('tasks/edit', 'TaskController@update');
$router->get('tasks/complete', 'TaskController@completeTask');
$router->post('tasks', 'TaskController@store');

$router->get('auth', 'AuthController@index');
$router->get('auth/logout', 'AuthController@logout');
$router->post('auth', 'AuthController@login');


