<?
	session_start();
	header('Content-Type: text/html; charset=UTF-8');
	include "connectDb.php"; 
	
	$sql = "UPDATE tb_user SET pass = '123456' WHERE icard = '".$_POST['icard']."' ";		
	$objQuery = mysql_query($sql);	
			
	session_start();
	session_destroy();
	setcookie("cookie_status", '');
?>
    	<script>
			alert("Username : <?=$_POST['icard'];?> Password : 123456");
			window.location.href = "login.php";
        </script>
