<?php

declare(strict_types=1);

namespace DawidMazurek\JsonRpcClient\Response;

class JsonRpcRequestResponse implements JsonRpcResponse
{
    private $id;
    private $result;

    public function __construct(array $response)
    {
        $this->id = $response['id'];
        $this->result = $response['result'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getResult()
    {
        return $this->result;
    }
}
