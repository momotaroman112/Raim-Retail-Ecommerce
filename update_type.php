<?php
		session_start();
		header('Content-Type: text/html; charset=UTF-8');
		include "connectDb.php"; 
		$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
		mysqli_set_charset($conn, "utf8");
		error_reporting(~E_NOTICE);

		$strSQL = "UPDATE product_type SET protype_name = '".$_POST["protype_name"]."' WHERE protype_id = '".$_POST["protype_id"]."' ";
		$objQuery = mysqli_query($conn, $strSQL);	
		if (!$objQuery) {
			die('Invalid query: ' . mysqli_error());
		}
?>
    	<script>
			alert("แก้ไขข้อมูลเรียบร้อยแล้ว");
			window.location.href = "list_type_product.php";
        </script>
