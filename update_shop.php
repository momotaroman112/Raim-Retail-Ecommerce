<?php
		session_start();
		header('Content-Type: text/html; charset=UTF-8');
		include "connectDb.php"; 
		$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
		mysqli_set_charset($conn, "utf8");
		error_reporting(~E_NOTICE);

		$strSQL = "UPDATE shop SET shop_add = '".$_POST["shop_add"]."', shop_tel = '".$_POST["shop_tel"]."', shop_email = '".$_POST["shop_email"]."', shop_fb = '".$_POST["shop_fb"]."', shop_line = '".$_POST["shop_line"]."' WHERE shop_id = 1 ";
		$objQuery = mysqli_query($conn, $strSQL);	
		if (!$objQuery) {
			die('Invalid query: ' . mysqli_error());
		}
?>
    	<script>
			alert("แก้ไขข้อมูลเรียบร้อยแล้ว");
			window.location.href = "shop.php";
        </script>
