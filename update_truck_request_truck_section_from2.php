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
                                            <label>location</label>
                                            <input type="text" class="form-control" placeholder="Enter location Name" value="<?php echo $data['location'];?>" name="cname" required="">
                                        </div>
                                         <div class="form-group">
                                            <label>Types of Goods</label>
                                            <input type="text" class="form-control" placeholder="Enter types of goods" value="<?php echo $data['tcargo'];?>" name="regno" required="">
                                        </div>
										   <div class="form-group">
                                            <label>Description</label>
                                            <input type="text" class="form-control" placeholder="Enter description" value="<?php echo $data['description'];?>" name="certino" required="">
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
										<img src="https://cdn.dribbble.com/users/1753238/screenshots/14539701/dribbble_072_4x.jpg" width="100px"/>
										</div>
										
										<div class="form-group">
                                            <label>Request Truck Status</label>
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
			
			$cname = mysqli_real_escape_string($lundry,$_POST['cname']);
			$reg = mysqli_real_escape_string($lundry,$_POST['regno']);
			$certi = mysqli_real_escape_string($lundry,$_POST['certino']);
			$budget = mysqli_real_escape_string($lundry,$_POST['budget']);
			$size = mysqli_real_escape_string($lundry,$_POST['size']);
			$okey = $_POST['status'];
			$target_dir = "images/category/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
	if($_FILES["cat_img"]["name"] != '')
	{		
    
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				 
$table="tbl_request_truck";
  $field = array('location'=>$cname,'tcargo'=>$reg,'description'=>$certi,'budget'=>$budget,'size'=>$size,'status'=>$okey,'certi_image'=>$target_file);
  $where = "where id=".$_GET['id']."";
$h = new Laundrore();
	  $check = $h->lundryupdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script>
 iziToast.success({
 title: ' Truck Owner Section!!',
    message: ' Truck Reque Update Successfully!!',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="truck_request.php"},3000);
  
  </script>
  
  
<?php 
}

	}
	else 
	{
		
		$table="tbl_request_truck";
  $field = array('location'=>$cname,'tcargo'=>$reg,'description'=>$certi,'budget'=>$budget,'size'=>$size,'status'=>$okey);
  $where = "where id=".$_GET['id']."";
$h = new Laundrore();
	  $check = $h->lundryupdateData($field,$table,$where);
if($check == 1)
{
?>
<script>
 iziToast.success({
    title: ' Truck Owner Section!!',
    message: ' Truck Reque Update Successfully!!',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="truck_request.php"},3000);
  
  </script>
  
<?php 
}else{ ?>
<script>
 iziToast.error({
 title: ' Truck Owner Section!!',
    message: ' Truck Reque Update Failed!!',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="truck_request.php"},3000);
  
  </script>
<?php

	}
	}
		}
		?>
    </body>



</html>