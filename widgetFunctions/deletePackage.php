<?php 
	include("../include/_conn.php");
	$packageId=isset($_POST['packageId'])?$_POST['packageId']:"";

	if ($packageId!=""){
		$sql="DELETE FROM dev_package WHERE id=$packageId";
			mysqli_query($db,$sql);
			echo "1";
	}
?>