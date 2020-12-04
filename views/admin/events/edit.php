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


<div id="page-wrapper">
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="<?=$location?>/views/admin"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
      <li><a href="#">الايفنتات</a></li>
    </ol>
  </section>
<div class="main-page">


				<div class="forms">



					<div class="form-two widget-shadow">
						<div class="form-title">
							<h4>الايفنتات :</h4>
						</div>

					</div>

					<div class="row">

            <div class="form-horizontal panel-info widget-shadow">
							<div class=" form-group padding-all panel-body-inputin">

                <div class=" widget-shadow">
                  <div class=" col-md-6 panel-grids">
                    <div class="panel panel-default"> <div class="panel-heading">
                       <h3 class="panel-title">اسم مسجل الايفنت</h3> </div>
                     <div class="panel-body">
                       <?=isset($item->user->name)?$item->user->name:'';?>
                     </div>
                   </div>
                  </div>
                 </div>

                 <div class=" widget-shadow">
                   <div class=" col-md-6 panel-grids">
                     <div class="panel panel-default"> <div class="panel-heading">
                        <h3 class="panel-title">اسم الايفنت</h3> </div>
                      <div class="panel-body"><?=$item->eventName;?></div> </div>
                   </div>
                  </div>

                  <div class=" widget-shadow">
                    <div class=" col-md-6 panel-grids">
                      <div class="panel panel-default"> <div class="panel-heading">
                         <h3 class="panel-title">اسم القاعة</h3> </div>
                       <div class="panel-body"><?=$item->hallName;?></div> </div>
                    </div>
                   </div>

                   <div class=" widget-shadow">
                     <div class=" col-md-6 panel-grids">
                       <div class="panel panel-default"> <div class="panel-heading">
                          <h3 class="panel-title">المدينة</h3> </div>
                        <div class="panel-body"><?=$item->city;?></div> </div>
                     </div>
                    </div>

                    <div class=" widget-shadow">
                      <div class=" col-md-6 panel-grids">
                        <div class="panel panel-default"> <div class="panel-heading">
                           <h3 class="panel-title">تاريخ البدء </h3> </div>
                         <div class="panel-body"><?= date('Y-m-d',strtotime($item->day_from));?></div> </div>
                      </div>
                     </div>

                     <div class=" widget-shadow">
                       <div class=" col-md-6 panel-grids">
                         <div class="panel panel-default"> <div class="panel-heading">
                            <h3 class="panel-title">تاريخ الانتهاء </h3> </div>
                          <div class="panel-body"><?= date('Y-m-d',strtotime($item->day_to));?></div> </div>
                       </div>
                      </div>

                      <div class=" widget-shadow">
                        <div class=" col-md-6 panel-grids">
                          <div class="panel panel-default"> <div class="panel-heading">
                             <h3 class="panel-title">توقيت البدء  </h3> </div>
                           <div class="panel-body"><?= date('H:i',strtotime($item->time_from));?></div> </div>
                        </div>
                       </div>

                       <div class=" widget-shadow">
                         <div class=" col-md-6 panel-grids">
                           <div class="panel panel-default"> <div class="panel-heading">
                              <h3 class="panel-title">توقيت الانتهاء  </h3> </div>
                            <div class="panel-body"><?= date('H:i',strtotime($item->time_to));?></div> </div>
                         </div>
                        </div>

                        <div class=" widget-shadow">
                          <div class=" col-md-6 panel-grids">
                            <div class="panel panel-default"> <div class="panel-heading">
                               <h3 class="panel-title">cover </h3> </div>
                             <div class="panel-body"><img src="<?=$location;?>/<?=$item->cover;?>" width="150"></div> </div>
                          </div>
                         </div>

                         <div class=" widget-shadow">
                           <div class=" col-md-6 panel-grids">
                             <div class="panel panel-default"> <div class="panel-heading">
                                <h3 class="panel-title">permission </h3> </div>
                              <div class="panel-body"><img src="<?=$location;?>/<?=$item->permission;?>" width="150"></div> </div>
                           </div>
                          </div>

                          <div class=" widget-shadow">
                            <div class=" col-md-6 panel-grids">
                              <div class="panel panel-default"> <div class="panel-heading">
                                 <h3 class="panel-title">map </h3> </div>
                               <div class="panel-body"><img src="<?=$location;?>/<?=$item->map;?>" width="150"></div> </div>
                            </div>
                           </div>


                            <div class=" widget-shadow">
                              <div class=" col-md-12 panel-grids">
                                <div class="panel panel-default"> <div class="panel-heading">
                                   <h3 class="panel-title">الموقع </h3> </div>
                                 <div class="panel-body">
                                   <?php if(!empty($item->lat) && !empty($item->lang)){ ?>
                                    <input type="hidden" id="lat" value="<?=$item->lat;?>">
                                    <input type="hidden" id="long" value="<?=$item->lang;?>">

                                   <div class="map" id="map" style="height: 500px;">
                                   </div>

                                  <?php } ?>

                                 </div> </div>
                              </div>
                             </div>



							</div>
						</div>
					</div>
				</div>




			</div>





<?php require_once '../footer.php'; ?>
<script>
      var map;

      function initMap() {
        var late = parseFloat($('#lat').val());;
        var long = parseFloat($('#long').val());
         var myLatLng = {lat: late, lng: long};
        map = new google.maps.Map(document.getElementById('map'), {
          center: myLatLng,
          zoom: 8
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: 'Hello World!'
          });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdB-OtsN9eywcvWkkR0XKrVD8HiIxBEDE&callback=initMap"
  async defer></script>
