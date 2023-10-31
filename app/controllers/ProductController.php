<?php

namespace App\Controllers;

use App\Classes\CSRFToken;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Session;
use App\Classes\UploadFile;
use App\Classes\ValidateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;

class ProductController
{
    public function home()
    {

        $pds = Product::all();
        list($products, $pages) = paginate(4, count($pds), new Product());
        $products = json_decode(json_encode($products));
        view("admin/product/home", compact('products', 'pages'));
    }
    public function create()
    {
        $cats = Category::all();
        $sub_cats = SubCategory::all();
        view("admin/product/create", compact('cats', 'sub_cats'));
    }
    public function store()
    {
        $post = Request::get('post');
        $file = Request::get('file');
        if (CSRFToken::checkToken($post->token)) {
            $rules = [
                "name" => ["required" => true, "unique" => "products", "minLength" => "3"],
                "description" => ["required" => true, "minLength" => "10"]
            ];
            $validator = new ValidateRequest();
            $validator->checkValidate($post, $rules);
            if ($validator->hasError()) {
                $errors = $validator->getErrors();
                $cats = Category::all();
                $sub_cats = SubCategory::all();
                view("admin/product/create", compact('cats', 'sub_cats', 'errors'));
            } else {
                if (!empty($file->file->name)) {
                    $uploadFile = new UploadFile();
                    if ($uploadFile->move($file)) {
                        $path = $uploadFile->getPath();

                        $product = new Product();
                        $product->name = $post->name;
                        $product->price = $post->price;
                        $product->cat_id = $post->cat_id;
                        $product->sub_cat_id = $post->sub_cat_id;
                        $product->image = $path;

                        if ($product->save()) {
                            $products = Product::all();
                            Session::flash("product_insert_success", "Product succesfully Created");
                            Redirect::to("/admin/product/home", compact('products'));
                        } else {
                            $errors = ["Problem Insert Product to Database"];
                            $cats = Category::all();
                            $sub_cats = SubCategory::all();
                            view("admin/product/create", compact('cats', 'sub_cats', 'errors'));
                        }
                    } else {
                        $errors = ["Plz check image size and type"];
                        $cats = Category::all();
                        $sub_cats = SubCategory::all();
                        view("admin/product/create", compact('cats', 'sub_cats', 'errors'));
                    }
                } else {
                    $errors = ["Image Fails"];
                    $cats = Category::all();
                    $sub_cats = SubCategory::all();
                    view("admin/product/create", compact('cats', 'sub_cats', 'errors'));
                    echo "fail";
                }
            }
        } else {
            $errors = ["Image Fails"];
            $cats = Category::all();
            $sub_cats = SubCategory::all();
            view("admin/product/create", compact('cats', 'sub_cats', 'errors'));
        }
        beautify($post);
        beautify($file);
    }
    public function edit($id)
    {
        $cats = Category::all();
        $sub_cats = SubCategory::all();
        $product = Product::where("id", $id)->first();
        view('admin/product/edit', compact('product', 'cats', 'sub_cats'));
    }

    public function update($id)
    {
        $post = Request::get('post');
        $file = Request::get('file');
        $f_path = "";

        if (CSRFToken::checkToken($post->token)) {
            $rules = [
                "name" => ["required" => true, "unique" => "products", "minLength" => "3"],
                "description" => ["required" => true, "minLength" => "10"]
            ];
            $validator = new ValidateRequest();
            $validator->checkValidate($post, $rules);

            if ($validator->hasError()) {
                $errors = $validator->getErrors();
                $product = Product::where('id', $id)->first();
                $cats = Category::all();
                $sub_cats = SubCategory::all();

                view('admin/product/edit', compact('errors', 'product', 'cats', 'sub_cats'));
                //Redirect::to("/admin/product/" . $id . "/edit", compact('errors'));
            } else {
                if (empty($file->file->name)) {
                    $f_path = $post->old_image;
                } else {
                    $uploadFile = new UploadFile();
                    if ($uploadFile->move($file)) {
                        $f_path = $uploadFile->getPath();
                    } else {
                        $product = Product::where('id', $id)->first();
                        $cats = Category::all();
                        $sub_cats = SubCategory::all();
                        $errors = ["file_move_error" => "Can't move upload file"];
                        view('admin/product/edit', compact('errors', 'product', 'cats', 'sub_cats'));
                    }
                }
                $product = Product::where('id', $id)->first();

                $product->name = $post->name;
                $product->price = $post->price;
                $product->cat_id = $post->cat_id;
                $product->sub_cat_id = $post->sub_cat_id;
                $product->image = $f_path;

                if ($product->update()) {
                    Session::flash("product_insert_success", "Product succesfully Updated");
                    Redirect::to("/admin/product/home");
                } else {
                    $errors = ["file_move_error" => "Product successfully Updated"];
                    $cats = Category::all();
                    $sub_cats = SubCategory::all();
                    $product = Product::where('id', $id)->first();
                    view("admin/product/edit", compact('cats', 'sub_cats', 'errors', 'product'));
                }
            }
        } else {
            Session::flash("Product Update Fail", "Product Update Fail");
            // $cats = Category::all();
            // $sub_cats = SubCategory::all();
            // $product = Product::where("id", $id)->first();
            Redirect::to("/admin/product/" . $id . "/edit");
        }
    }
    public function delete($id)
    {
        $con = Product::destroy($id);
        if ($con) {
            Session::flash("product_insert_success", "Product Delete Successfully");
            Redirect::to("/admin/product/home");
        } else {
            Session::flash("product_insert_success", "Product Delete Fail");
            Redirect::to("/admin/product/home");
        }
    }
}
