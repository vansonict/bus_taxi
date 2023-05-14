<?php
include_once '../ptittaxi_api/database.php';
include_once '../ptittaxi_api/dbconnect.php';
include_once '../ptittaxi_api/functions.php';
session_start();

if (isset($_GET['action'])) {
	$action = $_GET['action'];
	
	if ($action === 'getLog' && isset($_SESSION['token']) && isset($_POST['token'])) {
		if ($_SESSION['token'] == $_POST['token'] && isset($_SESSION['hangtaxi_id'])) {
			
			$hangtaxi_id = $_SESSION['hangtaxi_id'];
			$lat = $_SESSION['fix_lat'];
			$default_id = $_SESSION['default_id'];
			 
			$query = "SELECT k.id, l.description, name, phonenumber, lat, lon\n"
		    		. "FROM tbl_hangtaxi AS h, tbl_loaitaxi AS l, tbl_khachhangLog AS k\n"
				    . "WHERE h.id = k.hangtaxi_id\n"
				    . "AND l.id = k.loaitaxi_id\n"
				    . "AND ( k.hangtaxi_id = $hangtaxi_id\n"
				    . "OR ( k.hangtaxi_id = 0 AND $hangtaxi_id = $default_id ))\n" 
				    . "AND k.status = 0\n"
				    . "AND abs(k.lat - $lat) < 3000000\n"
				    . "ORDER BY k.id DESC\n";
			
			$data = array();
			$index = 0;
			$id = array();
			
		    if (!$result = mysql_query($query)) printError(mysql_error());
			while ($row = mysql_fetch_row($result)) {
				$item = array('loaitaxi' => $row[1], 'hangtaxi' => $row[2],
					'phonenumber' => $row[3], 'lat' => $row[4], 'lon' => $row[5]);
				$data[$index] = $item;
				$id[$index] = $row[0];
				$index++;
	        }
			
			if ($index == 0) return;
			$query = "UPDATE tbl_khachhangLog SET status = 1 WHERE id = $id[0]";
			for ($i = 0; $i < $index; $i++) {
				$query = $query . " OR id = $id[$i]";
			}
			if (!$result = mysql_query($query)) printError(mysql_error());
			echo json_encode(array('status' => 'success', 'requests' => $data));
		}
		else printError('username or token does not match, can not request log');
	}
	
	else if ( $action === 'login' && isset($_POST['username']) && isset($_POST['password']) ) {		
            $username = $_POST['username'];
            $password = $_POST['password'];
            $db = new DBQuery;
            //$password = sha1($_POST['password']);

            $query = "SELECT name, value FROM tbl_config WHERE name = 'default_hangtaxi_id'";
            if (!$result = mysql_query($query)) printError("Can not query ". mysql_error());
            if ($row = mysql_fetch_row($result)) {
                    $_SESSION['default_id'] = $row[1];
            }
            else printError("Can not fetch row ". mysql_error());							

            $query = "SELECT a.account, a.hangtaxi_id, d.fix_lat, d.fix_lng\n"
                            ."FROM account AS a, dia_phuong AS d\n"
                            ."WHERE account =  '$username'\n"
                            ."AND a.dia_phuong_id = d.id\n"
                            ."AND a.password =  '$password'\n";
            if (!$result = mysql_query($query)) printError(mysql_error());				
		if ($row = mysql_fetch_row($result)){
			
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			$_SESSION['login'] = 'yes';
			$_SESSION['hangtaxi_id'] = $row[1];
			$_SESSION['fix_lat'] = $row[2];
			$_SESSION['fix_lng'] = $row[3];
			
			$token = generatorToken($username);
			$_SESSION['token'] = $token;
			
			$value = array('status' => 'success', 'token' => $token, 
				'fix_lat' => $row[2], 'fix_lng' => $row[3]);
			echo json_encode($value);	
		} 
		else printError("Can not fetch row " + mysql_error());
            
//            $sql_login = "SELECT a.account, a.hangtaxi_id, d.fix_lat, d.fix_lng"
//                    . " FROM account a INNER JOIN dia_phuong d ON a.dia_phuong_id = d.id"
//                    . " WHERE a.account = '" . $username . "'"
//                    . " AND a.password = '" . $password . "'";
//            $result = $db -> loadRow($sql_login);
//            var_dump($result);
//            if ($result){
//
//                    $_SESSION['username'] = $username;
//                    $_SESSION['password'] = $password;
//                    $_SESSION['login'] = 'yes';
//                    $_SESSION['hangtaxi_id'] = $result[hangtaxi_id ];
//                    $_SESSION['fix_lat'] = $result[fix_lat];
//                    $_SESSION['fix_lng'] = $result[fix_lng];
//
//                    $token = generatorToken($username);
//                    $_SESSION['token'] = $token;
//
//                    $value = array('status' => 'success', 'token' => $token, 'fix_lat' => $result[fix_lat], 'fix_lng' => $result[fix_lng]);
//                    echo json_encode($value);	
//            } 
//            else printError("Can not fetch row " + mysql_error());
	}
	
	else if ($action === 'logout' && isset($_POST['token']) && isset($_SESSION['token'])) {
		if ($_POST['token'] == $_SESSION['token']) {
				
				$_SESSION['username'] = '';
				$_SESSION['password'] = '';
				$_SESSION['login'] = 'no';
				$_SESSION['token'] = '';
				$_SESSION['hangtaxi_id'] = -1;
				$_SESSION['fix_lat'] = 0;
				$_SESSION['fix_lng'] = 0;
				$_SESSION['default_id'] = -1;
				
				$value = array('status' => 'success');
				echo json_encode($value);
		} 
		else printError('username does not match '.$_SESSION['username']);
	} 
}

function printError($error) {
	$value = array('status' => 'failed', 'data' => $error);
	die(json_encode($value));
}

function generatorToken($username) {
	$date =  date('m/d/Y h:i:s a', time());
	$token = sha1($date . $username);
	return $token;
}

?>