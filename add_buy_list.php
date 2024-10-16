<?
		session_start();
		header('Content-Type: text/html; charset=UTF-8');
		include "connectDb.php"; 
		
		$strSQL_re = "SELECT * FROM buy_detail where buy_id = '".$_POST["buy_id"]."' and pro_name = '".$_POST["pro_name"]."' and buy_status = 'W' ";  
		$stmt_re  = mysql_query($strSQL_re);
		$row_re = mysql_fetch_array($stmt_re);
		$numrow = mysql_num_rows($stmt_re);
		if($numrow != ''){
			$rv_num = $row_re["qty"]+$_POST["qty"];
			
			$strSQL = "UPDATE buy_detail SET qty = '".$rv_num."' where buy_id = '".$_POST["buy_id"]."' and pro_name = '".$_POST["pro_name"]."' and buy_status = 'W' ";  							
			$objQuery = mysql_query($strSQL);
		}else{
			$rv_num = $_POST["qty"];
			
			$strSQL = "INSERT INTO buy_detail (id, buy_id, pro_name, qty, price, buy_status) VALUES (NULL, '".$_POST["buy_id"]."', '".$_POST["pro_name"]."', '".$_POST["qty"]."', '".$_POST["price"]."', 'W')";  							
			$objQuery = mysql_query($strSQL);
		}
		
?>
    	<script>
			window.location.href = "form_list_buy.php?buy_id=<?=$_POST["buy_id"];?>";
        </script>