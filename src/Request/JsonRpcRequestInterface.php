<?php

declare(strict_types=1);

namespace DawidMazurek\JsonRpcClient\Request;

interface JsonRpcRequestInterface
{
    public function getMethodName();
    public function getParams();
}
