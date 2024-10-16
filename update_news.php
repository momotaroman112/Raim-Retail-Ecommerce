<?php
		@session_start();
		header('Content-Type: text/html; charset=UTF-8');
		include "connectDb.php"; 
		$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
		mysqli_set_charset($conn, "utf8");
		error_reporting(~E_NOTICE);

		$sql="Select news_name from news Where news_name='".$_POST['news_name']."' and news_id != '$_POST[news_id]'  ";
		$rs=mysqli_query($conn, $sql);
		if(mysqli_num_rows($rs)>0){
?>
		<script>
			alert("ข่าวสาร <?=$_POST['news_name'];?> มีในระบบแล้ว");
			window.history.back();
        </script>
<?php
		}else{ 



		if($_FILES["applicant_files"]["name"] != "")
		{
			//*** Delete Old File ***//			
			@unlink("news/".$_POST["hdnOldFile"]);
			
			$sur = strrchr($_FILES['applicant_files']['name'], ".");
			$newfilename = (Date("dmy_His").$sur); 
			copy($_FILES["applicant_files"]["tmp_name"],"news/".$newfilename); 
			$file_img = "news/".$newfilename;
			
			//*** Update New File ***//
			$strSQL = "UPDATE news ";
			$strSQL .=" SET pic = '".$file_img."' WHERE news_id = '".$_POST['news_id']."' ";
			$objQuery = mysqli_query($conn, $strSQL);		
		}
		
		$strSQL = "update news set news_name = '$_POST[news_name]', news_detail = '$_POST[news_detail]' where news_id = '$_POST[news_id]' ";  							
		$objQuery = mysqli_query($conn, $strSQL);	

?>
    	<script>
			alert("บันทึกข้อมูลเรียบร้อย");
			window.location.href = "list_news.php";
        </script>
<?php
}
?>