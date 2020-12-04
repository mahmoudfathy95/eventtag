<?php

header('Content-Type: application/json');

require_once '../vendor/autoload.php';
require_once '../lib/Database.php';

   
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



if($user)
{
  $status=0;
  
    if($user->type==1)
    {
      
      if(empty($user->brand))
      {
          $status = -1;
      }
       
     
    }elseif($user->type== 2)
    {
        
        if(empty($user->logo) ||empty($user->company) || empty($user->expedition))
        {
            $status = -1;
        }
    }
    
   if( empty($user->front)  || empty($user->back)  || empty($user->cr) || $user->active==0)
   {
      $status = -1;
   }
   
   if($status==-1)
   {
       $user->adminActive = -1;
   }
 echo json_encode(["user"=>$user]);
  http_response_code(200);
}else
{
	echo json_encode(["errors"=>"somthing wrong happened please try again"]);
  http_response_code(400);
}



?>