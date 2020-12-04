<?php

header('Content-Type: application/json');

require_once '../vendor/autoload.php';
require_once '../lib/Database.php';
require_once '../lib/Validate.php';


$validate = new Validate();



if($_SERVER['REQUEST_METHOD']=="POST")
{
   $data = json_decode(file_get_contents('php://input'), true);

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
           http_response_code(400);
    echo json_encode(["message"=>"complete your profile"]);
    
    exit();
        }
    }
    
  if( empty($user->front)  || empty($user->back)  || empty($user->cr) || $user->active==0)
   {
      http_response_code(400);
    echo json_encode(["message"=>"complete your profile"]);
    
    exit();
   }
        
  if($user->adminActive == 0)
  {
    http_response_code(400);
    echo json_encode(["message"=>"this account under approval"]);
    
    exit();
  }



  if(empty($data['requests']))
  {
    echo json_encode(["message"=>"please choose booths"]);
    http_response_code(400);
    exit();
  }

   
  $last_order = Order::orderBy('created_at','desc')->first();
  if (empty($last_order)) 
  {
    $id= 1;
  }else
  {
    $id= $last_order->id+1;
  }

   $add_order= Order::create(['id'=>$id,"user_id"=>$user->id]);
   foreach ($data['requests'] as $key => $value) 
   {
      
      
    $update_booths = Booth::where('id',$value)->update(['open'=>0]);

    $add_booths = Request::create(['order_id'=>$id,'booths_id'=>$value]);
   }

   if(isset($data['products'] ))
   {
    
    foreach ($data['products'] as $key => $value) 
     {
      
      $add_booths = Rproduct::create(['order_id'=>$id,'product_id'=>$value]);
     }
   }

    if($add_order)
    {

    	echo json_encode(["message"=>"congrte ! order has been sent"]);
      http_response_code(200);
    }else
    {
    	echo json_encode(["errors"=>"somthing wrong happened please try again"]);
      http_response_code(400);
    }
}



?>