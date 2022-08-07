<?php 
require dirname( dirname(__FILE__) ).'/include/lanconfig.php';
require dirname( dirname(__FILE__) ).'/include/laundrore.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['uid'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
	$uid = $data['uid'];
	$pol= array();
	$pols = array();
	$r = $lundry->query("select * from tbl_order where uid=".$uid."");
	while($olist = $r->fetch_assoc())
	{
	$pol['package_number'] = 'Package'.$olist['id'];
	$pol['orderid'] = $olist['id'];
	$pol['pick_address'] = $olist['pick_address'];
	$pol['pick_lat'] = $olist['pick_lat'];
	$pol['pick_lng'] = $olist['pick_lng'];
	$pol['drop_address'] = $olist['drop_address'];
	$pol['drop_lat'] = $olist['drop_lat'];
	$pol['drop_lng'] = $olist['drop_lng'];
	$pol['p_total'] = $olist['o_total'];
	$pol['date_time'] = $olist['odate'];
	$pol['order_status'] = $olist['o_status'];
	$pol['transaction_id'] = $olist['trans_id'];
	$pol['wall_amt'] = $olist['wall_amt'];
	$pol['cou_amt'] = $olist['cou_amt'];
	$pol['subtotal'] = $olist['subtotal'];
	$pname = $lundry->query("select * from tbl_payment_list where id=".$olist['p_method_id']."")->fetch_assoc();
		$pol['p_method_name'] = $pname['title'];
	$pol['p_method_img'] = $pname['img'];
	$vname = $lundry->query("select * from tbl_vehicle where id=".$olist['vehicleid']."")->fetch_assoc();
	$pol['v_type'] = $vname['title'];
	$pol['v_img'] = $vname['img'];
	 if($olist['rid'] == 0)
	{
		$pol['rider_name'] = '';
		$pol['rider_img'] = '';
	}
	else 
	{
	$riderdata = $lundry->query("select * from tbl_rider where id=".$olist['rid']."")->fetch_assoc();
	$pol['rider_name'] = $riderdata['title'];
	$pol['rider_img'] = $riderdata['rimg'];
	
	}
	 $cname = $lundry->query("select * from tbl_category where id=".$olist['cat_id']."")->fetch_assoc();
	$pol['cat_img'] = $cname['cat_img'];
	$pol['cat_name'] = $cname['cat_name'];
	$pols[] = $pol;
	}
	$returnArr = array("Historyinfo"=>$pols,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Information  Get Successfully!!!");
}
echo json_encode($returnArr);
?>