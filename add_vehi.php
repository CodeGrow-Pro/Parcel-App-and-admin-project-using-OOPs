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
					$data = $lundry->query("select * from tbl_vehicle where id=".$_GET['id']."")->fetch_assoc();
					?>
					<h4 class="card-title mb-4">Edit Vehicle </h4>
					<form method="post" enctype="multipart/form-data" novalidate>
                                            <div class="row">
											
                                                <div class="form-group">
												<label for="a2" class="il-gray fs-14 fw-500 align-center"><span class="text-danger">*</span> Vehicle Title</label>
                                                   
                                                    <input type="text" name="vtitle" class="form-control" value="<?php echo $data['title'];?>" placeholder="Enter Vehicle Title" required>
                                                </div>
												
												
											
                                                <div class="form-group">
												<label for="a2" class="il-gray fs-14 fw-500 align-center"> Upload Vehicle Image</label>
                                                   
                                                    <input type="file" class="form-control" name="cat_img">
                                                </div>
												<div class="form-group">
												<img src="<?php echo $data['img']?>" width="100px" style="margin:10px;"/>
												</div>
												
												<div class="form-group col-3">
                                            <label id="no2" style=""><span class="text-danger">*</span> Base Delivery Distance</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Base Delivery Distance" id="ukms" value="<?php echo $data['ukms'];?>" name="ukms" style="" required="required">
                                        </div>
										
										<div class="form-group col-3">
                                            <label id="no2" style=""><span class="text-danger">*</span> Base Delivery Charge</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Base Delivery Charge" id="uprice" value="<?php echo $data['uprice'];?>" name="uprice" style="" required="required">
                                        </div>
										
										<div class="form-group col-3">
                                            <label id="no2" style=""><span class="text-danger">*</span> Extra Delivery Charge</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Extra Delivery Charge" id="aprice" value="<?php echo $data['aprice'];?>" name="aprice" style="" required="required">
                                        </div>
										
										<div class="form-group col-3">
                                            <label id="no2" style=""><span class="text-danger">*</span> Time Taken 1 Km Approx</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Time Taken 1 Km Approx(Mintues)" value="<?php echo $data['ttime'];?>" id="ttime" name="ttime" style="" required="required">
                                        </div>
												
												<div class="form-group col-4">
												<label for="a2" class="il-gray fs-14 fw-500 align-center"><span class="text-danger">*</span> Vehicle Status</label>
                                                    
                                                    <select name="status" class="form-control ih-medium ip-light radius-xs b-light px-15" required>
													<option value="">Select Status</option>
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>UnPublish</option>
											</select>
                                                </div>
												
												<div class="form-group col-4">
                                            <label id="no2" style=""><span class="text-danger">*</span> Vehicle Capacity</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Vehicle Capacity In Kg" id="capcity" name="capcity" value="<?php echo $data['capcity'];?>"style="" required="required">
                                        </div>
										
										<div class="form-group col-4">
                                            <label id="no2" style=""><span class="text-danger">*</span> Vehicle Size</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Vehicle Size" id="size" name="size" style="" value="<?php echo $data['size'];?>" required="required">
                                        </div>
										
												<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname"><span class="text-danger">*</span> Vehicle Description </label>
									<textarea class="form-control" rows="5" id="cdesc" name="cdesc" style="resize: none;" required="required"><?php echo $data['description'];?></textarea>
								</div>
							</div>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <button type="submit" name="edit_restban" class="btn btn-primary w-md">Edit  Vehicle</button>
                                                </div>
                                            
                                        </form>
				<?php } else { ?>
									<h4 class="card-title mb-4">Add Vehicle </h4>
                        <!-- start page title -->
                        <form method="post" enctype="multipart/form-data" novalidate>
                                            <div class="row">
											
											
                                                <div class="form-group">
												<label for="a2" class="il-gray fs-14 fw-500 align-center"><span class="text-danger">*</span> Vehicle Title</label>
                                                   
                                                    <input type="text" name="vtitle" class="form-control" placeholder="Enter Vehicle Title" required>
                                                </div>
												
												
											
                                                <div class="form-group">
												<label for="a2" class="il-gray fs-14 fw-500 align-center"><span class="text-danger">*</span> Upload Vehicle Image</label>
                                                   
                                                    <input type="file" name="cat_img" class="form-control" required>
                                                </div>
												
												<div class="form-group col-3">
                                            <label id="no2" style=""><span class="text-danger">*</span> Base Delivery Distance</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Base Delivery Distance" id="ukms" name="ukms" style="" required="required">
                                        </div>
										
										<div class="form-group col-3">
                                            <label id="no2" style=""><span class="text-danger">*</span> Base Delivery Charge</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Base Delivery Charge" id="uprice" name="uprice" style="" required="required">
                                        </div>
										
										<div class="form-group col-3">
                                            <label id="no2" style=""><span class="text-danger">*</span> Extra Delivery Charge</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Extra Delivery Charge" id="aprice" name="aprice" style="" required="required">
                                        </div>
										
										<div class="form-group col-3">
                                            <label id="no2" style=""><span class="text-danger">*</span> Time Taken 1 Km Approx</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Time Taken 1 Km Approx(Mintues)" id="ttime" name="ttime" style="" required="required">
                                        </div>
										
												<div class="form-group col-4">
												
												<label for="a2" class="il-gray fs-14 fw-500 align-center"><span class="text-danger">*</span> Vehicle Status</label>
                                                    
                                                    <select name="status" class="form-control" required>
													<option value="">Select Status</option>
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
												</div>
												
												<div class="form-group col-4">
                                            <label id="no2" style=""><span class="text-danger">*</span> Vehicle Capacity</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Vehicle Capacity In Kg" id="capcity" name="capcity" style="" required="required">
                                        </div>
										
										<div class="form-group col-4">
                                            <label id="no2" style=""><span class="text-danger">*</span> Vehicle Size</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Vehicle Size" id="size" name="size" style="" required="required">
                                        </div>
										
												
												<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname"><span class="text-danger">*</span> Vehicle Description </label>
									<textarea class="form-control" rows="5" id="cdesc" name="cdesc" style="resize: none;" required="required"></textarea>
								</div>
							</div>	
							
                                                </div>
                                                <div class="form-group mb-0">
                                                    <button type="submit" name="add_ban" class="btn btn-primary w-md">Add  Vehicle</button>
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
		if(isset($_POST['add_ban']))
		{
			$cdesc = $lundry->real_escape_string($_POST['cdesc']);
			$ukms = $_POST['ukms'];
			$uprice = $_POST['uprice'];
			$aprice = $_POST['aprice'];
			$okey = $_POST['status'];
			$title = $_POST['vtitle'];
			$capcity = $_POST['capcity'];
			$ttime = $_POST['ttime'];
			$size = $_POST['size'];
			$target_dir = "images/banner/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
			
   
			
				
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				


  $table="tbl_vehicle";
  $field_values=array("img","status","title","description","ukms","uprice","aprice","capcity","size","ttime");
  $data_values=array("$target_file","$okey","$title","$cdesc","$ukms","$uprice","$aprice","$capcity","$size","$ttime");
  
$h = new Laundrore();
	  $check = $h->lundryinsertdata($field_values,$data_values,$table);
if($check == 1)
{
?>

 <script src="assets/izitoast/js/iziToast.min.js"></script>
	 <script>
 iziToast.success({
    title: 'Vehicle Add Successfully!!',
    message: 'Vehicle Section!!',
    position: 'topRight'
  });
	 
	 setTimeout(function(){ 
	 window.location.href="add_vehi.php"},3000);
	 </script>
  
<?php 
}

		}
		?>
		
		<?php 
		if(isset($_POST['edit_restban']))
		{
			$cdesc = $lundry->real_escape_string($_POST['cdesc']);
			$ukms = $_POST['ukms'];
			$ttime = $_POST['ttime'];
			$uprice = $_POST['uprice'];
			$aprice = $_POST['aprice'];
			$title = $_POST['vtitle'];
			$okey = $_POST['status'];
			$capcity = $_POST['capcity'];
			$size = $_POST['size'];
			$target_dir = "images/banner/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
	if($_FILES["cat_img"]["name"] != '')
	{		
    
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				 
$table="tbl_vehicle";
  $field = array('status'=>$okey,'img'=>$target_file,'title'=>$title,'description'=>$cdesc,'ukms'=>$ukms,'uprice'=>$uprice,'aprice'=>$aprice,'capcity'=>$capcity,'size'=>$size,'ttime'=>$ttime);
  $where = "where id=".$_GET['id']."";
$h = new Laundrore();
	  $check = $h->lundryupdateData($field,$table,$where);
	  
if($check == 1)
{
?>

 <script>
 iziToast.success({
    title: 'Vehicle Section!!',
    message: 'Vehicle Update Successfully!!',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="list_vehi.php"},3000);
  
  </script>
  
<?php 
}

	}
	else 
	{
		
		$table="tbl_vehicle";
  $field = array('status'=>$okey,'title'=>$title,'description'=>$cdesc,'ukms'=>$ukms,'uprice'=>$uprice,'aprice'=>$aprice,'capcity'=>$capcity,'size'=>$size,'ttime'=>$ttime);
  $where = "where id=".$_GET['id']."";
$h = new Laundrore();
	  $check = $h->lundryupdateData($field,$table,$where);
if($check == 1)
{
?>

 <script>
 iziToast.success({
    title: 'Vehicle Section!!',
    message: 'Vehicle Update Successfully!!',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="list_vehi.php"},3000);
  
  </script>
  
<?php 
}


	}
		}
		?>
    </body>

</html>