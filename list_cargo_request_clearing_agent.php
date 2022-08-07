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
                                                <th>location</th>
                                                <th>Flammable</th>
                                                <th>Description</th></th>
                                                <!--<th>Budget</th>-->
                                                <!--<th>Required Size</th>-->
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
											 $stmt = $lundry->query("SELECT * FROM `tbl_req_clearing_agent`");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td> <?php echo $row['location']; ?></td>
                                                <td> <?php echo $row['flammable']; ?></td>
                                                <td><?php echo $row['description']; ?></td>
                                                <!--<td><?php echo $row['budget']; ?></td>-->
                                                <!--<td><?php echo $row['size']; ?></td>-->
                                               <!-- <td> <img src="<?php echo $row['front_img']; ?>" width="60px"></td>-->
                                               <!--<td> <img src="<?php echo $row['back_img']; ?>" width="60px"></td>-->
												
												<?php if($row['status'] == 1) { ?>

												
                                                <td><span class="badge rounded-pill bg-success font-size-12">Publish</span></td>
												<?php } else { ?>
												
												<td>
												<span class="badge rounded-pill bg-danger font-size-12">Unpublish</span></td>
												<?php } ?>
												
                                                <td> <a href="update_cargo_request_clearing_agent.php?id=<?php echo $row['id']; ?>" class="view">
                                                                    <span class="fa fa-edit btn btn-info"></span></a>
                                                               <?php 
                                                            $tname = 'tbl_req_clearing_agent';
                                                            $path = 'list_cargo_request_clearing_agent';
                                                            ?>
                                                                <a href="delete.php?did=<?php echo $row['id'];?> & tname=<?php echo $tname;?> & path=<?php echo $path; ?>">
                                                                    <span class="fa fa-trash btn btn-danger"></span></a>
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
   include 'include/laundrore.php'; 
        if(isset($_GET['did'])){
            $table="tbl_req_clearing_agent";
            $where = "where id=".$_GET['did']."";
            $h = new Laundrore();
            $check = $h->lundryDeleteData($where,$table);
            if($check == 1)
            {
                header('Location:list_cargo_request_clearing_agent.php');
         
         	}
        }
        ?>
    </body>



</html>