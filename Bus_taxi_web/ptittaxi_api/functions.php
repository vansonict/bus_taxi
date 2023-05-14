<?php

function calculateDistance($latitude1, $longitude1, $latitude2, $longitude2) {
	// degree to radian
	$dLat = deg2rad($latitude2 - $latitude1);
	$dLon = deg2rad($longitude2 - $longitude1);
	$lat1 = deg2rad($latitude1);
	$lat2 = deg2rad($latitude2);
	
	$Radius = 6378.1; // radius of earth
	$a = sin($dLat / 2)*sin($dLat / 2) + sin($dLon / 2)*sin($dLon / 2)*cos($lat1)*cos($lat2);
	$c = 2*atan2(sqrt($a), sqrt(1 - $a));
	return $Radius * $c;
}

?>