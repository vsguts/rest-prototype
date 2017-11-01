<?php

namespace App\Components;

class Application
{
    /**
     * @var Request
     */
    private $router;

    public function __construct(Request $router)
    {
        $this->router = $router;
    }

    /**
     * @return Response
     */
    public function handleRequest() : Response
    {

    }

}
