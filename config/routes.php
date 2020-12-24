<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes=new RouteCollection();

$routes->add('home',new Route('/',['_controller'=>'\App\Controller\HomeController::index']));
$routes->add('error404',new Route('/404',['_controller'=>'\App\Controller\ErrorController::error404']));
$routes->add('error500',new Route('/500',['_controller'=>'\App\Controller\ErrorController::error500']));

return $routes;