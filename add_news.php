<?php
		session_start();
		header('Content-Type: text/html; charset=UTF-8');
		include "connectDb.php"; 
		$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
		mysqli_set_charset($conn, "utf8");
		error_reporting(~E_NOTICE);

		$sql="Select news_name from news Where news_name='".$_POST['news_name']."' ";
		$rs=mysqli_query($conn, $sql);
		if(mysqli_num_rows($rs)>0){
?>
		<script>
			alert("ข่าวสาร <?=$_POST['news_name'];?> มีในระบบแล้ว");
			window.history.back();
        </script>
<?php
		}else{ 
			
		$sur = strrchr($_FILES['applicant_files']['name'], ".");
		$newfilename = (Date("dmy_His").$sur); 
		copy($_FILES["applicant_files"]["tmp_name"],"news/".$newfilename); 
		$file_img = "news/".$newfilename;

		$strSQL = "INSERT INTO news (news_id, news_name, news_detail, news_date, pic) VALUES (NULL, '".$_POST["news_name"]."', '".$_POST["news_detail"]."', NOW(), '$file_img')";  							
		$objQuery = mysqli_query($conn, $strSQL);	

?>
    	<script>
			alert("บันทึกข้อมูลเรียบร้อย");
			window.location.href = "list_news.php";
        </script>
<?php	} ?>