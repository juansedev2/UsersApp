<?php
require_once "./core/Bootstrap.php";
require_once "./core/router/Handler.php";
require_once "./core/router/Router.php";
$routes = require_once "./core/router/Routes.php";
$router = new Router($routes);
$router->treatRequest(Handler::getURL());