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
					$data = $lundry->query("select * from admin")->fetch_assoc();
					?>
					<h4 class="card-title mb-4">Update Profile </h4>
					<form method="post" enctype="multipart/form-data">
                                            <div class="row">
											
                                                <div class="form-group">
												<label for="a2" class="il-gray fs-14 fw-500 align-center">Username</label>
                                                   
                                                    <input type="text" name="username" class="form-control" value="<?php echo $data['username'];?>" placeholder="Enter Username" required>
                                                </div>
												
												<div class="form-group">
												<label for="a2" class="il-gray fs-14 fw-500 align-center">Password</label>
                                                   
                                                    <input type="text" name="password" class="form-control" value="<?php echo $data['password'];?>" placeholder="Enter password" required>
                                                </div>
											
                                                
												
                                                </div>
                                                <div class="form-group mb-0">
                                                    <button type="submit" name="uprofile" class="btn btn-primary w-md">Update Profile</button>
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
		if(isset($_POST['uprofile']))
		{
			$dname = $_POST['email'];
			$dsname = $_POST['password'];
			$id = 1;
			
$table="admin";
  $field = array('username'=>$dname,'password'=>$dsname);
  $where = "where id=".$id."";
$h = new Laundrore();
	  $check = $h->lundryupdateData($field,$table,$where);
	  
if($check == 1)
{
?>
  <script>
 iziToast.success({
    title: 'Profile Section!!',
    message: 'Profile Update Successfully!!',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="profile.php"},3000);
  
  </script>
  
<?php 
}	

		}
		?>
    </body>



</html>