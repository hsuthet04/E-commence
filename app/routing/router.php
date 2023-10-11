<?php

use App\Routing\RouteDispatcher;

$router = new AltoRouter();

$router->setBasePath("/E_Commence/public");

$router->map("GET", "/", "App\Controllers\IndexController@show", "Home Route");
$router->map("GET", "/admin/category", "App\Controllers\CategoryController@index", "Category Create");
$router->map("POST", "/admin/category", "App\Controllers\CategoryController@store", "Category Store");

new RouteDispatcher($router);