<?php

namespace App\Controllers;

interface ControllerInterface
{
    public function beforeAction();

    public function afterAction();

}
