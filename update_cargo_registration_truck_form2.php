<!doctype html>
<html lang="en">
   <?php include 'include/head.php';?>
   <body>
      <!-- <body data-layout="horizontal" data-topbar="dark"> -->
      <!-- Begin page -->
      <div id="layout-wrapper">
         <?php include 'include/inside.php';?>
         <!-- ========== Left Sidebar Start ========== -->
         <?php include 'include/sidebar.php';?>
         <!-- Left Sidebar End -->
         <!-- ============================================================== -->
         <!-- Start right Content here -->
         <!-- ============================================================== -->
         <div class="main-content">
            <div class="page-content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="card">
                           <div class="card-body">
                              <?php 
                                 if(isset($_GET['id']))
                                 {
                                 	$data = $lundry->query("select * from tbl_request_truck where id=".$_GET['id']."")->fetch_assoc();
                                 	?>
                              <h4 class="card-title mb-4">Edit </h4>
                              <form method="post" enctype="multipart/form-data">
                                 <div class="form-group">
                                    <label> location</label>
                                    <input type="text" class="form-control" placeholder="Enter location" value="<?php echo $data['location'];?>" name="cname" required="">
                                 </div>
                            <div class="form-group">
                                    <label> Type of cargo</label>
                                    <input type="text" class="form-control" placeholder="Enter type of cargo" value="<?php echo $data['tcargo'];?>" name="flam" required="">
                                 </div>
                                 <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control" placeholder="Enter Description" value="<?php echo $data['description'];?>" name="desc" required="">
                                 </div>
                                    <div class="form-group">
                                    <label>Budget</label>
                                    <input type="text" class="form-control" placeholder="Enter budget" value="<?php echo $data['budget'];?>" name="budget" required="">
                                 </div>
                                    <div class="form-group">
                                    <label>Required Size</label>
                                    <input type="text" class="form-control" placeholder="Enter Required size" value="<?php echo $data['size'];?>" name="size" required="">
                                 </div>
                                 <div class="form-group">
                                    <label> Status</label>
                                    <select name="status" class="form-control" required>
                                       <option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
                                       <option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>UnPublish</option>
                                    </select>
                                 </div>
                                 <div class="col-12">
                                    <button type="submit" name="edit_cargoowner" class="btn btn-primary mb-2">Update</button>
                                 </div>
                              </form>
                              <?php }?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end row -->
               </div>
               <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            <!-- Transaction Modal -->
         </div>
         <!-- end main content-->
      </div>
      <?php include 'include/lundryfoot.php';?>

      <?php 
        if(isset($_POST['edit_cargoowner']))
        {
         	$cname = mysqli_real_escape_string($lundry,$_POST['cname']);
         	$idno = mysqli_real_escape_string($lundry,$_POST['flam']);
         	$desc = mysqli_real_escape_string($lundry,$_POST['desc']);
         	$budget = mysqli_real_escape_string($lundry,$_POST['budget']);
         	$size = mysqli_real_escape_string($lundry,$_POST['size']);
         	$okey = $_POST['status'];
         	$target_dir = "images/category/";
         	$temp = explode(".", $_FILES["front_img"]["name"]);
          $newfilename = round(microtime(true)) . '.' . end($temp);
          $target_file = $target_dir . basename($newfilename);
          	$temp2 = explode(".", $_FILES["back_img"]["name"]);
          $newfilename2 = round(microtime(true)) . '.' . end($temp2);
          $target_file2 = $target_dir . basename($newfilename2);

       
              $table="tbl_request_truck";
              $field = array('location'=>$cname,'tcargo'=>$idno,'description'=>$desc,'budget'=>$budget,'size'=>$size,'status'=>$okey);
              $where = "where id=".$_GET['id']."";
              $h = new Laundrore();
              $check = $h->lundryupdateData($field,$table,$where);
              if($check == 1)
              {
              ?>
              <script>
                iziToast.success({
                    title: ' Cargo Section!!',
                    message: 'Request truck Update Successfully!!',
                    position: 'topRight'
                  });
                      setTimeout(function(){ 
                  window.location.href="list_cargo_truck_request_location_form2.php"},3000);
              </script>
              <?php 
              }else{ ?>
                   <script>
                iziToast.error({
                    title: ' Cargo Section!!',
                    message: 'Request truck Update failed!!',
                    position: 'topRight'
                  });
                      setTimeout(function(){ 
                  window.location.href="list_cargo_truck_request_location_form2.php"},3000);
              </script>
                 <?php 
              }
            }
        
      ?>
   </body>
</html>