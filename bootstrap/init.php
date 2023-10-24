<?php
use App\Classes\Database;
use App\Classes\ErrorHandler;
if (!isset($_SESSION)) session_start();
define("APP_ROOT", realpath(__DIR__ . "/../"));
define("URL_ROOT", "http://e_commence.com/");

require_once APP_ROOT . "/vendor/autoload.php";
new ErrorHandler();

require_once APP_ROOT . "/app/config/_env.php";

new Database();
require_once APP_ROOT . "/app/routing/router.php";

set_error_handler([new ErrorHandler(),'handleErrors']);


?>
