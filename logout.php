<?php
	session_start();
	session_destroy();
	setcookie("cookie_status", '');
	header("location:index.php");
	
	$strSQL = "DELETE FROM tb_orders SET SID = '' WHERE SID = '".session_id()."'  ";
	$objQuery = mysql_query($strSQL);
?>