<?php 
require dirname( dirname(__FILE__) ).'/include/lanconfig.php';
require dirname( dirname(__FILE__) ).'/include/laundrore.php';
header('Content-type: text/json');
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'), true);

if($data['uid'] == '' or $data['wallet'] == '')
{
    
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $wallet = strip_tags(mysqli_real_escape_string($lundry,$data['wallet']));
$uid =  strip_tags(mysqli_real_escape_string($lundry,$data['uid']));
$checkimei = mysqli_num_rows(mysqli_query($lundry,"select * from tbl_user where  `id`=".$uid.""));

if($checkimei != 0)
    {
		
		
      $vp = $lundry->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
	  
  $table="tbl_user";
  $field = array('wallet'=>$vp['wallet']+$wallet);
  $where = "where id=".$uid."";
$h = new Laundrore();
	  $check = $h->lundryupdateData_Api($field,$table,$where);
	  
	   $timestamp = date("Y-m-d H:i:s");
	   
	   $table="wallet_report";
  $field_values=array("uid","message","status","amt");
  $data_values=array("$uid",'Wallet Balance Added!!','Credit',"$wallet");
   
      $h = new Laundrore();
	  $checks = $h->lundryinsertdata_Api($field_values,$data_values,$table);
	  
	  
	   $wallet = $lundry->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
        $returnArr = array("wallet"=>$wallet['wallet'],"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Wallet Update successfully!");
        
    
	}
    else
    {
      $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"User Deactivate By Admin!!!!");  
    }
    
}

echo json_encode($returnArr);