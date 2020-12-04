<?php

header('Content-Type: application/json');

require_once '../vendor/autoload.php';
require_once '../lib/Database.php';
require_once '../lib/Validate.php';

$basic  = new \Nexmo\Client\Credentials\Basic('b47edfd1', 'xRIpAfUxa4NvyD1I');
$client = new \Nexmo\Client($basic);


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
      http_response_code(400);
    echo json_encode(["message"=>"please login first"]);
    
    exit();
  }
  
//   if(empty($_POST['phone']))
//   {
//       http_response_code(400);
//     echo json_encode(["message"=>"please enter valid phone"]);
    
//     exit();
//   }


 

 if(isset($_FILES['front']['name']))
 {
  $move_image = new image('front');
  $move_image->extenImages =['jpeg','jpg','png'];
  $move_image->direction = '../uploads/';
  $move_image->path = microtime();
  $store_front = $move_image->storage();

  $_POST['front']=$store_front;
 }

  if(isset($_FILES['back']['name']))
 {
  $move_image = new image('back');
  $move_image->extenImages =['jpeg','jpg','png'];
  $move_image->direction = '../uploads/';
  $move_image->path = microtime();
  $store_back = $move_image->storage();

  $_POST['back']=$store_back;
 }

  if(isset($_FILES['cr']['name']))
 {
  $move_image = new image('cr');
  $move_image->extenImages =['jpeg','jpg','png'];
  $move_image->direction = '../uploads/';
  $move_image->path = microtime();
  $store_cr = $move_image->storage();

  $_POST['cr']=$store_cr;
 }

  if(isset($_FILES['logo']['name']))
 {
  $move_image = new image('logo');
  $move_image->extenImages =['jpeg','jpg','png'];
  $move_image->direction = '../uploads/';
  $move_image->path = microtime();
  $store_cr = $move_image->storage();

  $_POST['logo']=$store_cr;
 }

 $digits = 4;
 $code = rand(pow(10, $digits-1), pow(10, $digits)-1);
 $_POST['code']=$code;

if(isset($_POST['send']))
{
    $send = $_POST['send']; 
    unset($_POST['send']);
}

 
  $update_user = User::where('id',$user->id)->update($_POST);

    if($update_user)
    {
        if(isset($send) && $send==1)
        {
                $to = $_POST['keyCountry'].$_POST['phone'];
                 
    
         try {
                $message = $client->message()->send([
                    'to' => $to,
                    'from' => 'Evento',
                    'text' => 'your eventat  App confirmation  Code  is : '.$code
                ]);
                $response = $message->getResponseData();
            
                if($response['messages'][0]['status'] == 0) {
                    http_response_code(200);
                    echo json_encode(["message"=>"congrte ! updated successed please check your phone to activate your account"]);
          
                } else {
                    
                    http_response_code(400);
                    echo json_encode(["message"=>"The message failed with status"]);
                }
            } catch (Exception $e) {
                echo "The message was not sent. Error: " . $e->getMessage() . "\n";
            }
        }else
        {
            http_response_code(200);
             echo json_encode(["message"=>"congrte ! updated successed "]);
        }
    
        
     
    }else
    {
    	echo json_encode(["errors"=>"somthing wrong happened please try again"]);
      http_response_code(400);
    }
}



?>