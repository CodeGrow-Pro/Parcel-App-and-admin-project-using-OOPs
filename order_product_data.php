<?php 

require 'include/lanconfig.php';

$pid = $_POST['pid'];
$c = $lundry->query("select * from tbl_order where id=".$pid."")->fetch_assoc();
$udata = $lundry->query("select * from tbl_user where id=".$c['uid']."")->fetch_assoc();
$pdata = $lundry->query("select * from tbl_payment_list where id=".$c['p_method_id']."")->fetch_assoc();
$cdata = $lundry->query("select * from tbl_category where id=".$c['cat_id']."")->fetch_assoc();
$vdata = $lundry->query("select * from tbl_vehicle where id=".$c['vehicleid']."")->fetch_assoc();
$rdata = $lundry->query("select * from tbl_rider where id=".$c['rid']."")->fetch_assoc();

function distance($lat1, $lon1, $lat2, $lon2, $unit) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
      return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
  } else {
      return $miles;
  }
}

?>

<div style="margin-left: auto;float: right;">
<button id='btn' class="btn btn-primary text-right cmd"  style="margin-left:2px;" onclick='downloadimage();'  style="float:right;"><i class="fas fa-camera" aria-hidden="true"></i></button>&nbsp;&nbsp;
<button id='btn' class="btn btn-primary text-right cmd" style="margin-left:2px;" onclick="printDiv();"  style="float:right;"><i class="fas fa-file-pdf"></i></button>
</div>

<div id="divprint">
 
  <div class="card-body bg-white mb-2">
   
                <div class="row d-flex">
                  <div class="col-md-3">
                    <!-- Heading -->
                    <h6 class="text-muted mb-1 card-title">Order No:</h6>
                    <!-- Text -->
                    <p class="mb-lg-0 font-size-sm font-weight-bold"><?php echo $pid;?></p>
                  </div>
                  <?php 
$date=date_create($c['odate']);
$order_date =  date_format($date,"d-m-Y");
?>
                  <div class="col-md-3">
                    <!-- Heading -->
                    <h6 class="text-muted mb-1 card-title">Order date:</h6>
                    <!-- Text -->
                    <p class="mb-lg-0 font-size-sm font-weight-bold">
                      <span><?php echo $order_date;?></span>
                    </p>
                  </div>
                  
                  <div class="col-md-3">
                    <!-- Heading -->
                    <h6 class="text-muted mb-1 card-title">Mobile Number:</h6>
                    <!-- Text -->
                    <p class="mb-0 font-size-sm font-weight-bold"> <?php echo $udata['mobile'];?></p>
                  </div>
                  
                  <div class="col-md-3">
                    <!-- Heading -->
                    <h6 class="text-muted mb-1 card-title">Customer Name:</h6>
                    <!-- Text -->
                    <p class="mb-0 font-size-sm font-weight-bold"><?php echo $udata['name'];?></p>
                  </div>
				  
				  
                  
                </div>
              </div>
              
              <div class="card style-2 mb-2">
                <div class="card-header">
                  <h4 class="mb-0 card-title">Total Order</h4>
                </div>
                <div class="card-body">
                  <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                    <li class="list-group-item d-flex">
                      <span>Subtotal</span>
                      <span class="ml-auto float-right" style="float: right !important;
    margin-left: auto!important;"><?php echo $c['subtotal'].' '.$set['currency'];?></span>
                    </li>
                  <?php 
  if($c['cou_amt'] != 0)
  {
  ?>
                    <li class="list-group-item d-flex">
                      <span>Coupon Code</span>
                      <span class="ml-auto float-right" style="float: right !important;
    margin-left: auto!important;"><?php echo $c['cou_amt'].' '.$set['currency'];?></span>
                    </li>
                     <?php } ?>
					 
					 <?php 
  if($c['wall_amt'] != 0)
  {
  ?>
                    <li class="list-group-item d-flex">
                      <span>Wallet</span>
                      <span class="ml-auto float-right" style="float: right !important;
    margin-left: auto!important;"><?php echo $c['wall_amt'].' '.$set['currency'];?></span>
                    </li>
                     <?php } ?>
					 
					  
                    <li class="list-group-item d-flex font-size-lg font-weight-bold">
					<?php if($pdata['title'] == 'Cash On Delivery')
					{
						?>
						<span>Net Amount <b>(Remain To Pay)</b></span>
						<?php 
					}
					else 
					{
						?>
						<span>Net Amount <b>(Paid)</b></span>
						<?php 
					}
					?>
                      
                      <span class="ml-auto float-right" style="float: right !important;
    margin-left: auto!important;"><?php echo $c['o_total'].' '.$set['currency'];?></span>
                    </li>
					
					
					
					
                  </ul>
                </div>
              </div>
			  
			  <div class="card style-2 mb-2">
                <div class="card-header">
                  <h4 class="mb-0 card-title">Payment & Category & Vehicle & Total Distance Information</h4>
                </div>
                <div class="card-body">
                  <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
				  
			  <li class="list-group-item d-flex font-size-lg font-weight-bold">
                      <span class="card-title">Paymen Gateway?</span>
                      <span class="ml-auto float-right" style="float: right !important;
    margin-left: auto!important;"><b> <img src="<?php echo $pdata['img'];?>" style="width: 20px;"> <?php echo $pdata['title'];?></b></span>
                    </li>
					
					<li class="list-group-item d-flex font-size-lg font-weight-bold">
                      <span class="card-title">Category?</span>
                      <span class="ml-auto float-right" style="float: right !important;
    margin-left: auto!important;"><img src="<?php echo $cdata['cat_img'];?>" style="width: 20px;"> <b><?php echo $cdata['cat_name'];?></b></span>
                    </li>
					
					<li class="list-group-item d-flex font-size-lg font-weight-bold">
                      <span class="card-title">Vehicle Type?</span>
                      <span class="ml-auto float-right" style="float: right !important;
    margin-left: auto!important;"><img src="<?php echo $vdata['img'];?>" style="width: 20px;"> <b><?php echo $vdata['title'];?></b></span>
                    </li>
					<?php 
					if($c['rid'] == 0)
					{
					}
					else 
					{
					?>
					<li class="list-group-item d-flex font-size-lg font-weight-bold">
                      <span class="card-title">Rider Details?</span>
                      <span class="ml-auto float-right" style="float: right !important;
    margin-left: auto!important;"><img src="<?php echo $rdata['rimg'];?>" style="width: 20px;"> <b><?php echo $rdata['title'];?> ( <?php echo $rdata['mobile'];?> )</b></span>
                    </li>
					<?php } ?>
					
					<li class="list-group-item d-flex font-size-lg font-weight-bold">
                      <span class="card-title">Total Distance(KM)?</span>
                      <span class="ml-auto float-right" style="float: right !important;
    margin-left: auto!important;"><i class="fas fa-map-pin"></i> <b><?php echo number_format((float)distance($c['pick_lat'], $c['pick_lng'], $c['drop_lat'],$c['drop_lng'], "K"), 2, '.', '').' Kms';?></b></span>
                    </li>
					 </ul>
                </div>
              </div>
              <div class="card style-2">
                <div class="card-header">
                  <h4 class="mb-0">Pickup &amp; Drop &amp; Order Status Details</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                                       
                    <div class="col-12 col-md-12" style="margin-bottom: 10px;display:flex;">
                      <!-- Heading -->
					   <div class="col-md-4">
                      <p class="mb-2 card-title font-weight-bold">
                        Pickup Address:
                      </p>

                      <p class="mb-7 mb-md-0">
                       <?php echo $c['pick_address'];?>
                      </p>
					  </div>
					  
					  <div class="col-md-4">
                      <p class="mb-2 card-title font-weight-bold">
                        Pickup Name:
                      </p>

                      <p class="mb-7 mb-md-0">
                       <?php echo $udata['name'];?>
                      </p>
					  </div>
					  
					  <div class="col-md-4">
                      <p class="mb-2 card-title font-weight-bold">
                        Pickup Mobile:
                      </p>

                      <p class="mb-7 mb-md-0">
                       <?php echo $udata['mobile'];?>
                      </p>
					  </div>
  
                    </div>
					
					<div class="col-12 col-md-12" style="margin-bottom: 10px;display:flex;">
                      <!-- Heading -->
					   <div class="col-md-4">
                      <p class="mb-2 card-title font-weight-bold">
                        Drop Address:
                      </p>

                      <p class="mb-7 mb-md-0">
                       <?php echo $c['drop_address'];?>
                      </p>
					  </div>
					  
					  <div class="col-md-4">
                      <p class="mb-2 card-title font-weight-bold">
                        Drop Name:
                      </p>

                      <p class="mb-7 mb-md-0">
                       <?php echo $c['drop_name'];?>
                      </p>
					  </div>
					  
					  <div class="col-md-4">
                      <p class="mb-2 card-title font-weight-bold">
                        Drop Mobile:
                      </p>

                      <p class="mb-7 mb-md-0">
                       <?php echo $c['drop_mobile'];?>
                      </p>
					  </div>
  
                    </div>
                    
                    <div class="col-12 col-md-12">
<?php 
if($c['p_method_id'] == 2)
{
}
else
{
  ?>
                      <!-- Heading -->
                      <p class="mb-2 card-title font-weight-bold">
                       Transaction Id:
                      </p>

                      <p class="mb-2 text-gray-500">
                        <?php echo $c['trans_id'];?>
                      </p>
<?php 
}
?>
                      <!-- Heading -->
                      <p class="mb-2 card-title font-weight-bold">
                        Order Status:
                      </p>

                      <p class="mb-0">
                        <?php echo $c['o_status'];?>
                      </p>

                    </div>
					
                  </div>
                </div>
              </div>
              
</div>