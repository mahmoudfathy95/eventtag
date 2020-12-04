<?php

header('Content-Type: application/json');

require_once '../vendor/autoload.php';
require_once '../lib/Database.php';
require_once '../lib/Validate.php';


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
  
  if(empty($user->company) || empty($user->expedition) ||  empty($user->logo) || empty($user->front)  || empty($user->back)  || empty($user->cr))
        {
            http_response_code(400);
            echo json_encode(["message"=>"please complete your profile first"]);
            
            exit();
        }
       
  if($user->adminActive == 0)
  {
    http_response_code(400);
    echo json_encode(["message"=>"this account under approval"]);
    
    exit();
  }

  $errors = $validate->validation($_POST,[
                       'eventName'=>'required|string',
                       'hallName'=>'required|string',
                       'city'=>'required|string',
                       'day_from'=>'required',
                       'day_to'=>'required',                   
                       'time_from'=>'required',
                       'time_to'=>'required',    
                       'lat'=>'required',
                       'lang'=>'required',
                       'booths'=>'required',
                        ]);


  if(empty($_FILES['cover']['name']))
  {
     
      http_response_code(400);
    echo json_encode(['message'=>'cover is required']);
    
    exit();
  }

  if(empty($_FILES['permission']['name']))
  { http_response_code(400);
    echo json_encode(['message'=>'permission is required']);
   
    exit();
  }

  if(empty($_FILES['map']['name']))
  {
    echo json_encode(['message'=>'map is required']);
    http_response_code(400);
    exit();
  }

  $move_image = new image('cover');
  $move_image->extenImages =['jpeg','jpg','png'];
  $move_image->direction = '../uploads/';
  $move_image->path = microtime();
  $store_cover = $move_image->storage();

  $_POST['cover']=$store_cover;

  $move_image = new image('permission');
  $move_image->extenImages =['jpeg','jpg','png'];
  $move_image->direction = '../uploads/';
  $move_image->path = microtime();
  $store_permission = $move_image->storage();

  $_POST['permission']=$store_permission;

  $move_image = new image('map');
  $move_image->extenImages =['jpeg','jpg','png'];
  $move_image->direction = '../uploads/';
  $move_image->path = microtime();
  $store_map = $move_image->storage();

  $_POST['map']=$store_map;

  $last_event = Event::orderBy('created_at','desc')->first();
  if (empty($last_event)) 
  {
    $_POST['id'] = 1;
  }else
  {
    $_POST['id'] = $last_event->id+1;
  }
  
  $booths = explode(',', $_POST['booths']);
  unset($_POST['booths']);
  
  $_POST['user_id']=$user->id;

  $add_event = Event::create($_POST);

  
  foreach ($booths as $key) 
  {
    $booth = explode('-', $key);
    $add_booth = Booth::create(['name'=>$booth[0],'price'=>$booth[1],'event_id'=>$_POST['id']]);
  }


    if($add_event)
    {
    	echo json_encode(["message"=>"your event has been added successfully"]);
      http_response_code(200);
    }else
    {
    	echo json_encode(["message"=>"somthing wrong happened please try again"]);
      http_response_code(400);
    }
}



?>