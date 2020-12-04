<?php
session_start();

header('Content-Type: application/json');

require_once '../vendor/autoload.php';
require_once '../lib/Database.php';




$walk= Walk::get();
if(count($walk) == 0)
{
  $walk=[];
}

echo json_encode(['walkThrough'=>$walk]);



?>