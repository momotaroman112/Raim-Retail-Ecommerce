<?php
		session_start();
		header('Content-Type: text/html; charset=UTF-8');
		include "connectDb.php"; 
		$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
		mysqli_set_charset($conn, "utf8");
		error_reporting(~E_NOTICE);
		
		$sql="Select name_product from product_detail Where name_product='".$_POST["name_product"]."'";
		$rs=mysqli_query($conn, $sql);
		if(mysqli_num_rows($rs)>0){
?>
		<script>
			alert("<?=$_POST["name_product"];?> มีในระบบแล้ว");
			window.location.href = "form_add_product_pc.php";
        </script>
<?php
		}else{
		
			//กำหนดรหัสสินค้า
			$strSQL_pro = "SELECT MAX(id) AS maxpro FROM product_detail ";
			$objQuery_pro = mysqli_query($conn, $strSQL_pro)  or die(mysqli_error());
			$row_pro = mysqli_fetch_array($objQuery_pro);
			$maxpro = substr($row_pro[maxpro],-4)+1;
			if($maxpro==''){ // ถ้าได้เป็นค่าว่าง หรือ null ก็แสดงว่ายังไม่มีข้อมูลในฐานข้อมูล
				$maxOrder="PC0001"; 
			}else{
				$maxOrder="PC".sprintf("%04d",$maxpro);//ถ้าไม่ใช่ค่าว่าง
			}
			
			
			$sur = strrchr($_FILES['file_product']['name'], "."); 
			$newfilename = (date("dmy_His").$sur); //กำหนดชื่อไฟล์ภาพ
			copy($_FILES["file_product"]["tmp_name"], "product/".$newfilename); //ย้ายรูปไปในโฟร์เดอร์ product 
			$file_img = "product/".$newfilename; 
			
			//เพื่มข้อมูลสินค้าลงฐานข้อมูล
			$strSQL = "INSERT INTO product_detail (id, protype_id, name_product, detail_product, price, pic, amount, status, date_product) VALUES ('$maxOrder', '".$_POST["protype_id"]."', '".$_POST["name_product"]."', '".$_POST["detail_product"]."', '".$_POST["price"]."', '".$file_img."', '".$_POST["amount"]."',  '', NOW())";  							
			$objQuery = mysqli_query($conn, $strSQL);	
			if (!$objQuery) {
				die('Invalid query: ' . mysqli_error());
			}
?>
    	<script>
			alert("บันทึกข้อมูลสินค้าเรียบร้อยแล้ว");
			window.location.href = "list_product.php?protype_id=<?=$_POST["protype_id"];?>";
        </script>
<?php	} ?>