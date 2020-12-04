<?php session_start(); ?>

<?php
  
    require_once dirname(__DIR__).'/../vendor/autoload.php';
    require_once dirname(__DIR__).'/../lib/Database.php';
    require_once dirname(__DIR__).'/../lib/image.php';
    require_once dirname(__DIR__).'/../lib/Dashboard.php';
    $validate = new Dashboard();

    if($_SERVER['REQUEST_METHOD']=="POST")
    {
      

    	if($_POST['type']==1)
    	{

    		$email = $_POST['email'];
    		$password = $_POST['password'];

       $errors = $validate->validation($_POST,[
                 'email:email'=>'required',
                 'password:password'=>'required',
                  ]);
       if(count($errors)>0)
       {
           http_response_code(400);
          echo json_encode(['errors'=>$errors]);
          
          exit();
       }


    		$check_user = Admin::where('email',$email)->first();
    		
    		
    		if(!empty($check_user) && $password==$check_user->password)
    		{
    		     header('Content-Type: application/json');
    			$_SESSION['admin']=$check_user->id;
    		    echo json_encode(['success'=>'true']);
    		}else
    		{
    		       http_response_code(400);
                  $errors=['warn'=>'ربما يكون البريد او كلمة السر خاطئة'];
                  echo json_encode(['errors'=>$errors]);
                  exit();

    		}

    	}elseif ($_POST['type']==2)
    	{

            $id = $_SESSION['admin'];
            unset($_POST['type']);
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

           $id = $_SESSION['admin'];
           $img = $_FILES['image']['name'];
            if (!empty($img))
            {

                $move_image = new image('image');
                $move_image->extenImages =['jpeg','jpg','png'];
                $move_image->direction = '../../uploads/';
                $move_image->path = microtime();
                $store_image = $move_image->storage();
                $image=$store_image;
                $update = Admin::where('id',$id)->update(["img"=>$image]);
            }else
            {
              $errors=[];
              http_response_code(400);
              $errors[$img] = $img.' is required';
              echo json_encode(['errors'=>$errors]);
              exit();
            }

            if($update)
            {
                $_SESSION["success"] = "updated success";
                $success['success'] = 'تم التعديل بنجاح';
                echo json_encode(['success'=>$success]);
            }else
            {
              $errors=[];
              http_response_code(400);
              $errors['warn'] = 'something wrong happened please try agan later';
              echo json_encode(['errors'=>$errors]);
              exit();
            }

        }
    }
?>
