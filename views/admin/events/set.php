<?php session_start(); ?>

<?php

require_once dirname(__DIR__).'/../../vendor/autoload.php';
require_once dirname(__DIR__).'/../../lib/Database.php';
require_once dirname(__DIR__).'/../../lib/image.php';
require_once dirname(__DIR__).'/../../lib/Dashboard.php';
$validate = new Dashboard();

    if($_SERVER['REQUEST_METHOD']=="POST")
    {

    	if($_POST['type']==1)
    	{
    		unset($_POST['type']);

    		$move_image = new image('image');
            $move_image->path = microtime();
            $store_image = $move_image->storage();
            $image=$store_image;
            $_POST['img']=$image;
    		$add = $model->create($_POST);


    		if($add)
    		{
               $_SESSION["success"] = "added success";
    			echo "true";
    		}else
    		{
    			echo "false";
    		}

    	}elseif ($_POST['type']==2)
    	{

            $id = $_POST['id'];
            $img = $_FILES['image']['name'];
            unset($_POST['type']);
            unset($_POST['id']);

            if (!empty($img))
            {

                $move_image = new image('image');
                $move_image->path = microtime();
                $store_image = $move_image->storage();
                $image=$store_image;
                $_POST['img']=$image;
            }

            $update = $model->update($id,$_POST);
    		if($update)
    		{
                $_SESSION["success"] = "updated success";
    			echo "true";
    		}else
    		{
    			echo "false";
    		}
    	}elseif ($_POST['type']==3)
        {
            $id = $_POST['id'];
            $check_events = Order::where('event_id',$id)->get();
            // if(count($check_events)>0)
            // {
            //   $errors=[];
            //   http_response_code(400);
            //   $errors['warn'] = 'عفوا لايمكن مسح هذا الايفنت لان له طلبات';
            //   echo json_encode(['errors'=>$errors]);
            //   exit();
            // }
            $cat = Event::destroy($id);
            $orders = Order::where('event_id',$id)->get();
            foreach($orders as $key)
            {
                $delete_request = Request::where('order_id',$key->id)->delete();
                
            }
            $delete_orders = Order::where('event_id',$id)->delete();
            $delete_booths = Booth::where('event_id',$id)->delete();
            
            if($cat)
            {
              $_SESSION["success"] = "deleted success";
                echo "true";
            }else
            {
               echo "false";
            }

        }elseif ($_POST['type']==4)
          {
              $id = $_POST['id'];
              $user = Event::where('id',$id)->first();
              $get_user = User::where('id',$user->user_id)->first();

                if($user->active==0)
                {
                    $title = 'اهلا بك';
                  $body = 'لقد تم تفعيل الايفنت الخاص بك';
                  $body .= $user->eventName;
                 $notification = $validate->notification($get_user->firebase,$body,$title);
                 $create_notification = Notification::create(['title'=>$title,'body'=>$body,'user_id'=>$get_user->id,'type'=>3,'type_id'=>$user->id]);
                  $cat = Event::where('id',$id)->update(['active'=>1]);
                  $status="ايقاف";
                }else {
                    $title = 'اهلا بك';
                  $body = 'لقد تم ايقاف الايفنت الخاص بك';
                  $body .= $user->eventName;
                 $notification = $validate->notification($get_user->firebase,$body,$title);
                 $create_notification = Notification::create(['title'=>$title,'body'=>$body,'user_id'=>$get_user->id,'type'=>2,'type_id'=>$user->id]);
                  $cat = Event::where('id',$id)->update(['active'=>0]);
                  $status='تفعيل';
                }
                echo json_encode(['status'=>$status]);


          }
    }
?>
