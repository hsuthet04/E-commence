<?php

namespace App\routing;

use AltoRouter;

class RouteDispatcher
{
    private $match, $controller, $method;

    public function __construct(AltoRouter $router)
    {
        $this->match = $router->match();

        if ($this->match) {
            list($controller, $method) = explode("@", $this->match["target"]);

            echo "<br>Controller is " . $controller;
            echo "<br>Method is " . $method;
        } else {
            header($_SERVER["SERVER_PROTOCOL"] . "404 not found");
            echo "Not Match Route";
        }
    }
}
