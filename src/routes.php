<?php
use Soatok\DholeCryptoWeb\View\{
    Index
};

return FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', new Index());
});
