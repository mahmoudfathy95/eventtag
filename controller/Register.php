<?php

header('Content-Type: application/json');

require_once '../vendor/autoload.php';
require_once '../lib/Database.php';
require_once '../lib/Validate.php';


$validate = new Validate();



if($_SERVER['REQUEST_METHOD']=="POST")
{
   
  $errors = $validate->validation($_POST,[
                       'name'=>'required|string',
                       'email'=>'required|email|unique:User',
                       'phone'=>'required|unique:User',
                       'keyCountry'=>'required',
                       'password'=>'required',
                       'confirm'=>'required|confirm:password',
                       'type'=>'required',
                       'firebase'=>'required'
                     ]);



// if($_POST['type']==1)
// {

//     $errors = $validate->validation($_POST,[
//                       'brand'=>'required',
//                      ]);
 

 
// }elseif($_POST['type'] == 2)
// {
//   $errors = $validate->validation($_POST,[
//                       'company'=>'required',
//                       'expedition'=>'required',
//                       'lat'=>'required',
//                       'lang'=>'required',
//                      ]);

 
//   if(empty($_FILES['logo']['name']))
//   {
//     echo json_encode(['message'=>'logo is required']);
//     http_response_code(400);
//     exit();
//   }

if(isset($_FILES['logo']['name'])){
  $move_image = new image('logo');
  $move_image->extenImages =['jpeg','jpg','png'];
  $move_image->direction = '../uploads/';
  $move_image->path = microtime();
  $store_logo = $move_image->storage();

  $_POST['logo']=$store_logo;

}

//  if(empty($_FILES['front']['name']))
//   {
//     echo json_encode(['message'=>'front is required']);
//     http_response_code(400);
//     exit();
//   }
  
//   if(empty($_FILES['back']['name']))
//   {
//     echo json_encode(['message'=>'back is required']);
//     http_response_code(400);
//     exit();
//   }
  
//   if(empty($_FILES['cr']['name']))
//   {
//     echo json_encode(['message'=>'cr is required']);
//     http_response_code(400);
//     exit();
//   }


if(isset($_FILES['front']['name'])){
  $move_image = new image('front');
  $move_image->extenImages =['jpeg','jpg','png'];
  $move_image->direction = '../uploads/';
  $move_image->path = microtime();
  $store_front = $move_image->storage();

  $_POST['front']=$store_front;
}

if(isset($_FILES['back']['name'])){
  $move_image = new image('back');
  $move_image->extenImages =['jpeg','jpg','png'];
  $move_image->direction = '../uploads/';
  $move_image->path = microtime();
  $store_back = $move_image->storage();

  $_POST['back']=$store_back;
}

if(isset($_FILES['cr']['name'])){
  $move_image = new image('cr');
  $move_image->extenImages =['jpeg','jpg','png'];
  $move_image->direction = '../uploads/';
  $move_image->path = microtime();
  $store_cr = $move_image->storage();

  $_POST['cr']=$store_cr;
}
  

  unset($_POST['confirm']);
  $_token = helper::_token();
  $_token=str_replace('+','',$_token);
  $_POST['token']=$_token;
  
   
  $add_user = User::create($_POST);

    if($add_user)
    {

    	echo json_encode(["message"=>"congrte ! register successed","type"=>$_POST['type'],"token"=>$_token]);
      http_response_code(200);
    }else
    {
    	echo json_encode(["errors"=>"somthing wrong happened please try again"]);
      http_response_code(400);
    }
}



?>