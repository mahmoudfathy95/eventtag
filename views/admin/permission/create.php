<?php session_start();?>

<?php require_once '../header.php';?>



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
      <li><a href="#">  اضافة قسم</a></li>
    </ol>
  </section>
<div class="main-page">


				<div class="forms">



					<div class="form-two widget-shadow">
						<div class="form-title">
							<h4>  اضافة قسم:</h4>
						</div>

					</div>

					<div class="row">

						<div class="widget-shadow">
							<div class=" padding-all panel-body-inputin">
                <form  class="form-horizontal" id="create" method="post" role="form" enctype='multipart/form-data'>
                  <input type="hidden" name="type" value="1">
                  <div class="form-group">
										<label class="col-md-2 control-label">الاسم</label>
										<div class="col-md-8">
											<div class="input-group">
												<span class="input-group-addon">
												</span>
	                      <input type="text" name="name" class="form-control1 tab-child" id="name">
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
                        <input type="file" name="image" class="form-control1  tab-child" id="image">
                        <span id="image-error" style="color:red;"></span>
	                     </div>
											</div>
										</div>
								

                  <div class="form-group">

										<div class="col-md-8">
										<button type="submit" class="btn btn-default">حفظ</button>
										</div>
									</div>


								</form>
							</div>
						</div>
					</div>
				</div>




<?php require_once '../footer.php'; ?>
<script type="text/javascript">

  var radio = $('input[name=typecat]:checked').val();
    if(radio == 1)
    {
      $('#maincat').show();
    }else
    {
      $('#maincat').hide();
    }

 $('input[name=typecat]').change(function()
 {
    var radio = $(this).val();
    if(radio == 1)
    {
      $('#maincat').fadeIn();
    }else
    {
      $('#maincat').fadeOut();
    }
 });



$('#create').submit(function(e)
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
            $('.overlay').fadeOut();
            $.each(JSON.parse(errorMessage.responseText)['errors'], function(index, value)
            {
              console.log(index);
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




<?php require_once '../footer.php'; ?>
