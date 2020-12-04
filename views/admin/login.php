<?php session_start(); ?>


<?php

require_once dirname(__DIR__).'/../vendor/autoload.php';
require_once dirname(__DIR__).'/../lib/Database.php';

$location = "https://eventatglobal.com/";
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Evento | Log in</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- Bootstrap Core CSS -->
<link href="<?=$location?>/public/admin/css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- toaster -->
<link href="<?=$location?>/public/admin/css/jquery.toast.css" rel="stylesheet">
<!-- //toaster -->
<link href="<?=$location?>/public/admin/css/login.css" rel='stylesheet' type='text/css' />

<body>
  <div class="login-wrap">
	<div class="login-html" style="direction: rtl;">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">تسجيل الدخول</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
		<div class="login-form">

        <form class="form-signin" id="login"  method="post">
      <input type="hidden" name="type" value="1">
			<div class="sign-in-htm">
				<div class="group">
					<label for="user" class="label">الايميل</label>
          <input type="email" name="email" id="email" class="input tab-child" placeholder="ادخل الايميل">
          <span id="email-error" style="color:red;"></span>
				</div>
				<div class="group">
					<label for="pass" class="label">كلمة المرور</label>
          <input type="password" name="password" id="password" class="input tab-child" placeholder="ادخل كلمة المرور">
            <span id="password-error" style="color:red;"></span>
           <div class="form-group has-feedback">  </div>
				</div>
				<div class="group">
					<div class="checkbox icheck"></div>
				</div>
				<div class="group">
					<input type="submit" class="button" value="تسجيل الدخول">
				</div>

			</div>
    </form>

		</div>
	</div>
</div>








  </body>
  </html>
<script src="<?=$location?>/public/admin/js/jquery-1.11.1.min.js"></script>
<script src="<?=$location?>/public/admin/js/bootstrap.js"> </script>
<script src="<?=$location?>/public/admin/js/bootstrap.bundle.min.js"> </script>
<!-- toaster -->
<script src="<?=$location?>/public/admin/js/jquery.toast.js"> </script>
<!-- //toaster -->

<script type="text/javascript">


$('#login').submit(function(e)
{
    e.preventDefault(e);

    $form = $(this);
    var action = $form.attr('action');
    var vali = validate();
    if(vali==true)
    {
    $.ajax(
    {
        url:'set.php',
        type:'post',
        data:new FormData(this),
        contentType:false,
        processData:false,
        success:function(responce)
        {
            console.log(responce);
           if (JSON.parse(responce)['success']) {
             window.location.href="index.php";
            }
            else {
                   $.each(JSON.parse(responce)['errors'], function(index, value)
          {
              
               $.toast({
                 text: value, // Text that is to be shown in the toast
                 heading: '', // Optional heading to be shown on the toast
                 icon: 'error', // Type of toast icon
                 showHideTransition: 'slide', // fade, slide or plain
                 allowToastClose: false, // Boolean value true or false
                 hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                 stack: 10, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                 position: 'bottom-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                 textAlign: 'right',  // Text alignment i.e. left, right or center
                 loader: true,  // Whether to show loader or not. True by default
                 loaderBg: '#000',  // Background color of the toast loader
                 beforeShow: function () {}, // will be triggered before the toast is shown
                 afterShown: function () {}, // will be triggered after the toat has been shown
                 beforeHide: function () {}, // will be triggered before the toast gets hidden
                 afterHidden: function () {}  // will be triggered after the toast has been hidden
                   });
             

          });
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

</script>
