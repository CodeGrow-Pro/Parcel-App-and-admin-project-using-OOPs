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
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
									<table id="datatable" class="table  dt-responsive  nowrap w-100">
                                       <thead>
                                            <tr>
                                               <th class="text-center">
                                                    #
                                                </th>
                                                <th>Full Name</th>
                                                
                                                
                                                
                                                <th>Email Id</th>
                                                <th>Mobile</th>
												<th>Status</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
											 $stmt = $lundry->query("SELECT * FROM `tbl_user` order by id desc");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td> <?php echo $row['name']; ?></td>
                                                
                                                <td> <?php echo $row['email']; ?></td>
                                                
												<td> <?php echo $row['mobile']; ?></td>
                                                
                                               
												
												
																								<?php if($row['status'] == 1) { ?>
                                                <td><a href="?id=<?php echo $row['id'];?>&status=0"><div class="badge rounded-pill bg-danger font-size-12">Make Deactive</div></a></td>
												<?php } else { ?>
												<td><a href="?id=<?php echo $row['id'];?>&status=1"><div class="badge rounded-pill bg-success font-size-12">Make Active</div></a></td>
												<?php } ?>
												
												
												
												
                                                </tr>
<?php } ?>                                           
                                        </tbody>
                                        
                                    </table>
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
		
		if(isset($_GET['status']))
		{
			
		$id = $_GET['id'];
$status = $_GET['status'];
 $table="tbl_user";
  $field = "status=".$status."";
  $where = "where id=".$id."";
$h = new Laundrore();
	  $check = $h->lundryupdateData_single($field,$table,$where);
if($check == 1)
{
?>
   <script>
 iziToast.success({
    title: 'User Section!!',
    message: 'User Staus Update Successfully!!',
    position: 'topRight'
  });
  setTimeout(function(){ window.location.href="userlist.php";}, 3000);
  </script>
<?php 
}
else 
{

?>
<script>
 iziToast.error({
    title: 'Operation DISABLED!!',
    message: 'For Demo purpose all  Insert/Update/Delete are DISABLED !!',
    position: 'topRight'
  });
  setTimeout(function(){ window.location.href="userlist.php";}, 3000);
	 </script>
  
<?php 	
}
 	  
		}
		?>
	  
    </body>



</html>
</html>