<?php

header('Content-Type: application/json');

require_once '../vendor/autoload.php';
require_once '../lib/Database.php';
require_once '../lib/Validate.php';


$validate = new Validate();



if($_SERVER['REQUEST_METHOD']=="POST")
{
  $data = json_decode(file_get_contents('php://input'), true);
   $query = Event::query();
   
   if(isset($data['eventName']))
   {
     $query->where('eventName','like', '%' . $data['eventName'] . '%');
   }

   if(isset($data['hallName']))
   {
     $query->where('hallName','like', '%' . $data['hallName'] . '%');
   }

   if(isset($data['city']))
   {
     $query->where('city','like', '%' . $data['city'] . '%');
   }

   if(isset($data['day_from']))
   {
     $query->where('day_from','>=', $data['day_from']);
   }

   if(isset($data['day_to']))
   {
     $query->where('day_to','<=', $data['day_to']);
   }

   if(isset($data['time_from']))
   {
     $query->where('time_from','>=', $data['time_from']);
   }

   if(isset($data['time_to']))
   {
     $query->where('time_to','<=', $data['time_to']);
   }

  if(isset($data['lat']))
  {
     $query->where('lat','like', '%' . $data['lat'] . '%');
  }

  if(isset($data['lang']))
  {
     $query->where('lang','like', '%' . $data['lang'] . '%');
  }
  

  $allEvents = $query->with(['booths','user'])->where('active',1)->get();
  echo json_encode(["allEvents"=>$allEvents]);   
  
  
}elseif($_SERVER['REQUEST_METHOD']=="GET")
{
 
  $allEvents = Event::with(['booths','user'])->where('active',1)->get();
  echo json_encode(["allEvents"=>$allEvents]);
}


?>