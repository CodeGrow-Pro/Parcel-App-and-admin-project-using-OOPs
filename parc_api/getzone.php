<?php 
require dirname( dirname(__FILE__) ).'/include/lanconfig.php';
header('Content-type: text/json');
$coordinates = $lundry->query("SELECT ST_AsGeoJSON(`coordinates`), ST_AsText(ST_Centroid(`coordinates`)) as center  FROM `zones` WHERE status=1");
	$kl = array();
	$js = array();
	while($row = $coordinates->fetch_array())
	{
		$data = json_decode($row[0]);
		$rows = $data->coordinates[0];
		$datas = array();

		foreach ($rows as $row) {
			$datas['lat'] = $row[1];
			$datas['lng'] = $row[0];
			$js[] = $datas;
		}

	}
$main_data = $lundry->query("SELECT * from tbl_setting")->fetch_assoc();
echo json_encode(array('Zone'=>$js,'Main_data'=>$main_data));
