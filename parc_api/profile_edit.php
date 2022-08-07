<?php 
require dirname( dirname(__FILE__) ).'/include/lanconfig.php';
require dirname( dirname(__FILE__) ).'/include/laundrore.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['name'] == '' or $data['password'] == '' or $data['uid'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    
    $name = strip_tags(mysqli_real_escape_string($lundry,$data['name']));
   
    $email = strip_tags(mysqli_real_escape_string($lundry,$data['email']));
     $password = strip_tags(mysqli_real_escape_string($lundry,$data['password']));
	 
$uid =  strip_tags(mysqli_real_escape_string($lundry,$data['uid']));
$checkimei = $lundry->query("select * from tbl_user where  `id`=".$uid."")->num_rows;

if($checkimei == 0)
    {
		     $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"User Not Exist!!!!");  
	}

else 
{	
	   $table="tbl_user";
  $field = array('name'=>$name,'password'=>$password,'email'=>$email);
  $where = "where id=".$uid."";
$h = new Laundrore();
	  $check = $h->lundryupdateData_Api($field,$table,$where);
	  
            $c = $lundry->query("select * from tbl_user where  `id`=".$uid."")->fetch_assoc();
        $returnArr = array("UserLogin"=>$c,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Profile Update successfully!");
        
    
	}
    
}

echo json_encode($returnArr);