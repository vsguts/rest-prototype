<?php

namespace App\Exceptions;

class BaseException extends \Exception
{
    public function getReponseCode()
    {
        return 500;
    }
}
