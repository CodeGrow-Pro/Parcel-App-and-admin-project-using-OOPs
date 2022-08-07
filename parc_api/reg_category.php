<?php 
require dirname( dirname(__FILE__) ).'/include/lanconfig.php';
require dirname( dirname(__FILE__) ).'/include/laundrore.php';
$data = json_decode(file_get_contents('php://input'), true);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if($data['name'] == '' or $data['id_number'] == '' or $data['user_id'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    
    $user_id = strip_tags(mysqli_real_escape_string($lundry,$data['user_id']));
    $fname = strip_tags(mysqli_real_escape_string($lundry,$data['name']));
    $id_number = strip_tags(mysqli_real_escape_string($lundry,$data['id_number']));

     
    $check_user = $lundry->query("select * from tbl_category_user where user_id='".$user_id."'");
   
    $field_values=array("user_id","name","id_number");
  	$data_values=array("$user_id",'$fname',"$id_number");

    if($check_user->num_rows != 0)
    {
        $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"T Number Already Used!");
    }
    else
    {
    	$table = 'tbl_category_user';
    	$h = new Laundrore();
	  	$checks = $h->lundryinsertdata_Api($field_values,$data_values,$table);
	  	$c = $lundry->query("select * from tbl_category_user where id=".$checks."")->fetch_assoc();
    
        $returnArr = array("UserLogin"=>$c,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Sign Up Done Successfully!");
    }
    
}

echo json_encode($returnArr);