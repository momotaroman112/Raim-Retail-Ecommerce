<?
		session_start();
		header('Content-Type: text/html; charset=UTF-8');
		include "connectDb.php"; 

		$sql="Select promotion_name from promotion Where promotion_name='".$_POST[promotion_name]."' ";
		$rs=mysql_query($sql);
		if(mysql_num_rows($rs)>0){
?>
		<script>
			alert("โปรโมชั่น <?=$_POST[promotion_name];?> มีในระบบแล้ว");
			window.history.back();
        </script>
<?
		}else{ 
			
		$sur = strrchr($_FILES['applicant_files']['name'], ".");
		$newfilename = (Date("dmy_His").$sur); 
		copy($_FILES["applicant_files"]["tmp_name"],"promotion/".$newfilename); 
		$file_img = "promotion/".$newfilename;

		$strSQL = "INSERT INTO promotion (promotion_id, promotion_name, promotion_detail, promotion_date, pic, promotion_end) VALUES (NULL, '".$_POST["promotion_name"]."', '".$_POST["promotion_detail"]."', NOW(), '$file_img', '".$_POST["promotion_end"]."')";  							
		$objQuery = mysql_query($strSQL);	

?>
    	<script>
			alert("บันทึกข้อมูลเรียบร้อย");
			window.location.href = "list_promotion.php";
        </script>
<?	} ?>