<?php
		session_start();
		header('Content-Type: text/html; charset=UTF-8');
		include "connectDb.php";
		$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
		mysqli_set_charset($conn, "utf8");
		error_reporting(~E_NOTICE); 
		
		if($_POST['end_date'] < $_POST['start_date']){
?>
		<script>
			alert("เลือกวันที่ไม่ถูกต้อง กรุณาเลือกใหม่");
			window.history.back();
        </script>
<?php
		}else{
		
			$strSQL = "UPDATE product_detail SET price_pro = '".$_POST["price_pro"]."', start_date = '".$_POST["start_date"]."', end_date = '".$_POST["end_date"]."' WHERE id = '".$_POST["id_product"]."' ";
			$objQuery = mysqli_query($conn, $strSQL);	
			if (!$objQuery) {
				die('Invalid query: ' . mysqli_error());
			}
?>
    	<script>
			alert("บันทึกข้อมูลเรียบร้อยแล้ว");
			window.location.href = "list_product.php";
        </script>
<?php
		}
?>