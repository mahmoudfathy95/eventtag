
<?php

require_once dirname(__DIR__).'/../vendor/autoload.php';
require_once dirname(__DIR__).'/../lib/Database.php';
$location = "https://eventatglobal.com";?>
<?php

     if(!isset($_SESSION['admin']) || empty($_SESSION['admin']))
     {
     ?>
    <script>
        window.location.href="login.php";
    </script>
   <?php
     }

  $id = $_SESSION['admin'];
  $admin = Admin::where('id',$id)->first();

?>

<!DOCTYPE HTML>
<html>
<head>
<title>Evento</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- Bootstrap Core CSS -->
<link href="<?=$location?>/public/admin/css/bootstrap.css" rel='stylesheet' type='text/css' />

<!-- Custom CSS -->
<link href="<?=$location?>/public/admin/css/style.css" rel='stylesheet' type='text/css' />

<!-- font-awesome icons CSS -->
<link href="<?=$location?>/public/admin/css/font-awesome.css" rel="stylesheet">
<!-- //font-awesome icons CSS-->

<!-- side nav css file -->
<link href='<?=$location?>/public/admin/css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
<!-- //side nav css file -->

 <!-- js-->
<script src="<?=$location?>/public/admin/js/jquery-1.11.1.min.js"></script>
<script src="<?=$location?>/public/admin/js/modernizr.custom.js"></script>

<!--webfonts-->
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<!--//webfonts-->

<!-- chart -->
<script src="<?=$location?>/public/admin/js/Chart.js"></script>
<!-- //chart -->

<!-- toaster -->
<link href="<?=$location?>/public/admin/css/jquery.toast.css" rel="stylesheet">
<!-- //toaster -->



<!-- Metis Menu -->
<script src="<?=$location?>/public/admin/js/metisMenu.min.js"></script>
<script src="<?=$location?>/public/admin/js/custom.js"></script>
<link href="<?=$location?>/public/admin/css/custom.css" rel="stylesheet">
<!--//Metis Menu -->
<style>
#chartdiv {
  width: 100%;
  height: 295px;
}
</style>
<!--pie-chart --><!-- index page sales reviews visitors pie chart -->
<script src="<?=$location?>/public/admin/js/pie-chart.js" type="text/javascript"></script>
 <script type="text/javascript">

        $(document).ready(function () {
            $('#demo-pie-1').pieChart({
                barColor: '#2dde98',
                trackColor: '#eee',
                lineCap: 'round',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

            $('#demo-pie-2').pieChart({
                barColor: '#8e43e7',
                trackColor: '#eee',
                lineCap: 'butt',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

            $('#demo-pie-3').pieChart({
                barColor: '#ffc168',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });


        });

    </script>
<!-- //pie-chart --><!-- index page sales reviews visitors pie chart -->

	<!-- requried-jsfiles-for owl -->
					<link href="<?=$location?>/public/admin/css/owl.carousel.css" rel="stylesheet">
					<script src="<?=$location?>/public/admin/js/owl.carousel.js"></script>
						<script>
							$(document).ready(function() {
								$("#owl-demo").owlCarousel({
									items : 3,
									lazyLoad : true,
									autoPlay : true,
									pagination : true,
									nav:true,
								});
							});
						</script>
					<!-- //requried-jsfiles-for owl -->

<link href="<?=$location?>/public/admin/css/datatables.css">
  </head>
<body class="cbp-spmenu-push">


<!-- header-starts -->
<div class="sticky-header header-section ">
  <div class="header-left">
    <!--toggle button start-->
    <button id="showLeftPush"><i class="fa fa-bars"></i></button>
    <!--toggle button end-->
    <div class="profile_details_left"><!--notifications of menu start -->
      <ul class="nofitications-dropdown">


      </ul>
      <div class="clearfix"> </div>
    </div>
    <!--notification menu end -->
    <div class="clearfix"> </div>
  </div>
  <div class="header-right">



    <div class="profile_details">
      <ul>
        <li class="dropdown profile_details_drop">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <div class="profile_img">
              <span class="prfil-img"><img src="<?=$location;?>/<?=$admin->img;?>" alt="" width="50"> </span>
              <div class="user-name">
                <p><?=$admin->username;?></p>
                <span>Administrator</span>
              </div>
              <i class="fa fa-angle-down lnr"></i>
              <i class="fa fa-angle-up lnr"></i>
              <div class="clearfix"></div>
            </div>
          </a>
          <ul class="dropdown-menu drp-mnu">

            <li> <a href="<?=$location?>/views/admin/profile.php"><i class="fa fa-suitcase"></i> اعدادات الحساب</a> </li>
            <li> <a href="<?=$location?>/views/admin/logout.php"><i class="fa fa-sign-out"></i> تسجيل الخروج</a> </li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="clearfix"> </div>
  </div>
  <div class="clearfix"> </div>
</div>
<!-- //header-ends -->

<?php require_once 'aside.php'; ?>
