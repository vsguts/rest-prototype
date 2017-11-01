<?php

namespace App\Base;

use App\Controllers\ControllerInterface;
use App\Exceptions\BadRequestException;
use App\Exceptions\BaseException;
use App\Http\Request;
use App\Http\Response;

class Application
{
    /**
     * Need for access from outside
     * @var self
     */
    public static $app;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var array Application config
     */
    private $config;

    public function __construct(Request $request, array $config)
    {
        $this->request = $request;
        $this->config = $config;

        if (!isset(self::$app)) {
            self::$app = $this; // Set first application instance into self::$app
        }
    }

    /**
     * @param Router $router
     * @return Response
     */
    final public function handleRequest(Router $router) : Response
    {
        try {
            $params = $router->resolve($this->request);
            $controller = $this->prepareController($params['controller']);
            $action = $this->prepareAction($params['action']);
            $args = $this->prepareArgs($controller, $action, $params['params'], $this->request->getQueryParams());
            $result = $this->runControllerAction($controller, $action, $args);

        } catch (BaseException $e) {
            $response = new Response;
            pd($e);

            return $response;
        }
        pd('TODO', $this->request, $router);
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param $controllerName
     * @return ControllerInterface
     * @throws BadRequestException
     */
    protected function prepareController($controllerName)
    {
        if (class_exists($controllerName) && is_a($controllerName, ControllerInterface::class, true)) {
            return new $controllerName($this);
        }
        throw new BadRequestException('Controller not found');
    }

    protected function prepareAction($action)
    {
        return $action . 'Action';
    }

    /**
     * @param ControllerInterface $controller
     * @param string              $action
     * @param array               $routeParams Route params (from path)
     * @param array               $queryParams Query params (from $_GET)
     * @return array
     * @throws BadRequestException
     */
    protected function prepareArgs(ControllerInterface $controller, $action, $routeParams, $queryParams)
    {
        $refMethod = new \ReflectionMethod($controller, $action);

        // Prepare args
        $args = [];
        foreach ($refMethod->getParameters() as $param) {
            $name = $param->getName();
            if (isset($routeParams[$name])) {
                $args[] = $routeParams[$name];
            } elseif (isset($queryParams[$name])) {
                $args[] = $queryParams[$name];
            } elseif ($param->isDefaultValueAvailable()) {
                $args[] = $param->getDefaultValue();
            } else {
                throw new BadRequestException('Invalid params: missed $' . $name . ' in the ' . get_class($controller) . '::' . $action);
            }
        }

        return $args;
    }

    private function runControllerAction(ControllerInterface $controller, $action, $args)
    {
        $controller->beforeAction();
        $result = call_user_func_array([$controller, $action], $args);
        $controller->afterAction();
        return $result;
    }

}
