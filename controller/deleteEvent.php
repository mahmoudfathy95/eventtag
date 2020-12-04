<?php

header('Content-Type: application/json');

require_once '../vendor/autoload.php';
require_once '../lib/Database.php';
require_once '../lib/Validate.php';


$validate = new Validate();



if($_SERVER['REQUEST_METHOD']=="POST")
{
  $data = json_decode(file_get_contents('php://input'), true);
   
  $errors = $validate->validation($data,[
                       'event_id'=>'required'
                     ]);

 
  
  $check = Event::find($data['event_id']);
  if(empty($check))
  {
    echo json_encode(['message'=>'this event not found']);
    http_response_code(400);
    exit();
  }
  $delete_event = Event::destroy($data['event_id']);
  $delete_booths = Booth::where('event_id',$data['event_id'])->delete();

    if($delete_event)
    {
    	echo json_encode(["message"=>"your event has been deleted successfully"]);
      http_response_code(200);
    }else
    {
    	echo json_encode(["errors"=>"somthing wrong happened please try again"]);
      http_response_code(400);
    }
}



?>