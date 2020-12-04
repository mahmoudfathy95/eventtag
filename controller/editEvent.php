<?php

header('Content-Type: application/json');

require_once '../vendor/autoload.php';
require_once '../lib/Database.php';
require_once '../lib/Validate.php';


$validate = new Validate();



if($_SERVER['REQUEST_METHOD']=="POST")
{
   
  $errors = $validate->validation($data,[
                       'event_id'=>'required'
                     ]);


if(isset($_FILES['cover']['name']))
{
  $move_image = new image('cover');
  $move_image->extenImages =['jpeg','jpg','png'];
  $move_image->direction = '../uploads/';
  $move_image->path = microtime();
  $store_cover = $move_image->storage();

  $_POST['cover']=$store_cover;
}
  
if(isset($_FILES['permission']['name']))
{
  $move_image = new image('permission');
  $move_image->extenImages =['jpeg','jpg','png'];
  $move_image->direction = '../uploads/';
  $move_image->path = microtime();
  $store_permission = $move_image->storage();

  $_POST['permission']=$store_permission;
}
  

if(isset($_FILES['map']['name']))
{
  $move_image = new image('map');
  $move_image->extenImages =['jpeg','jpg','png'];
  $move_image->direction = '../uploads/';
  $move_image->path = microtime();
  $store_map = $move_image->storage();

  $_POST['map']=$store_map;
}

$id = $_POST['event_id'];
unset($_POST['event_id']);
  
  
  $update_event = Event::where('id', $id)->update($_POST);

    if($update_event)
    {
    	echo json_encode(["message"=>"your event has been updated successfully"]);
      http_response_code(200);
    }else
    {
    	echo json_encode(["errors"=>"somthing wrong happened please try again"]);
      http_response_code(400);
    }
}



?>