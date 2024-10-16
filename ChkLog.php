<?php
	header('Content-Type: text/html; charset=UTF-8');
	@session_start();
	include "connectDb.php"; 
	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
		mysqli_set_charset($conn, "utf8");
		error_reporting(~E_NOTICE);
	
	if($_POST["email"] == 'admin' && $_POST["pass"] == '1234'){
		$_SESSION["fname"] = 'ADMIN';
		$_SESSION["email"] = 'admin@gmail.com';
		$_SESSION["id_member"] = '0';
		$_SESSION["status"] = 'ADMIN';
		
	?>
			<script>
            		window.location.href = 'list_order.php';
        	</script>
	<?php
	}
	
		$query = "SELECT * FROM tb_member WHERE email = '".$_POST["email"]."' AND pass = '".$_POST["pass"]."' and status != 'C' ";
		$objQuery = mysqli_query($conn, $query) or die ("Error Query [".$query."]");
		$row = mysqli_fetch_array($objQuery);
		
		$name = $row['full_name'];
		$strAdd = $row['status'];
			if($strAdd == ''){
		?>
				<script>
					alert("ไม่สามารถเข้าสู่ระบบได้");
					window.location.href = 'login.php';
				</script>
		<?php
			}else{

				$_SESSION["fname"] = $row['full_name'].' '.$row['last_name'];
				$_SESSION["email"] = $row['email'];
				$_SESSION["id_member"] = $row['id'];
				$_SESSION["status"] = $row['status'];
				if($_SESSION["status"] == 'MEMBER'){
		?>
				<script>
					window.location.href = 'index.php';
				</script>
		<?php
				}else if($_SESSION["status"] == 'ADMIN' || $_SESSION["status"] == 'USER'){
		?>
				<script>
					window.location.href = 'list_order.php';
				</script>
		<?php
				}
	}
	//mysqli_close();
?>