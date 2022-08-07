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
									
									<table id="example" class="table  dt-responsive  nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
												<th>Order Id.</th>
												<th>Customer Name</th>
												
                                               
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
										<?php 
										$city = $lundry->query("select * from tbl_order where o_status='Processing'");
										$i=0;
										while($row = $city->fetch_assoc())
										{
											$udata = $lundry->query("select * from tbl_user where id=".$row['uid']."")->fetch_assoc();
											$i = $i + 1;
											?>
											<tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
												 <td>
                                                    <?php echo $row['id']; ?>
                                                </td>
												 <td class="align-middle">
                                                   <?php echo $udata['name']; ?>
                                                </td>
                                                
												
                                               
                                                
                                               
				 
												
												
                                                <td><span class="badge rounded-pill bg-success font-size-12"> <?php echo $row['o_status'];?></span></td>
												
												
                                                <td><button class="preview_d btn btn-primary" data-id="<?php echo $row['id'];?>" data-toggle="modal" data-target="#myModal">Preview</button>
												
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
										
                        <!-- end row -->
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <!-- Transaction Modal -->
              
                
               
            </div>
            <!-- end main content-->

        </div>
        
        <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg ">

    
    <div class="modal-content gray_bg_popup">
      <div class="modal-header">
        <h4>Order Preivew</h4>
        <button type="button" class="close popup_open" data-bs-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body p_data">
      
      </div>
     
    </div>

  </div>
</div>

       <?php include 'include/lundryfoot.php';?>
	   
	   

 
	  
    </body>



</html>