<?php 
require dirname( dirname(__FILE__) ).'/include/lanconfig.php';
header('Content-type: text/json');
$vehicle = $lundry->query("SELECT * from tbl_code where status=1");
$myarray = array();
while($row = $vehicle->fetch_assoc())
{
	$myarray[] = $row;
	
}
$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Country Code List Get Successfully!!!","Codelist"=>$myarray);
echo json_encode($returnArr);