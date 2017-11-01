<?php

namespace App\Controllers\Traits;

use App\Exceptions\UnauthorizedException;

trait AuthTrait
{
    protected function checkAuth()
    {
        $auth = $this->application->getRequest()->getAuth();
        if ($auth) {
            $config = $this->application->getConfig();
            if (
                $auth['login'] == $config['auth']['login']
                && $auth['password'] == $config['auth']['password']
            ) {
                return true;
            }
        }
        throw new UnauthorizedException('You are not authorized');
    }

}
