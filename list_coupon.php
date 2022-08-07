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
                                                <th>Sr No.</th>
                                               <th>Code</th>
                                                
                                                <th>Image</th>
                                                 <th>Expired Date</th>
                                                <th>Min Amount</th>
												<th>Discount</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
											
											 $stmt = $lundry->query("SELECT * FROM `tbl_scoupon`");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
												<td> <?php echo $row['c_title']; ?></td>
                                                
                                                <td class="align-middle">
                                                   <img src="<?php echo $row['c_img']; ?>" width="60" height="60"/>
                                                </td>
                                                
                                               <td> <?php 
											   $date=date_create($row['cdate']);
echo date_format($date,"d-m-Y");
											   ?></td>
											   <td> <?php echo $row['min_amt']; ?></td>
											   <td> <?php echo $row['c_value']; ?></td>
												<?php if($row['status'] == 1) { ?>
												
                                                <td><span class="badge rounded-pill bg-success font-size-12">Publish</span></td>
												<?php } else { ?>
												
												<td>
												<span class="badge rounded-pill bg-danger font-size-12">Unpublish</span></td>
												<?php } ?>
												
                                               <td>
												<a href="add_coupon.php?id=<?php echo $row['id']; ?>" class="view">
                                                                    <span class="fa fa-edit btn btn-info"></span></a>
                                                            
                                                            
                                                            
                                                                <a href="?did=<?php echo $row['id']; ?>">
                                                                    <span class="fa fa-trash btn btn-danger"></span></a>
												
												
												</td>
												</td>
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
if(isset($_GET['did']))
{
	$id = $_GET['did'];

$table="tbl_scoupon";
$where = "where id=".$id."";
$h = new Laundrore();
	$check = $h->lundryDeleteData($where,$table);

if($check == 1)
{
?>

 <script>
 iziToast.error({
    title: 'Coupon	Section!!',
    message: 'Coupon Delete Successfully!!',
    position: 'topRight'
  });
  setTimeout(function(){ window.location.href="list_coupon.php";}, 3000);
  </script>
  
<?php 
}


}
?> 	  
    </body>



</html>