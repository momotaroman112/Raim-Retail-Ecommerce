<?
		session_start();
		header('Content-Type: text/html; charset=UTF-8');
		include "connectDb.php"; 

		$sql="Select promotion_name from promotion Where promotion_name='".$_POST[promotion_name]."' and promotion_id != '$_POST[promotion_id]'  ";
		$rs=mysql_query($sql);
		if(mysql_num_rows($rs)>0){
?>
		<script>
			alert("โปรโมชั่น <?=$_POST[promotion_name];?> มีในระบบแล้ว");
			window.history.back();
        </script>
<?
		}else{ 



		if($_FILES["applicant_files"]["name"] != "")
		{
			//*** Delete Old File ***//			
			@unlink("promotion/".$_POST["hdnOldFile"]);
			
			$sur = strrchr($_FILES['applicant_files']['name'], ".");
			$newfilename = (Date("dmy_His").$sur); 
			copy($_FILES["applicant_files"]["tmp_name"],"promotion/".$newfilename); 
			$file_img = "promotion/".$newfilename;
			
			//*** Update New File ***//
			$strSQL = "UPDATE promotion ";
			$strSQL .=" SET pic = '".$file_img."' WHERE promotion_id = '".$_POST['promotion_id']."' ";
			$objQuery = mysql_query($strSQL);		
		}
		
		$strSQL = "update promotion set promotion_name = '$_POST[promotion_name]', promotion_detail = '$_POST[promotion_detail]', promotion_end = '$_POST[promotion_end]' where promotion_id = '$_POST[promotion_id]' ";  							
		$objQuery = mysql_query($strSQL);	

?>
    	<script>
			alert("บันทึกข้อมูลเรียบร้อย");
			window.location.href = "list_promotion.php";
        </script>
<?
}
?>