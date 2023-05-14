<?php 
	session_start();
	require_once ('database1.php');
	class Xlnguoidung extends DBQuery{
		
		//Xuât ra tất cả user
		public function Doc_danh_sach_nguoi_dung(){
			$db = new DBQuery;
			$sql = 'SELECT * FROM tbl_nguoi_dung';
			$rs = $db->loadArray($sql);
			return $rs;
		}
		/*public function set_cookie($name,$value,$time){
            setcookie($name,$value,$time);
       	}
      	public function set_session($name,$value){
            $_SESSION[$name] = $value;
      	}
                 */
		//Kiểm tra liên quan tới đăng nhập
		public function Dang_nhap($username, $password){
			$db = new DBQuery;
			$sql = "SELECT * FROM tbl_nguoi_dung WHERE TenDangNhap = '".$username."' AND MatKhau = '".md5($password)."'";
			$rs = $db -> loadRow($sql);
			if($rs){
				$_SESSION['user'] = $username;
				$_SESSION['type_user'] = $rs['ID'];
			} 
		}
		//Xóa user
		public function xoa($username){
			$db = new DBQuery;
			$db -> delete_query("tbl_nguoi_dung","TenDangNhap='".$username."'");
		}
		//Thêm user mới
		public function them($id, $acc, $pass){
			$db = new DBQuery;
			$arrayInsert = array ("ID"=>$id, "TenDangNhap"=>$acc, "MatKhau"=>md5($pass));
			$db->insert_query("tbl_nguoi_dung",$arrayInsert);
		}
		//kiểm tra user mới
		public function kt_user($username){
			$db = new DBQuery;
			$sql = "SELECT * FROM tbl_nguoi_dung WHERE TenDangNhap = '".$username."'";
			$rs = $db -> loadRow($sql);
			return $rs;
		}
		//Cập nhật thông user cũ
		public function capnhat($id, $acc, $pass){
			$db = new DBQuery;
			$arrayUpdate = array ("ID"=>$id, "MatKhau"=>md5($pass));
			$db->update_query("tbl_nguoi_dung", $arrayUpdate, "TenDangNhap='".$username."'");
		}
	}
	$c_user = new Xlnguoidung;
?>

