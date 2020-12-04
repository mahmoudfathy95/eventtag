<?php session_start(); ?>

<?php 

$page ="data";?>

<?php require_once '../header.php'; ?>
<?php require_once '../aside.php'; ?>
<?php require_once '../../../lib/Database.php'; ?>
<?php require_once '../../../lib/model.php'; ?>
<?php

   $model = new model();
   $model->set('contacts');
   $data = $model->first();
?>

 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            بيانات الموقع
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=$location?>/views/admin"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
            <li><a href="#">بيانات الموقع</a></li>
          </ol>
        </section>


        

           
      

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

            <?php if(isset($_SESSION['success'])){ ?>
            <div class="callout callout-success">
            
            <p><?=$_SESSION['success'];?></p>
            </div>
            <?php unset($_SESSION['success']); } ?>


            <?php if(isset($_SESSION['error'])){ ?>
            <div class="callout callout-warning">
            
            <p><?=$_SESSION['error'];?></p>
            </div>
            <?php } ?>
            
                
              <div class="box">
                <div class="box-header">
               <!-- <a href="<?=$location?>/views/admin/category/create.php" class="btn bg-navy btn-flat margin">اضافة قسم</a> -->
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table style="overflow: scroll;display: block;" id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>الفيسبوك</th>
                        <th>تويتر</th>
                        <th>انستجرام</th>
                        <th>الواتس</th>
                        <th>التليفون</th>
                        <th>تعديل</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                    
                      <tr>
                        <td><?=$data->facebook;?></td>
                        <td><?=$data->twitter;?></td>
                         <td><?=$data->instgram;?></td>
                        <td><?=$data->whatsapp;?></td>
                        <td><?=$data->phone;?></td>
                        
                        <td>
                           <a href="<?=$location?>/views/admin/data/edit.php?id=<?=$data->id;?>">
                        	<i class="fa fa-fw fa-edit"></i></td>
                           </a>
                       
                      </tr>
                    
                      
                    </tbody>
                   
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php require_once '../footer.php'; ?>

<script type="text/javascript">
  $('.delete').on("click",function(e)
{
    e.preventDefault(e);
    var id = $(this).data('id');
 var confirmed=confirm('هل متاكد من انك تريد حذف هذا العنصر؟');
 if(confirmed)
 {
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
           console.log('Error' + errorMessage);
        }

    });
 }
    

});
</script>