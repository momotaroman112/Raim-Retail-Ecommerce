<?php
		session_start();
		header('Content-Type: text/html; charset=UTF-8');
		include "connectDb.php"; 
		$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
		mysqli_set_charset($conn, "utf8");
		error_reporting(~E_NOTICE);
		
		$strSQL_invoice = "SELECT date_save FROM tb_invoice ORDER BY  date_save DESC ";
		$objQuery_invoice = mysqli_query($conn, $strSQL_invoice)  or die(mysqli_error());
		$row_invoice = mysqli_fetch_array($objQuery_invoice);
		$yy = date('Y', strtotime($row_invoice['date_save']));
		$mm = date('m', strtotime($row_invoice['date_save']));
		
		$strSQL_max = "SELECT MAX(id) AS maxinvoice FROM tb_invoice ";
		$objQuery_max = mysqli_query($conn, $strSQL_max)  or die(mysqli_error());
		$row_max = mysqli_fetch_array($objQuery_max);
		
		if($yy == date('Y') && $mm == date('m')){
			$maxid = $row_max['maxinvoice']+1;
			$max_voice = sprintf("%04d",$maxid);
			$maxinvoice = date('Y').date('m').$max_voice;
		}else{
			$maxinvoice = date('Y').date('m').'0001';
		}
		
		if($_FILES['file_invoice']['name']){
			$sur = strrchr($_FILES['file_invoice']['name'], ".");
			$newfilename = (date("dmy_His").$sur); 
			copy($_FILES["file_invoice"]["tmp_name"],"invoice/".$newfilename); 
			$file_img = "invoice/".$newfilename;
		}
		
		$strSQL = "INSERT INTO tb_invoice (id, id_invoice, bankID, date_invoice, id_order, id_member, file_invoice, detail, user, date_save) VALUES (NULL, '".$maxinvoice."', '".$_POST["bank"]."',  '".$_POST["date_invoice"]."', '".$_POST["id_order"]."', '".$_POST["id_member"]."', '".$file_img."', '".$_POST["detail"]."', '".$_POST["user"]."', NOW())";  							
		$objQuery = mysqli_query($conn, $strSQL);	
		//echo $strSQL;
		if (!$objQuery) {
			die('Invalid query: ' . mysqli_error());
		}
		
		$strSQL = "UPDATE orders SET status_pay = 'S' WHERE OrderID = '".$_POST["id_order"]."' ";  							
		$objQuery = mysqli_query($conn, $strSQL);	
		if (!$objQuery) {
			die('Invalid query: ' . mysqli_error());
		}
		if($_SESSION['status'] == 'ADMIN'){
?>
    	<script>
			alert("บันทึกข้อมูลการชำระสินค้าเรียบร้อยแล้ว");
			window.location.href = "list_invoice.php";
        </script>
<?php  	}else{	?>
		<script>
			alert("บันทึกข้อมูลการชำระสินค้าเรียบร้อยแล้ว รอเจ้าหน้าที่ตรวจสอบยอดชำระ");
			window.location.href = "List_order_mem.php";
        </script>
<?php		} ?>