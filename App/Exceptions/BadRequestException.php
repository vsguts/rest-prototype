<?php

namespace App\Exceptions;

class BadRequestException extends HttpException
{
    public function getReponseCode()
    {
        return 400;
    }
}
