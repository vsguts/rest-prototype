<?php

require __DIR__ . '/functions.php';

spl_autoload_register(function($class) {
    $path = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        include $path;
    }
});