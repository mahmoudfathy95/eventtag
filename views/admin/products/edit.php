<?php session_start(); ?>

<?php $page ="products";?>

<?php require_once '../header.php'; ?>
<?php require_once '../aside.php'; ?>
<?php

   $allCategories = Category::get();

   if(isset($_GET['id']))
   {
    $id = $_GET['id'];
   	$item = Product::find($id);
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

<div id="page-wrapper">
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="<?=$location?>/views/admin"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
      <li><a href="#">  تعديل منتج</a></li>
    </ol>
  </section>
<div class="main-page">


				<div class="forms">



					<div class="form-two widget-shadow">
						<div class="form-title">
							<h4>  تعديل منتج:</h4>
						</div>

					</div>

					<div class="row">

						<div class="widget-shadow">
							<div class=" padding-all panel-body-inputin">
                <form  class="form-horizontal" id="update" method="post" role="form" enctype='multipart/form-data'>
                  <input type="hidden" name="type" value="2">
                  <input type="hidden" name="id" value="<?=$id;?>">
                  <div class="form-group">
                    <label class="col-md-2 control-label">الاسم</label>
                    <div class="col-md-8">
                      <div class="input-group">
                        <span class="input-group-addon">
                        </span>
                        <select name="cat_id" class="form-control1 tab-child" id="cat_id">
                          <option value="">اختر قسم رئيسي</option>
                          <?php
                          foreach ($allCategories as $key) {?>
                            <option <?=(isset($item->cat_id)&& $item->cat_id==$key->id)?'selected':'';?> value="<?=$key->id;?>">
                                <?=$key->name;?>
                              </option>
                          <?php } ?>
                        </select>
                        <span id="cat_id-error" style="color:red;"></span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
										<label class="col-md-2 control-label">الاسم</label>
										<div class="col-md-8">
											<div class="input-group">
												<span class="input-group-addon">
												</span>
                        <input type="text" name="name" class="form-control1 tab-child" id="name" value="<?=isset($item->name)?$item->name:'';?>">
                        <span id="name-error" style="color:red;"></span>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">الصورة</label>
										<div class="col-md-8">
											<div class="input-group">
												<span class="input-group-addon">
												</span>
                        <input type="file" name="image" class="form-control1" id="image">
                        <span id="image-error" style="color:red;"></span>
	                     </div>
											</div>
										</div>

                    <div class="form-group">
                      <label class="col-md-2 control-label">التفاصيل</label>
                      <div class="col-md-8">
                        <div class="input-group">
                          <span class="input-group-addon">
                          </span>
                          <textarea name="details" class="form-control tab-child" id="details"><?=isset($item->details)?$item->details:'';?></textarea>
                          <span id="details-error" style="color:red;"></span>
                         </div>
                        </div>
                      </div>

                    <div class="form-group">
                      <div class="col-md-6">
                       <img style="padding-top: 34px;" width="150" src="<?=$location;?>/<?=isset($item->img)?$item->img:'';?>">
                      </div>
                    </div>


                  <div class="form-group">

										<div class="col-md-8">
										<button type="submit" class="btn btn-default">تعديل</button>
										</div>
									</div>


								</form>
							</div>
						</div>
					</div>
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
             $('.overlay').fadeOut();
             
            if(JSON.parse(responce)['errors'])
            {
                $.each(JSON.parse(responce)['errors'], function(index, value)
                  {
                     toastcheck(value,'error','خطأ','');
        
                  });
            }else
            {
                window.location.href="index.php";
                
            }
           

            


        },error:function(errorMessage)
        {
        
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



function toastcheck(text,icon,heading,fun)
{
     $.toast({
            text: text, // Text that is to be shown in the toast
            heading:heading, // Optional heading to be shown on the toast
            icon: icon, // Type of toast icon
            showHideTransition: 'slide', // fade, slide or plain
            allowToastClose: false, // Boolean value true or false
            hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
            stack: 10, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
            position: 'top-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
            textAlign: 'right',  // Text alignment i.e. left, right or center
            loader: true,  // Whether to show loader or not. True by default
            loaderBg: '#000',  // Background color of the toast loader
            beforeShow: function () {}, // will be triggered before the toast is shown
            afterShown: function () {}, // will be triggered after the toat has been shown
            beforeHide: function () {}, // will be triggered before the toast gets hidden
            afterHidden: function () {fun}  // will be triggered after the toast has been hidden
              });
}
</script>