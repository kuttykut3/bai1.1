<?php
	$conn = mysqli_connect("localhost", "root", "", "challenge1.1");
	function is_user() {
		if(isset($_SESSION['user']) && !is_null($_SESSION['user']) && $_SESSION['role'] == 0) {
			return true;
		} 
		return false;
	}

	function is_admin() {
		if(isset($_SESSION['user']) && !is_null($_SESSION['user']) && $_SESSION['role'] == 1) {
			return true;
		}
		return false;
	}

	function is_passwdMatched() {
		if(isset($_POST['password']) && !is_null($_POST['repassword']) && $_POST['password'] == $_POST['repassword']) {
			return true;
		}
		return false;
	}

	function db_get_row($sql) {
		global $conn;
		$query = mysqli_query($conn, $sql);
		$row = array();
		if(mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
		}
		return $row;
	}

	function validate($check) {
		$parttern = "/^[A-Za-z0-9_\.@]{1,32}$/"; //filter character, allow 1 to 32 char
		if (preg_match($parttern, $check))
			return true;
	    else return false;
	}

	function validate_name($check) {
		$parttern = "/[A-Za-z]{1,32}$/"; //filter character, allow 1 to 32 char
		if (preg_match($parttern, $check))
			return true;
	    else return false;
	}

	//Kiểm tra email có đúng định dạng hay không
	function validate_email($check) {
		$parttern ="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/";
		if(preg_match($parttern, $check))
        	return true;
		else return false;
    
	}
?>
