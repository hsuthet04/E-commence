<?php

use App\Classes\Session;
use App\Classes\ValidateRequest;

// use Illuminate\Database\Capsule\Manager as Capsule;

// use Whoops\Run;

require_once "../bootstrap/init.php";

//pagination(5,10,"categories",new \App\Controllers\CategoryController());


// *
// $post = [
//     "name" => "puci",
//     "age" => 20,
//     "emal"=> "cola@gmail.com",
// ];
// $policy = [
//     "name" => ["string" => true, "minLength" => "5"],
//     "email"=> ["email" => true,"maxLength"=>"25"],
//     "age" => ["number" => true, "minLength" => "2"],
// ];
// $validator = new ValidateRequest();
// $validator->checkValidate($post, $policy);

// if( $validator->hasError()){
//     beautify($validator->getErrors());
// } else{
//     echo "good to go";
// }
// *
// $orig="Local Electornic";
// $vari="Local-electric";
//echo slug("Category_Ten");

// $con=$validator->string("name","cola","4");
// var_dump($con);


// $con=Session::has("name");
// var_dump($con);
//Session::add("name","Tester1");

// Session::replace("name","test2");
// echo Session::get("name");

//file=>move_uploaded_file(temp_name,path+filename);

// $user = Capsule::table("users")->where("id", 1)->get();
// echo "<pre>" . print_r($user, true) . "</pre>";

// $mailer = new Mail();
// $content="ethu is gay";
// $data=[
//     "to"=>"chocolatessukiiiuvu@gmail.com",
//     "to_name"=>"Hsu Thet",
//     "content"=>$content,
//     "subject"=>"New email test",
//     "filename"=>"welcome",
//     "img_link"=>"https://www.rainforest-alliance.org/wp-content/uploads/2021/06/capybara-square-1.jpg.optimal.jpg"
// ];

// $mailer->send();
// extract($data);

// echo $to_name;

// if ($mailer->send($data)) {
//     echo "<h1>Mail send successfully</h1>";
// } else {
//     echo "<h1>Mail send fail</h1>";
// }
