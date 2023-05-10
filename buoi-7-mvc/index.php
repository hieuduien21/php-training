<?php

// 1. require file autoload
// 2. định tuyến controller, action dựa vào hệ thống routing build in

session_start();

require __DIR__ . "/autoload/autoload.php";

$router = new Router\Route();
require __DIR__ . "/Router/web.php";

$router->dispatchRoute($_SERVER['REQUEST_URI']);
