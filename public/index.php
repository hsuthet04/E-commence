<?php
require_once "../bootstrap/init.php";

$var = "BaseController@index";

list($controller, $method) = explode("@", $var);

echo "controller is" . $controller;
echo "<br>method is " . $method;
