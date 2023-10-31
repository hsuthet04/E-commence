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
use App\Models\SubCategory;


class CategoryController extends BaseController
{
    public function index()
    {
        // Redirect::to("/");
        $categories = Category::all()->count();
        list($cats, $pages) = paginate(3, $categories, new Category());
        $subcategories = SubCategory::all()->count();
        list($sub_cats, $sub_pages) = paginate(3, $subcategories, new SubCategory());

        $cats = json_decode(json_encode($cats));
        $sub_cats = json_decode(json_encode($sub_cats));
        view("admin/category/create", compact('cats', 'pages', 'sub_cats', 'sub_pages'));
    }
    public function store()
    {
        $post = Request::get("post");
        //Session::remove("token");
        if (CSRFToken::checkToken($post->token)) {
            $rules = [
                "name" => ["required" => true, "minLength" => "3", "unique" => "categories"]
            ];
            $validator = new ValidateRequest();
            $validator->checkValidate($post, $rules);


            if ($validator->hasError()) {
                $errors = $validator->getErrors();
                $categories = Category::all()->count();
                list($cats, $pages) = paginate(3, $categories, new Category());
                $cats = json_decode(json_encode($cats));

                $subcategories = SubCategory::all()->count();
                list($sub_cats, $sub_pages) = paginate(3, $subcategories, new SubCategory());
                $sub_cats = json_decode(json_encode($sub_cats));
                view("admin/category/create", compact('cats', 'errors', 'pages', 'sub_cats', 'sub_pages'));
            } else {
                $slug = slug($post->name);
                $con = Category::create([
                    "name" => $post->name,
                    "slug" => $slug
                ]);
                if ($con) {
                    $success = "Success";
                    $categories = Category::all()->count();
                    list($cats, $pages) = paginate(3, $categories, new Category());
                    $cats = json_decode(json_encode($cats));

                    $subcategories = SubCategory::all()->count();
                    list($sub_cats, $sub_pages) = paginate(3, $subcategories, new SubCategory());
                    $sub_cats = json_decode(json_encode($sub_cats));
                    view("admin/category/create", compact('cats', 'success', 'pages', 'sub_cats', 'sub_pages'));
                } else {
                    $errors = "Fail";
                    $categories = Category::all()->count();
                    list($cats, $pages) = paginate(3, $categories, new Category());
                    $cats = json_decode(json_encode($cats));
                    $subcategories = SubCategory::all()->count();
                    list($sub_cats, $sub_pages) = paginate(3, $subcategories, new SubCategory());
                    $sub_cats = json_decode(json_encode($sub_cats));
                    view("admin/category/create", compact('cats', 'errors', 'pages', 'sub_cats', 'sub_pages'));
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
                exit;
            } else {
                Category::where("id", $post->id)->update(["name" => $post->name]);
                //$data['con'] = "Good to go";
                echo json_encode("update success");
                exit;
            }
        } else {
            header('HTTP/1.1 422 Token Mismatch Error', true, 422);
            echo json_encode(["error" => "Token Mismatch Error"]);
            exit;
        }
    }
}
