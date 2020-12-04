<?php

header('Content-Type: application/json');

require_once '../vendor/autoload.php';
require_once '../lib/Database.php';
require_once '../lib/Validate.php';


$validate = new Validate();



if($_SERVER['REQUEST_METHOD']=="POST")
{
  $data = json_decode(file_get_contents('php://input'), true);

  if(!isset($_GET['token']) || empty($_GET['token']))
  {
    http_response_code(400);
    echo json_encode(["message"=>"please login first"]);
    exit();
  }

  if(!isset($_GET['type']))
  {
    $type = 1;
  }else
  {
    $type=$_GET['type'];
  }

  $_token = $_GET['token'];
  $user = User::where('token',$_token)->first();
  
  if(empty($user))
  {
      http_response_code(400);
    echo json_encode(["message"=>"please login first"]);
    
    exit();
  }

  

   if($type == 1)
  {
      
    $query= Booth::query();
    $query->with('event')->with('order');
    $query->whereHas('order', function($q) use ($user)
      {
        
          $q->where('user_id',$user->id);
    
      });
      
   if(isset($data['boothName']))
   {
     $query->where('name','like', '%' . $data['boothName'] . '%');
   }
   
    if(isset($data['price_form']))
   {
     $query->where('price','>=',$data['price_form']);
   }
   
    if(isset($data['price_to']))
   {
     $query->where('price','<=',$data['price_to']);
   }
   
     if(isset($data['eventName']))
   {
     
     $query->whereHas('event', function($q) use ($data)
      {
        $q->where('eventName','like', '%' . $data['eventName'] . '%');

      });
   }
   
   
   if(isset($data['hallName']))
   {
     $query->whereHas('event', function($q) use ($data)
      {
        $q->where('hallName','like', '%' . $data['hallName'] . '%');

      });
   }

   if(isset($data['city']))
   {
     $query->whereHas('event', function($q) use ($data)
      {
        $q->where('city','like', '%' . $data['city'] . '%');

      });
   }

   if(isset($data['day_from']))
   {
     $query->whereHas('event', function($q) use ($data)
      {
        $q->where('day_from','>=', $data['day_from']);

      });
   }

   if(isset($data['day_to']))
   {
    $query->whereHas('event', function($q) use ($data)
      {
        $q->where('day_to','<=', $data['day_to']);

      });
   }

   if(isset($data['time_from']))
   {
     $query->whereHas('event', function($q) use ($data)
      {
        $q->where('time_from','>=', $data['time_from']);

      });
   }

   if(isset($data['time_to']))
   {
     $query->whereHas('event', function($q) use ($data)
      {
        $q->where('time_to','<=', $data['time_to']);

      });
   }

  if(isset($data['lat']))
  {
     $query->whereHas('event', function($q) use ($data)
      {
        $q->where('lat','like', '%' . $data['lat'] . '%');

      });
  }

  if(isset($data['lang']))
  {
   
      $query->whereHas('event', function($q) use ($data)
      {
        $q->where('lang','like', '%' . $data['lang'] . '%');
      });
  }
   
  
      
      
    $myReservation = $query->get();
    
    $data=[];
    
    foreach($myReservation as $key)
    {
        $orders = $key->order;
        unset($key->order);
        foreach($orders as $k)
        {
            $key->order=$k;
            array_push($data,$key);
        }
    }
    
    echo json_encode(["booths"=>$data]);

  }elseif($type == 2)
  {
      
    $query= Booth::query();
    $query->with('event')->with('order');
    $query->whereHas('event', function($q) use ($user)
      {
        $q->where('user_id',$user->id);
        
    
      });
      
    if(isset($data['boothName']))
   {
     $query->where('name','like', '%' . $data['boothName'] . '%');
   }
     
    if(isset($data['price_form']))
   {
     $query->where('price','>=',$data['price_form']);
   }
   
    if(isset($data['price_to']))
   {
     $query->where('price','<=',$data['price_to']);
   }
   
    if(isset($data['eventName']))
   {
     
     $query->whereHas('event', function($q) use ($data)
      {
        $q->where('eventName','like', '%' . $data['eventName'] . '%');

      });
   }

   if(isset($data['hallName']))
   {
     $query->whereHas('event', function($q) use ($data)
      {
        $q->where('hallName','like', '%' . $data['hallName'] . '%');

      });
   }

   if(isset($data['city']))
   {
     $query->whereHas('event', function($q) use ($data)
      {
        $q->where('city','like', '%' . $data['city'] . '%');

      });
   }

   if(isset($data['day_from']))
   {
     $query->whereHas('event', function($q) use ($data)
      {
        $q->where('day_from','>=', $data['day_from']);

      });
   }

   if(isset($data['day_to']))
   {
    $query->whereHas('event', function($q) use ($data)
      {
        $q->where('day_to','<=', $data['day_to']);

      });
   }

   if(isset($data['time_from']))
   {
     $query->whereHas('event', function($q) use ($data)
      {
        $q->where('time_from','>=', $data['time_from']);

      });
   }

   if(isset($data['time_to']))
   {
     $query->whereHas('event', function($q) use ($data)
      {
        $q->where('time_to','<=', $data['time_to']);

      });
   }

  if(isset($data['lat']))
  {
     $query->whereHas('event', function($q) use ($data)
      {
        $q->where('lat','like', '%' . $data['lat'] . '%');

      });
  }

  if(isset($data['lang']))
  {
   
      $query->whereHas('event', function($q) use ($data)
      {
        $q->where('lang','like', '%' . $data['lang'] . '%');
      });
  }
   
   
    $myReservation = $query->get();
    
    $data=[];
    
    foreach($myReservation as $key)
    {
        $orders = $key->order;
        unset($key->order);
        foreach($orders as $k)
        {
            $key->order=$k;
            array_push($data,$key);
        }
    }
    
    echo json_encode(["booths"=>$data]);
    

  }
  
  
  
}else
{

  
  if(!isset($_GET['token']) || empty($_GET['token']))
  {
    http_response_code(400);
    echo json_encode(["message"=>"please login first"]);
    exit();
  }

  if(!isset($_GET['type']))
  {
    $type = 1;
  }else
  {
    $type=$_GET['type'];
  }

  $_token = $_GET['token'];
  $user = User::where('token',$_token)->first();



  if(empty($user))
  {
      http_response_code(400);
    echo json_encode(["message"=>"please login first"]);
    
    exit();
  }

  if($type == 1)
  {
    $query= Booth::query();
    $query->with('event')->with('order');
    $query->whereHas('order', function($q) use ($user)
      {
        
          $q->where('user_id',$user->id);
    
      });
    $myReservation = $query->get();
    
    $data=[];
    
    foreach($myReservation as $key)
    {
        $orders = $key->order;
        unset($key->order);
        foreach($orders as $k)
        {
            $key->order=$k;
            array_push($data,$key);
        }
    }
    
    echo json_encode(["booths"=>$data]);
    
  }elseif($type == 2)
  {
    $query= Booth::query();
    $query->with('event')->with('order');
    $query->whereHas('event', function($q) use ($user)
      {
        $q->where('user_id',$user->id);
        
    
      });
    $myReservation = $query->get();
    
    $data=[];
    
    foreach($myReservation as $key)
    {
        $orders = $key->order;
        unset($key->order);
        foreach($orders as $k)
        {
            $key->order=$k;
            array_push($data,$key);
        }
    }
    
    echo json_encode(["booths"=>$data]);

  }
  
  
 

}



?>