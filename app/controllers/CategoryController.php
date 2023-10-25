<?php

namespace App\Controllers;

use App\Classes\CSRFToken;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Session;
use App\Classes\UpdateFile;
use App\Classes\ValidateRequest;
use App\Controllers\BaseController;
use App\Models\Category;


class CategoryController extends BaseController
{
    public function index()
    {
        // Redirect::to("/");
        $categories = Category::all()->count();
        list($cats, $pages) = paginate(3, $categories, new Category());
        $cats = json_decode(json_encode($cats));
        //beautify($cats); 
        view("admin/category/create", compact('cats', 'pages'));
    }
    public function store()
    {
        $post = Request::get("post");
        //Session::remove("token");
        if (CSRFToken::checkToken($post->token)) {
            $rules = [
                "name" => ["required" => true, "minLength" => "5", "unique" => "categories"]
            ];
            $validator = new ValidateRequest();
            $validator->checkValidate($post, $rules);

            // beautify(Request::all());
            // echo "<hr>";

            // $uploadFile = new UpdateFile();
            // var_dump($uploadFile->move(Request::get("file")));
            if ($validator->hasError()) {
                //beautify($validator->getErrors());
                $cats = Category::all();
                $errors = $validator->getErrors();
                view("admin/category/create", compact('cats', 'errors'));
            } else {
                $slug = slug($post->name);
                $con = Category::create([
                    "name" => $post->name,
                    "slug" => $slug
                ]);
                if ($con) {
                    $cats = Category::all();
                    $success = "Success";
                    view("admin/category/create", compact('cats', 'success'));
                } else {
                    echo "fail";
                }
                // $category->name = $post->name;
                // $category->slug = $slug;

                // if ($category->save()) {
                //     echo "Success";
                // } else {
                //     echo "fail";
                // }
            }
        } else {
            Session::flash("error", "CSRF field error");
            Redirect::back();
        }
    }
    public function delete($id)
    {
        $con = Category::destroy($id);
        if ($con) {
            Session::flash("delete_success", "Category Delete Successfully");
            Redirect::to("/admin/category/create");
        } else {
            Session::flash("delete_fail", "Category Delete Fail");
            Redirect::to("/admin/category/create");
        }
    }
    public function update()
    {
        $post = Request::get('post');
        $data = [
            "name" => $post->name,
            "token" => $post->token,
            "id" => $post->id,
            "con" => ''
        ];

        if (CSRFToken::checkToken($post->token)) {
            $rules = [
                "name" => ["required" => true, "minlength" => "5", "uniques" => "categories"]
            ];
            $validator = new ValidateRequest();
            $validator->checkValidate($post, $rules);

            if ($validator->hasError()) {
                //$data['con'] = "Validation error";
                header('HTTP/1.1 422 Validation Error', true, 422);
                echo json_encode($validator->getErrors());
            } else {
                Category::where("id", $post->id)->update(["name" => $post->name]);
                $data['con'] = "Good to go";
                echo json_encode($data);
            }
        } else {
            header('HTTP/1.1 422 Token Mismatch Error', true, 422);
            echo json_encode(["errors" => ""]);
        }
    }
}
