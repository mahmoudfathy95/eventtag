<?php
session_start();

header('Content-Type: application/json');

require_once '../vendor/autoload.php';
require_once '../lib/Database.php';
require_once '../lib/Validate.php';


$validate = new Validate();



if($_SERVER['REQUEST_METHOD']=="POST")
{
   $data = json_decode(file_get_contents('php://input'), true);
  $errors = $validate->validation($data,[
                       'email'=>'required',
                       'password'=>'required',
                       'firebase'=>'required'
                     ]);

 
  $status="complete";
  $check_email= User::where('email',$data['email'])->first();
  $check_pass= User::where('password',$data['password'])->first();
  if(!empty($check_pass) && !empty($check_email))
  {
    if($check_email->type==1)
    {
      
      if(empty($check_email->brand))
      {
          $status = 'empyt';
      }
       
     
    }elseif($check_email->type== 2)
    {
        
        if(empty($check_email->company) || empty($check_email->expedition))
        {
            $status = 'empyt';
        }
    }
    
   if(empty($check_email->logo) || empty($check_email->front)  || empty($check_email->back)  || empty($check_email->cr) )
   {
      $status = 'empyt';
   }
   
   $update_firebase = User::where('id',$check_email->id)->update(['firebase'=>$data['firebase']]);
   
    echo json_encode(["message"=>"congrte ! login successed","type"=>"$check_email->type","token"=>$check_email->token,"status"=>$status]);
      http_response_code(200);
  }else
  {
  	echo json_encode(["message"=>"may be emil or paasword wrong please try again"]);
    http_response_code(400);
  }
}



?>