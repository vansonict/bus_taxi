<?php

include_once 'database.php';
	
if (isset($_GET['action']) && isset($_GET['callback'])) {
	$db = new DBQuery;
	$action = $_GET['action'];
	$callback = $_GET['callback'];
	$idHX = '';
	$idLX = '';
	$end = '';
	
	if ($action == 'searchXe') {
            $sql_hangcar = "SELECT TenHang,IDHangXe FROM hang_xe";	
            $hangcar = $db->loadArray($sql_hangcar);
			
			$sql_carType = "SELECT IDLoaiXe, LoaiXe FROM loai_xe";
			$carType = $db->loadArray($sql_carType);
			
			$carResults = array("hangxe" => $hangcar, "loaixe" => $carType);
			$jsonCar = json_encode($carResults);
            //echo json_encode($records );
            echo $callback."($jsonCar)";
            //echo "<html><body>$jsonTaxiName</body></html>";
	}
	
	if ($action === 'searchInfo') {
		$idHX = $_GET['id_hangxe'];
		$idLX = $_GET['id_loaixe'];
		$end = $_GET['diemden'];
		
		$sql = "SELECT x.BKS, x.TimeArrive, l.LoTrinhTomTat,l.LoTrinhChiTiet
				FROM xe_khach AS x INNER JOIN lo_trinh AS l
					ON x.IDLoTrinh = l.IDLoTrinh
				WHERE x.IDHangXe LIKE '%" . $idHX . "%'
					AND x.IDLoaiXe LIKE '%" . $idLX . "%'
					AND l.LoTrinhChiTiet LIKE '%" . $end . "%'
					AND x.IDTrangThai = 1";
		
		$reInfoArr = $db->loadArray($sql);
		//var_dump($reInfoArr);
		$jsonInfo = json_encode($reInfoArr);
		echo $callback."($jsonInfo)";
	}
	
	if($action == 'checkIMSI'){
            //echo $_GET['IMSI'];
            $imsi = $_GET['IMSI'];
            $sql_checkIMSI = "SELECT COUNT(IMSI)as IMSI, SoDienThoai FROM khach_hang WHERE IMSI = " . $imsi . "";	
            $records = $db->loadArray($sql_checkIMSI);

            $jsonTaxiName = json_encode($records );
            //echo json_encode($records );
            echo $callback."($jsonTaxiName)";
            //echo "<html><body>$jsonTaxiName</body></html>";
	}
	if($action == 'insertPhoneNumber'){
            //echo $_GET['IMSI'];
            $imsi = $_GET['IMSI'];
            $sdt = $_GET['sdt'];
            $sql_insertPhoneNumber = "INSERT INTO khach_hang (SoDienThoai, IMSI) value ('" . $sdt . "',' " . $imsi . "')";
            $result = $db -> query($sql_insertPhoneNumber);
            $jsonn = json_encode($result);
            echo $callback."($jsonn)";
	}
	if($action == 'updatePhoneNumber'){
		//echo $_GET['IMSI'];
		$imsi = $_GET['IMSI'];
		$sdt = $_GET['sdt'];
		$sql_updatePhoneNumber = "UPDATE  khach_hang SET  SoDienThoai =  '" . $sdt . "' WHERE  IMSI ='" . $imsi . "'";
	    $result = $db -> query($sql_updatePhoneNumber);
    	$jsonn = json_encode($result);
    	echo $callback."($jsonn)";
	}
	if($action == 'insertLog'){
		$imsi = $_GET['imsi'];
		$hang = $_GET['hang'];
		$loai = $_GET['loai'];
		$lat = $_GET['lat'];
		$long = $_GET['long'];
		$sdt = $_GET['sdt'];
		$today = date("Y-m-d H:i:s");
		/*
		$sql_checkSDT = "SELECT COUNT(IDKhachHang) FROM khach_hang WHERE SoDienThoai like '" . $sdt . "'";
		$checkKH = $db -> loadResult($sql_idkhachhang);
		if($checkKH == 0){
			$sql_insertPhoneNumber = "INSERT INTO khach_hang (SoDienThoai, IMSI) value ('" . $sdt . "','" . $imsi . "')";
			$db -> query($sql_insertPhoneNumber);
		}
		//get IDKhachHang
		$sql_idkhachhang = "SELECT IDKhachHang FROM khach_hang WHERE SoDienThoai = '". $sdt . "'";
		$idKhachHang = $db -> loadResult($sql_idkhachhang);
		*/
		$idKhachHang = 1;
		$sql_insertLog = "INSERT INTO lich_su (IDHangXe, IDLoaiXe, ThoiGian, IDKhachHang, StartLat, StartLon)
		 VALUE ('" . $hang . "', '" . $loai . "', '" . $today . "','" . $idKhachHang . "','" . $lat . "','" . $long . "')";
    		$result = $db -> query($sql_insertLog);
    	$jsonn = json_encode($result);
    	echo $callback."($jsonn)";
	}
	
	if($action === 'tcinfohx'){
		//echo $_GET['id'];
		$id = $_GET['id'];
		$sql_ckhangtaxi = "SELECT TenHang, SoDienThoai, DiaPhuong FROM hang_xe WHERE IDHangXe = '".$id."'";	
    	$records = $db->loadArray($sql_ckhangtaxi);
    	
		$jsonTaxi = json_encode($records);
		echo $callback."($jsonTaxi)";
	}
}

?>