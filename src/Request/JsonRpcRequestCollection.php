<?php

declare(strict_types=1);

namespace DawidMazurek\JsonRpcClient\Request;

use DawidMazurek\JsonRpcClient\Exception\RequestWithoutId;

class JsonRpcRequestCollection
{
    /**
     * @var \SplObjectStorage
     */
    private $requests;

    /**
     * @var int
     */
    private $requestId;

    public function __construct()
    {
        $this->requests = new \SplObjectStorage();
        $this->requestId = 0;
    }

    public function addRequest(JsonRpcRequestInterface $request)
    {
        $this->requests->attach($request);
        if ($request instanceof JsonRpcRequest) {
            $this->requests->offsetSet($request, ++$this->requestId);
        }
    }

    /**
     * @return JsonRpcRequestInterface[]
     */
    public function getAllRequests(): array
    {
        $requests = [];
        $this->requests->rewind();

        while ($this->requests->valid()) {
            $requests []= $this->requests->current();
            $this->requests->next();
        }

        return $requests;
    }

    public function requestHasId(JsonRpcRequestInterface $request): bool
    {
        return $this->requests->offsetExists($request)
            && !is_null($this->requests->offsetGet($request));
    }

    /**
     * @param JsonRpcRequestInterface $request
     * @return int
     * @throws RequestWithoutId
     */
    public function getRequestId(JsonRpcRequestInterface $request): int
    {
        if ($this->requests->offsetExists($request)) {
            return $this->requests->offsetGet($request);
        }

        throw new RequestWithoutId();
    }

    public function getByRequestId(int $offset): JsonRpcRequest
    {
        $this->requests->rewind();

        while ($this->requests->valid()) {
            $request = $this->requests->current();
            if ($this->requests->offsetGet($request) === $offset) {
                return $request;
            }
            $this->requests->next();
        }
    }
}
