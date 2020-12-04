<?php
     $menu = Permission::where('type',0)->orderby('sort','asc')->get();
     function check_permission($group_id,$permission_id)
     {
       $check = GroupPer::where('group_id',$group_id)->where('permission_id',$permission_id)->first();
       if(!empty($check))
       {
         return true;
       }else {
         return false;
       }
     }

 ?>


<div class="main-content">
<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
  <!--left-fixed -navigation-->
  <aside class="sidebar-left">
    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
          <h1><a class="navbar-brand" href="<?=$location?>/views/admin">
            Evento</a>
          </h1>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="<?=$location?>/views/admin">
              <i class="fa fa-dashboard"></i> <span>الرئيسية</span>
              </a>
            </li>
    <?php foreach ($menu as $key ) {

      if(check_permission($admin->group_id,$key->id)){

      ?>
           <li class="treeview">
              <a href="<?=$location.$key->url?>">
              <i class="fa fa-laptop"></i>
              <span><?=$key->name;?></span>
              </a>
            </li>
   <?php  }} ?>

          </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
  </aside>
</div>
  <!--left-fixed -navigation-->
