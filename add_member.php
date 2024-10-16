<?
		session_start();
		header('Content-Type: text/html; charset=UTF-8');
		include "connectDb.php"; 
		
		$sql="Select email from tb_member Where email='".$_POST["email"]."'";
		$rs=mysql_query($sql);
		if(mysql_num_rows($rs)>0){
?>
		<script>
			alert("อีเมล์นี้มีผู้ใช้งานแล้ว");
			window.location.href = "register.php";
        </script>
<?
		}else{
		
		/*$sur = strrchr($_FILES['applicant_files']['name'], ".");
		$newfilename = (Date("dmy_His").$sur); 
		copy($_FILES["applicant_files"]["tmp_name"],"profile/".$newfilename); 
		$file_img = "profile/".$newfilename;*/
		
		$strSQL = "INSERT INTO `tb_member` (`id`, `email`, `pass`, `fname`, `lname`, `mobile`,  `status`, `date_member`) VALUES (NULL, '".$_POST["email"]."', '".$_POST["pass"]."', '".$_POST["fname"]."', '".$_POST["fname"]."', '".$_POST["mobile"]."', 'MEMBER', NOW())";  							
		$objQuery = mysql_query($strSQL);	
		if (!$objQuery) {
			die('Invalid query: ' . mysql_error($strSQL));
		}
		}
?>
    	<script>
			alert("บันทึกข้อมูลเรียบร้อยแล้ว กรุณาเข้าสู่ระบบ");
			//window.history.back();
			window.location.href = "login.php";
        </script>
