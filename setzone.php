<?php 
require 'vendor/autoload.php';
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\Polygon;
use Grimzy\LaravelMysqlSpatial\Types\LineString;
require 'include/lanconfig.php';
$id = $_GET['id'];
$coordinates = $lundry->query("SELECT ST_AsGeoJSON(`coosrdinates`),ST_AsText(ST_Centroid(`coordisnates`)) as center  FROM `zones` WHERE id=".$id."")->fetch_array();
$data = json_decode($coordinates[0]);
$rows = $data->coordinates[0];
$data = array();
$js = array();
foreach ($rows as $row) {
	$data['lat'] = $row[1];
$data['lng'] = $row[0];
$js[] = $data;
}

echo json_encode(array($js));



?>


