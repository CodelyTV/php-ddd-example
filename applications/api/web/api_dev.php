<?php

use CodelyTv\Api\ApiKernel;
use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

// If you don't want to setup permissions the proper way, just uncomment the following PHP line
// read http://symfony.com/doc/current/book/installation.html#configuration-and-setup for more information
//umask(0000);

// This check prevents access to debug front controllers that are deployed by accident to production servers.
// Feel free to remove this, extend it, or make something more sophisticated.
if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !in_array(isset($_SERVER, $_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '', ['127.0.0.1', 'fe80::1', '::1'])
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check ' . basename(__FILE__) . ' for more information.');
}

require_once __DIR__ . '/../../../vendor/autoload.php';
Debug::enable();

$env    = 'dev';
$debug  = true;
$kernel = new ApiKernel($env, $debug);

$request  = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
