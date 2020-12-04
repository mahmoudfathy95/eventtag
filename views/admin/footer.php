
   <!--//footer-->
</div>

<!-- new added graphs chart js-->

   <script src="<?=$location?>/public/admin/js/Chart.bundle.js"></script>
   <script src="<?=$location?>/public/admin/js/utils.js"></script>


<!-- Classie --><!-- for toggle left push menu script -->
  <script src="<?=$location?>/public/admin/js/classie.js"></script>
  <script>
    var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
      showLeftPush = document.getElementById( 'showLeftPush' ),
      body = document.body;

    showLeftPush.onclick = function() {
      classie.toggle( this, 'active' );
      classie.toggle( body, 'cbp-spmenu-push-toright' );
      classie.toggle( menuLeft, 'cbp-spmenu-open' );
      disableOther( 'showLeftPush' );
    };


    function disableOther( button ) {
      if( button !== 'showLeftPush' ) {
        classie.toggle( showLeftPush, 'disabled' );
      }
    }
  </script>
<!-- //Classie --><!-- //for toggle left push menu script -->

<!--scrolling js-->
<script src="<?=$location?>/public/admin/js/jquery.nicescroll.js"></script>
<script src="<?=$location?>/public/admin/js/scripts.js"></script>
<!--//scrolling js-->

<!-- side nav js -->
<script src='<?=$location?>/public/admin/js/SidebarNav.min.js' type='text/javascript'></script>
<script>
     $('.sidebar-menu').SidebarNav()
   </script>
<!-- //side nav js -->



<!-- Bootstrap Core JavaScript -->
  <script src="<?=$location?>/public/admin/js/bootstrap.js"> </script>
<!-- //Bootstrap Core JavaScript -->

<!-- <script src="<?=$location?>/public/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=$location?>/public/admin/plugins/datatables/dataTables.bootstrap.min.js"></script> -->
<script src="<?=$location?>/public/admin/js/datatables.js"></script>
<!-- toaster -->
<script src="<?=$location?>/public/admin/js/jquery.toast.js"> </script>
<!-- //toaster -->


 <script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>

</body>
</html>
