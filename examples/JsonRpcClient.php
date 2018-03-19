<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use DawidMazurek\JsonRpcClient\Boundary\Http\RequestFactory;
use DawidMazurek\JsonRpcClient\Client\JsonRpcClient;
use DawidMazurek\JsonRpcClient\Client\JsonRpcClientConfiguration;
use DawidMazurek\JsonRpcClient\Request\JsonRpcNotification;
use DawidMazurek\JsonRpcClient\Request\JsonRpcRequest;
use DawidMazurek\JsonRpcClient\Request\JsonRpcRequestCollection;
use Http\Adapter\Guzzle6\Client;


$config = [
    'uri' => 'http://localhost:8182/examples/server.php'
];

$adapter = Client::createWithConfig($config);
$client = new JsonRpcClient(
    $adapter,
    new RequestFactory(
        new JsonRpcClientConfiguration($config)
    )
);

$sampleRequest = new JsonRpcRequest('sampleMethod', ['param' => 'value']);
$sampleNotification= new JsonRpcNotification('methodName', ['param' => 'value']);
$requests = new JsonRpcRequestCollection();
$requests->addRequest($sampleRequest);
$requests->addRequest($sampleNotification);

$bulkResponse = $client->execute($requests);
$sampleResponse = $bulkResponse->getResponseFor($sampleRequest);

var_dump($sampleResponse);
