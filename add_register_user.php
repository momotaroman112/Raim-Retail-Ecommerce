<?
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
			alert("อีเมล์นี้มีในระบบแล้ว กรุณาตรวจสอบข้อมูล");
			window.location.href = "register.php";
        </script>
<?
		}else{
		
		if($_FILES['pic']['name'] != ''){
			$sur = strrchr($_FILES['pic']['name'], ".");
			$newfilename = (Date("dmy_His").$sur); 
			copy($_FILES["pic"]["tmp_name"],"profile/".$newfilename); 
			$file_img = "profile/".$newfilename;
		}
		
			$strSQL = "INSERT INTO tb_member (id, pic, email, pass, full_name, last_name, mobile, sex, address, districts, amphures, provinces, zipcode, status, date_member) VALUES  (NULL, '".$file_img."', '".$_POST["email"]."', '".$_POST["pass"]."', '".$_POST["full_name"]."', '".$_POST["last_name"]."', '".$_POST["mobile"]."', '".$_POST["sex"]."', '".$_POST["address"]."', '".$_POST["districts"]."', '".$_POST["amphures"]."', '".$_POST["provinces"]."', '".$_POST["zipcodes"]."', '".$_POST["status"]."', NOW())";  							
			$objQuery = mysqli_query($conn, $strSQL);	
			
			
			
		
?>
    	<script>
			alert("บันทึกข้อมูลเรียบร้อยแล้ว");
			window.location.href = "list_user.php";
        </script>
<?
		}
?>