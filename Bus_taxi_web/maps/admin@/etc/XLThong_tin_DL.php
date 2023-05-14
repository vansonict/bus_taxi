<?php
	require_once ('database1.php');
	class ThongTinDaiLy extends DBQuery{
		
		//Đọc toàn bộ thông tin đại lý có trong bảng tbl_daily
		public function Doc_danh_sach_dl(){
			$db = new DBQuery;
			$sql = 'SELECT * FROM tbl_daily';
			$rs = $db->loadArray($sql);
			return $rs;
		}
		//Tổng số đại lý 
		public function so_luong(){
			$db = new DBQuery;
			$sql = 'SELECT COUNT(*) AS so_dl FROM tbl_daily';
			$rs = $db -> loadRow($sql);
			return $rs['so_dl'];
		}
		//Xuất ra mảng từ vị trị p -> p_one trong bảng 
		public function hien_thi_dl($p , $p_one){
			$db = new DBQuery;
			$sql = "SELECT * FROM tbl_daily LIMIT $p,$p_one";
			$rs = $db->loadArray($sql);
			return $rs;
		}
		//Hiển thị thông tin đại lý có tên cần tìm
		public function chi_tiet_ten($name){
			$db = new DBQuery;
			$sql = 'SELECT * FROM tbl_daily WHERE name = '.$name;
			$rs = $db -> loadRow($sql);
			return $rs;
		}
                //Hiển thị những đại lý theo điều kiện đại lý cấp trên
                public function chi_tiet_daily($name, $parent_id){
			$db = new DBQuery;
			$sql = 'SELECT * FROM tbl_daily WHERE name = '.$name.' AND parent_id = 0';
			$rs = $db -> loadRow($sql);
			return $rs;
		}
		//Hiển thị thông tin đại lý theo cấp
		public function chi_tiet_parent($parent_id){
			$db = new DBQuery;
			$sql = "SELECT * FROM tbl_daily WHERE parent_id = '".$parent_id."'";
			$rs = $db -> loadArray($sql);
			return $rs;
		}
		//Xóa record đại lý có tên cần xóa
		public function xoa($name){
			$db = new DBQuery;
                        return $db -> delete_query("tbl_daily","name='".$name."'");
		}
		//Thêm trường thông tin đại lý mới
		public function them($name, $parent, $pass, $mobile, $contact){
			$db = new DBQuery;
                        if($this->chi_tiet_ten($name))
                            return FALSE;
			$arrayInsert = array ("name"=>$name, "parent_id"=>$parent, "password"=>$pass, "mobile"=>$mobile, "contact"=>$contact);
			$insertDaiLy = $db->insert_query("tbl_daily",$arrayInsert);
                        //var_dump($insertDaiLy);
                        return $insertDaiLy;
		}
		//Cập nhật thông tin đại lý
		public function capnhat($id, $name, $parent, $pass, $mobile, $contact){
			$db = new DBQuery;
			$arrayUpdate = array ("name"=>$name, "parent_id"=>$parent, "password"=>$pass, "mobile"=>$mobile, "contact"=>$contact);
			$db->update_query("tbl_daily", $arrayUpdate, "id='".$id."'");
		}
	}
	$c_student = new ThongTinDaiLy();
?>
