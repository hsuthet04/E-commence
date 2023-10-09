<?php
if (!isset($_SESSION)) session_start();

define("APP_ROOT", realpath(__DIR__ . '/../'));

require_once APP_ROOT . "/vendor/autoload.php";
require_once APP_ROOT . "/app/config/_env.php";
require_once APP_ROOT . "/app/routing/RouteDispatcher.php";
require_once APP_ROOT . "/app/routing/router.php";
