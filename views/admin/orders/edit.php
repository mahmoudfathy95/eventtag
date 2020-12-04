<?php session_start(); ?>


<?php $page ="admin";?>

<?php require_once '../header.php'; ?>
<?php require_once '../aside.php'; ?>
<?php

   if(isset($_GET['id']))
   {
    $id = $_GET['id'];
   	$item = Event::with('user')->find($id);

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
            الايفنتات

          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=$location?>/views/admin"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
            <li><a href="#"> الايفنتات</a></li>
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
                <div class="box-body" style="height: 700px;">
                  <form  id="update" method="post" role="form" enctype='multipart/form-data'>
                  	<input type="hidden" name="type" value="2">
                  	<input type="hidden" name="id" value="<?=$id;?>">
                    <!-- text input -->



	                    <div class="form-group col-md-12">

                        <div class="col-md-6">
 	                      <label>اسم مسجل الايفنت</label>
 	                      <p><?=isset($item->user->name)?$item->user->name:'';?></p>
 	                     </div>

	                     <div class="col-md-6">
	                      <label>اسم الايفنت</label>
	                      <p><?=$item->eventName;?></p>
	                     </div>

	                    <div class="col-md-6">
	                      <label>اسم القاعة</label>
	                      <p><?=$item->hallName;?></p>
	                    </div>

                    <div class="form-group" >
	                     <div class="col-md-6">
	                      <label>المدينة</label>
	                      <p><?=$item->city;?></p>
	                     </div>


	                </div>

                  <div class="form-group" >
                     <div class="col-md-6">
                      <label>تاريخ البدء </label>
                      <p><?= date('Y-m-d',strtotime($item->day_from));?></p>
                     </div>
                </div>

                <div class="form-group" >
                   <div class="col-md-6">
                    <label>تاريخ الانتهاء </label>
                    <p><?= date('Y-m-d',strtotime($item->day_to));?></p>
                   </div>
              </div>

              <div class="form-group" >
                 <div class="col-md-6">
                  <label>توقيت البدء </label>
                  <p><?= date('H:i',strtotime($item->time_from));?></p>
                 </div>
            </div>

            <div class="form-group" >
               <div class="col-md-6">
                <label>توقيت الانتهاء </label>
                <p><?= date('H:i',strtotime($item->time_to));?></p>
               </div>
          </div>

              <div class="form-group" >
                 <div class="col-md-6">
                  <label>cover  </label>
                  <p><img src="<?=$location;?>/<?=$item->cover;?>" width="150"></p>
                 </div>


            </div>

                <div class="form-group" >
                   <div class="col-md-6">
                    <label>permission</label>
                    <p><img src="<?=$location;?>/<?=$item->permission;?>" width="150"></p>
                   </div>


              </div>

              <div class="form-group" >
                 <div class="col-md-6">
                  <label>map</label>
                  <p><img src="<?=$location;?>/<?=$item->map;?>" width="150"></p>
                 </div>


            </div>

          <?php if(!empty($item->lat) && !empty($item->lang)){ ?>
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.3.1/css/ol.css" type="text/css">
           <input type="hidden" id="lat" value="<?=$item->lat;?>">
           <input type="hidden" id="long" value="<?=$item->lang;?>">

          <div class="map" id="map" style="height: 500px;">
          </div>

         <?php } ?>
                  </form>


                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div>
<?php require_once '../footer.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.3.1/build/ol.js"></script>
<script src="<?=$location?>/public/admin/dist/js/map.js"></script>
