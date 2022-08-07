<!doctype html>
<html lang="en">

    

<?php include 'include/head.php';
?>

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
					$data = $lundry->query("select * from tbl_scoupon where id=".$_GET['id']."")->fetch_assoc();
					?>
					<h4 class="card-title mb-4">Edit Store Coupon Code </h4>
					 <form method="post" enctype="multipart/form-data" onsubmit="return postForm()">
                                    
                                    <div class="card-body">
                                        
                                        <div class="row">
<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

<div class="form-group">
									<label>Coupon Image</label>
									
									
                                                <input type="file" name="f_up" class="form-control">
                                                
											<br>
											<br>
									<img src="<?php echo $data['c_img'];?>" width="100" height="100"/>
								</div>
								
								
								
								
								</div>
								
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Coupon Expiry Date</label>
									<input type="date" name="cdate" value="<?php echo $data['cdate'];?>" class="form-control" id="projectinput8" required>
								</div>
								</div>
								
								
								
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group">
								
									<label for="cname">Coupon Code </label>
									<div class="row">
								<div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
									<input type="text" id="ccode" value="<?php echo $data['c_title'];?>" class="form-control" onkeypress="return isNumberKey(event)" 
    maxlength="8" name="ccode" oninput="this.value = this.value.toUpperCase()" required >
									</div>
									
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<button id="gen_code" class="btn btn-success pads"><i data-feather="refresh-ccw" aria-hidden="true"></i></button>
									</div>
									</div>
								</div>
								</div>
								
								
                             
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon title </label>
									<input type="text"  class="form-control" value="<?php echo $data['ctitle'];?>"  name="ctitle" required >
								</div>
							</div>
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon subtitle </label>
									<input type="text"  class="form-control" value="<?php echo $data['subtitle'];?>"  name="subtitle" required >
								</div>
							</div>
							

  

<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon Status </label>
									<select name="cstatus" class="form-control" required>
									<option value="">Select Coupon Status</option>
									<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
									<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>Unpublish</option>
									
									</select>
								</div>
							</div>	
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Coupon Min Order Amount</label>
									<input type="number" id="cname" value="<?php echo $data['min_amt'];?>" class="form-control"  name="minamt" step="1"
                  onkeypress="return event.charCode >= 48 && event.charCode <= 57" required >
								</div>
								</div>
								
							
 <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon Value </label>
									<input type="number" id="cname" class="form-control"  value="<?php echo $data['c_value'];?>" name="cvalue" step="1"
                  onkeypress="return event.charCode >= 48 && event.charCode <= 57" required >
								</div>
							</div>

									   
<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon Description </label>
									<textarea class="form-control rez" rows="5" id="cdesc" name="cdesc"><?php echo $data['c_desc'];?></textarea>
								</div>
							</div>							
								
							</div>

								
							
                                        
										
                                    </div>
                                    <div class=" text-left">
                                        <button name="update_coupon" class="btn btn-primary">Update Coupon</button>
                                    </div>
                                </form>
				<?php } else { ?>
									<h4 class="card-title mb-4">Add Store Coupon Code</h4>
                        <!-- start page title -->
                    <form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        
                                        <div class="row">
<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Coupon Image</label>
									
									
                                                <input type="file" name="f_up" class="form-control" required>
                                                
                                            
								</div>
								</div>
								
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Coupon Expiry Date</label>
									<input type="date" name="cdate" class="form-control" id="projectinput8" required>
								</div>
								</div>
								
								
								
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group">
								
									<label for="cname">Coupon Code </label>
									<div class="row">
								<div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
									<input type="text" id="ccode" class="form-control" onkeypress="return isNumberKey(event)" 
    maxlength="8" name="ccode" required  oninput="this.value = this.value.toUpperCase()">
									</div>
									
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
									<button id="gen_code" class="btn btn-success"><i class="fas fa-sync-alt" aria-hidden="true"></i></button>
									</div>
									</div>
								</div>
								</div>
								
								
                             
							
							 <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon title </label>
									<input type="text"  class="form-control"  name="ctitle" required >
								</div>
							</div>

<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon subtitle </label>
									<input type="text"  class="form-control"   name="subtitle" required >
								</div>
							</div>
  	

<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon Status </label>
									<select name="cstatus" class="form-control" required>
									<option value="">Select Coupon Status</option>
									<option value="1">Publish</option>
									<option value="0">Unpublish</option>
									
									</select>
								</div>
							</div>	
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Coupon Min Order Amount</label>
									<input type="number" id="cname"  class="form-control"  name="minamt" step="1"
                  onkeypress="return event.charCode >= 48 && event.charCode <= 57" required >
								</div>
								</div>
								
 <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon Value</label>
									<input type="number" id="cname" class="form-control"  name="cvalue" step="1"
                  onkeypress="return event.charCode >= 48 && event.charCode <= 57" required >
								</div>
							</div>
 
									   
<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon Description </label>
									<textarea class="form-control rez" rows="5" id="cdesc" name="cdesc" ></textarea>
								</div>
							</div>							
								
							</div>
                                        
										
                                    </div>
                                    <div class=" text-left">
                                        <button name="add_scoupon" class="btn btn-primary">Add Coupon</button>
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
		if(isset($_POST['add_scoupon']))
		{
			
			
			$ccode = $lundry->real_escape_string($_POST['ccode']);
							$cdate = $_POST['cdate'];
							$minamt = $_POST['minamt'];
							$ctitle = $lundry->real_escape_string($_POST['ctitle']);
							$cstatus = $_POST['cstatus'];
							$cvalue = $_POST['cvalue'];
							$subtitle = $_POST['subtitle'];
							$cdesc = $lundry->real_escape_string($_POST['cdesc']);
							
			$target_dir = "images/scoupon/";
			$temp = explode(".", $_FILES["f_up"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
		
		
   
			
		move_uploaded_file($_FILES["f_up"]["tmp_name"], $target_file);
				


  $table="tbl_scoupon";
 
  $field_values=array("c_img","c_desc","c_value","c_title","status","cdate","ctitle","min_amt","subtitle");
  $data_values=array("$target_file","$cdesc","$cvalue","$ccode","$cstatus","$cdate","$ctitle","$minamt","$subtitle");
  
$h = new Laundrore();
	  $check = $h->lundryinsertdata($field_values,$data_values,$table);
if($check == 1)
{
?>
 <script>
 iziToast.success({
    title: 'Coupon Section!!',
    message: 'Coupon Code Insert Successfully!!',
    position: 'topRight'
  });
  setTimeout(function(){ 
	 window.location.href="add_coupon.php"},3000);
  </script>
  
<?php 
}

		}
		?>
		
		<?php 
		if(isset($_POST['update_coupon']))
		{
			
			
			                $ccode = $lundry->real_escape_string($_POST['ccode']);
							$cdate = $_POST['cdate'];
							$minamt = $_POST['minamt'];
							$ctitle = $lundry->real_escape_string($_POST['ctitle']);
							$cstatus = $_POST['cstatus'];
							$subtitle = $_POST['subtitle'];
							$cvalue = $_POST['cvalue'];
							$cdesc = $lundry->real_escape_string($_POST['cdesc']);
							
			$target_dir = "images/scoupon/";
			$temp = explode(".", $_FILES["f_up"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
	if($_FILES["f_up"]["name"] != '')
	{		
    
			
		move_uploaded_file($_FILES["f_up"]["tmp_name"], $target_file);
				 
$table="tbl_scoupon";
  $field=array('c_img'=>$target_file,'c_desc'=>$cdesc,'c_value'=>$cvalue,'c_title'=>$ccode,'status'=>$cstatus,'cdate'=>$cdate,'ctitle'=>$ctitle,'min_amt'=>$minamt,'subtitle'=>$subtitle);
  $where = "where id=".$_GET['id']."";
$h = new Laundrore();
	   $check = $h->lundryupdateData($field,$table,$where);
	  
if($check == 1)
{
?>
 <script>
 iziToast.success({
    title: 'Coupon Section!!',
    message: 'Coupon Code Update Successfully!!',
    position: 'topRight'
  });
  setTimeout(function(){ 
	 window.location.href="add_coupon.php"},3000);
  </script>
  
<?php 
}

			
	}
	else 
	{
		
		$table="tbl_scoupon";
  $field=array('c_desc'=>$cdesc,'c_value'=>$cvalue,'c_title'=>$ccode,'status'=>$cstatus,'cdate'=>$cdate,'ctitle'=>$ctitle,'min_amt'=>$minamt,'subtitle'=>$subtitle);
  $where = "where id=".$_GET['id']."";
$h = new Laundrore();
	  $check = $h->lundryupdateData($field,$table,$where);
if($check == 1)
{
?>

 <script>
 iziToast.success({
    title: 'Coupon Section!!',
    message: 'Coupon Code Update Successfully!!',
    position: 'topRight'
  });
  setTimeout(function(){ 
	 window.location.href="add_coupon.php"},3000);
  </script>
  
<?php 
}


	}
		}
		?>
    </body>

</html>