<?php

namespace App\Base;

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
    public function handleRequest(Router $router) : Response
    {
        try {
            $params = $router->resolve($this->request);
            pd($params);
        } catch (BaseException $e) {
            $response = new Response;

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

}
