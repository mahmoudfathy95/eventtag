<?php
session_start();

header('Content-Type: application/json');

require_once '../vendor/autoload.php';
require_once '../lib/Database.php';
require_once '../lib/Validate.php';



$validate = new validate();



if($_SERVER['REQUEST_METHOD']=="POST")
{
  $data = json_decode(file_get_contents('php://input'), true);
  $errors = $validate->validation($data,[
                       'email'=>'required',
                       'password'=>'required',

                     ]);



  $check_email= User::where('email',$data['email'])->first();
 
  if(!empty($check_email))
  {
    $update_pass = User::where('id',$check_email->id)->update(['password'=>$data['password']]);
    if($update_pass)
    {
      echo json_encode(["message"=>"password updated success"]);
      http_response_code(200);
    }
    

  }else
  {
    http_response_code(400);
  	echo json_encode(["message"=>"this code is wrong"]);
   
  }
}



?>