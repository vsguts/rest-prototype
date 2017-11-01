<?php

namespace App\Components;

class Request
{
    private $path;

    private $headers;

    private $rawBody;

    /**
     * Returns HTTP method
     * @return string Uppercase method
     */
    public function getMethod()
    {
        if (isset($_SERVER['REQUEST_METHOD'])) {
            return strtoupper($_SERVER['REQUEST_METHOD']);
        }
        return 'GET';
    }

    /**
     * Return requested path
     * @return string
     */
    public function getPath()
    {
        if (is_null($this->path)) {
            $scriptDir = dirname($_SERVER['SCRIPT_NAME']);
            $uri = $_SERVER['REQUEST_URI'];
            if (strpos($uri, $scriptDir) === 0) {
                $uri = substr($uri, strlen($scriptDir));
            }
            $this->path = ltrim($uri, '/');
        }
        return $this->path;
    }

    /**
     * Returns GET params
     * @return array
     */
    public function getQueryParams()
    {
        return $_GET;
    }

    /**
     * Returns the request headers
     * @return array
     */
    public function getHeaders()
    {
        if (is_null($this->headers)) {
            $this->headers = [];
            foreach ($_SERVER as $name => $value) {
                if (strpos($name, 'HTTP_') === 0) {
                    $name = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))));
                    $this->headers[$name] = $value;
                }
            }
        }
        return $this->headers;
    }

    /**
     * Returns the raw HTTP request body.
     * @return string
     */
    public function getRawBody()
    {
        if (is_null($this->rawBody)) {
            $this->rawBody = file_get_contents('php://input');
        }
        return $this->rawBody;
    }

}
