<?php

namespace App\Exceptions;

class UnauthorizedException extends HttpException
{
    public function getReponseCode()
    {
        header('WWW-Authenticate: Basic realm="User email/API key"'); // FIXME )
        return 401;
    }
}
