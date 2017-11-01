<?php

namespace App\Base;

use App\Exceptions\BadRequestException;
use App\Http\Request;

class Router
{
    /**
     * Routes array:
     * [
     *   'get' => [
     *     'user/<id>' => [
     *       'controller' => 'App\Controller\UserController',
     *       'action' => 'updateAction',
     *     ]
     *   ]
     * ]
     * @var array
     */
    private $routes = [];

    /**
     * @param string $method Http method: GET, POST, etc.
     * @param string $path Url path: "post/{\d:id}"
     * @param string $controller Controller name
     * @param string $action Action name
     */
    public function add($method, $path, $controller, $action)
    {
        $this->routes[$method][$path] = [
            'controller' => $controller,
            'action' => $action,
        ];
    }

    public function clear()
    {
        $this->routes = [];
    }

    /**
     * @param Request $request
     * @return array
     * @throws BadRequestException
     */
    public function resolve(Request $request)
    {
        if (!empty($this->routes[$request->getMethod()])) {
            foreach ($this->routes[$request->getMethod()] as $path => $data) {

            }
        }
        throw new BadRequestException('Route not found');
    }

}
