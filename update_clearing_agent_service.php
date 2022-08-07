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
					$data = $lundry->query("select * from tbl_clearing_add_service where id=".$_GET['id']."")->fetch_assoc();
					?>
					<h4 class="card-title mb-4">Edit </h4>
					<form method="post" enctype="multipart/form-data">
                                       
									   <div class="form-group">
                                            <label>street Address</label>
                                            <input type="text" class="form-control" placeholder="Enter address" value="<?php echo $data['st_addess'];?>" name="address" required="">
                                        </div>
                                         <div class="form-group">
                                            <label>City Name</label>
                                            <input type="text" class="form-control" placeholder="Enter city name" value="<?php echo $data['city'];?>" name="city" required="">
                                        </div>
										   <div class="form-group">
                                            <label>State</label>
                                            <input type="text" class="form-control" placeholder="Enter state" value="<?php echo $data['state'];?>" name="state" required="">
                                        </div>
                                            <div class="form-group">
                                            <label>Postal Code</label>
                                            <input type="text" class="form-control" placeholder="Enter Postal code" value="<?php echo $data['pcode'];?>" name="pcode" required="">
                                        </div>
                                        							   <div class="form-group">
                                            <label>Waehouse Spesification</label>
                                            <input type="text" class="form-control" placeholder="Enter warehouse specification" value="<?php echo $data['warehouse_speci'];?>" name="wspeci" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Size</label>
                                            <input type="text" class="form-control" placeholder="Enter size" value="<?php echo $data['size'];?>" name="size" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Floor height</label>
                                            <input type="text" class="form-control" placeholder="Enter floor height" value="<?php echo $data['fheight'];?>" name="height" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="text" class="form-control" placeholder="Enter price" value="<?php echo $data['price'];?>" name="price" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Duration</label>
                                            <input type="text" class="form-control" placeholder="Enter duration" value="<?php echo $data['duration'];?>" name="duration" required="">
                                        </div><br>
											<div class="form-group">
										<img src="https://static.vecteezy.com/system/resources/previews/005/260/830/original/refresh-symbol-icon-free-vector.jpg" width="100px"/>
										</div>
										
										<div class="form-group">
                                            <label>Truck Status</label>
                                            <select name="status" class="form-control" required>
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>UnPublish</option>
											</select>
                                        </div>
										<div class="col-12">
                                                <button type="submit" name="edit" class="btn btn-primary mb-2">Update</button>
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
		if(isset($_POST['edit']))
		{
			
			$address = mysqli_real_escape_string($lundry,$_POST['address']);
			$city = mysqli_real_escape_string($lundry,$_POST['city']);
			$state = mysqli_real_escape_string($lundry,$_POST['state']);
			$pcode	 = mysqli_real_escape_string($lundry,$_POST['pcode']);
			$wspeci = mysqli_real_escape_string($lundry,$_POST['wspeci']);
			$size = mysqli_real_escape_string($lundry,$_POST['size']);
				$height = mysqli_real_escape_string($lundry,$_POST['height']);
			$price = mysqli_real_escape_string($lundry,$_POST['price']);
			$duration = mysqli_real_escape_string($lundry,$_POST['duration']);
			$okey = $_POST['status'];
			$target_dir = "images/category/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
	if($_FILES["cat_img"]["name"] != '')
	{		
    
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				 
$table="tbl_clearing_add_service";
  $field = array('st_addess'=>$address,'city'=>$city,'state'=>$state,'pcode'=>$pcode,'warehouse_speci'=>$wspeci,'size'=>size,'fheight'=>$height,'price'=>$price,'duration'=>$duration,'certi_image'=>$target_file,'status'=>$okey);
  $where = "where id=".$_GET['id']."";
$h = new Laundrore();
	  $check = $h->lundryupdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script>
 iziToast.success({
    title: ' clearing Agent Section!!',
    message: ' Service Update Successfully!!',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="list_add_service.php"},3000);
  
  </script>
  
  
<?php 
}

	}
	else 
	{
		
		$table="tbl_clearing_add_service";
  $field = array('st_addess'=>$address,'city'=>$city,'state'=>$state,'pcode'=>$pcode,'warehouse_speci'=>$wspeci,'size'=>$size,'fheight'=>$height,'price'=>$price,'duration'=>$duration,'status'=>$okey);
  $where = "where id=".$_GET['id']."";
$h = new Laundrore();
	  $check = $h->lundryupdateData($field,$table,$where);
if($check == 1)
{
?>
<script>
 iziToast.success({
    title: ' clearing Agent Section!!',
    message: ' Service Update Successfully!!',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="list_add_service.php"},3000);
  
  </script>
  
<?php 
}else{ ?>
<script>
 iziToast.error({
    title: ' clearing Agent Section!!',
    message: ' Service Update failed!!',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="list_add_service.php"},3000);
  
  </script>
<?php

	}
	}
		}
		?>
    </body>



</html>