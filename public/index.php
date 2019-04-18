<?php
namespace Soatok\DholeCryptoWeb;

use FastRoute\Dispatcher;

define('SOATOK_WEB_ROOT', __DIR__);
require dirname(__DIR__) . '/src/bootstrap.php';

/**
 * @var Dispatcher $dispatcher
 * @var string $httpMethod
 * @var string $uri
 */
if (Collection::isStaticResource(SOATOK_WEB_ROOT . $uri)) {
    \header('Cache-Control: max-age=2592000, public');
    \header('Content-Type: ' . Collection::mimeType(SOATOK_WEB_ROOT . $uri));
    echo file_get_contents(SOATOK_WEB_ROOT . $uri);
    exit(0);
}

/** @var array<int, int|View|array> $routeInfo */
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case Dispatcher::NOT_FOUND:
        // Handle 404
        http_response_code(404);
        echo 'HTTP/1.1 404 Not Found', PHP_EOL;
        exit(404);
        break;
    case Dispatcher::METHOD_NOT_ALLOWED:
        // Handle 404
        http_response_code(405);
        echo 'HTTP/1.1 405 Method Not Allowed', PHP_EOL;
        exit(405);
    case Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        if (!($handler instanceof View)) {
            http_response_code(500);
            echo 'HTTP/1.1 500 Internal Server Error (TypeError)', PHP_EOL;
            exit(500);
        }

        // Just print the response:
        echo $handler($vars);
}
