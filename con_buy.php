<?
		session_start();
		header('Content-Type: text/html; charset=UTF-8');
		include "connectDb.php"; 
		
		$strSQL = "update buy set buy_status = '' where buy_id ='$_GET[buy_id]' ";  							
		$objQuery = mysql_query($strSQL);
		
		$strSQL2 = "update buy_detail set buy_status = '' where buy_id ='$_GET[buy_id]'  ";  							
		$objQuery2 = mysql_query($strSQL2);	
		
		$strSQL_list = "SELECT * FROM buy_detail where buy_id ='$_GET[buy_id]' ";
		$stmt  = mysql_query($strSQL_list);
		while($row = mysql_fetch_array($stmt)){
			$total_price += $row[price]*$row[qty];
			
			$strSQL_up = "update buy set total_price = '$total_price' where buy_id = '$row[buy_id]' ";  							
			$objQuery_up = mysql_query($strSQL_up);
		}
		
?>
    	<script>
			window.location.href = "list_buy.php";
        </script>
