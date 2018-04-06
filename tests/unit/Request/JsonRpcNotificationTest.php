<?php

declare(strict_types=1);

namespace DawidMazurek\JsonRpcClient\Request;

use PHPUnit\Framework\TestCase;

class JsonRpcNotificationTest extends TestCase
{
    /**
     * @test
     */
    public function deliversConstructParamsToGetters()
    {
        $methodName = 'nameOfMethod';
        $params = ['param' => 'value'];

        $notification = new JsonRpcNotification($methodName, $params);
        $this->assertEquals($methodName, $notification->getMethodName());
        $this->assertEquals($params, $notification->getParams());
    }
}
