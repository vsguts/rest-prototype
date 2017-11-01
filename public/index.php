<?php


use App\Base\Application;
use App\Http\Request;

require __DIR__ . '/../bootstrap/bootstrap.php';

$config = require __DIR__ . '/../config/config.php';
$application = new Application(new Request(), $config);

$router = require __DIR__ . '/../routes/routes.php';
$response = $application->handleRequest($router);

$response->send();
