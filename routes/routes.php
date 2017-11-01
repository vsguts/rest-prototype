<?php

use App\Base\Router;
use App\Controllers\UserController;

$router = new Router;

$router->add('get', 'user/<id>', UserController::class, 'update');

return $router;
