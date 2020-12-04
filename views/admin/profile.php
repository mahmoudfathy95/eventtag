<?php session_start();?>

<?php require_once 'header.php';?>



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
      <li><a href="#">اعدادات الحساب</a></li>
    </ol>
  </section>
<div class="main-page">


				<div class="forms">



					<div class="form-two widget-shadow">
						<div class="form-title">
							<h4>اعدادات الحساب :</h4>
						</div>

					</div>

					<div class="row">

						<div class="widget-shadow">
							<div class=" padding-all panel-body-inputin">
                <form  class=" form-horizontal" id="update" method="post" role="form" enctype='multipart/form-data'>
                  <input type="hidden" name="type" value="2">
                  <div class="form-group">
										<label class="col-md-2 control-label">الاسم</label>
										<div class="col-md-8">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-user"></i>
												</span>
                        <input type="text" name="username" class="form-control1 tab-child" id="username" value="<?=isset($admin->username)?$admin->username:'';?>">
                        <span id="username-error" style="color:red;"></span>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">كلمة المرور</label>
										<div class="col-md-8">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-key"></i>
												</span>
                        <input type="password" name="password" class="form-control1 tab-child" id="password" value="<?=isset($admin->password)?$admin->password:'';?>">
                        <span id="password-error" style="color:red;"></span>
											</div>
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

        <div class="forms">



					<div class="form-two widget-shadow">
						<div class="form-title">
							<h4> تغيير الصورة :</h4>
						</div>

					</div>

					<div class="row">

						<div class="widget-shadow">
							<div class=" padding-all panel-body-inputin">
                <form  class=" form-horizontal" id="image" method="post" role="form" enctype='multipart/form-data'>
                     <input type="hidden" name="type" value="3">
                	<div class="form-group">
										<label class="col-md-2 control-label">الصورة</label>
										<div class="col-md-8">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-image"></i>
												</span>
                        <input type="file" name="image" class="form-control1 tab-child1" id="image-field">
                        <span id="image-error" style="color:red;"></span>
											</div>
										</div>
									</div>

                  <div class="form-group" >
                    <div class="col-md-12">
                      <img width="100" src="<?=$location;?>/<?=isset($admin->img)?$admin->img:'';?>">
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



			</div>
</div>




<?php require_once 'footer.php'; ?>

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
          $.toast({
                  text: "تم التعديل بنجاح", // Text that is to be shown in the toast
                  heading: '', // Optional heading to be shown on the toast
                  icon: 'success', // Type of toast icon
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
                  beforeHide: function () {location.reload()}, // will be triggered before the toast gets hidden
                  afterHidden: function () {}  // will be triggered after the toast has been hidden
              });

        },error:function(errorMessage)
        {
          $('.overlay').fadeOut();
          $.each(JSON.parse(errorMessage.responseText)['errors'], function(index, value)
          {

             if(index == "warn")
             {
               $('#warn-error').html('<div class="callout callout-danger"><p>'+value+'</p></div>');
             }else
             {
               $('#'+index).css('border','1px solid red');
               $('#'+index+'-error').text(value);

             }

          });
        }

    });
  }

});

$('#image').submit(function(e)
{
    e.preventDefault(e);

    $form = $(this);
    var action = $form.attr('action');
    var vali = validate1();
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
                $.each(JSON.parse(responce)['success'], function(index, value)
                  {
                     toastcheck(value,'success','',location.reload());
        
                  });
                
            }
           
         
         


        },error:function(errorMessage)
        {
          $('.overlay').fadeOut();
        
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

function validate1()
{
   var x,y,i,check=true;
    x = document.getElementsByClassName("tab-child1");
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
