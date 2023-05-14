<?php 

/*

 * Author : Vanson

 * Email  : vansonict@gmail.com

 * */

 

//Config CSDL và host

$host_name = 'localhost';

$host_user = 'pingtaxi_svtt';

$host_pass = 'svtt12345';

$dbname = 'pingtaxi_dev';

$address = 'http://pingtaxi.com.vn/';



//Define 1 số constant

define('localhost', $host_name);

define('root', $host_user);

define('password',$host_pass);

define('dbname',$dbname);

define('address', $address);



class DBQuery{

	var $servername;

	var $user;

	var $pass;

	var $dbname;

	var $num_record;   //Lấy số bản ghi

	var $db_connect;

        var $address;

    var $result = null;  //Thuộc tính result trả về kết quả của query.

	function __construct(){	//Hàm khởi tạo (khởi dựng)

		$this->servername = localhost;

		$this->dbname = dbname;

		$this->user = root;

		$this->pass = password;

	}

	function __open(){

		if(isset($this->dbname)){

			$this->db_connect = @mysql_connect($this->servername, $this->user, $this->pass);

			mysql_select_db($this->dbname);

			//mysql_set_charset('utf8',$this->db_connect);

			mysql_query("SET NAMES 'utf8' ", $this->db_connect);

			return true;

		}

		else{

			echo mysql_error();

			return false;

		}

	}

	function __close(){

		mysql_close();

	}

	//Chạy câu truy vấn query

	public function query($sql){

		$open = $this->__open();

        $this->result = mysql_query($sql, $this->db_connect);

        if (!$this->result){

            $output = "Database query failed: " . mysql_error() . "<br /><br />";

            die($output);

        }

        return $this->result;

    } 

	/**

	  *	đây là nơi chứa hàm dành cho các câu lệnh

	  *	query như select - from - where

	  *	đầu tiên chỉ cần truyền trực tiếp câu lệnh sql vào hàm, chưa cần

	  *	build câu lệnh sql

	  **/

	

    

    //Trả kết quả về mảng

	function loadArray($sql){

		

		$open = $this->__open();

		if($open){

			$re = mysql_query($sql);

			if($re){

				$nr = mysql_num_rows($re);

				$this->num_record = $nr;

				$result = array();

				for($i=0; $i<$nr; $i++){

					$result[$i] = mysql_fetch_assoc($re);

				}

				return $result;

			}

			else {

				return false;

				echo mysql_error();

			}

		}

		else echo mysql_error();

		$this->__close();

	}

    

    //Load về 1 kết quả 

	function loadResult($sql){

		$open = $this->__open();

		if($open){

			$re = mysql_query($sql);

			if($re){

				$result = mysql_fetch_row($re);

				return $result[0];

			}

			else {

				return false;

				echo mysql_error();

			}

		}

		else echo mysql_error();

		$this->__close();

	}

    

    //Load về 1 hàng, dữ liệu được trả về là kết quả của 1 bản ghi (record)

	function loadRow($sql){

		$open = $this->__open();

		if($open){

			$re = mysql_query($sql);

			if($re){

				$result = mysql_fetch_assoc($re);

				return $result;

			}

			else {

				return false;

				echo mysql_error();

			}

		}

		else echo mysql_error();

		$this->__close();

	}

    

    //Load về 1 cột 

	// Tham số $column là tên của cột cần lấy

    function loadColumn($sql,$column){

        $array = $this->query($sql);

        $result = array();

        foreach($array as $ele){

            if($ele[$column]){

                $result[] = $ele[$column];    

            }

            else echo 'Không tồn tại trường '.$column;

        }

        return $result;

    }

    

    

	/**

	  *	đây là nơi chứa hàm dành cho các câu lệnh

	  *	non_query như insert - delete - update

	  *	đầu tiên chỉ cần truyền trực tiếp câu lệnh sql vào hàm, chưa cần

	  *	build câu lệnh sql

	  **/

	  

	//thêm 1 record (insert)

	function insert_query($table, $array)

    {

        if(!is_array($array))

        {

            return false;

        }

        $fields = "`".implode("`,`", array_keys($array))."`";

        $values = implode("','", $array);

        $rs = $this->query("

            INSERT 

            INTO {$table} (".$fields.") 

            VALUES ('".$values."')

        ");

        //var_dump($rs);

        return $rs;

    } 

	

	//Xóa 1 record (delate)

	function delete_query($table, $where="", $limit=""){

        $query = "";

        if(!empty($where))

        {

            $query .= " WHERE $where";

        }

        

        if(!empty($limit))

        {

            $query .= " LIMIT $limit";

        }

        

        return $this->query("

            DELETE 

            FROM $table 

            $query

        ");

	} 

	

	//Chỉnh sửa (UPDATE)

	function update_query($table, $array, $where="", $limit="", $no_quote=false)

    {

        if(!is_array($array))

        {

            return false;

        }

        

        $comma = "";

        $query = "";

        $quote = "'";

        

        if($no_quote == true)

        {

            $quote = "";

        }

        

        foreach($array as $field => $value)

        {

            $query .= $comma."`".$field."`={$quote}{$value}{$quote}";

            $comma = ', ';

        }

        

        if(!empty($where))

        {

            $query .= " WHERE $where";

        }

        

        if(!empty($limit))

        {

            $query .= " LIMIT $limit";

        }

        

        return $this->query("

            UPDATE $table 

            SET $query

        ");

    } 

	

	function non_query($sql){

		$open = $this->__open();

		if($open){

			$re = mysql_query($sql);

			if($re) return mysql_affected_rows();

			else{

				return false;

			}

		}

		$this->__close();

	}

}

?>