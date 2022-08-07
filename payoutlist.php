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
							   <?php 
	if(isset($_GET['payout']))
						{
							$stmts = $lundry->query("SELECT * FROM `payout_setting` where id=".$_GET['payout']."")->fetch_assoc();
							?>
							<form class="form" method="post"  enctype="multipart/form-data">
							<div class="form-body">
								

								

								
								<div class="form-group">
									<label for="cname">PayOut By?</label>
									<select name="pby" class="form-control" required>
									<option value="">select a Method</option>
									<option value="upi" <?php if($stmts['type'] == 'upi'){echo 'selected';} ?>>UPI</option>
									<option value="bank" <?php if($stmts['type'] == 'bank'){echo 'selected';} ?>>BANK</option>
									<option value="paypal" <?php if($stmts['type'] == 'paypal'){echo 'selected';} ?>>PAYPAL</option>
									</select>
								</div>
								

								
<div class="form-group">
						<label for="cname">PayOut Image?</label>			
<input type="hidden" name="request_id" value="<?php echo $_GET['payout'];?>"/>								
								
								

                                                <input type="file" name="p_proof" class="form-control" required>
                                                
                                          
											
								</div>
								
							</div>

							 <div class=" text-left">
                                        <button name="mark_com" class="btn btn-primary">Complete Payout <i class="fas fa-receipt"></i></button>
                                    </div>
							
							
						</form>
						</div>
							   <?php 
						}
						else 
						{
						?>
                                    <div class="card-body">
									<table id="datatable" class="table  dt-responsive  nowrap w-100">
                                          <thead>
                                                <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                               <th>Request Id</th>
                                    <th>Amount</th>
                                   
									<th>Delivery Boy Name</th>
                                    <th>Payment Receive Details</th>
									<th>Payment Prefer Method</th>
									<th>Delivery Boy Mobile</th>
									
									 <th>Status</th>
<th>Action</th>
                                                </tr>
                                            </thead>
                                           <tbody>
                                            <?php 
											 $stmt = $lundry->query("SELECT * FROM `payout_setting`");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td><?php echo $row['rid'];?></td> 
                                    <td><?php echo $row['amt'].' '.$set['currency'];?></td>
									<?php 
									$vdetails = $lundry->query("select * from tbl_rider where id=".$row['vid']."")->fetch_assoc();
									?>
									<td><?php echo $vdetails['title'];?></td>
									<?php 
									if($row['type'] == 'upi')
									{
									?>
									<td><?php echo $vdetails['upi_id'];?></td>
									<?php } else if($row['type'] == 'paypal')
									{
										?>
									<td><?php echo $vdetails['paypal_id'];?></td>
									<?php } else 
									{
										?>
									<td><?php echo 'Bank Name: '.$vdetails['bank_name'].'<br>'.'A/C No: '.$vdetails['acc_number'].'<br>'.'A/C Name: '.$vdetails['receipt_name'].'<br>'.'IFSC CODE: '.$vdetails['ifsc'].'<br>';?></td>
									<?php } ?>									
									<td><?php echo $vdetails['mobile'];?></td>
									 <td><?php echo ucfirst($row['type']);?></td>
									 <td><?php echo ucfirst($row['status']);?></td>
                                     <td>
									 <?php if($row['status'] == 'pending') {?>
									<a href="?payout=<?php echo $row['id'];?>"><button class="btn shadow-z-2 btn-danger gradient-pomegranate">Make A Payout</button></a>
									 <?php } else { ?>
									 <p><?php echo ucfirst($row['status']);?></p>
									 <?php } ?>
									</td>
                                                </tr>
<?php } ?>                                           
                                        </tbody>
                                        
                                    </table>
										</div>
						<?php } ?>
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
						if(isset($_POST['mark_com']))
						{
							$pby = $_POST['pby'];
							$id = $_POST['request_id'];
							
       $target_dir = "images/proof/";
								$temp = explode(".", $_FILES["p_proof"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
       
        
       move_uploaded_file($_FILES["p_proof"]["tmp_name"], $target_file);
						
						$status = 'completed';
						$table="payout_setting";
  $field = array('proof'=>$target_file,'p_by'=>$pby,'status'=>$status);
  $where = "where id=".$id."";
$h = new Laundrore();
	  $check = $h->lundryupdateData($field,$table,$where);
	  
if($check == 1)
{
?>
 
 <script>
 iziToast.success({
    title: 'PayOut Section!!',
    message: 'Payout Sent Successfully!!',
    position: 'topRight'
  });
				  
	 
  </script>
  <script>
setTimeout(function(){ window.location.href="payoutlist.php";}, 3000);
</script>
<?php 
}

						}
						?>
	  
    </body>



</html>