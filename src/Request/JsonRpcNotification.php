<?php

declare(strict_types=1);

namespace DawidMazurek\JsonRpcClient\Request;

class JsonRpcNotification implements JsonRpcRequestInterface
{
    /**
     * @var string
     */
    private $methodName;
    /**
     * @var array
     */
    private $params;

    public function __construct(string $methodName, array $params)
    {
        $this->methodName = $methodName;
        $this->params = $params;
    }

    public function getMethodName(): string
    {
        return $this->methodName;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}
