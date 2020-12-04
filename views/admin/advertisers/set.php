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
            $check_events = Event::where('user_id',$id)->get();
            if(count($check_events)>0)
            {
              $errors=[];
              http_response_code(400);
              $errors['warn'] = 'عفوا لا يمكنك مسح هذا المستخدم لان له ايفنتات';
              echo json_encode(['errors'=>$errors]);
              exit();
            }
             $check_orders = Order::where('user_id',$id)->get();
            if(count($check_orders)>0)
            {
              $errors=[];
              http_response_code(400);
              $errors['warn'] = 'عفوا لا يمكنك مسح هذا المستخدم لان له طلبات';
              echo json_encode(['errors'=>$errors]);
              exit();
            }
            
            $cat = User::destroy($id);
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
              $user = User::where('id',$id)->first();

                if($user->adminActive==0)
                {
                    $title = 'اهلا بك';
                  $body = 'لقد تم تفعيل الحساب الخاص بك';
                 $notification = $validate->notification($user->firebase,$body,$title);
                 $create_notification = Notification::create(['title'=>$title,'body'=>$body,'user_id'=>$user->id,'type'=>1,'type_id'=>$user->id]);
                  $cat = User::where('id',$id)->update(['adminActive'=>1]);
                  $status="ايقاف";
                }else {
                    $title = 'اهلا بك';
                  $body = 'لقد تم ايقاف الحساب الخاص بك';
                 $notification = $validate->notification($user->firebase,$body,$title);
                 $create_notification = Notification::create(['title'=>$title,'body'=>$body,'user_id'=>$user->id,'type'=>2,'type_id'=>$user->id]);
                  $cat = User::where('id',$id)->update(['adminActive'=>0]);
                  $status='تفعيل';
                }
                echo json_encode(['status'=>$status]);


          }
    }
?>
