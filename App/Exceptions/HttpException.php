<?php

namespace App\Exceptions;

class HttpException extends BaseException
{
    public function getReponseCode()
    {
        return 500;
    }
}
