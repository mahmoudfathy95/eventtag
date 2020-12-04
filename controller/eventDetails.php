<?php
 
header('Content-Type: application/json');

require_once '../vendor/autoload.php';
require_once '../lib/Database.php';


if(isset($_GET['id']) and !empty($_GET['id']))
{
 $id = (int) $_GET['id'];
 $event = Event::with('user')->where("id",$id)->first();
 if($_SERVER['REQUEST_METHOD']=="POST")
{
  $data = json_decode(file_get_contents('php://input'), true);
  $query = Booth::query();
  
  if(isset($data['price_from']))
  {
      
    $price_from =$data['price_from'] ;  
    $query->where('price','>=',$price_from);
  }
  
  if(isset($data['price_to']))
  {
      
    $price_to =$data['price_to'] ;  
    $query->where('price','<=',$price_to);
  }

  $booths = $query->where('event_id',$id)->get();
 }else
 {
  $booths = Booth::where('event_id',$id)->get();
 }
 
 $event['booths'] = $booths;
 echo json_encode(["event"=>$event]);
}
?>