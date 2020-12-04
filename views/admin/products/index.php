

<?php session_start(); ?>


<?php require_once '../header.php'; ?>
<?php

$allCategories = Product::with('category')->get();

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


<div id="page-wrapper" style="min-height: 172px;">
			<div class="main-page">
				<div class="tables">


					<h2 class="title1">المنتجات</h2>



					<div class="bs-example widget-shadow" data-example-id="contextual-table">
						<h4 style="display:inline-block">المنتجات :</h4>
						
						  <?php
             $permission_create = Permission::where('name','المنتجات')->where('action','create')->first();
            if(check_permission($admin->group_id,$permission_create->id)){
             ?>

            <a class="btn btn-default" href="<?=$location;?>/views/admin/products/create.php" style="background-color: #F2B33F;float: left;display: inline-block;">
              <i class="fa fa-fw fa-fire"></i>
              اضافة منتج
            </a>
              <?php } ?>



                      <?php if(isset($_SESSION['success'])){ ?>
                      <div class="panel panel-success">
                        <div class="panel-heading">

                          <p><?=$_SESSION['success'];?></p>
                        </div>
                      </div>
                      <?php unset($_SESSION['success']); } ?>


                      <?php if(isset($_SESSION['error'])){ ?>
                      <div class="panel panel-danger">
                        <div class="panel-heading">

                           <p><?=$_SESSION['error'];?></p>
                        </div>
                      </div>
                      <?php } ?>

                      <div  id ="warn" class="panel panel-danger">

                      <p></p>
                      </div>

						<table id="example1" class="table">
                <thead>
                  <tr>
                    <th> الاسم </th>
                    <th>القسم </th>
                    <th>الصورة </th>

                    <th>تعديل</th>
                    <th>حذف</th>
                  </tr>
                </thead>
                  <tbody>
                    <?php foreach ($allCategories as $key) {?>
                      <tr>
                        <td><?=$key->name;?></td>
                        <td><?=$key->category->name;?></td>
                        <td>
                          <img src="<?=$location;?>/<?=$key->img;?>" width="150">
                        </td>
                        <td>
                            <?php
                           $permission_edit = Permission::where('name','المنتجات')->where('action','update')->first();
                          if(check_permission($admin->group_id,$permission_edit->id)){
                           ?>
                           <a href="<?=$location?>/views/admin/products/edit.php?id=<?=$key->id;?>">
                          <i class="fa fa-fw fa-edit"></i></td>
                           </a>
                           <?php } ?>
                        <td>
                              <?php
                           $permission_delete = Permission::where('name','المنتجات')->where('action','delete')->first();
                          if(check_permission($admin->group_id,$permission_delete->id)){
                           ?>
                          <button class="delete" data-id="<?=$key->id;?>">
                            <i class="fa fa-fw fa-trash"></i>
                          </button>
                          <?php } ?>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
            </table>
					</div>

				</div>
			</div>
		</div>


<?php require_once '../footer.php'; ?>


<script type="text/javascript">

$('.dic-active').on('click',function(){

  var id = $(this).find('button').data('id');

  var that = this;
  $('.overlay').fadeIn();
  $.ajax(
   {
       url:'set.php',
       type: "POST",
       data: {id: id, type: 4},
       success:function(responce)
       {
         $('.overlay').fadeOut();
         $(that).find('button').html(JSON.parse(responce)['status']);

       },error:function(errorMessage)
       {
          console.log('Error' + errorMessage);
       }

   });

});

  $('.delete').on("click",function(e)
{
    e.preventDefault(e);
    var id = $(this).data('id');
 var confirmed=confirm('هل متاكد من انك تريد حذف هذا العنصر؟');
 if(confirmed)
 {

     $('.overlay').fadeIn();
  $.ajax(
    {
        url:'set.php',
        type: "POST",
        data: {id: id, type: 3},
        success:function(responce)
        {


            window.location.href="index.php";


        },error:function(errorMessage)
        {
          $('.overlay').fadeOut();
          $.toast({
    text: "لا يمكن مسح هذا الايفنت لوجود طلبات عليه", // Text that is to be shown in the toast
    heading: 'خطأ', // Optional heading to be shown on the toast
    icon: 'error', // Type of toast icon
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
    afterHidden: function () {}  // will be triggered after the toast has been hidden
});

          $.each(JSON.parse(errorMessage.responseText)['errors'], function(index, value)
          {

             if(index == "warn")
             {
               $('#warn').html('<div class="panel-heading"><p>'+value+'</p></div>');
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
</script>
