<?php error_reporting(E_ALL);
ini_set('display_errors', '1'); ?>
<!doctype html>
<html lang="en">

    

<?php include 'include/head.php';?>
<?php 

if(isset($_SESSION['laundryname']))
{
	?>
	<script>
	window.location.href="dashboard.php";
	</script>
	<?php 
}
else 
{
}
?>
    <body>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-primary bg-soft">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="p-4" style="color:white;">
                                            <h5 class="" style="color:white;">Welcome Back !</h5>
                                            <p>Sign in to continue to <?php echo $set['webname'];?>.</p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                
                                <div class="p-2">
                                    <form class="form-horizontal" method="post">
        
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                                        </div>
                
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" class="form-control" placeholder="Enter password" name="password" aria-label="Password" aria-describedby="password-addon">
                                                <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                        </div>
										
										

                                       
                                        
                                        <div class="mt-3 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light" name="sub_login" type="submit">Log In</button>
                                        </div>
            
                                        
                                    </form>
                                </div>
            
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            
                           
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end account-pages -->

      <?php include 'include/lundryfoot.php';?>
	  
	  <?php 
	if(isset($_POST['sub_login']))
	{
	    
		$username = $_POST['username'];
		$password = $_POST['password'];
	
	 $h = new Laundrore();
	
	 $count = $h->lundrylogin($username,$password,'admin');
 if($count != 0)
 {
	 $_SESSION['laundryname'] = $username;
	 ?>
	 
	 
	 <script>
 iziToast.success({
    title: 'Login Successfully!!',
    message: 'Welcome Admin!!',
    position: 'topRight'
  });
	 
	 setTimeout(function(){ 
	 window.location.href="dashboard.php"},3000);
	 </script>
	 <?php 
 }
 else 
 {
	 ?>
	
	 <script>
 iziToast.error({
    title: 'Wrong Data Enter!',
    message: 'Please Use Valid Data!!',
    position: 'topRight'
  });
	 </script>
	 <?php 
 }
	 
	 
	}	
	
	?>
    </body>


</html>
