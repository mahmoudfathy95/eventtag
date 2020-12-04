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
  
  $allnotification =[];
  $notification = Notification::where('user_id',$user->id)->get();
  
  $allnotification['notification'] = $notification;
  $allnotification['comment']=['active account'=>1,'stop account'=>2,'event'=>3,'order'=>4];
  if(count($allnotification)>0)
  {
     echo json_encode(["allNotification"=>$allnotification]);
   }else
   {
    echo json_encode(["allNotification"=>array()]);
   }
 




?>