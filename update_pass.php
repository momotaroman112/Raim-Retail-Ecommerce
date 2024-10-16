<?php
	session_start();
	header('Content-Type: text/html; charset=UTF-8');
	include "connectDb.php"; 
	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
		mysqli_set_charset($conn, "utf8");
		error_reporting(~E_NOTICE);
	
	$strSQL = "SELECT * FROM tb_member WHERE pass = '".$_POST[password_old]."' and id = '".$_POST['id_member']."' ";
	$stmt =  mysqli_query($conn, $strSQL);
	$row_member = mysqli_fetch_array($stmt);
	if(mysqli_num_rows($rs)== 0){
?>
		<script>
			alert("คุณกรอกรหัสผ่านเดิมไม่ถูกต้อง");
			window.history.back();
        </script>
<?php
	}else if($_POST['password'] != $_POST['password2']){
?>
		<script>
			alert("คุณยืนยันรหัสผ่านไม่ถูกต้อง กรุณากรอกรหัสผ่านอีกครั้ง");
			window.location.href = "edit_pass.php?member=<?=$_POST['id'];?>";
        </script>
<?php
	}else{
		$sql = "UPDATE tb_member SET pass = '".$_POST['password']."' WHERE id = '".$_POST['id_member']."' ";		
		$objQuery = mysqli_query($conn, $sql);	
		
		session_start();
		session_destroy();
		setcookie("cookie_status", '');

?>
    	<script>
			alert("แก้ไขรหัสผ่านเรียบร้อย กรุณาเข้าสู่ระบบอีกครั้ง");
			window.location.href = "login.php";
        </script>
<?php	 } ?>