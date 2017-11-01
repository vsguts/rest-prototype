<?php

use App\Base\Router;
use App\Controllers\SiteController;
use App\Controllers\UserController;

$router = new Router;

$router->add('get', '', SiteController::class, 'index');

$router->add('get', 'users', UserController::class, 'index');
$router->add('get', 'users/{id}', UserController::class, 'view');
$router->add('post', 'users', UserController::class, 'create');
$router->add('put', 'users/{id}', UserController::class, 'update');
$router->add('delete', 'users/{id}', UserController::class, 'delete');

return $router;
