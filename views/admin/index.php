<?php session_start();?>

<?php require_once 'header.php';?>

<div id="page-wrapper">
  <div class="main-page">
  <div class="col_3">
      <div class="col-md-3 widget widget1">
        <div class="r3_counter_box">
                <i class="pull-left fa fa-lemon-o icon-rounded"></i>
                <div class="stats">
                  <h5><strong><?=count(Event::all());?></strong></h5>
                  <span>عدد الايفنتات</span>
                </div>
            </div>
      </div>
      <div class="col-md-3 widget widget1">
        <div class="r3_counter_box">
                <i class="pull-left fa  fa-sun-o user1 icon-rounded"></i>
                <div class="stats">
                  <h5><strong><?=count(Product::all());?></strong></h5>
                  <span>عدد المنتجات</span>
                </div>
            </div>
      </div>
      <div class="col-md-3 widget widget1">
        <div class="r3_counter_box">
                <i class="pull-left fa fa-money user2 icon-rounded"></i>
                <div class="stats">
                  <h5><strong><?=count(Order::where('active',1)->get());?></strong></h5>
                  <span>عدد الطلبات المكتملة</span>
                </div>
            </div>
      </div>

      <div class="col-md-3 widget widget1">
        <div class="r3_counter_box">
                <i class="pull-left fa fa-money user2 icon-rounded"></i>
                <div class="stats">
                  <h5><strong><?=count(Order::where('active',0)->get());?></strong></h5>
                  <span>عدد الطلبات فى الانتظار</span>
                </div>
            </div>
      </div>

      <div class="col-md-3 widget widget1">
        <div class="r3_counter_box">
                <i class="pull-left fa fa-users dollar2 icon-rounded"></i>
                <div class="stats">
                  <h5><strong><?=count(User::where('type',1)->get());?></strong></h5>
                  <span>عدد المستخدمين</span>
                </div>
            </div>
       </div>

       <div class="col-md-3 widget widget1">
         <div class="r3_counter_box">
                 <i class="pull-left fa fa-users dollar2 icon-rounded"></i>
                 <div class="stats">
                   <h5><strong><?=count(User::where('type',2)->get());?></strong></h5>
                   <span>عدد المعلنين</span>
                 </div>
             </div>
        </div>
      <div class="clearfix"> </div>
</div>



  </div>
</div>




<?php require_once 'footer.php'; ?>
