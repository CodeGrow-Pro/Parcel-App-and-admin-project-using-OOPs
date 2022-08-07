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
                                $data = $lundry->query("select * from tbl_setting")->fetch_assoc();
                              ?>
                              <h4 class="card-title mb-4">Edit Setting </h4>
                              <h5 class="h5_set"><i class="fa fa-gear fa-spin"></i>  General  Information</h5>
                              <form method="post" enctype="multipart/form-data">
                                 <div class="row">
                                    <div class="form-group col-4">
                                       <label><span class="text-danger">*</span> Website Name</label>
                                       <input type="text" class="form-control " placeholder="Enter Store Name" value="<?php echo $data['webname'];?>" name="webname" required="">
                                    </div>
                                    <div class="form-group col-4" style="margin-bottom: 48px;">
                                       <label><span class="text-danger">*</span> Website Image</label>
                                       <div class="custom-file">
                                          <input type="file" name="weblogo" class="custom-file-input form-control">
                                          <label class="custom-file-label">Choose Website Image</label>
                                          <br>
                                          <img src="<?php echo $data['weblogo'];?>" width="60" height="60"/>
                                       </div>
                                    </div>
                                    <div class="form-group col-4">
                                       <label for="cname">Select Timezone</label>
                                       <select name="timezone" class="form-control" required>
                                          <option value="">Select Timezone</option>
                                          <?php 
                                             $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
                                             $limit =  count($tzlist);
                                             ?>
                                          <?php 
                                             for($k=0;$k<$limit;$k++)
                                             {
                                             ?>
                                          <option <?php echo $tzlist[$k];?> <?php if($tzlist[$k] == $data['timezone']) {echo 'selected';}?>><?php echo $tzlist[$k];?></option>
                                          <?php } ?>
                                       </select>
                                    </div>
                                    <div class="form-group col-4">
                                       <label><span class="text-danger">*</span> Currency</label>
                                       <input type="text" class="form-control" placeholder="Enter Currency"  value="<?php echo $data['currency'];?>" name="currency" required="">
                                    </div>
                                    <div class="form-group col-4">
                                       <label><span class="text-danger">*</span> Minimum Payout for Delivery Boy</label>
                                       <input type="text" class="form-control numberonly" placeholder="Enter Payout for Delivery Boy"  value="<?php echo $data['pdboy'];?>" name="pdboy" required="">
                                    </div>
                                    <div class="form-group col-12">
                                       <h5 class="h5_set"><i class="fa fa-signal"></i> Onesignal Information</h5>
                                    </div>
                                    <div class="form-group col-6">
                                       <label><span class="text-danger">*</span> User App Onesignal App Id</label>
                                       <input type="text" class="form-control " placeholder="Enter User App Onesignal App Id"  value="<?php echo $data['one_key'];?>" name="one_key" required="">
                                    </div>
                                    <div class="form-group col-6">
                                       <label><span class="text-danger">*</span> User  App Onesignal Rest Api Key</label>
                                       <input type="text" class="form-control " placeholder="Enter User Boy App Onesignal Rest Api Key"  value="<?php echo $data['one_hash'];?>" name="one_hash" required="">
                                    </div>
                                    <div class="form-group col-6">
                                       <label><span class="text-danger">*</span> Delivery Boy App Onesignal App Id</label>
                                       <input type="text" class="form-control " placeholder="Enter Delivery Boy App Onesignal App Id"  value="<?php echo $data['d_key'];?>" name="d_key" required="">
                                    </div>
                                    <div class="form-group col-6">
                                       <label><span class="text-danger">*</span> Delivery Boy App Onesignal Rest Api Key</label>
                                       <input type="text" class="form-control " placeholder="Enter Delivery Boy App Onesignal Rest Api Key"  value="<?php echo $data['d_hash'];?>" name="d_hash" required="">
                                    </div>
                                    <div class="form-group col-12">
                                       <h5 class="h5_set"><i class="fa fa-user-plus" aria-hidden="true"></i> Refer And Earn Information</h5>
                                    </div>
                                    <div class="form-group col-6">
                                       <label><span class="text-danger">*</span> Sign Up Credit</label>
                                       <input type="text" class="form-control numberonly" placeholder="Enter Sign Up Credit"  value="<?php echo $data['scredit'];?>" name="scredit" required="">
                                    </div>
                                    <div class="form-group col-6">
                                       <label><span class="text-danger">*</span> Refer Credit</label>
                                       <input type="text" class="form-control numberonly" placeholder="Enter Refer Credit"  value="<?php echo $data['rcredit'];?>" name="rcredit" required="">
                                    </div>
                                    <div class="col-12">
                                       <button type="submit" name="edit_setting" class="btn btn-primary mb-2">Edit Setting</button>
                                    </div>
                                 </div>
                              </form>
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
         if(isset($_POST['edit_setting']))
         {
         	$webname = mysqli_real_escape_string($lundry, $_POST['webname']);
         	$timezone = $_POST['timezone'];
         	$currency = $_POST['currency'];
         	$mobile = $_POST['mobile'];
         	$pdboy = $_POST['pdboy'];
         	$one_key = $_POST['one_key'];
         	$one_hash = $_POST['one_hash'];
         	$d_key = $_POST['d_key'];
         	$d_hash = $_POST['d_hash'];
         	$scredit = $_POST['scredit'];
         	$rcredit =$_POST['rcredit'];
         	$rid = 1;

         	$target_dir = "images/website/";
         	$temp = explode(".", $_FILES["weblogo"]["name"]);
         	$newfilename = round(microtime(true)) . '.' . end($temp);
         	$target_file = $target_dir . basename($newfilename);

         	

         	if($_FILES["weblogo"]["name"] != '')
         	{
         
         		move_uploaded_file($_FILES["weblogo"]["tmp_name"], $target_file);
         		$table="tbl_setting";
         			$field = array('timezone'=>$timezone,'weblogo'=>$target_file,'webname'=>$webname,'currency'=>$currency,'pdboy'=>$pdboy,'one_key'=>$one_key,'one_hash'=>$one_hash,'d_key'=>$d_key,'d_hash'=>$d_hash,'scredit'=>$scredit,'rcredit'=>$rcredit);
         			$where = "where id=".$rid."";
         		$h = new Laundrore();
         		$check = $h->lundryupdateData($field,$table,$where);
		         if($check == 1)
		         {
		         ?>
			      <script>
			         iziToast.success({
			            title: 'Setting Section!!',
			            message: 'Setting Update Successfully!!',
			            position: 'topRight'
			          });
			         			 setTimeout(function(){ 
			          window.location.href="setting.php"},3000);
			          
			          
			      </script>
		      	<?php 
		         }
         
         	}
         else 
         {
         	$table="tbl_setting";
           $field = array('timezone'=>$timezone,'webname'=>$webname,'currency'=>$currency,'pdboy'=>$pdboy,'one_key'=>$one_key,'one_hash'=>$one_hash,'d_key'=>$d_key,'d_hash'=>$d_hash,'scredit'=>$scredit,'rcredit'=>$rcredit);
           $where = "where id=".$rid."";
         $h = new Laundrore();
         $check = $h->lundryupdateData($field,$table,$where);
         if($check == 1)
         {
         ?>
      <script>
         iziToast.success({
            title: 'Setting Section!!',
            message: 'Setting Update Successfully!!',
            position: 'topRight'
          });
         			 setTimeout(function(){ 
          window.location.href="setting.php"},3000);
          
          
      </script>
      <?php 
         }
         
         }	
         		}
         		?>
   </body>
</html>