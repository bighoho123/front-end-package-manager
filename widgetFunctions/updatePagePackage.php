<?php 
	include("../include/_conn.php");
	$packageArray=isset($_POST['packageArray'])?$_POST['packageArray']:array();
	$pageId=isset($_POST['pageId'])?$_POST['pageId']:"";
	if ($pageId!=""){
		$packageString=implode(",", $packageArray);
		$sql="UPDATE dev_page SET packageIds='$packageString' WHERE id=$pageId";
		mysqli_query($db,$sql);
		echo "1";
	}
?>