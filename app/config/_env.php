<?php

// define("APP_ROOT", realpath(__DIR__ . "/../../"));
//echo APP_ROOT;


$dotEnv = Dotenv\Dotenv::createUnsafeImmutable(APP_ROOT);

$dotEnv->load();
