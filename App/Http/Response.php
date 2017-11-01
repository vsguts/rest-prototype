<?php

namespace App\Http;

use App\Components\Serializer\PlainText;
use App\Components\Serializer\SerializerInterface;

class Response
{
    protected $content;

    protected $statusCode;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct($content, $statusCode = 200)
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
    }

    /**
     * @param SerializerInterface $serializer
     */
    public function setSerializer(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @return SerializerInterface
     */
    public function getSerializer(): SerializerInterface
    {
        if (!$this->serializer) {
            $this->serializer = new PlainText; // We need any serializer to show error
        }
        return $this->serializer;
    }

    public function send()
    {
        if ($this->statusCode) {
            http_response_code($this->statusCode);
        }

        $serializer = $this->getSerializer();

        if ($contentType = $serializer->getContentType()) {
            header('Content-Type: ' . $contentType);
        }

        echo $serializer->encode($this->content);
    }
}
