<?php
		session_start();
		header('Content-Type: text/html; charset=UTF-8');
		include "connectDb.php"; 
		$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
		mysqli_set_charset($conn, "utf8");
		error_reporting(~E_NOTICE);
		
		$strSQL = "INSERT INTO send_order (send_id, id_invoice, send_company, send_number, date_send) VALUES (NULL, '".$_POST["id_invoice"]."', '".$_POST["send_company"]."', '".$_POST["send_number"]."', '".$_POST["date_send"]."')";  							
		$objQuery = mysqli_query($conn, $strSQL);	
		if (!$objQuery) {
			die('Invalid query: ' . mysqli_error());
		}
		
		$sql_order = "SELECT * FROM tb_invoice 
			inner join tb_orders on tb_orders.OrderID =  tb_invoice.id_order
			WHERE tb_invoice.id_invoice = '".$_POST["id_invoice"]."' ";
		$st_order = mysqli_query($conn, $sql_order);
		$row = mysqli_fetch_array($st_order);
		//echo $date_exp;
		
		$strSQL = "UPDATE tb_invoice SET status_send = 'Y' WHERE id_order = '".$row["OrderID"]."' ";  							
		$objQuery = mysqli_query($conn, $strSQL);	
		if (!$objQuery) {
			die('Invalid query: ' . mysqli_error());
		}
?>
		<script>
			alert("บันทึกข้อมูลเรียบร้อยแล้ว");
			window.location.href = "list_send.php";
        </script>
