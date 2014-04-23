<?php 
	session_start();
	if (!isset($_SESSION['id'])){
		if ($_SESSION['id']!="admin"){
			// Not logged in
			header("Location: ../index.php");
			exit;
		}		
	}
?>