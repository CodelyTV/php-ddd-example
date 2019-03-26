<?php

use CodelyTv\MoocBackend\MoocBackendKernel;
use CodelyTv\Shared\Infrastructure\Symfony\KernelCache;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . '/../../bootstrap.php';;
$env    = $_ENV['APP_ENV'];
$debug  = $_ENV['SYMFONY_APP_DEBUG'];
$kernel = new KernelCache(new MoocBackendKernel($env, $debug));

$request = Request::createFromGlobals();
Request::setTrustedProxies([$request->server->get('REMOTE_ADDR')], Request::HEADER_X_FORWARDED_ALL);

$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
