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
											<th>Cargo Owner Name</th>
											<th>Cargo Owner Id No</th>
											<th>Cargo Owner Front Image</th>
											<th>Cargo Owner Back Image</th>
											
												<th>Category Status</th>
												<th>Action</th>
									</tr>
                                        </thead>
                                        <tbody>
										<?php 
										$city = $lundry->query("select * from tbl_cargoowner");
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
                                                    <?php echo $row['cname']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['idno']; ?>
                                                </td>
                                                
                                                <td class="align-middle">
                                                   <img src="<?php echo $row['front_img']; ?>" width="60px"/>
                                                </td>
                                                <td class="align-middle">
                                                   <img src="<?php echo $row['back_img']; ?>" width="60px"/>
                                                </td>
                                                
                                               
												<?php if($row['cat_status'] == 1) { ?>
												
                                                <td><span class="badge rounded-pill bg-success font-size-12">Publish</span></td>
												<?php } else { ?>
												
												<td>
												<span class="badge rounded-pill bg-danger font-size-12">Unpublish</span></td>
												<?php } ?>
                                                <td>
												
                                                            
                                                                <a href="add_cat.php?id=<?php echo $row['id']; ?>" class="view">
                                                                    <span class="fa fa-edit btn btn-info"></span></a>
                                                            
                                                            
                                                             <?php 
                                                            $tname = 'tbl_cargoowner';
                                                            $path = 'list_cargoowner';
                                                            ?>
                                                                <a href="delete.php?did=<?php echo $row['id'];?> & tname=<?php echo $tname;?> & path=<?php echo $path; ?>">
                                                                    <span class="fa fa-trash btn btn-danger"></span></a>
                                                                
                                                            
                                                        
												
												
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