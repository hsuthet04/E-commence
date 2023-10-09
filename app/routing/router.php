<?php

$router = new AltoRouter();

$router->map("GET", "/", "BaseController@index", "Home Route");

new \App\routing\RouteDispatcher($router);
