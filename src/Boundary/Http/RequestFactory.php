<?php

declare(strict_types=1);

namespace DawidMazurek\JsonRpcClient\Boundary\Http;

use DawidMazurek\JsonRpcClient\Client\JsonRpcRequest;
use GuzzleHttp\Psr7\Request;

class RequestFactory
{
    const HTTP_METHOD_POST = 'POST';
    const HTTP_METHOD_GET= 'GET';
    /**
     * @var JsonRpcCLientConfiguration
     */
    private $config;

    public function __construct(JsonRpcCLientConfiguration $config)
    {
        $this->config = $config;
    }

    public function createPostRequest(array $requestPayload): Request
    {
        $body = json_encode($requestPayload);
        return new Request(self::HTTP_METHOD_POST, $this->config->getUri(), [], $body);
    }

    public function createGetRequest(JsonRpcRequest $jsonRpcRequest): Request
    {

    }
}
