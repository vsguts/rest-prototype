<?php

namespace App\Controllers;

class UserController extends AbstractController
{
    public function indexAction()
    {
        pd('index');
    }

    public function viewAction($id, $qwe, $gvs = '123')
    {
        pd('view', $id);
    }

}
