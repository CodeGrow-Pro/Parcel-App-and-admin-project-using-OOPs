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
                                 	$data = $lundry->query("select * from tbl_cargoowner where id=".$_GET['id']."")->fetch_assoc();
                                 	?>
                              <h4 class="card-title mb-4">Edit Cargo Owner </h4>
                              <form method="post" enctype="multipart/form-data">
                                 <div class="form-group">
                                    <label>Cargo Owner Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Cargo Owner Name" value="<?php echo $data['cname'];?>" name="cname" required="">
                                 </div>
                                 <div class="form-group">
                                    <label>Cargo Owner ID Proof</label>
                                    <input type="text" class="form-control" placeholder="Enter Cargo Owner ID Proof" value="<?php echo $data['idno'];?>" name="idno" required="">
                                 </div>
                                 <div class="form-group">
                                    <label>Front Image</label>
                                    <input type="file" name="front_img" class="form-control">
                                    <br>
                                 </div>
                                 <div class="form-group">
                                    <label>Back Image</label>
                                    <input type="file" name="back_img" class="form-control">
                                    <br>
                                 </div>
                                 <div class="form-group">
                                    <img src="<?php echo $data['front_img'];?>" width="100px"/>
                                    <img src="<?php echo $data['back_img'];?>" width="100px"/>
                                 </div>
                                 <div class="form-group">
                                    <label>Cargo Owner Status</label>
                                    <select name="status" class="form-control" required>
                                       <option value="1" <?php if($data['cat_status'] == 1){echo 'selected';}?>>Publish</option>
                                       <option value="0" <?php if($data['cat_status'] == 0){echo 'selected';}?>>UnPublish</option>
                                    </select>
                                 </div>
                                 <div class="col-12">
                                    <button type="submit" name="edit_cargoowner" class="btn btn-primary mb-2">Update</button>
                                 </div>
                              </form>
                              <?php } else { ?>
                              <h4 class="card-title mb-4">Add Cargo Owner </h4>
                              <!-- start page title -->
                              <form method="post" enctype="multipart/form-data">
                                 <div class="form-group">
                                    <label>Cargo Owner Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Cargo Owner Name" name="cname" required="">
                                 </div>
                                 <div class="form-group">
                                    <label>Cargo Owner Id Proof</label>
                                    <input type="text" class="form-control" placeholder="Enter Cargo Owner Id No" name="idno" required="">
                                 </div>
                                 <div class="form-group">
                                    <label>Cargo Owner Front Image</label>
                                    <input type="file" name="front_img" class="form-control"  required="">
                                 </div>
                                 <div class="form-group">
                                    <label>Cargo Owner Back Image</label>
                                    <input type="file" name="back_img" class="form-control"  required="">
                                 </div>
                                 <div class="form-group">
                                    <label>Cargo Owner Status</label>
                                    <select name="status" class="form-control" required="">
                                       <option value="1">Publish</option>
                                       <option value="0">UnPublish</option>
                                    </select>
                                 </div>
                                 <div class="col-12">
                                    <button type="submit" name="add_cargoowner" class="btn btn-primary mb-2">Add Cargo Owner</button>
                                 </div>
                              </form>
                              <?php } ?>
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
          if(isset($_POST['add_cargoowner']))
          {
         	
            $cname = mysqli_real_escape_string($lundry,$_POST['cname']);
            $idno = mysqli_real_escape_string($lundry,$_POST['idno']);
            $okey = $_POST['status'];
            
            $target_dir = "images/category/";
            $temp = explode(".", $_FILES["front_img"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            $target_file = $target_dir . basename($newfilename);
            move_uploaded_file($_FILES["front_img"]["tmp_name"], $target_file);
         		   $target_dir = "images/category/";
            $temp1 = explode(".", $_FILES["back_img"]["name"]);
            $newfilename1 = round(microtime(true)) . '.' . end($temp1);
            $target_file1 = $target_dir . basename($newfilename1);
            move_uploaded_file($_FILES["back_img"]["tmp_name"], $target_file1);
         
         
            $table="tbl_cargoowner";
            $field_values=array("cname","idno","cat_status","front_img","back_img");
            $data_values=array("$cname","$idno","$okey","$target_file","$target_file1");
         
            $h = new Laundrore();
            $check = $h->lundryinsertdata($field_values,$data_values,$table);
            if($check == 1)
            {
            ?>
              <script>
                iziToast.success({
                    title: ' Cargo Owner Add Successfully!!',
                    message: ' Cargo Owner Section!!',
                    position: 'topRight'
                  });
                  
                  setTimeout(function(){ 
                  window.location.href="add_cargoowner.php"},3000);
                  
              </script>
            <?php 
            }
         
         	}
        ?>

      <?php 
        if(isset($_POST['edit_cargoowner']))
        {
         	$cname = mysqli_real_escape_string($lundry,$_POST['cname']);
         	$idno = mysqli_real_escape_string($lundry,$_POST['idno']);
         	$okey = $_POST['status'];
         	$target_dir = "images/category/";
         	$temp = explode(".", $_FILES["front_img"]["name"]);
          $newfilename = round(microtime(true)) . '.' . end($temp);
          $target_file = $target_dir . basename($newfilename);
          	$temp2 = explode(".", $_FILES["back_img"]["name"]);
          $newfilename2 = round(microtime(true)) . '.' . end($temp2);
          $target_file2 = $target_dir . basename($newfilename2);

          if($_FILES["front_img"]["name"] != '' && $_FILES["back_img"]["name"] != '')
          {
            move_uploaded_file($_FILES["front_img"]["tmp_name"], $target_file);
            move_uploaded_file($_FILES["back_img"]["tmp_name"], $target_file2);
            $table="tbl_cargoowner";
            $field = array('cname'=>$cname,'idno'=>$idno,'cat_status'=>$okey,'front_img'=>$target_file,'back_img'=>$target_file2);
            $where = "where id=".$_GET['id']."";
            $h = new Laundrore();
            $check = $h->lundryupdateData($field,$table,$where);
            if($check == 1)
            {
            ?>
              <script>
                iziToast.success({
                    title: ' Cargo Owner Section!!',
                    message: ' Cargo Owner Update Successfully!!',
                    position: 'topRight'
                  });
                      setTimeout(function(){ 
                  window.location.href="list_cargo_owner.php"},3000);
                  
                  
              </script>
            <?php 
            }
            }else  if($_FILES["back_img"]["name"] != '' && $_FILES["front_img"]["name"] == ''){
         
            // ...................... back image
         
            $temp = explode(".", $_FILES["back_img"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            $target_file = $target_dir . basename($newfilename);			
            if($_FILES["back_img"]["name"] != '' && $_FILES["front_img"]["name"] == '')
            {
              move_uploaded_file($_FILES["back_img"]["tmp_name"], $target_file);
              $table="tbl_cargoowner";
              $field = array('cname'=>$cname,'idno'=>$idno,'cat_status'=>$okey,'back_img'=>$target_file);
              $where = "where id=".$_GET['id']."";
              $h = new Laundrore();
              $check = $h->lundryupdateData($field,$table,$where);
              if($check == 1)
              {
              ?>
              <script>
                iziToast.success({
                    title: ' Cargo Owner Section!!',
                    message: ' Cargo Owner Update Successfully!!',
                    position: 'topRight'
                  });
                      setTimeout(function(){ 
                  window.location.href="list_cargo_owner.php"},3000);
              </script>
              <?php 
              }
            }
            }else  if($_FILES["back_img"]["name"] == '' && $_FILES["front_img"]["name"] != ''){
         
            // ...................... back image
         
            $temp = explode(".", $_FILES["front_img"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            $target_file = $target_dir . basename($newfilename);			
            if($_FILES["back_img"]["name"] == '' && $_FILES["front_img"]["name"] != '')
            {
              move_uploaded_file($_FILES["front_img"]["tmp_name"], $target_file);
              $table="tbl_cargoowner";
              $field = array('cname'=>$cname,'idno'=>$idno,'cat_status'=>$okey,'front_img'=>$target_file);
              $where = "where id=".$_GET['id']."";
              $h = new Laundrore();
              $check = $h->lundryupdateData($field,$table,$where);
              if($check == 1)
              {
              ?>
              <script>
                iziToast.success({
                    title: ' Cargo Owner Section!!',
                    message: ' Cargo Owner Update Successfully!!',
                    position: 'topRight'
                  });
                      setTimeout(function(){ 
                  window.location.href="list_cargo_owner.php"},3000);
              </script>
              <?php 
              }
            }
            }
         	  else 
            {
              $table="tbl_cargoowner";
              $field = array('cname'=>$cname,'idno'=>$idno,'cat_status'=>$okey);
              $where = "where id=".$_GET['id']."";
              $h = new Laundrore();
              $check = $h->lundryupdateData($field,$table,$where);
              if($check == 1)
              {
              ?>
              <script>
                iziToast.success({
                    title: ' Cargo Owner Section!!',
                    message: ' Cargo Owner Update Successfully!!',
                    position: 'topRight'
                  });
                      setTimeout(function(){ 
                  window.location.href="list_cargo_owner.php"},3000);
              </script>
              <?php 
              }
            }
          }
        
      ?>
   </body>
</html>