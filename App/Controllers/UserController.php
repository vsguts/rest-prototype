<?php

namespace App\Controllers;

use App\Controllers\Traits\AuthTrait;
use App\Exceptions\NotFoundException;
use App\Http\Response;
use App\Models\User;

class UserController extends AbstractController
{
    use AuthTrait;

    public function beforeAction()
    {
        $this->checkAuth();
    }

    public function indexAction($return_params = false)
    {
        $data = User::findMany();

        if ($return_params) { // Url: /users?return_params=1&a=b
            return [
                'data' => $data,
                'params' => $this->application->getRequest()->getQueryParams(),
            ];
        }

        return $data;
    }

    public function viewAction($id)
    {
        if ($model = User::findOne($id)) {
            return $model;
        }
        throw new NotFoundException('Model not found');
    }

    public function deleteAction($id)
    {
        return new Response(null, 204);
    }

}
