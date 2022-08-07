 <?php 
require dirname( dirname(__FILE__) ).'/include/lanconfig.php';

$data = json_decode(file_get_contents('php://input'), true);
 
$uid = $data['uid'];
if($uid == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{ 
$count = $lundry->query("select * from tbl_user where id=".$uid."")->num_rows;
if($count != 0)
{
$wallet = $lundry->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
$curr = $lundry->query("select scredit,rcredit from tbl_setting")->fetch_assoc();
$pol = array();
$c = array();
$sel = $lundry->query("select * from tbl_page where status=1");
while($row = $sel->fetch_assoc())
{
   
		
		$pol['title'] = $row['title'];
		
		$pol['description'] = $row['description'];
		
		
		$c[] = $pol;
	
	
}

$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Wallet Balance Get Successfully!","code"=>$wallet['code'],"signupcredit"=>$curr['scredit'],"refercredit"=>$curr['rcredit'],"mobile"=>'+917276465975',"email"=>'support@cscodetech.com',"pagelist"=>$c);
}
else 
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Not Exist User!");
}
}
echo json_encode($returnArr);

