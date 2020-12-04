<?php

header('Content-Type: application/json');

require_once '../vendor/autoload.php';
require_once '../lib/Database.php';
require_once '../lib/Validate.php';


$validate = new Validate();



if($_SERVER['REQUEST_METHOD']=="POST")
{
   if(!isset($_GET['token']) || empty($_GET['token']))
  {
    http_response_code(400);
    echo json_encode(["message"=>"please login first"]);
    exit();
  }

  $_token = $_GET['token'];
  $user = User::where('token',$_token)->first();
  
  if(empty($user))
  {
    echo json_encode(["message"=>"please login first"]);
    http_response_code(400);
    exit();
  }
$data = json_decode(file_get_contents('php://input'), true);
$errors = $validate->validation($data,[
                       'oldPassword'=>'required',
                       'newPassword'=>'required',
                       'confirm'=>'required|confirm:newPassword',
                     ]);

 
  if($data['oldPassword'] != $user->password)
  {
    echo json_encode(['message'=>"this password not right"]);
    http_response_code(400);
    exit();
  }

 $password = $data['newPassword'];
    
  $update_user = User::where('id',$user->id)->update(["password"=>$password]);

    if($update_user)
    {
    	echo json_encode(["message"=>"congrte ! updated successed"]);
      http_response_code(200);
    }else
    {
    	echo json_encode(["errors"=>"somthing wrong happened please try again"]);
      http_response_code(400);
    }
}



?>