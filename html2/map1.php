<html>
<head>	
	<meta charset="utf-8">
  	<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
  	<title>Карта Сампло</title>
    	<link rel="stylesheet" href="https://js.arcgis.com/4.0/esri/css/main.css">
    	<script src="https://js.arcgis.com/4.0/"></script>

  	<style>
    	html,
    	body,
    	#viewDiv {
      	padding: 0;
      	margin: 0;
      	height: 100%;
      	width: 100%;
    	}
  	</style>

	<script>
 		require([
			"esri/Map",
     		"esri/views/MapView",
      		"esri/Graphic",
      		"esri/geometry/Polygon",
      		"esri/symbols/SimpleFillSymbol",
      		"dojo/domReady!"
		], function(Map, MapView, Graphic, Polygon, SimpleFillSymbol){
  			var map = new Map({
        		basemap: "topo"
      		});

      		var view = new MapView({
        		center: [50.102645, 53.197957],
        		container: "viewDiv",
        		map: map,
        		zoom: 18
      		});

		var fillSymbol = new SimpleFillSymbol({
        		color: [227, 139, 79, 0.8],
        		outline: {
          		color: [255, 255, 255],
          		width: 1
        		}
      		});
		<?php
		$file_array = file("polygons.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		$m=count($file_array);
		for ($n = 0; $n < $m; $n++)
		{
			$pieces = preg_split("/,(?!\s)/", $file_array[$n]);?>

			var polygon = new Polygon({
				rings: [<?php for ($i = 0; $i < count($pieces); $i++) {echo $pieces[$i].', ';}?>]
			});

			var polygonGraphic = new Graphic({
	        	geometry: polygon,
	        	symbol: fillSymbol
	      		});

			view.graphics.add(polygonGraphic);
		<?php } ?>

   		});
	</script>
</head>
<body>
	<div id="viewDiv"></div>
</body>
</html>