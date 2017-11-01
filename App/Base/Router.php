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
        $method = strtoupper($method);
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
        $method = $request->getMethod();
        if (!empty($this->routes[$method])) {
            $pathParts = explode('/', $request->getPath());
            foreach ($this->routes[$method] as $routePath => $routeData) {
                $routeParts = explode('/', $routePath);

                if (count($routeParts) != count($pathParts)) {
                    continue;
                }

                $routeData['params'] = [];

                foreach ($routeParts as $routePartIndex => $routePart) {
                    if (preg_match('/{([a-z]+)}/Sui', $routePart, $matches)) { // Variable
                        $paramName = $matches[1];
                        $routeData['params'][$paramName] = $pathParts[$routePartIndex];
                    } elseif ($routePart != $pathParts[$routePartIndex]) { // Constant
                        continue(2); // Next route
                    }
                }

                return $routeData;
            }
        }

        throw new BadRequestException('Route not found');
    }

}
