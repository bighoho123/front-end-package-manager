<?php 
	include("../include/_conn.php");
	$name=isset($_POST['name'])?mysqli_real_escape_string($db,$_POST['name']):"";
	$website=isset($_POST['website'])?mysqli_real_escape_string($db,$_POST['website']):"";
	$version=isset($_POST['version'])?mysqli_real_escape_string($db,$_POST['version']):"";
	$dependency=isset($_POST['dependency'])?mysqli_real_escape_string($db,$_POST['dependency']):"";
	$code=isset($_POST['code'])?mysqli_real_escape_string($db,$_POST['code']):"";
	$description=isset($_POST['description'])?mysqli_real_escape_string($db,$_POST['description']):"";
	$packageId=isset($_POST['packageId'])?$_POST['packageId']:"";

	if ($packageId==""){
		if ($name!=""||$website!=""||$version!=""||$dependency!=""||$code!=""||$description!=""){
			$sql="INSERT INTO dev_package (name, website, version, dependency, code, description) VALUES ('$name', '$website', '$version', '$dependency', '$code', '$description')";
			mysqli_query($db,$sql);
			echo "1";
		}
	} else {
		if ($name!=""||$website!=""||$version!=""||$dependency!=""||$code!=""||$description!=""){
			$sql="UPDATE dev_package SET name='$name', website='$website', version='$version', dependency='$dependency', code='$code', description='$description' WHERE id=$packageId";
			mysqli_query($db,$sql);
			echo "2";
		}
	}
?>