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
											<th>Vehicle Title</th>
											<th>Vehicle Image</th>
											<th>Vehicle Capacity</th>
											<th>Vehicle Size</th>
											<th>Vehicle Time</th>
												<th>Vehicle Status</th>
												<th>Action</th>
									</tr>
                                        </thead>
                                        <tbody>
										<?php 
										$city = $lundry->query("select * from tbl_vehicle");
										$i=0;
										while($row = $city->fetch_assoc())
										{
											$i = $i + 1;
											?>
											<tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                
												<td>
                                                    <?php echo $row['title']; ?>
                                                </td>
												
                                                <td class="align-middle">
                                                   <img src="<?php echo $row['img']; ?>" width="60px"/>
                                                </td>
                                                
                                               <td>
                                                    <?php echo $row['capcity']; ?>
                                                </td>
												
												<td>
                                                    <?php echo $row['size']; ?>
                                                </td>
												
												<td>
                                                    <?php echo $row['ttime'].' Min'; ?>
                                                </td>
												
												
												<?php if($row['status'] == 1) { ?>
												
                                                <td><span class="badge rounded-pill bg-success font-size-12">Publish</span></td>
												<?php } else { ?>
												
												<td>
												<span class="badge rounded-pill bg-danger font-size-12">Unpublish</span></td>
												<?php } ?>
                                                <td>
												
                                                            
                                                                <a href="add_vehi.php?id=<?php echo $row['id']; ?>" class="view">
                                                                    <span class="fa fa-edit btn btn-info"></span></a>
                                                            
                                                            
                                                            
                                                              
                                                            
                                                        
												
												
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
        
        

       <?php include 'include/lundryfoot.php';?>
	 
	  
    </body>



</html>