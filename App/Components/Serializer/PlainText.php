<?php

namespace App\Components\Serializer;

class PlainText implements SerializerInterface
{
    public function encode($decoded)
    {
        return print_r($decoded, true);
    }

    public function decode($encoded)
    {
        return $encoded;
    }

    public function getContentType()
    {
        return 'text/plain';
    }
}
