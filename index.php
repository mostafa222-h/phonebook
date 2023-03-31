<?php

#front controller



include "bootstrap/init.php";
use App\Core\Routing\Router;



$router = new Router();
$router->run();

// $route = '/post/{slug}';

// nice_dump($route);
// nice_dump($pattern);
// nice_dump('/^\/post\/(?<slug>[-%\w]+)$/');

// $route_pattern = '/^\/post\/(?<slug>[-%\w]+)$/' ;

// $uri1 = '/post/what-is-php' ;

// $uri2 = '/post/why-you-must-choose-mysite' ;