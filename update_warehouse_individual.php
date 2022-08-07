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
					$data = $lundry->query("select * from tbl_warehouse_individual where id=".$_GET['id']."")->fetch_assoc();
					?>
					<h4 class="card-title mb-4">Edit Warehouse Individual </h4>
					<form method="post" enctype="multipart/form-data">
                                       
									   <div class="form-group">
                                            <label>Cargo Owner</label>
                                            <input type="text" class="form-control" placeholder="Enter Cago Owner" value="<?php echo $data['cargo_name'];?>" name="cname" required="">
                                        </div>
                                         <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" class="form-control" placeholder="Enter full name" value="<?php echo $data['fname'];?>" name="regno" required="">
                                        </div>
										   <div class="form-group">
                                            <label>TIN No</label>
                                            <input type="text" class="form-control" placeholder="Enter TIN number" value="<?php echo $data['tin_no'];?>" name="certino" required="">
                                        </div>
                                      <div class="form-group">
                                             <label>Certificate Image</label>
                                            
                                                <input type="file" name="cat_img" class="form-control">
                                                
											<br>
											
                                        </div>
										<div class="form-group">
										<img src="<?php echo $data['certi_image'];?>" width="100px"/>
										</div><br>
											<div class="form-group">
										<img src="https://cdn1.vectorstock.com/i/1000x1000/16/85/warehouse-logistic-logo-icon-design-vector-22461685.jpg" width="100px"/>
										</div>
										
										<div class="form-group">
                                            <label>Category Status</label>
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
			$okey = $_POST['status'];
			$target_dir = "images/category/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
	if($_FILES["cat_img"]["name"] != '')
	{		
    
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				 
$table="tbl_warehouse_individual";
  $field = array('cargo_name'=>$cname,'fname'=>$reg,'tin_no'=>$certi,'certi_image'=>$target_file,'status'=>$okey);
  $where = "where id=".$_GET['id']."";
$h = new Laundrore();
	  $check = $h->lundryupdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script>
 iziToast.success({
     title: ' warehouse Section!!',
    message: ' warehouse Update Successfully!!',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="list_warehouse_individual.php"},3000);
  
  </script>
  
  
<?php 
}

	}
	else 
	{
		
		$table="tbl_warehouse_individual";
  $field = array('cargo_name'=>$cname,'fname'=>$reg,'tin_no'=>$certi,'status'=>$okey,);
  $where = "where id=".$_GET['id']."";
$h = new Laundrore();
	  $check = $h->lundryupdateData($field,$table,$where);
if($check == 1)
{
?>
<script>
 iziToast.success({
    title: ' warehouse Section!!',
    message: ' warehouse Update Successfully!!',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="list_warehouse_individual.php"},3000);
  
  </script>
  
<?php 
}else{ ?>
<script>
 iziToast.error({
    title: ' warehouse Section!!',
    message: ' warehouse Update Failed!!',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="list_warehouse_individual.php"},3000);
  
  </script>
<?php

	}
	}
		}
		?>
    </body>



</html>