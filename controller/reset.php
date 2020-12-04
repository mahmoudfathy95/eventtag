<?php
session_start();

header('Content-Type: application/json');

require_once '../vendor/autoload.php';
require_once '../lib/Database.php';
require_once '../lib/Validate.php';

$basic  = new \Nexmo\Client\Credentials\Basic('b47edfd1', 'xRIpAfUxa4NvyD1I');
$client = new \Nexmo\Client($basic);


$validate = new validate();



if($_SERVER['REQUEST_METHOD']=="POST")
{
  $data = json_decode(file_get_contents('php://input'), true);
  $errors = $validate->validation($data,[
                       'email'=>'required'
                     ]);



  $check_email= User::where('email',$data['email'])->first();

  if(!empty($check_email))
  {
    $digits = 4;
    $code = rand(pow(10, $digits-1), pow(10, $digits)-1);
    $add_reset = Reset::create(['code'=>$code,'user_id'=>$check_email->id]);
   $to = $check_email->keyCountry.$check_email->phone;
    try {
      $message = $client->message()->send([
          'to' => $to,
          'from' => 'Evento',
          'text' => 'your eventat  App confirmation  Code  is : '.$code
      ]);
      $response = $message->getResponseData();

        if($response['messages'][0]['status'] == 0) {
            echo json_encode(["message"=>"code send successed","code"=>$code]);
             http_response_code(200);
        } else {
            http_response_code(400);
             echo json_encode(["message"=>"The message failed with status please try again"]);
            exit();
        }
    } catch (Exception $e) {
      http_response_code(400);
      echo json_encode(["message"=>"The message was not sent. Error"]);
      exit();
    }
    
    
    
    
  }else
  {
       http_response_code(400);
  	echo json_encode(["errors"=>"somthing wrong happened please try again"]);
   
  }
}



?>