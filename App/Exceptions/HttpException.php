<?php

namespace App\Exceptions;

class HttpException extends \Exception
{
    public function getReponseCode()
    {
        return 500;
    }
}
