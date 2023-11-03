<?php

namespace App\Controllers;

use App\Classes\Request;
use App\Classes\Session;
use App\Models\Product;

class IndexController extends BaseController
{
    public function show()
    {
        $count = Product::all()->count();
        list($pros, $pages) = paginate(4, $count, new Product());
        $products = json_decode(json_encode($pros));
        $featured = Product::where("featured", 2)->get();
        view("home", compact('products', 'pages', 'featured'));
    }
    public function cart()
    {
        $post = Request::get('post');
        $items = $post->cart;
        $carts = [];
        foreach ($items as $item) {
            $product = Product::where("id", $item)->first();
            $product->qty = 1;
            array_push($carts, $product);
        }

        echo json_encode($carts);
        exit;
    }
    public function showCart()
    {
        view('cart');
        // $items = Session::get("cart-items");

    }
}
