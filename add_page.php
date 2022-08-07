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
					$data = $lundry->query("select * from tbl_page where id=".$_GET['id']."")->fetch_assoc();
					?>
					<h4 class="card-title mb-4">Edit Page </h4>
					 <form method="post" enctype="multipart/form-data" onsubmit="return postForm()">
                                    
                                    <div class="card-body">
                                        
                                        <div class="row">

								
								
                             
							
							 <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Page title </label>
									<input type="text"  class="form-control"  value="<?php echo $data['title'];?>" name="ctitle" required >
								</div>
							</div>

  	

<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Page Status </label>
									<select name="cstatus" class="form-control" required>
									<option value="">Select Page Status</option>
									<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
									<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>Unpublish</option>
									
									</select>
								</div>
							</div>	
							
							

									   
<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Page Description </label>
									<textarea class="form-control" rows="5" id="cdesc" name="cdesc" style="resize: none;"><?php echo $data['description'];?></textarea>
								</div>
							</div>							
								
							</div>
                                        
										
                                    </div>
                                    <div class=" text-left">
                                        <button name="edit_page" class="btn btn-primary">Edit Page</button>
                                    </div>
                                </form>
				<?php } else { ?>
									<h4 class="card-title mb-4">Add Page </h4>
                        <!-- start page title -->
                    <form method="post" enctype="multipart/form-data" onsubmit="return postForm()">
                                    
                                    <div class="card-body">
                                        
                                        <div class="row">

								
								
                             
							
							 <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Page title </label>
									<input type="text"  class="form-control"  name="ctitle" required >
								</div>
							</div>

  	

<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Page Status </label>
									<select name="cstatus" class="form-control" required>
									<option value="">Select Page Status</option>
									<option value="1">Publish</option>
									<option value="0">Unpublish</option>
									
									</select>
								</div>
							</div>	
							
							

									   
<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Page Description </label>
									<textarea class="form-control" rows="5" id="cdesc" name="cdesc" style="resize: none;"></textarea>
								</div>
							</div>							
								
							</div>
                                        
										
                                    </div>
                                    <div class=" text-left">
                                        <button name="add_page" class="btn btn-primary">Add Page</button>
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
		if(isset($_POST['add_page']))
		{
			
			
			
							$ctitle = $lundry->real_escape_string($_POST['ctitle']);
							$cstatus = $_POST['cstatus'];
							$cdesc = $lundry->real_escape_string($_POST['cdesc']);
  $table="tbl_page";
  
  $field_values=array("description","status","title");
  $data_values=array("$cdesc","$cstatus","$ctitle");
  
$h = new Laundrore();
	  $check = $h->lundryinsertdata($field_values,$data_values,$table);
if($check == 1)
{
?>
 <script>
 iziToast.success({
    title: 'Page Section!!',
    message: 'Page Insert Successfully!!',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="add_page.php"},3000);
  
  </script>
  
<?php 
}

		}
		?>
		
		<?php 
		if(isset($_POST['edit_page']))
		{
			
			
			                $ctitle = $lundry->real_escape_string($_POST['ctitle']);
							$cstatus = $_POST['cstatus'];
							$cdesc = $lundry->real_escape_string($_POST['cdesc']);
	
		$table="tbl_page";
  $field=array('description'=>$cdesc,'status'=>$cstatus,'title'=>$ctitle);
  $where = "where id=".$_GET['id']."";
$h = new Laundrore();
	  $check = $h->lundryupdateData($field,$table,$where);
if($check == 1)
{
?>
<script>
 iziToast.success({
    title: 'Page Section!!',
    message: 'Page Update Successfully!!',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="list_page.php"},3000);
 
  </script>
<?php 
}


	
		}
		?>
    </body>

</html>