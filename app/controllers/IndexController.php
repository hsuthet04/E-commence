<?php

namespace App\Controllers;

use App\Models\Product;

class IndexController extends BaseController
{
    public function show()
    {
        $count = Product::all()->count();
        list($pros, $pages) = paginate(8, $count, new Product());
        $products = json_decode(json_encode($pros));
        $featured = Product::where("featured", 2)->get();
        view("home", compact('products', 'pages','featured'));
    }
}
