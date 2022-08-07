<?php 
require dirname( dirname(__FILE__) ).'/include/lanconfig.php';
header('Content-type: text/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'), true);
$vehicle = $lundry->query("SELECT * from tbl_vehicle where status=1");
$myarray = array();
$arr = array();
$long = $data['long'];
$lat = $data['lat'];
$zone = $lundry->query("select * FROM zones where ST_Contains(coordinates, GeomFromText('POINT($long $lat)'))")->fetch_assoc();
$zoneid = $zone['id'];
while($row = $vehicle->fetch_assoc())
{
	$myarray['id'] = $row['id'];
	$myarray['title'] = $row['title'];
	$myarray['img'] = $row['img'];
	$myarray['description'] = $row['description'];
	$myarray['capcity'] = $row['capcity'];
	$myarray['size'] = $row['size'];
	$myarray['start_distance'] = $row['ukms'];
	$myarray['start_price'] = $row['uprice'];
	$myarray['after_price'] = $row['aprice'];
	$myarray['time_taken'] = $row['ttime'];
	$vehicle_check = $lundry->query("select * from tbl_rider where dzone=".$zoneid." and vehiid=".$row['id']."")->num_rows;
	if($vehicle_check !=0)
	{
	$myarray['is_available'] = '1';
	}
	else 
	{
		$myarray['is_available'] = '0';
	}
	$arr[] = $myarray;
	
}

$sel = $lundry->query("select * from tbl_payment_list where status =1 ");
$s = array();
while($sp = $sel->fetch_assoc())
{
	$s[] = $sp;
}

$vehicle = $lundry->query("SELECT * from tbl_category where cat_status=1");
$myarrays = array();
while($row = $vehicle->fetch_assoc())
{
	$myarrays[] = $row;
	
}

$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Vehicle List Get Successfully!!!","Vehiclelist"=>$arr,"Paymentdata"=>$s,"Categorylist"=>$myarrays);
echo json_encode($returnArr);

;