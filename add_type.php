<?php
		session_start();
		header('Content-Type: text/html; charset=UTF-8');
		include "connectDb.php"; 
		$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
		mysqli_set_charset($conn, "utf8");
		error_reporting(~E_NOTICE);
		
		$sql="Select * from product_type Where protype_name='".$_POST["protype_name"]."'";
		$rs=mysqli_query($conn, $sql);
		if(mysqli_num_rows($rs)>0){
?>
		<script>
			alert("<?=$_POST["protype_name"];?> มีในระบบแล้ว");
			window.history.back();
        </script>
<?php
		}else{

			$strSQL = "INSERT INTO product_type (protype_id, protype_name) VALUES (NULL, '".$_POST["protype_name"]."')";  							
			$objQuery = mysqli_query($conn, $strSQL);	
			if (!$objQuery) {
				die('Invalid query: ' . mysqli_error());
			}
?>
    	<script>
			alert("เพิ่มข้อมูลเรียบร้อยแล้ว");
			window.location.href = "list_type_product.php";
        </script>
<?php	} ?>