<?php

namespace App\Controllers;

class SiteController extends AbstractController
{

    public function indexAction()
    {
        return [
            'message' => 'Hello!',
        ];
    }

}
