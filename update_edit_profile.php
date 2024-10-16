<?php
	session_start();
	header('Content-Type: text/html; charset=UTF-8');
	include "connectDb.php"; 
	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
		mysqli_set_charset($conn, "utf8");
		error_reporting(~E_NOTICE);
	
	if($_FILES["pic"]["name"] != "")
		{
			//*** Delete Old File ***//			
			@unlink("profile/".$_POST["hdnOldFile"]);
			
			$sur = strrchr($_FILES['pic']['name'], ".");
			$newfilename = (Date("dmy_His").$sur); 
			copy($_FILES["pic"]["tmp_name"],"profile/".$newfilename); 
			$file_img = "profile/".$newfilename;
			
			//*** Update New File ***//
			$strSQL = "UPDATE tb_member ";
			$strSQL .=" SET pic = '".$file_img."' WHERE id = '".$_POST['id_member']."' ";
			$objQuery = mysqli_query($conn, $strSQL);		
		}
		

	$sql = "UPDATE tb_member SET last_name = '".$_POST['last_name']."', full_name = '".$_POST['full_name']."', mobile = '".$_POST['mobile']."', address = '".$_POST['address']."', provinces = '".$_POST['provinces']."', amphures = '".$_POST['amphures']."', districts = '".$_POST['districts']."', zipcode = '".$_POST['zipcode']."', sex = '".$_POST['sex']."' WHERE id = '".$_POST['id_member']."' ";		
	$objQuery = mysqli_query($conn, $sql);	
	if (!$objQuery) {
		die('Invalid query: ' . mysqli_error());
	}
	
	$_SESSION["fname"] = $_POST['full_name'].' '.$_POST['last_name'];
?>
	<script>
		alert("แก้ไขข้อมูลเรียบร้อยเรียบร้อยแล้ว");
		window.location.href = "profile.php?id_member=<?=$_POST['id_member'];?>";
	</script>
