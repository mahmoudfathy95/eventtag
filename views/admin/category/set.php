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
    		$name = $_POST['name'];

        $errors = $validate->validation($_POST,[
                  'name:name'=>'required'
                   ]);
        if(count($errors)>0)
        {
           echo json_encode(['errors'=>$errors]);
           http_response_code(404);
           exit();
        }

        $img = $_FILES['image']['name'];
        if(empty($img))
        {
          $errors=[];
          http_response_code(400);
          $errors[$img] = $this->name.' is required';
          echo json_encode(['errors'=>$errors]);
          exit();
        }

    		$move_image = new image('image');
            $move_image->extenImages =['jpeg','jpg','png'];
            $move_image->path = microtime();
            $store_image = $move_image->storage();

    		$create = Category::create(["name"=>$name,"img"=>$store_image]);


    		if($create)
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
        unset($_POST['id']);
        unset($_POST['type']);
    		$name = $_POST['name'];

        $errors = $validate->validation($_POST,[
                  'name:name'=>'required'
                   ]);
        if(count($errors)>0)
        {
           echo json_encode(['errors'=>$errors]);
           http_response_code(404);
           exit();
        }

        $img = $_FILES['image']['name'];

        if (!empty($img))
        {

            $move_image = new image('image');
            $move_image->extenImages =['jpeg','jpg','png'];
            $move_image->path = microtime();
            $store_image = $move_image->storage();
            $_POST['img']=$store_image;
        }

        $update = Category::where('id',$id)->update($_POST);

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
            $check_products = Product::where('cat_id',$id)->get();
            if(count($check_products)>0)
            {
              $errors=[];
              http_response_code(400);
              $errors['warn'] = 'عفوا لا يمكنك مسح هذا القسم لانه يحتوى على منتجات';
              echo json_encode(['errors'=>$errors]);
              exit();
            }
            $cat = Category::destroy($id);
            if($cat)
            {
              $_SESSION["success"] = "deleted success";
                echo "true";
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
