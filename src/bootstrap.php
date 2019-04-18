<?php
namespace Soatok\DholeCryptoWeb;

use FastRoute\Dispatcher;

require dirname(__DIR__) . '/vendor/autoload.php';

/** @var Dispatcher $dispatcher */
$dispatcher = require_once __DIR__ . '/routes.php';

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);
