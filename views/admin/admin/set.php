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
        $move_image->extenImages =['jpeg','jpg','png'];
        $move_image->path = microtime();
        $store_image = $move_image->storage();
        $_POST['img']=$store_image;
    		$add = Admin::create($_POST);


    		if($add)
    		{
          $_SESSION["success"] = "added success";
    			echo "true";
    		}else
    		{
          $errors=[];
         http_response_code(400);
         $errors['warn'] = 'something wrong happened please try agan later';
         echo json_encode(['errors'=>$errors]);
         exit();
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
              $move_image->extenImages =['jpeg','jpg','png'];
              $move_image->path = microtime();
              $store_image = $move_image->storage();
              $_POST['img']=$store_image;
            }

            $update = Admin::where('id',$id)->update($_POST);
    		if($update)
    		{
                $_SESSION["success"] = "updated success";
    			echo "true";
    		}else
    		{
          $errors=[];
         http_response_code(400);
         $errors['warn'] = 'something wrong happened please try agan later';
         echo json_encode(['errors'=>$errors]);
         exit();
    		}
    	}elseif ($_POST['type']==3)
        {
            $id = $_POST['id'];
            $cat = Admin::destroy($id);
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
              $user = Admin::where('id',$id)->first();

                if($user->active==0)
                {
                  $cat = Admin::where('id',$id)->update(['active'=>1]);
                  $status="ايقاف";
                }else {
                  $cat = Admin::where('id',$id)->update(['active'=>0]);
                  $status='تفعيل';
                }
                echo json_encode(['status'=>$status]);


          }
    }
?>
