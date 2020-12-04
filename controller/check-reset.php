<?php
session_start();

header('Content-Type: application/json');

require_once '../vendor/autoload.php';
require_once '../lib/Database.php';


$validate = new validate();



if($_SERVER['REQUEST_METHOD']=="POST")
{
   
  $errors = $validate->validation($_POST,[
                       'email'=>'required'
                     ]);

  



  $check_email= User::where('email',$_POST['email'])->first();
 
  if(!empty($check_email))
  {

    echo json_encode(["message"=>"congrte ! login successed"]);
      http_response_code(200);
  }else
  {
      http_response_code(400);
  	echo json_encode(["errors"=>"somthing wrong happened please try again"]);
    
  }
}



?>