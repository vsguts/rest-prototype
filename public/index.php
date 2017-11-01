<?php

use App\Components\Application;
use App\Components\Request;

require __DIR__ . '/../bootstrap/bootstrap.php';

$application = new Application(new Request());
$response = $application->handleRequest();
$response->send();
