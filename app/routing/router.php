<?php

use App\Routing\RouteDispatcher;

$router = new AltoRouter();

//$router->setBasePath("/E_Commence/public");

$router->map("GET", "/", "App\Controllers\IndexController@show", "Home Route");

$router->map("POST", "/cart", "App\Controllers\IndexController@cart", "Cart Route");
$router->map("GET", "/cart", "App\Controllers\IndexController@showCart", "Show Cart Route");
$router->map("POST", "/payout", "App\Controllers\IndexController@payout", "Payout Route");
$router->map("GET", "/product[i:id]/detail", "App\Controllers\Indexcontroller@productDetail", "Product Cetail Route");
$router->map("POST", "/payment/stripe", "App\Controllers\PaymentController@stripePayment", "Stripe Route");
$router->map("GET", "/paypal/success/[*:paymentID]/[*:payerID]/[*:paymentToken]", "App\Controllers\PaymentController@paypalSuccess", "Paypal Success Stripe Route");

require_once "admin_route.php";
require_once "user_route.php";

new RouteDispatcher($router);
