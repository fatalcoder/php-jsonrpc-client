<?php

declare(strict_types=1);

namespace DawidMazurek\JsonRpcClient\Request;

use DawidMazurek\JsonRpcClient\Exception\NoRequestWithGivenId;
use DawidMazurek\JsonRpcClient\Exception\RequestWithoutId;
use PHPUnit\Framework\TestCase;

class JsonRpcRequestCollectionTest extends TestCase
{
    /**
     * @test
     */
    public function transfersRequest()
    {
        $requestCollection = new JsonRpcRequestCollection();
        $request = $this->createMock(JsonRpcRequestInterface::class);
        $requestCollection->addRequest($request);
        $this->assertCount(1, $requestCollection->getAllRequests());
    }

    /**
     * @test
     */
    public function notificationWillNotHaveId()
    {
        $requestCollection = new JsonRpcRequestCollection();
        $notification = $this->createMock(JsonRpcNotification::class);
        $requestCollection->addRequest($notification);
        $this->assertFalse($requestCollection->requestHasId($notification));
    }

    /**
     * @test
     */
    public function requestWillHaveId()
    {
        $requestCollection = new JsonRpcRequestCollection();
        $request = $this->createMock(JsonRpcRequest::class);
        $requestCollection->addRequest($request);
        $this->assertTrue($requestCollection->requestHasId($request));
    }

    /**
     * @test
     */
    public function multipleRequestsWillHaveIncrementedIdAssigned()
    {
        $requestCollection = new JsonRpcRequestCollection();
        $request = $this->createMock(JsonRpcRequest::class);
        $request2 = $this->createMock(JsonRpcRequest::class);
        $requestCollection->addRequest($request);
        $requestCollection->addRequest($request2);
        $this->assertEquals(1, $requestCollection->getRequestId($request));
        $this->assertEquals(2, $requestCollection->getRequestId($request2));
    }

    /**
     * @test
     */
    public function saveRequestMultiplyAddedWillExistOnce()
    {
        $requestCollection = new JsonRpcRequestCollection();
        $request = $this->createMock(JsonRpcRequest::class);
        $requestCollection->addRequest($request);
        $requestCollection->addRequest($request);
        $this->assertCount(1, $requestCollection->getAllRequests());
        $this->assertEquals(1, $requestCollection->getRequestId($request));
    }

    /**
     * @test
     */
    public function gettingByIdWillReturnSameRequest()
    {
        $requestCollection = new JsonRpcRequestCollection();
        $request = $this->createMock(JsonRpcRequest::class);
        $requestCollection->addRequest($request);
        $requestId = $requestCollection->getRequestId($request);
        $this->assertSame($request, $requestCollection->getByRequestId($requestId));
    }

    /**
     * @test
     */
    public function gettingNotificationIdWillThrowException()
    {
        $this->expectException(RequestWithoutId::class);

        $requestCollection = new JsonRpcRequestCollection();
        $notification = $this->createMock(JsonRpcNotification::class);
        $requestCollection->addRequest($notification);
        $requestCollection->getRequestId($notification);
    }

    /**
     * @test
     */
    public function gettingSecondRequest()
    {
        $requestCollection = new JsonRpcRequestCollection();
        $request = $this->createMock(JsonRpcRequest::class);
        $request2 = $this->createMock(JsonRpcRequest::class);
        $requestCollection->addRequest($request);
        $requestCollection->addRequest($request2);
        $requestId = $requestCollection->getRequestId($request2);
        $this->assertSame($request2, $requestCollection->getByRequestId($requestId));
    }

    /**
     * @test
     */
    public function throwsExceptionWhenGettingNoExisingRequest()
    {
        $this->expectException(NoRequestWithGivenId::class);

        $requestCollection = new JsonRpcRequestCollection();
        $requestCollection->getByRequestId(1);
    }
}
