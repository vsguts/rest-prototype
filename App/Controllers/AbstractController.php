<?php

namespace App\Controllers;

use App\Base\Application;

abstract class AbstractController implements ControllerInterface
{
    /**
     * @var Application
     */
    public $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function beforeAction()
    {
    }

    public function afterAction()
    {
    }

}
