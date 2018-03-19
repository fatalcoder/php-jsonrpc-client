<?php

declare(strict_types=1);

namespace DawidMazurek\JsonRpcClient\Client;

class JsonRpcClientConfiguration
{
    private $uri;

    public function __construct(array $config)
    {
        $this->uri = $config['uri'];
    }

    public function getUri()
    {
        return $this->uri;
    }
}
