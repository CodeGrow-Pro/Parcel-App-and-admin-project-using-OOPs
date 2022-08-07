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
<?php 
						if(isset($_GET['cid']))
						{
							?>
							<div class="card">
							<div class="card-header">
                                <h4 class="card-title">Manage Cash</h4>
                            </div>
                            <div class="card-body">
							<form method="post" enctype="multipart/form-data">
                                       
									   <?php $sales  = $lundry->query("select sum(o_total) as full_total from tbl_order where o_status='completed'  and p_method_id=2 and  rid=".$_GET['cid']."")->fetch_assoc();
             $payout =   $lundry->query("select sum(amt) as full_payouts from tbl_cash where rid=".$_GET['cid']."")->fetch_assoc();
                 
				
				$pb = 0;
				 if($sales['full_total'] == ''){$pb =  '0';}else {$pb  = number_format((float)($sales['full_total']) - $payout['full_payouts'], 2, '.', ''); } ?>
				 
									   <div class="form-group">
                                            <label><span class="text-danger">*</span> Remain  Cash</label>
                                            <input type="text" class="form-control" value="<?php echo $pb;?>"  name="remain" required="" readonly>
                                        </div>
										
										 <div class="form-group">
                                            <label><span class="text-danger">*</span> Received Cash</label>
                                            <input type="text" class="form-control" placeholder="Enter Received Cash"  name="rcash" required="">
                                        </div>
										
										 <div class="form-group">
                                            <label><span class="text-danger">*</span> Message</label>
                                            <input type="text" class="form-control" placeholder="Enter Message"  name="message" required="" >
                                        </div>
										
                                     
										
										
										<div class="col-12">
                                                <button type="submit" name="add_cash" class="btn btn-primary mb-2">Add Cash Collection</button>
                                            </div>
                                    </form>
									</div>
									</div>
							<?php
						}
						else if(isset($_GET['hid']))
						{
							?>
							<div class="card">
							 <div class="card-header">
                                <h4 class="card-title">Delivery Boy Cash Collection Log</h4>
                            </div>
                            <div class="card-body">
							
                                <div class="table-responsive">
                                    <table id="datatable" class="table  dt-responsive  nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
												<th>Delivery Boy Name</th>
                                                
												 
												 <th>Received <br>Cash</th>
												 <th>Message</th>
                                                <th>Received <br>Date</th>
                                                

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
											 $stmts = $lundry->query("SELECT * FROM `tbl_rider` where id =".$_GET['hid']."")->fetch_assoc();
											 $stmt = $lundry->query("SELECT * FROM `tbl_cash` where rid =".$_GET['hid']."");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td class="align-middle">
                                                   <?php echo $stmts['title']; ?>
                                                </td>
												
                                                <td class="align-middle">
                                                  <?php echo $row['amt'].' '.$set['currency']; ?>
                                                </td>
                                                
                                               
				 <td class="align-middle">
                                                  <?php echo $row['message']; ?>
                                                </td>
												
												 <td class="align-middle">
                                                  <?php echo date("d M Y, h:i a", strtotime($row['pdate'])); ?>
                                                </td>
												
                                                </tr>
<?php } ?> 
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
							</div>
							<?php 
						}
						else {
						?>
                                <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
									<table id="datatable" class="table  dt-responsive  nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
												<th>Delivery Boy Name</th>
                                                <th>Delivery Boy Image</th>
												 
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
										<?php 
										$city = $lundry->query("select * from tbl_rider");
										$i=0;
										while($row = $city->fetch_assoc())
										{
											$i = $i + 1;
											?>
											<tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td class="align-middle">
                                                   <?php echo $row['title']; ?>
                                                </td>
												
                                                <td class="align-middle">
                                                   <img src="<?php echo $row['rimg']; ?>" width="60" />
                                                </td>
                                                
                                               
				 
												<?php if($row['status'] == 1) { ?>
												
                                                <td><span class="badge rounded-pill bg-success font-size-12">Current Active</span></td>
												<?php } else { ?>
												
												<td>
												<span class="badge rounded-pill bg-danger font-size-12">Current Deactive</span></td>
												<?php } ?>
												
                                                <td><a href="add_rider.php?id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="bottom" title="edit" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-edit"></i></a>
												<a href="?cid=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="bottom" title="Manage Cash" class="btn btn-info shadow btn-xs sharp mr-1"><i class="fas fa-money-bill"></i></a>
												<a href="?hid=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="bottom" title="Cash Collection Log" class="btn btn-info shadow btn-xs sharp mr-1"><i class="fa fa-history"></i></a>
												</td>
												
												</td>
                                                </tr>
											<?php 
										}
										?>
                                            </tbody>
                                        
                                    </table>
										</div>
										</div>
										</div>
										</div>
						<?php } ?>
										
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
	if(isset($_POST['add_cash']))
	{
		$remain = $_POST['remain'];
		$rcash = $_POST['rcash'];
		$message = $_POST['message'];
		$rid = $_GET['cid'];
$timestamp = date("Y-m-d H:i:s");
     if($remain == 0)
	 {
		?>
	<script>
 iziToast.error({
    title: 'Amount issue!!',
    message: 'Remain Amount Was 0.',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="list_rider.php"},3000);
  
  </script>
	<?php  
	 }
	 else if($rcash > $remain)
	   {
		   ?>
	<script>
 iziToast.error({
    title: 'Amount issue!!',
    message: 'You cant Receive Greater Than Remain Amount.',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="list_rider.php"},3000);
  
  </script>
	<?php 
	   }
	   else 
	   {
	   $table="tbl_cash";
  $field_values=array("rid","message","amt","pdate");
  $data_values=array("$rid","$message","$rcash","$timestamp");
   
      $h = new Laundrore();
	  $checks = $h->lundryinsertdata($field_values,$data_values,$table);
	  
	  if($checks == 1)
{
?>
<script>
 iziToast.success({
    title: ' Category Add Successfully!!',
    message: ' Category Section!!',
    position: 'topRight'
  });
	 
	 setTimeout(function(){ 
	 window.location.href="list_rider.php"},3000);
	 </script>
  
<?php 
}

	   }
		}
	?>
	
    </body>



</html>