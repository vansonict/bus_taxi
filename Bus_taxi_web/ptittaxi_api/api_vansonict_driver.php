<?php 
    require_once 'dbconnect.php';
    if (isset($_GET['action']) && isset($_GET['callback'])) {	
        $action = $_GET['action'];	
        $callback = $_GET['callback'];	
        
        if($action == 'insertdb'){
			$driverName = $_GET['driverName'];
			$numPhone = $_GET['numPhone'];
			$address = $_GET['address'];
            $bks = $_GET['bks'];		
            $password = $_GET['password'];		
            $loaixe = $_GET['cartype'];		
            $hangxe = $_GET['hangxe'];
			$lotrinh = $_GET['lotrinh'];
				
            $result = null;		
			//check tai xe
			$queryDriver = "SELECT SoDienThoai FROM tai_xe WHERE SoDienThoai = " . $numPhone;
			//check xe
            $str= " select bks from xe_khach where bks = '".$bks."'";	
            $query1= mysql_query($queryDriver); 
			$query2= mysql_query($str);
			
            if(mysql_num_rows($query1) == 0 && mysql_num_rows($query2) == 0){
				$insertDri = "INSERT INTO tai_xe(HoTen, SoDienThoai, DiaChi) VALUES ('" . $driverName . "'," . $numPhone . ", '" . $address . ")";
                $insertCar="insert into xe_khach(bks, MatKhau, IDLoaiXe, IDHangXe, IDLoTrinh, IDTaiXe) values ('".$bks."','".$password."','".$loaixe."','".$hangxe."','".$lotrinh."')";
				mysql_query($insertDri);	
                mysql_query($insertCar);			
                $result = array("status" => "ok");		
                
            }else {		
                $result = array("status" => "error");
            }		
            $json = json_encode($result);		
            echo $_GET['callback']."($json)";
		}
       
		//cập nhật ghế
		if($action === 'update-seat') {
			$bks = $_GET['bks'];
			$ghe = $_GET['seat'];
			$trangThai = 2;
			$result = null;	
			
			if($ghe > 0)
				$trangThai = 1;
				
			$sql = "UPDATE xe_khach
					SET SoGheTrong = " . $ghe . ", IDTrangThai = " . $trangThai . "
					WHERE BKS = '" . $bks . "'";
			//echo $sql;
			$booleansql = mysql_query($sql);
			if($booleansql){
				$result = array("status" => "ok");	
			}else {		
                $result = array("status" => "error");
			}
			$json = json_encode($result);		
            echo $callback."($json)";
		}
		
		if($action == 'listdong'){		
			$query = "SELECT IDHangXe, TenHang
						FROM hang_xe";		
			$result = mysql_query($query);		
			$hangtaxi = array();		
			$i = 0;		
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$hangtaxi[$i++] = $row;	
			};		
			$query = "SELECT IDLoaiXe, LoaiXe
						FROM loai_xe";		
			$result = mysql_query($query);		
			$loaitaxi = array();		
			$i = 0;		
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$loaitaxi[$i++] = $row;	
			};	
			//get lộ trình
			$queryRoad = "SELECT IDLoTrinh, LoTrinh
							FROM lo_trinh";
			$result = mysql_query($queryRoad);
			$loTrinh = array();
			$i = 0;
			while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$loTrinh[$i++] = $row;
			};
			$jsonResult = array("hangtaxi" => $hangtaxi,"loaitaxi" => $loaitaxi, "lotrinh" => $loTrinh);		
			$json = json_encode($jsonResult);		
			echo $_GET['callback']."($json)";	
		}	
		if ($action === 'login') {		
			$bks = $_GET['bks'];		
			$pass = $_GET['password'];		
			$pass_query = mysql_query("SELECT MatKhau FROM xe_khach where BKS = '".$bks."'");
			if($row = mysql_fetch_array($pass_query, MYSQL_ASSOC)){
				if($pass == $row['MatKhau']){				
					$result = array("status"=>"ok");
				}else{					
					$result = array("status"=>"error");	
				}	
			}						
			$json = json_encode($result);			
			echo  $_GET['callback']."($json)";	
		}			
		if($action == 'checkinfo'){		
			$bks = $_GET['BKS'];		
			$str= " select BKS from tbl_xetaxi where bks = '".$bks."'";		
			$query1= mysql_query($str);		
			$result = null;
          
			if(mysql_num_rows($query1)==0){			
				$result = array("status" => "ok");
			}else {			
				$result = array("status" => "error");	
			}		
			$json = json_encode($result);		
			echo $_GET['callback']."($json)";
		}	
	}	
?>