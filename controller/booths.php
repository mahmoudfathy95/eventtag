<?php
session_start();

header('Content-Type: application/json');

require_once '../vendor/autoload.php';
require_once '../lib/Database.php';



if($_SERVER['REQUEST_METHOD']=="POST")
{
  $data = json_decode(file_get_contents('php://input'), true);

  $all =[];
  if(isset($data['booths']))
  {
  	 foreach ($data['booths'] as $key) 
	  {
	  	$booth = Booth::with('event')->where('id',$key)->first();
	  	array_push($all, $booth);
	  }

  }
 
  echo json_encode(['booths'=>$all]);
}


?>