<?
		session_start();
		header('Content-Type: text/html; charset=UTF-8');
		include "connectDb.php"; 
		
		/*$new_id =mysql_result(mysql_query("Select Max(substr(service_id,-4))+1 as MaxID from  service"),0,"MaxID");
		 if($new_id==''){ // ถ้าได้เป็นค่าว่าง หรือ null ก็แสดงว่ายังไม่มีข้อมูลในฐานข้อมูล
			$std_id="SV0001";
		}else{
			$std_id="SV".sprintf("%04d",$new_id);//ถ้าไม่ใช่ค่าว่าง
		}*/
		
		function random_char($len){
		  $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		  $ret_char = "";
		  $num = strlen($chars);
		  for($i = 0; $i < $len; $i++) {
			  $ret_char.= $chars[rand()%$num];
			  $ret_char.=""; 
		  }
		  return $ret_char; 
		}
		$std_id = 'WO'.random_char(4); 
		
		
		$strSQL = "INSERT INTO service (service_id, service_date, full_name, address, mobile, service_status) VALUES ('$std_id', NOW(), '".$_POST["full_name"]."', '".$_POST["address"]."', '".$_POST["mobile"]."', 'W')";  							
		$objQuery = mysql_query($strSQL);	
		if (!$objQuery) {
			die('Invalid query: ' . mysql_error());
		}
		
		$sql_data = "SELECT * FROM service ORDER BY service_date DESC LIMIT 0 , 1 ";
		$stmt_data =  mysql_query($sql_data);
		$row_data = mysql_fetch_array($stmt_data);

?>
    	<script>
			//alert("บันทึกการแจ้งซ่อมเรียบร้อยแล้ว");
			window.location.href = "form_service_detail.php?service_id=<?=$row_data['service_id'];?>";
        </script>
