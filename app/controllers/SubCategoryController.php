<?php

namespace App\Controllers;

use App\Classes\CSRFToken;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Session;
use App\Models\SubCategory;
use App\Classes\ValidateRequest;

class SubCategoryController extends BaseController
{
    public function store()
    {
        $post = Request::get('post');

        if (CSRFToken::checkToken($post->token)) {
            $rules = [
                "name" => ["unique" => "sub_categories", "minLength" => "3"]
            ];
            $validator = new ValidateRequest();
            $validator->checkValidate($post, $rules);
            if ($validator->hasError()) {
                header('HTTP/1.1 422 Validation Error', true, 422);
                $errors = $validator->getErrors();
                echo json_encode($errors);
                exit;
            } else {
                $subcat = new SubCategory();
                $subcat->name = $post->name;
                $subcat->cat_id = $post->parent_cat_id;

                if ($subcat->save()) {
                    echo "Sub Category Create success";
                    exit;
                } else {
                    header('HTTP/1.1 422 Sub Category Create Fail', true, 422);
                    $data = ["name" => "Sub Category Create Fail"];
                    echo json_encode($data);
                    exit;
                }
            }
        } else {
            header('HTTP/1.1 422 Token Mismatch Error', true, 422);
            echo "Token mismatch error";
            exit;
        }
    }
    public function update()
    {
        $post = Request::get("post");
        if (CSRFToken::checkToken($post->token)) {
            $rules = [
                "name" => ["unique" => "sub_categories", "minLength" => "3"]
            ];
            $validator = new ValidateRequest();
            $validator->checkValidate($post, $rules);
            if ($validator->hasError()) {
                header('HTTP/1.1 422 Validation Error', true, 422);
                $errors = $validator->getErrors();
                echo json_encode($errors);
                exit;
            } else {
                SubCategory::where("id", $post->id)->update(["name" => $post->name]);
                echo "Sub Category Edit success";
                exit;
            }
        } else {
            header('HTTP/1.1 422 Token Mismatch Error', true, 422);
            echo "Token mismatch error";
            exit;
        }
    }
    public function delete($id)
    {
        $con = SubCategory::destroy($id);
        if ($con) {
            Session::flash("delete_success", "Sub Category Delete Successfully");
            Redirect::to("/admin/category/create");
        } else {
            Session::flash("delete_fail", "Sub Category Delete Fail");
            Redirect::to("/admin/category/create");
        }
    }
}
