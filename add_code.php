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
					$data = $lundry->query("select * from tbl_code where id=".$_GET['id']."")->fetch_assoc();
					?>
					<h4 class="card-title mb-4">Edit Country Code </h4>
					 <form method="post" enctype="multipart/form-data">
                                       
									   <div class="form-group">
                                            <label>Country Code</label>
                                            <input type="text" class="form-control" placeholder="Enter Country Code" value="<?php echo $data['ccode'];?>" name="cname" required="">
                                        </div>
										
                                      
										
										<div class="form-group">
                                            <label>Country Code Status</label>
                                            <select name="status" class="form-control" required>
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>UnPublish</option>
											</select>
                                        </div>
										<div class="col-12">
                                                <button type="submit" name="edit_ccode" class="btn btn-primary mb-2">Update Country Code</button>
                                            </div>
                                    </form>
				<?php } else { ?>
									<h4 class="card-title mb-4">Add Country Code </h4>
                        <!-- start page title -->
                    <form method="post" enctype="multipart/form-data">
                                       
									   <div class="form-group">
                                            <label>Country Code</label>
                                            <input type="text" class="form-control" placeholder="Enter Country Code"  name="cname" required="">
                                        </div>
										
                                      
										<div class="form-group">
                                            <label>Country Code Status</label>
                                            <select name="status" class="form-control" required>
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
										<div class="col-12">
                                                <button type="submit" name="add_ccode" class="btn btn-primary mb-2">Add Country Code</button>
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
		if(isset($_POST['add_ccode']))
		{
			$dname = $_POST['cname'];
			
			$okey = $_POST['status'];
			
		
				


  $table="tbl_code";
  $field_values=array("ccode","status");
  $data_values=array("$dname","$okey");
  
$h = new Laundrore();
	  $check = $h->lundryinsertdata($field_values,$data_values,$table);
if($check == 1)
{
?>
 <script>
 iziToast.success({
    title: 'Country Section!!',
    message: 'Country Code Insert Successfully!!',
    position: 'topRight'
  });
  setTimeout(function(){ 
	 window.location.href="add_code.php"},3000);
  </script>
  
<?php 
}

		
		
		}
		?>
		
		<?php 
		if(isset($_POST['edit_ccode']))
		{
			$dname = $_POST['cname'];
			
			$okey = $_POST['status'];
			
			
$table="tbl_code";
  $field = array('ccode'=>$dname,'status'=>$okey);
  $where = "where id=".$_GET['id']."";
$h = new Laundrore();
	  $check = $h->lundryupdateData($field,$table,$where);
	  
if($check == 1)
{
?>
 <script>
 iziToast.success({
    title: 'Country Section!!',
    message: 'Country Code Update Successfully!!',
    position: 'topRight'
  });
  
   setTimeout(function(){ 
	 window.location.href="add_code.php"},3000);
  </script>
  
<?php 
}

 
		}
		?>
    </body>



</html>