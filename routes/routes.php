<?php

use App\Base\Router;
use App\Controllers\UserController;

$router = new Router;

$router->add('get', 'users', UserController::class, 'index');
$router->add('get', 'user/{id}', UserController::class, 'view');
$router->add('post', 'user/{id}', UserController::class, 'view');

return $router;
