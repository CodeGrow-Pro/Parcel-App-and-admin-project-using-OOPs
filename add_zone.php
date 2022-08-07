<!doctype html>
<html lang="en">

    

<?php 

require 'vendor/autoload.php';
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\Polygon;
use Grimzy\LaravelMysqlSpatial\Types\LineString;
include 'include/head.php';
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

?>

    <body>

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <?php include 'include/inside.php';?>

            <!-- ========== Left Sidebar Start ========== -->
           <?php include 'include/sidebar.php';?>
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
<div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
									<?php 
				if(isset($_GET['id']))
				{
					$data = $lundry->query("select * from zones where id=".$_GET['id']."")->fetch_assoc();
					?>
					<h4 class="card-title mb-4">Edit Zone </h4>
					<form method="post" enctype="multipart/form-data">
                                            <div class="row">
											<div class="form-group">
												<label for="a2" class="il-gray fs-14 fw-500 align-center">Zone Name</label>
                                                   
                                                    <input type="text" class="form-control" placeholder="Enter Zone Name" value="<?php echo $data['title'];?>" name="zname" required>
                                                </div>
												
												
												<div class="form-group">
												<label for="a2" class="il-gray fs-14 fw-500 align-center">Zone Status</label>
                                                    
                                                    <select name="status" class="form-control" required>
													<option value="">Select Status</option>
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>UnPublish</option>
											</select>
                                                </div>
												
												
												<div class="form-group">
<label class="input-label" for="exampleFormControlInput1">Coordinates<span class="input-label-secondary" title="(draw your zone area on the map)">(draw your zone area on the map)</span></label>
<textarea type="text" rows="8" name="coordinates" id="coordinates" class="form-control" readonly="" style="height: 40px;"><?php echo $data['alias'];?></textarea>
</div>
												
												<div class="form-group" style="height:500px;">
												<input id="pac-input" class="controls rounded" style="height: 3em;width:fit-content;" title="Search your location here" type="text" placeholder="Search here" />
<div id="map-canvas" style="height: 100%; margin:0px; padding: 0px;"></div>
												</div>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <button type="submit" name="edit_restban" class="btn btn-primary w-md">Edit  Zone</button>
                                                </div>
                                            
                                        </form>
				<?php } else { ?>
									<h4 class="card-title mb-4">Add Zone </h4>
                        <!-- start page title -->
                        <form method="post" enctype="multipart/form-data">
                                            <div class="row">
											
                                                <div class="form-group">
												<label for="a2" class="il-gray fs-14 fw-500 align-center">Zone Name</label>
                                                   
                                                    <input type="text" class="form-control" placeholder="Enter Zone Name" name="zname" required>
                                                </div>
												
												
												<div class="form-group">
												<label for="a2" class="il-gray fs-14 fw-500 align-center">Zone Status</label>
                                                    
                                                    <select name="status" class="form-control" required>
													<option value="">Select Status</option>
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                                </div>
												
												<div class="form-group">
<label class="input-label" for="exampleFormControlInput1">Coordinates<span class="input-label-secondary" title="(draw your zone area on the map)">(draw your zone area on the map)</span></label>
<textarea type="text" rows="8" name="coordinates" id="coordinates" class="form-control" readonly="" style="height: 40px;"></textarea>
</div>
												
												<div class="form-group" style="height:500px;">
												<input id="pac-input" class="controls rounded" style="height: 3em;width:fit-content;" title="Search your location here" type="text" placeholder="Search here" />
<div id="map-canvas" style="height: 100%; margin:0px; padding: 0px;"></div>
												</div>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <button type="submit" name="add_ban" class="btn btn-primary w-md">Add  Zone</button>
                                                </div>
                                            
                                        </form>
				<?php } ?>
										</div>
										</div>
										</div>
										</div>
                        <!-- end row -->
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <!-- Transaction Modal -->
              
                
               
            </div>
            <!-- end main content-->

        </div>
        
        

       <?php include 'include/lundryfoot.php';?>
	   
	   <?php 
		if(isset($_POST['add_ban']))
		{
			
			$zname = $_POST['zname'];
			$okey = $_POST['status'];
			$coordinates = $_POST['coordinates'];
           
        foreach(explode('),(',trim($coordinates,'()')) as $index=>$single_array){
            if($index == 0){
                $lastcord = explode(',',$single_array);
            }
            $coords = explode(',',$single_array);
            $polygon[] = new Point($coords[0], $coords[1]);
        }
		
		$polygon[] = new Point($lastcord[0], $lastcord[1]);
		$pv = new Polygon([new LineString($polygon)]);

	    $table="zones";
        $field_values = array("coordinates","title","status","alias");

        $data_values = array("ST_GeomFromText('POLYGON($pv)')","$zname","$okey","$coordinates");

        $h = new Laundrore();
	    $check = $h->lundryzoneinsertdata($field_values,$data_values,$table);
if($check == 1)
{
?>

 <script src="assets/izitoast/js/iziToast.min.js"></script>
	 <script>
 iziToast.success({
    title: 'Zone Add Successfully!!',
    message: 'Zone Section!!',
    position: 'topRight'
  });
	 
	 setTimeout(function(){ 
	window.location.href="add_zone.php"},3000);
	 </script>
  
<?php
}

		}
		?>
		
		<?php 
		if(isset($_POST['edit_restban']))
		{
			
			
			$zname = $_POST['zname'];
			$okey = $_POST['status'];
			$coordinates = $_POST['coordinates'];
			
	foreach(explode('),(',trim($coordinates,'()')) as $index=>$single_array){
            if($index == 0)
            {
                $lastcord = explode(',',$single_array);
            }
            $coords = explode(',',$single_array);
            $polygon[] = new Point($coords[0], $coords[1]);
        }
		
		$polygon[] = new Point($lastcord[0], $lastcord[1]);
		 $pv = new Polygon([new LineString($polygon)]);
		  
$table="zones";
  $field = array('coordinates'=>"ST_GeomFromText('POLYGON($pv)')",'title'=>$zname,'status'=>$okey,'alias'=>$coordinates);
  $where = "where id=".$_GET['id']."";
$h = new Laundrore();
$check = $h->lundryzoneupdateData($field,$table,$where);
	  

if($check == 1)
{
?>

 <script src="assets/izitoast/js/iziToast.min.js"></script>
	 <script>
 iziToast.success({
    title: 'Zone Add Successfully!!',
    message: 'Zone Section!!',
    position: 'topRight'
  });
	 
	 setTimeout(function(){ 
	window.location.href="list_zone.php"},3000);
	 </script>
  
<?php
}


	
	
		}
		?>
    </body>

   
   <?php      if(!isset($_GET['id']))
				{
					?>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAnQJv56D7bGV68W6wCw0YB6ckIUtcmly8&libraries=drawing,places&v=3.45.8"></script> 			
		<script>
		
        var map; // Global declaration of the map
        var drawingManager;
        var lastpolygon = null;
        var polygons = [];

        function resetMap(controlDiv) {
            // Set CSS for the control border.
            const controlUI = document.createElement("div");
            controlUI.style.backgroundColor = "#fff";
            controlUI.style.border = "2px solid #fff";
            controlUI.style.borderRadius = "3px";
            controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
            controlUI.style.cursor = "pointer";
            controlUI.style.marginTop = "8px";
            controlUI.style.marginBottom = "22px";
            controlUI.style.textAlign = "center";
            controlUI.title = "Reset map";
            controlDiv.appendChild(controlUI);
            // Set CSS for the control interior.
            const controlText = document.createElement("div");
            controlText.style.color = "rgb(25,25,25)";
            controlText.style.fontFamily = "Roboto,Arial,sans-serif";
            controlText.style.fontSize = "10px";
            controlText.style.lineHeight = "16px";
            controlText.style.paddingLeft = "2px";
            controlText.style.paddingRight = "2px";
            controlText.innerHTML = "X";
            controlUI.appendChild(controlText);
            // Setup the click event listeners: simply set the map to Chicago.
            controlUI.addEventListener("click", () => {
                lastpolygon.setMap(null);
                $('#coordinates').val('');
                
            });
        }

        function initialize() {
                                    var myLatlng = { lat: 21.2408, lng: 72.8806 };


            var myOptions = {
                zoom: 13,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
            drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.POLYGON,
                drawingControl: true,
                drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: [google.maps.drawing.OverlayType.POLYGON]
                },
                polygonOptions: {
                editable: true
                }
            });
            drawingManager.setMap(map);


            //get current location block
            // infoWindow = new google.maps.InfoWindow();
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                    const pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };
                    map.setCenter(pos);
                });
            }

            google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
                if(lastpolygon)
                {
                    lastpolygon.setMap(null);
                }
                $('#coordinates').val(event.overlay.getPath().getArray());
                lastpolygon = event.overlay;
                auto_grow();
            });

            const resetDiv = document.createElement("div");
            resetMap(resetDiv, lastpolygon);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(resetDiv);

            // Create the search box and link it to the UI element.
            const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });
            let markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                return;
                }
                // Clear out the old markers.
                markers.forEach((marker) => {
                marker.setMap(null);
                });
                markers = [];
                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();
                places.forEach((place) => {
                if (!place.geometry || !place.geometry.location) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                const icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25),
                };
                // Create a marker for each place.
                markers.push(
                    new google.maps.Marker({
                    map,
                    icon,
                    title: place.name,
                    position: place.geometry.location,
                    })
                );

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
                });
                map.fitBounds(bounds);
            });
        }

function auto_grow() {
        let element = document.getElementById("coordinates");
        element.style.height = "5px";
        element.style.height = (element.scrollHeight)+"px";
    }
        google.maps.event.addDomListener(window, 'load', initialize);
		</script>
				<?php } else { ?>
		<script src="https://maps.googleapis.com/maps/api/js?v=3.45.8&key=AIzaSyAnQJv56D7bGV68W6wCw0YB6ckIUtcmly8&libraries=drawing,places"></script>
	<script>
    auto_grow();
    function auto_grow() {
        let element = document.getElementById("coordinates");
        element.style.height = "5px";
        element.style.height = (element.scrollHeight)+"px";
    }

</script>
<script>
    var map; // Global declaration of the map
    var lat_longs = new Array();
    var drawingManager;
    var lastpolygon = null;
    var bounds = new google.maps.LatLngBounds();
    var polygons = [];


    function resetMap(controlDiv) {
        // Set CSS for the control border.
        const controlUI = document.createElement("div");
        controlUI.style.backgroundColor = "#fff";
        controlUI.style.border = "2px solid #fff";
        controlUI.style.borderRadius = "3px";
        controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
        controlUI.style.cursor = "pointer";
        controlUI.style.marginTop = "8px";
        controlUI.style.marginBottom = "22px";
        controlUI.style.textAlign = "center";
        controlUI.title = "Reset map";
        controlDiv.appendChild(controlUI);
        // Set CSS for the control interior.
        const controlText = document.createElement("div");
        controlText.style.color = "rgb(25,25,25)";
        controlText.style.fontFamily = "Roboto,Arial,sans-serif";
        controlText.style.fontSize = "10px";
        controlText.style.lineHeight = "16px";
        controlText.style.paddingLeft = "2px";
        controlText.style.paddingRight = "2px";
        controlText.innerHTML = "X";
        controlUI.appendChild(controlText);
        // Setup the click event listeners: simply set the map to Chicago.
        controlUI.addEventListener("click", () => {
            lastpolygon.setMap(null);
            $('#coordinates').val('');
            
        });
    }

    function initialize() {
        var myLatlng = new google.maps.LatLng(21.244497494207994, 72.89035114781187);
        var myOptions = {
            zoom: 13,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

        const polygonCoords = [

                        { lat: 21.259089951353, lng: 72.882684395524 },
                        { lat: 21.24789093392, lng: 72.857793495866 },
                        { lat: 21.227730557734, lng: 72.888177559587 },
                        { lat: 21.240531116109, lng: 72.921651528092 },
                        { lat: 21.254450461714, lng: 72.907746956559 },
                        { lat: 21.259089951353, lng: 72.882684395524 },
                    ];

        var zonePolygon = new google.maps.Polygon({
            paths: polygonCoords,
            strokeColor: "#FFC0CB",
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillOpacity: 0,
        });

       // zonePolygon.setMap(map);

        zonePolygon.getPaths().forEach(function(path) {
            path.forEach(function(latlng) {
                bounds.extend(latlng);
                map.fitBounds(bounds);
            });
        });

        
        drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.POLYGON,
            drawingControl: true,
            drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: [google.maps.drawing.OverlayType.POLYGON]
            },
            polygonOptions: {
            editable: true
            }
        });
        drawingManager.setMap(map);

        google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
            var newShape = event.overlay;
            newShape.type = event.type;
        });

        google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
            if(lastpolygon)
                {
                    lastpolygon.setMap(null);
                }
                $('#coordinates').val(event.overlay.getPath().getArray());
                lastpolygon = event.overlay;
                auto_grow();
        });
        const resetDiv = document.createElement("div");
        resetMap(resetDiv, lastpolygon);
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(resetDiv);

        // Create the search box and link it to the UI element.
        const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });
            let markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                return;
                }
                // Clear out the old markers.
                markers.forEach((marker) => {
                marker.setMap(null);
                });
                markers = [];
                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();
                places.forEach((place) => {
                if (!place.geometry || !place.geometry.location) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                const icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25),
                };
                // Create a marker for each place.
                markers.push(
                    new google.maps.Marker({
                    map,
                    icon,
                    title: place.name,
                    position: place.geometry.location,
                    })
                );

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
                });
                map.fitBounds(bounds);
            });
    }
    google.maps.event.addDomListener(window, 'load', initialize);

    function set_all_zones()
    {
		
		
        $.get({
            url: 'setzones.php',
			data:
			{
				id:<?php echo $_GET['id'];?>
			},
            dataType: 'json',
            success: function (datas) {

                var j = JSON.parse(JSON.stringify(datas));
				var lat = j[0][1].lat;
				var lng = j[0][1].lng;
				
                for(var i=0; i<datas.length;i++)
                {
                    polygons.push(new google.maps.Polygon({
                        paths: datas[i],
                        strokeColor: "#FF0000",
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: "#FF0000",
                        fillOpacity: 0.1,
                    }));
                    polygons[i].setMap(map);
                }
				map.setCenter(new google.maps.LatLng(lat, lng));
				
            },
        });
		
		
    }
    $(document).ready(function(){
        set_all_zones();
		
    });



</script>
				<?php } ?>

</html>