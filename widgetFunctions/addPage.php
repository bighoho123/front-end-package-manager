<?php 
	include("../include/_conn.php");
	$name=isset($_POST['name'])?mysqli_real_escape_string($db,$_POST['name']):"";
	$path=isset($_POST['path'])?mysqli_real_escape_string($db,$_POST['path']):"";
	$note=isset($_POST['note'])?mysqli_real_escape_string($db,$_POST['note']):"";
	$pageId=isset($_POST['pageId'])?$_POST['pageId']:"";

	if ($pageId==""){
		if ($name!=""||$path!=""||$note!=""){
			$sql="INSERT INTO dev_page (name, path, note) VALUES ('$name','$path','$note')";
			mysqli_query($db,$sql);
			echo "1";
		}
	} else {
		if ($name!=""||$path!=""||$note!=""){
			$sql="UPDATE dev_page SET name='$name', path='$path', note='$note' WHERE id=$pageId";
			mysqli_query($db,$sql);
			echo "2";
		}
	}
?>