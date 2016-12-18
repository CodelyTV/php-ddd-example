<?php

use CodelyTv\Api\ApiKernel;
use CodelyTv\Infrastructure\Symfony\KernelCache;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . '/../../../vendor/autoload.php';

$env    = 'prod';
$debug  = false;
$kernel = new KernelCache(new ApiKernel($env, $debug));

$request = Request::createFromGlobals();
Request::setTrustedProxies([$request->server->get('REMOTE_ADDR')]);

$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
