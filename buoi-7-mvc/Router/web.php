<?php

$router->addRoute('/', [
    'controller' => 'App\Http\Controllers\HomeController',
    'action' => 'index'
]);

$router->addRoute('/news', [
    'controller' => 'App\Http\Controllers\NewsController',
    'action' => 'index'
]);

$router->addRoute('/products/add', [
    'controller' => 'App\Http\Controllers\HomeController',
    'action' => 'create'
]);

$router->addRoute('/products/update', [
    'controller' => 'App\Http\Controllers\HomeController',
    'action' => 'update'
]);

$router->addRoute('/products/delete', [
    'controller' => 'App\Http\Controllers\HomeController',
    'action' => 'delete'
]);