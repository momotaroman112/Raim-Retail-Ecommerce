<?php
		session_start();
		header('Content-Type: text/html; charset=UTF-8');
		include "connectDb.php"; 
		$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
		mysqli_set_charset($conn, "utf8");
		error_reporting(~E_NOTICE);
		
		if($_FILES["file_product"]["name"] != "")
		{
			//*** Delete Old File ***//			
			@unlink("product/".$_POST["hdnOldFile"]);
			
			$sur = strrchr($_FILES['file_product']['name'], ".");
			$newfilename = (Date("dmy_His").$sur); 
			copy($_FILES["file_product"]["tmp_name"],"product/".$newfilename); 
			$file_img = "product/".$newfilename;
			
			//*** Update New File ***//
			$strSQL = "UPDATE product_detail ";
			$strSQL .=" SET pic = '".$file_img."' WHERE id = '".$_POST['id_product']."' ";
			$objQuery = mysqli_query($conn, $strSQL);		
		}
		
		$strSQL = "UPDATE product_detail SET protype_id = '".$_POST["protype_id"]."', name_product = '".$_POST["name_product"]."', amount = '".$_POST["amount"]."', detail_product = '".$_POST["detail_product"]."', price = '".$_POST["price"]."' WHERE id = '".$_POST["id_product"]."' ";
		$objQuery = mysqli_query($conn, $strSQL);	
		if (!$objQuery) {
			die('Invalid query: ' . mysqli_error());
		}
?>
    	<script>
			alert("แก้ไขข้อมูลสินค้าเรียบร้อยแล้ว");
			window.location.href = "list_product.php?protype_id=<?=$_POST["protype_id"];?>";
        </script>
