<?php session_start(); ?>

<?php $page ="admin"; ?>
<?php require_once '../header.php'; ?>
<?php require_once '../aside.php'; ?>
<?php

$mainMenu = Permission::where('type',0)->get();
if(isset($_GET['id']))
{
  $id = $_GET['id'];
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


<div id="page-wrapper" style="min-height: 172px;">
			<div class="main-page">
				<div class="tables">


					<h2 class="title1">الصلاحيات</h2>



					<div class="bs-example widget-shadow" data-example-id="contextual-table">
            <h4 style="display:inline-block">الصلاحيات :</h4>
            <div class="row">

            					<div class="col-md-12 general-grids1 grids-right widget-shadow">

            						<ul id="myTabs" class="nav nav-tabs" role="tablist">
                          <li role="presentation" class=" per-tit">
                            <a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
                             صلاحيات الافعال
                            </a>
                          </li>
                          <li role="presentation" class="active per-tit">
                            <a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">
                              صلاحيات القوائم الرئيسة
                            </a>
                          </li>
                        </ul>

            						<div id="myTabContent" class="tab-content scrollbar1" tabindex="5001" style="overflow: hidden; outline: none;">
                          <div role="tabpanel" class="tab-pane fade " id="home" aria-labelledby="home-tab">
                            <table  class="table">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>اسم القائمة</th>
                                    <th>اضافة</th>
                                    <th>تعديل</th>
                                    <th>حذف</th>
                                    <th>تفعيل</th>
                                  </tr>
                                </thead>
                                  <tbody>
                                    <?php $i=1;foreach($mainMenu as $key) {?>
                                      <tr>
                                        <td><?=$i;?></td>
                                        <td><?=$key->name;?></td>
                                        <td>
                                          <?php
                                            $check_create = Permission::where('type',$key->id)->where('action','create')->first();
                                            if(!empty($check_create)){
                                            $check = GroupPer::where('group_id',$id)->where('permission_id',$check_create->id)->first();
                                            if(!empty($check))
                                            {
                                              $checked = 'checked';
                                            }else {
                                              $checked='';
                                            }
                                           ?>
                                          <input type="checkbox" data-id="<?=$check_create->id;?>" name="show" class="show" <?=$checked;?>>
                                        <?php } ?>
                                        </td>

                                        <td>
                                          <?php
                                            $check_update = Permission::where('type',$key->id)->where('action','update')->first();
                                            if(!empty($check_update)){
                                            $check = GroupPer::where('group_id',$id)->where('permission_id',$check_update->id)->first();
                                            if(!empty($check))
                                            {
                                              $checked = 'checked';
                                            }else {
                                              $checked='';
                                            }
                                           ?>
                                          <input type="checkbox" data-id="<?=$check_update->id;?>" name="show" class="show" <?=$checked;?>>
                                        <?php } ?>
                                        </td>

                                        <td>
                                          <?php
                                            $check_delete = Permission::where('type',$key->id)->where('action','delete')->first();
                                            if(!empty($check_delete)){
                                            $check = GroupPer::where('group_id',$id)->where('permission_id',$check_delete->id)->first();
                                            if(!empty($check))
                                            {
                                              $checked = 'checked';
                                            }else {
                                              $checked='';
                                            }
                                           ?>
                                          <input type="checkbox" data-id="<?=$check_delete->id;?>" name="show" class="show" <?=$checked;?>>
                                        <?php } ?>
                                        </td>

                                        <td>
                                          <?php
                                            $check_active = Permission::where('type',$key->id)->where('action','active')->first();
                                            if(!empty($check_active)){
                                            $check = GroupPer::where('group_id',$id)->where('permission_id',$check_active->id)->first();
                                            if(!empty($check))
                                            {
                                              $checked = 'checked';
                                            }else {
                                              $checked='';
                                            }
                                           ?>
                                          <input type="checkbox" data-id="<?=$check_active->id;?>" name="show" class="show" <?=$checked;?>>
                                        <?php } ?>
                                        </td>

                                      </tr>
                                    <?php $i++;} ?>

                                  </tbody>
                            </table>

                          </div>


                          <div role="tabpanel" class="tab-pane fade active in" id="profile" aria-labelledby="profile-tab">
                            <table id="example1" class="table">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>اسم القائمة</th>
                                    <th>عرض/اخفاء</th>
                                  </tr>
                                </thead>
                                  <tbody>
                                    <?php $i=1;foreach($mainMenu as $key) {?>
                                      <tr>
                                        <td><?=$i;?></td>
                                        <td><?=$key->name;?></td>
                                        <td>
                                          <?php
                                            $check = GroupPer::where('group_id',$id)->where('permission_id',$key->id)->first();
                                            if(!empty($check))
                                            {
                                              $checked = 'checked';
                                            }else {
                                              $checked='';
                                            }
                                           ?>
                                          <input type="checkbox" data-id="<?=$key->id;?>" name="show" class="show" <?=$checked;?>>
                                        </td>

                                      </tr>
                                    <?php $i++;} ?>

                                  </tbody>
                            </table>
                          </div>
                         </div>
            					</div>
            					<div class="clearfix"> </div>
            				</div>


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

  $('.show').on("click",function(e)
{
    // e.preventDefault(e);
    var id = $(this).data('id');
    var group = "<?=$id;?>";

    $('.overlay').fadeIn();
    $.ajax(
    {
        url:'set.php',
        type: "POST",
        data: {id: id,group: group,type: 1},
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
                   toastcheck(value,'success','','');

                });
            }




        },error:function(errorMessage)
        {

        }

    });

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
