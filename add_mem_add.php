<?php
		session_start();
		header('Content-Type: text/html; charset=UTF-8');
	include "connectDb.php"; 
	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
	mysqli_set_charset($conn, "utf8");
	error_reporting(~E_NOTICE);
		
		$strSQL = "INSERT INTO member_add (id, id_member, address, districts, amphures, provinces, zipcode) VALUES  (NULL, '".$_POST["user_id"]."', '".$_POST["address"]."', '".$_POST["districts"]."', '".$_POST["amphures"]."', '".$_POST["provinces"]."', '".$_POST["zipcodes"]."')";  							
		$objQuery = mysqli_query($conn,$strSQL);	

		$sql = "SELECT * FROM member_add ORDER BY id DESC  ";
		$smt = mysqli_query($conn,$sql) or die ("Error Query [".$sql."]");
		$row = mysqli_fetch_array($smt);
		
?>
    	<script>
			alert("บันทึกข้อมูลเรียบร้อยแล้ว");
			window.location.href = "checkout_product.php?id_mem=<?php echo $row['id'];?>&id_member=<?php echo $row['id_member'];?>";
        </script>
