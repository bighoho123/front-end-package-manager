<?php 
	include("../include/_conn.php");
	$pageId=isset($_POST['pageId'])?$_POST['pageId']:"";

	if ($pageId!=""){
		$sql="DELETE FROM dev_page WHERE id=$pageId";
			mysqli_query($db,$sql);
			echo "1";
	}
?>