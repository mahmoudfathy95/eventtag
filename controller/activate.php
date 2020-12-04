<?php

header('Content-Type: application/json');

require_once '../vendor/autoload.php';
require_once '../lib/Database.php';
require_once '../lib/Validate.php';


$validate = new validate();



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
      http_response_code(400);
    echo json_encode(["message"=>"please login first"]);
    
    exit();
  }
   
  $data = json_decode(file_get_contents('php://input'), true);
  $errors = $validate->validation($data,[
                       'code'=>'required'
                     ]);


  if($data['code']==$user->code)
  {
    $update_active = User::where('id',$user->id)->update(['active'=>1]);
     if($update_active)
    {
    	echo json_encode(["message"=>"congrte ! your account activated"]);
      http_response_code(200);
    }else
    {
        http_response_code(400);
    	echo json_encode(["errors"=>"somthing wrong happened please try again"]);
      
    }
  }else
  {
       http_response_code(400);
    	echo json_encode(["errors"=>"this code not valid"]);
  }

   
}



?>