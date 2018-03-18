<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use DawidMazurek\JsonRpcClient\Client\JsonRpcClient;
use DawidMazurek\JsonRpcClient\Request\JsonRpcNotification;
use DawidMazurek\JsonRpcClient\Request\JsonRpcRequest;
use DawidMazurek\JsonRpcClient\Request\JsonRpcRequestCollection;


$client = new JsonRpcClient();

$sampleRequest = new JsonRpcRequest('methodName', ['param' => 'value']);
$sampleNotification= new JsonRpcNotification('methodName', ['param' => 'value']);
$requests = new JsonRpcRequestCollection();
$requests->addRequest($sampleRequest);
$requests->addRequest($sampleNotification);
$requests->addRequest(clone $sampleRequest);

$bulkResponse = $client->execute($requests);
$sampleResponse = $bulkResponse->getResponseFor($sampleRequest);

$sampleResponse = $bulkResponse->getResponseById(1);
