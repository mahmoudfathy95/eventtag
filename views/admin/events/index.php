<?php session_start(); ?>

<?php $page ="admin"; ?>
<?php require_once '../header.php'; ?>
<?php require_once '../aside.php'; ?>
<?php

   $allevents = Event::with(['user'])->get();


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


					<h2 class="title1">الايفنتات</h2>



					<div class="bs-example widget-shadow" data-example-id="contextual-table">
						<h4>الايفنتات :</h4>


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
                    <th>#</th>
                    <th>اسم مسجل الايفنت</th>
                    <th>اسم الايفنت</th>
                    <th>اسم القاعة</th>
                    <th>المدينة</th>
                    <th>تاريخ البدء</th>
                    <th>تاريخ الانتهاء</th>
                    <th>توقيت البدء</th>
                    <th>توقيت الانتهاء</th>
                    <th>الحالة</th>
                    <th>الاكشاك</th>
                    <th>التفاصيل</th>
                    <th>حذف</th>
                  </tr>
                </thead>
                  <tbody>
                    <?php $i=1;foreach ($allevents as $key) {?>

                      <tr>
                        <td><?=$i;?></td>
                        <td><?=isset($key->user->name)?$key->user->name:'';?></td>
                        <td><?=$key->eventName;?></td>
                        <td><?=$key->hallName;?></td>
                        <td><?=$key->city;?></td>
                        <td><?php echo date('Y-m-d',strtotime($key->day_from));?></td>
                        <td><?php echo date('Y-m-d',strtotime($key->day_to));?></td>
                        <td><?php echo date('H:i',strtotime($key->time_from));?></td>
                        <td><?php echo date('H:i',strtotime($key->time_to));?></td>
                        <td class="activeAdmin">
                          <?php
                            if($key->active==0)
                            {
                              $status= 'تفعيل';
                            }else {
                              $status= "ايقاف";
                            }
                            ?>
                            
                              <?php
                             $permission_delete = Permission::where('name','الايفنتات')->where('action','active')->first();
                            if(check_permission($admin->group_id,$permission_delete->id)){
                             ?>
                            <div class="dic-active">
                              <button class="active btn btn-primary btn-flat  btn-lg" data-id="<?=$key->id;?>">
                                 <?php
                                   echo $status;
                                  ?>
                              </button>
                            </div>
                              <?php }?>


                        </td>
                        <td>
                           <a href="<?=$location?>/views/admin/booths/?id=<?=$key->id;?>">
                          <i class="fa fa-fw  fa-external-link"></i>
                        </td>
                        <td>
                           <a href="<?=$location?>/views/admin/events/edit.php?id=<?=$key->id;?>">
                        	<i class="fa fa-fw fa-edit"></i>
                        </td>

                        <td>
                            <?php
                           $permission_delete = Permission::where('name','الايفنتات')->where('action','delete')->first();
                          if(check_permission($admin->group_id,$permission_delete->id)){
                           ?>
                        	<button class="delete" data-id="<?=$key->id;?>">
                        		<i class="fa fa-fw fa-trash"></i>
                        	</button>
                        	<?php }?>

                        </td>
                      </tr>
                    <?php $i++;} ?>

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
          $('.overlay').fadeOut();
         
         
        }

    });
 }


});

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
