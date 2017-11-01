<?php

namespace App\Components\Serializer;

class Json implements SerializerInterface
{
    public function encode($decoded)
    {
        return json_encode($decoded);
    }

    public function decode($encoded)
    {
        return json_decode($encoded, true);
    }

    public function getContentType()
    {
        return 'application/json';
    }
}
