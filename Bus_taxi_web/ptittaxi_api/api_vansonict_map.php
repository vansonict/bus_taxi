<?php

include_once 'dbconnect.php';
include_once 'functions.php';
	
if (isset($_GET['action'])) {
	$action = $_GET['action'];
	if ($action == 'getCustomerLog' && isset($_GET['lat']) && isset($_GET['lon'])) {
		$driverLat = floatval($_GET['lat']);
		$driverLon = floatval($_GET['lon']);		
		$now = new DateTime('now');
		$nowTimestamp = $now->getTimestamp();
		
		$query = "SELECT * FROM tbl_khachhangLog 
				WHERE $nowTimestamp - UNIX_TIMESTAMP(time_stamp) < 24*3600*30";		
	    $result = mysql_query($query) or die('Could not select '.mysql_error());
		
		$minDistance = 999999;
		$mPhoneNumber = null;
		$mLat = 0.0;
		$mLon = 0.0;
		
		while ($picture = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$lat = $picture['lat'];
			$lon = $picture['lon'];
			$phoneNumber = $picture['phonenumber'];
			
			$distance = calculateDistance($lat, $lon, $driverLat, $driverLon);
			if ($distance < $minDistance) {
				$minDistance = $distance;
				$mPhoneNumber = $phoneNumber;
				$mLat = $lat;
				$mLon = $lon;
			}
        }

		$customer = array('latitude' => $mLat,
				'longitude' => $mLon,
				'phoneNumber' => $mPhoneNumber);				
		$jsonCustomer = json_encode($customer);
		echo $_GET['callback']."($jsonCustomer)";
	}
	else if ($action == 'insertFromTg') {
		if (isset($_POST['lat']) && isset($_POST['lon']) && isset($_POST['hangTaxiId'])
				&& isset($_POST['loaiTaxiId']) && isset($_POST['phoneNumber'])) {
					
			$lat = $_POST['lat'] * 1000000;
			$lon = $_POST['lon'] * 1000000;
			$hangTaxiId = $_POST['hangTaxiId'];
			$loaiTaxiId = $_POST['loaiTaxiId'];
			$phoneNumber = $_POST['phoneNumber'];
			
			$query = "INSERT INTO tbl_khachhangLog(hangtaxi_id, loaitaxi_id, phonenumber, lat, lon) 
					VALUES('$hangTaxiId', '$loaiTaxiId', '$phoneNumber', '$lat', '$lon')";
			if (!mysql_query($query)) die("101 ". mysql_error());
			else echo "100 OK";
		} 
		else echo "201 Not enough parameter";		
	}
	else if ($action == 'getConfig') {
		$query = "SELECT name, value FROM tbl_config";
		$result = mysql_query($query) or die('Could not select'.mysql_error());

		$config = array();		
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			if ($row['name'] == "giaidoan") {
				$config['giaidoan'] = $row['value'];
			}	
			else if ($row['name'] == 'sdt_tg') {
				$config['sdt_tg'] = $row['value'];
			}
		}
		$jsonConfig = json_encode($config);
		echo $_GET['callback']."($jsonConfig)";
	} 
}

?>