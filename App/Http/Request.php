<?php

namespace App\Http;

use App\Components\Serializer\Json;
use App\Components\Serializer\PlainText;
use App\Components\Serializer\SerializerInterface;
use App\Exceptions\BadRequestException;

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
            list($uri) = explode('?', $_SERVER['REQUEST_URI'], 2);
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

    public function getAuth()
    {
        if (isset($_SERVER['PHP_AUTH_USER']) || isset($_SERVER['PHP_AUTH_PW'])) {
            return [
                'login' => $_SERVER['PHP_AUTH_USER'] ?? '',
                'password' => $_SERVER['PHP_AUTH_PW'] ?? ''
            ];
        }
    }

    public function getResponseSerializer() : SerializerInterface
    {
        $headers = $this->getHeaders();
        if (!empty($headers['Accept'])) {

            $accept = explode(',', $headers['Accept']);
            foreach ($accept as &$aceptItem) {
                list($aceptItem) = explode(';', $aceptItem);
            }

            if (array_intersect($accept, ['application/json', '*/*'])) {
                return new Json;
            } elseif (array_intersect($accept, ['text/plain'])) {
                return new PlainText;
            } else {
                throw new BadRequestException('Accept not supported yet: ' . $headers['Accept']);
            }
        }
        return new Json;
    }

}
