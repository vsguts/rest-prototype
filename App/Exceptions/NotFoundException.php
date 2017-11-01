<?php

namespace App\Exceptions;

class NotFoundException extends HttpException
{
    public function getReponseCode()
    {
        return 404;
    }
}
