<?php

declare(strict_types=1);

namespace DawidMazurek\JsonRpcClient\Response;

class JsonRpcRequestError implements JsonRpcResponse
{
    private $id = '';
    private $errorCode = 0;
    private $errorMessage = '';

    public function __construct(array $response)
    {
        $this->id = (string)$response['id'];
        $this->errorCode = $response['error']['code'];
        $this->errorMessage = $response['error']['message'];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}
