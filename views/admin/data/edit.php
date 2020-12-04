<?php session_start(); ?>

<?php $page ="data";?>

<?php require_once '../header.php'; ?>
<?php require_once '../aside.php'; ?>
<?php require_once '../../../lib/Database.php'; ?>
<?php require_once '../../../lib/model.php'; ?>
<?php
   $model = new model();
   $model->set('contacts');
   
   if(isset($_GET['id']))
   {
   	$id=$_GET['id'];
   	$item = $model->find($id);
   }
?>

<style type="text/css">
  .overlay
  {
    position: fixed;
    top: 0;
    left: 0;
    background: rgba(0,0,0,.5);
    width: 100%;
    height: 100%;
    z-index: 10000;
    display: none;

  }

  .overlay i
  {
    color: #fff;
    font-size: 40px;
    position: absolute;
    top: 50%;
    right: 50%;
  }
</style>
<div class="overlay">
  <i class="fa fa-refresh fa-spin"></i>
</div>

<div class="content-wrapper" style="min-height: 946px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           بيانات الموقع
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=$location?>/views/admin"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
            <li><a href="#"> بيانات الموقع</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
           
            <!-- right column -->
            <div class="col-md-12">
               <div class="alert-warn">
              
            </div>
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header with-border">
                  
                </div><!-- /.box-header -->
                <div class="box-body" style="height: 300px;">
                  <form  id="update" method="post" role="form" enctype='multipart/form-data'>
                  	<input type="hidden" name="type" value="2">
                  	<input type="hidden" name="id" value="<?=$id;?>">
                    <!-- text input -->
	                    <div class="form-group">
	                     <div class="col-md-6">					
	                      <label>الفيسبوك</label>
	                      <input type="text" name="facebook" class="form-control tab-child" id="facebook" value="<?=isset($item->facebook)?$item->facebook:'';?>">
	                     </div>

	                    <div class="col-md-6">	
	                      <label>تويتر</label>
	                      <input type="text" name="twitter" class="form-control tab-child" id="twitter" value="<?=isset($item->twitter)?$item->twitter:'';?>">
	                     </div>
	                    </div>

                      <div class="form-group">
                       <div class="col-md-6">         
                        <label>انستجرام</label>
                        <input type="text" name="instgram" class="form-control tab-child" id="instgram" value="<?=isset($item->instgram)?$item->instgram:'';?>">
                       </div>

                      <div class="col-md-6">  
                        <label>الواتس</label>
                        <input type="text" name="whatsapp" class="form-control tab-child" id="whatsapp" value="<?=isset($item->whatsapp)?$item->whatsapp:'';?>">
                       </div>
                      </div>

                      <div class="form-group">
                       <div class="col-md-6">         
                        <label>التليفون</label>
                        <input type="text" name="phone" class="form-control tab-child" id="phone" value="<?=isset($item->phone)?$item->phone:'';?>">
                       </div>

                      </div>
                   
	                <div class="form-group col-md-12"style="margin-top: 20px;">
            <button type="submit" class="btn btn-primary">تعديل</button>
        </div>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div>
<?php require_once '../footer.php'; ?>

<script type="text/javascript">
	
$('#update').submit(function(e)
{
    e.preventDefault(e);

    $form = $(this);
    var action = $form.attr('action');
    var vali = validate();
    if(vali==true)
    {
      $('.overlay').fadeIn();
    $.ajax(
    {
        url:'set.php',
        type:'post',
        data:new FormData(this),
        contentType:false,
        processData:false,
        success:function(responce)
        {
         
            window.location.href="index.php";
         
            
            
            
        },error:function(errorMessage)
        {
           console.log('Error' + errorMessage);
        }

    });
  }

});

$('input,textarea').keyup(function(event){
   $(this).css('border',"1px solid green");
});

$('input,select').change(function(event){
   $(this).css('border',"1px solid green");
});


function validate()
{
   var x,y,i,check=true;
    x = document.getElementsByClassName("tab-child");
   console.log($(x[1]).val().length);
   for (i = 0; i < x.length; i++) 
   {
     if($(x[i]).val().length==0)
     {
      $(x[i]).css("border","1px solid red");
      check=false
     }
   }

   return check;
   
}

</script>