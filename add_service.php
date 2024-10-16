<?
		session_start();
		header('Content-Type: text/html; charset=UTF-8');
		include "connectDb.php"; 

		$strSQL = "INSERT INTO service_detail (serdetail_id, service_id, serviec_name, service_detail, service_status) VALUES (NULL, '".$_POST["service_id"]."', '".$_POST["serviec_name"]."', '".$_POST["service_detail"]."', 'W')";  							
		$objQuery = mysql_query($strSQL);	
		if (!$objQuery) {
			die('Invalid query: ' . mysql_error());
		}
?>
    	<script>
			//alert("บันทึกการแจ้งซ่อมเรียบร้อยแล้ว");
			window.location.href = "form_service_detail.php?service_id=<?=$_POST['service_id'];?>";
        </script>
