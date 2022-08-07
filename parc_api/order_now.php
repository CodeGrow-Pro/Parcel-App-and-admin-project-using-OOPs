<?php 
require dirname( dirname(__FILE__) ).'/include/lanconfig.php';
require dirname( dirname(__FILE__) ).'/include/laundrore.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);

function siteURL() {
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
    $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  return $protocol.$domainName;
}

if($data['uid'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
$uid =  $data['uid'];
$vp = $lundry->query("select wallet from tbl_user where id=".$uid."")->fetch_assoc();
	 if($vp['wallet'] >= $data['wall_amt'])
	 {
$p_method_id = $data['p_method_id'];
$pick_address = $data['pick_address'];
$pick_lat = $data['pick_lat'];
$pick_lng = $data['pick_lng'];
$subtotal = $data['subtotal'];
$drop_address = $data['drop_address'];
$drop_lat = $data['drop_lat'];
$drop_lng = $data['drop_lng'];
$drop_name = $data['drop_name'];
$drop_mobile = $data['drop_mobile'];
$vehicleid = $data['vehicleid'];
$cou_id = $data['cou_id'];
$cou_amt = number_format((float)$data['cou_amt'], 2, '.', '');	
$timestamp = date("Y-m-d H:i:s");
$transaction_id = $data['transaction_id'];
$wall_amt = number_format((float)$data['wall_amt'], 2, '.', '');
$o_total = number_format((float)$data['o_total'], 2, '.', '');
$cat_id = $data['cat_id'];

$getzoneid = $lundry->query("select id FROM zones where ST_Contains(coordinates,GeomFromText('POINT(".$pick_lng." ".$pick_lat.")'))")->fetch_assoc();
$zoneid = $getzoneid['id'];
$table="tbl_order";
  $field_values=array("dzone","subtotal","uid","odate","p_method_id","pick_address","pick_lat","cou_id","cou_amt","o_total","pick_lng","trans_id","drop_address","drop_lat","drop_lng","wall_amt","drop_name","drop_mobile","vehicleid","cat_id");
  $data_values=array("$zoneid","$subtotal","$uid","$timestamp","$p_method_id","$pick_address","$pick_lat","$cou_id","$cou_amt","$o_total","$pick_lng","$transaction_id","$drop_address","$drop_lat","$drop_lng","$wall_amt","$drop_name","$drop_mobile","$vehicleid","$cat_id");
  
      $h = new Laundrore();
	  $oid = $h->lundryinsertdata_Api_Id($field_values,$data_values,$table);
	  

if($wall_amt != 0)
{
 $vp = $lundry->query("select wallet from tbl_user where id=".$uid."")->fetch_assoc();
	  $mt = intval($vp['wallet'])-intval($wall_amt);
  $table="tbl_user";
  $field = array('wallet'=>"$mt");
  $where = "where id=".$uid."";
$h = new Laundrore();
	  $check = $h->lundryupdateData_Api($field,$table,$where);
	  
	  $table="wallet_report";
  $field_values=array("uid","message","status","amt");
  $data_values=array("$uid",'Wallet Used in Order Id#'.$oid,'Debit',"$wall_amt");
   
      $h = new Laundrore();
	  $checks = $h->lundryinsertdata_Api($field_values,$data_values,$table);
}

$udata = $lundry->query("select name from tbl_user where id=".$uid."")->fetch_assoc();
$name = $udata['name'];

	   


$content = array(
       "en" => $name.', Your Order #'.$oid.' Has Been Received.'
   );
$heading = array(
   "en" => "Order Received!!"
);

$fields = array(
'app_id' => $set['one_key'],
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid),
'filters' => array(array('field' => 'tag', 'key' => 'userid', 'relation' => '=', 'value' => $uid)),
'contents' => $content,
'headings' => $heading,
'big_picture' => siteURL().'/order_process_img/received.png'
);
$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.$set['one_hash']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);
  
  

	$content = array(
       "en" => 'New Order Arrival!!'
   );
$heading = array(
   "en" => "Check Order And Accept!!"
);

$fields = array(
'app_id' => $set['d_key'],
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid),
'filters' => array(array('field' => 'tag', 'key' => 'vehicleid', 'relation' => '=', 'value' => $vehicleid),array("operator" => "and"),array('field' => 'tag', 'key' => 'dzoneid', 'relation' => '=', 'value' => $zoneid)),
'contents' => $content,
'headings' => $heading
);

$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.$set['d_hash']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);

	
	
	    $tbwallet = $lundry->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Placed Successfully!!!","wallet"=>$tbwallet['wallet'],"order_id" =>$oid);
	 }
	 else 
	 {
		 $tbwallet = $lundry->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
$returnArr = array("ResponseCode"=>"200","Result"=>"false","ResponseMsg"=>"Wallet Balance Not There As Per Order Refresh One Time Screen!!!","wallet"=>$tbwallet['wallet']);
	 }
}

echo json_encode($returnArr);