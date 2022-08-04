<?php 
	session_start();
	if(isset($_SESSION['user']) && $_SESSION['user'] != NULL) {
		session_destroy();
		header("location:login.php");
	}
	header("location:login.php");
?>
