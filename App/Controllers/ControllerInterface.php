<?php

namespace App\Controllers;

use App\Base\Application;

interface ControllerInterface
{
    public function __construct(Application $application);

    public function beforeAction();

    public function afterAction();

}
