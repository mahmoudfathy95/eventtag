<?php session_start(); ?>

<?php
    
    require_once dirname(__DIR__).'/../../lib/Database.php';
    require_once dirname(__DIR__).'/../../lib/model.php';
    require_once dirname(__DIR__).'/../../lib/image.php';
    $model = new model();
    $model->set('contacts');
     
    if($_SERVER['REQUEST_METHOD']=="POST")
    {

    	if($_POST['type']==1)
    	{
    		$name_ar = $_POST['namear'];
    		$name_en = $_POST['nameen'];

    		$move_image = new image('image');
            $move_image->path = microtime();
            $store_image = $move_image->storage();
            $image=$store_image;

    		if($_POST['typecat']==1)
    		{
              if(!empty($_POST['catid']))
              {
                $add = $model->create(["name_ar"=>$name_ar,"name_en"=>$name_en,"cat_id"=>$_POST['catid'],"img"=>$image,"type"=>0]);
              }else
              {
              	$add = $model->create(["name_ar"=>$name_ar,"name_en"=>$name_en,"img"=>$image,"type"=>1]);
              }
    		}else
    		{
    			$add = $model->create(["name_ar"=>$name_ar,"name_en"=>$name_en,"img"=>$image,"type"=>2]);
    		}

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
    		unset($_POST['type']);
            unset($_POST['id']);

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
            $cat = $model->destroy($id);
            if($cat)
            {
              $_SESSION["success"] = "deleted success";
                echo "true";  
            }else
            {
               echo "false"; 
            }

        } 
    }
?>