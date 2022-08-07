<?php 
require dirname( dirname(__FILE__) ).'/include/lanconfig.php';
require dirname( dirname(__FILE__) ).'/include/laundrore.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['uid'] == '' or $data['order_id'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
	 $order_id = $lundry->real_escape_string($data['order_id']);
 $uid =  $lundry->real_escape_string($data['uid']);
 
 
 $table="tbl_order";
  $field = array('o_status'=>'Cancelled');
  $where = "where uid=".$uid." and id=".$order_id."";
$h = new Laundrore();
	  $check = $h->lundryupdateData_Api($field,$table,$where);
 $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Cancelled successfully!");
 
}
echo json_encode($returnArr);
?>