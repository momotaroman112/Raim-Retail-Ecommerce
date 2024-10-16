<?php
		session_start();
		header('Content-Type: text/html; charset=UTF-8');
		include "connectDb.php";
		$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
		mysqli_set_charset($conn, "utf8");
		error_reporting(~E_NOTICE); 
		
		$sql="Select email from tb_member Where email='".$_POST["email"]."'";
		$rs=mysqli_query($conn, $sql);
		if(mysqli_num_rows($rs)>0){
?>
		<script>
			alert("อีเมล์นี้ได้สมัครไว้แล้ว กรุณาตรวจสอบข้อมูล");
			window.location.href = "register.php";
        </script>
<?php
		}else{
		
		if($_FILES['pic']['name'] != ''){
			$sur = strrchr($_FILES['pic']['name'], ".");
			$newfilename = (Date("dmy_His").$sur); 
			copy($_FILES["pic"]["tmp_name"],"profile/".$newfilename); 
			$file_img = "profile/".$newfilename;
		}
		
			$strSQL = "INSERT INTO tb_member (id, pic, email, pass, full_name, last_name, mobile, sex, address, districts, amphures, provinces, zipcode, status, date_member) VALUES  (NULL, '".$file_img."', '".$_POST["email"]."', '".$_POST["pass"]."', '".$_POST["full_name"]."', '".$_POST["last_name"]."', '".$_POST["mobile"]."', '".$_POST["sex"]."', '".$_POST["address"]."', '".$_POST["districts"]."', '".$_POST["amphures"]."', '".$_POST["provinces"]."', '".$_POST["zipcodes"]."', 'MEMBER', NOW())";  							
			$objQuery = mysqli_query($conn, $strSQL);	
			if (!$objQuery) {
				die('Invalid query: ' . mysqli_error($strSQL));
			}
			
			$sqlmem = "SELECT * FROM tb_member ORDER BY id DESC  ";
			$smtmem = mysqli_query($conn,$sqlmem) or die ("Error Query [".$sqlmem."]");
			$rowmem = mysqli_fetch_array($smtmem);
			
			$strSQL_mem = "INSERT INTO member_add (id, id_member, address, districts, amphures, provinces, zipcode) VALUES  (NULL, '".$rowmem["id"]."', '".$_POST["address"]."', '".$_POST["districts"]."', '".$_POST["amphures"]."', '".$_POST["provinces"]."', '".$_POST["zipcodes"]."')";  							
			$objQuery_mem = mysqli_query($conn,$strSQL_mem);
?>
    	<script>
			alert("บันทึกข้อมูลเรียบร้อยแล้ว กรุณาเข้าสู่ระบบ");
			window.location.href = "login.php";
        </script>
<?php
		}
?>