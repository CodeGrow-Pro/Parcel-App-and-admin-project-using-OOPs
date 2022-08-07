<?php 
require 'lanconfig.php';
$GLOBALS['lundry'] = $lundry;

class Laundrore {

	function lundrylogin($username,$password,$tblname) {
		if($tblname == 'admin')
		{
		$q = "select * from ".$tblname." where username='".$username."' and password='".$password."'";
	return $GLOBALS['lundry']->query($q)->num_rows;
		}
		else if($tblname == 'lundry_details')
		{
			$q = "select * from ".$tblname." where email='".$username."' and password='".$password."'";
	return $GLOBALS['lundry']->query($q)->num_rows;
		}
		else 
		{
			$q = "select * from ".$tblname." where email='".$username."' and password='".$password."' and status=1";
	return $GLOBALS['lundry']->query($q)->num_rows;
		}
	}
	
	function lundryinsertdata($field,$data,$table){

    $field_values = implode(',',$field);
    $data_values = implode("','",$data);

    $sql = "INSERT INTO $table($field_values) VALUES('$data_values')";
    $result=$GLOBALS['lundry']->query($sql);
    return $result;
  }

  function lundryzoneinsertdata($field,$data,$table){

    $field_values = implode(',',$field);
    // $data_values = implode("','",$data);
    $sql = "INSERT INTO $table($field_values) VALUES($data[0],'$data[1]', '$data[2]', '$data[3]')";
    $result=$GLOBALS['lundry']->query($sql);
    return $result;
  }
  
  

  
  function insmulti($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values) VALUES('$data_values')";
    $result=$GLOBALS['lundry']->multi_query($sql);
  return $result;
  }
  
  function lundryinsertdata_id($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values) VALUES('$data_values')";
    $result=$GLOBALS['lundry']->query($sql);
  return $GLOBALS['lundry']->insert_id;
  }
  
  function lundryinsertdata_Api($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values) VALUES('$data_values')";
    $result=$GLOBALS['lundry']->query($sql);
  return $result;
  }
  
  function lundryinsertdata_Api_Id($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);
    $sql = "INSERT INTO $table($field_values) VALUES('$data_values')";
    $result=$GLOBALS['lundry']->query($sql);
    return $GLOBALS['lundry']->insert_id;
  }
  
  function lundryupdateData($field,$table,$where){
    $cols = array();
    foreach($field as $key=>$val) {
        if($val != NULL) // check if value is not null then only add that colunm to array
        {
			
           $cols[] = "$key = '$val'"; 
			
        }
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " $where";
    $result=$GLOBALS['lundry']->query($sql);
    return $result;
  }
  
  

  
   function lundryupdateData_Api($field,$table,$where){
$cols = array();

    foreach($field as $key=>$val) {
        if($val != NULL) // check if value is not null then only add that colunm to array
        {
           $cols[] = "$key = '$val'"; 
        }
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " $where";
$result=$GLOBALS['lundry']->query($sql);
    return $result;
  }
  
  
  
  
  function lundryupdateData_single($field,$table,$where){
$query = "UPDATE $table SET $field";

$sql =  $query.' '.$where;
$result=$GLOBALS['lundry']->query($sql);
  return $result;
  }
  
  function lundryDeleteData($where,$table){

    $sql = "Delete From $table $where";
    $result=$GLOBALS['lundry']->query($sql);
  return $result;
  }
  
  function lundryDeleteData_Api($where,$table){

    $sql = "Delete From $table $where";
    $result=$GLOBALS['lundry']->query($sql);
  return $result;
  }
 
}
?>