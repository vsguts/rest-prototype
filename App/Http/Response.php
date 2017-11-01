<?php

namespace App\Http;

class Response
{
    public $contentType = 'application/json';

    protected $statusCode;

    public function __construct($statusCode = 200)
    {
        $this->statusCode = $statusCode;
    }

    public function send()
    {
        if ($this->statusCode) {
            // header()
        }
    }
}
