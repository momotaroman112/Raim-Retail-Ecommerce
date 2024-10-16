<?
		session_start();
		header('Content-Type: text/html; charset=UTF-8');
		include "connectDb.php"; 
		
		$strSQL = "INSERT INTO buy (buy_id, buy_date, dealer_id) VALUES (NULL, '".$_POST["buy_date"]."', '".$_POST["dealer_id"]."')";  							
		mysql_query($strSQL);	
		
		$sql_buy = "SELECT * FROM buy ORDER BY buy_id DESC  ";
		$st_buy = mysql_query($sql_buy);
		$row_buy = mysql_fetch_array($st_buy); 
?>
    	<script>
			window.location.href = "form_list_buy.php?buy_id=<?=$row_buy[buy_id];?>";
        </script>