<?php

namespace App\Components\Serializer;

interface SerializerInterface
{
    public function encode($decoded);

    public function decode($encoded);

    public function getContentType();
}
