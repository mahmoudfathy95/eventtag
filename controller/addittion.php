<?php

header('Content-Type: application/json');

require_once '../vendor/autoload.php';
require_once '../lib/Database.php';

$categories = Category::with('products')->get();
if(count($categories)==0)
{
	$categories = array();
}



$data = ['categories'=>$categories];

echo json_encode($data); 

?>