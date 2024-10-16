<?php
		session_start();
		header('Content-Type: text/html; charset=UTF-8');
		include "connectDb.php"; 
		$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
		mysqli_set_charset($conn, "utf8");
		error_reporting(~E_NOTICE);
		
		$strSQL = "UPDATE member_add SET address = '".$_POST['address']."', districts = '".$_POST['districts']."', amphures = '".$_POST['amphures']."', provinces = '".$_POST['provinces']."', zipcode = '".$_POST['zipcode']."' WHERE id = '".$_POST['id_mem']."' ";  							
		$objQuery = mysqli_query($conn, $strSQL);
?>
    	<script>
			alert("บันทึกข้อมูลเรียบร้อยแล้ว");
			window.location.href = "checkout_product.php?id_mem=<?php echo $_POST['id_mem'];?>&id_member=<?php echo $_POST['id_member'];?>";
        </script>
