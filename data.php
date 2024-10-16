<?php	
		session_start();
		include "connectDb.php"; 
		$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
		mysqli_set_charset($conn, "utf8");
		error_reporting(~E_NOTICE);
		
		$select_id = $_GET['select_id'];
    	$result = $_GET['result'];
		$point_id = $_GET['point_id'];
?>

<?php if($result=='amphures'){ 
	$rstTemp=mysqli_query($conn, "select * from amphures Where PROVINCE_ID ='".$select_id."' Order By AMPHUR_NAME ASC");
?>
	<option value="" selected="selected">-- เลือกอำเภอ --</option>
<?php
	while($arr_2=mysqli_fetch_array($rstTemp)){
?>
	
    <option value="<?=$arr_2['AMPHUR_ID']?>" <?php if($arr_2['AMPHUR_ID']==$point_id){ echo "selected"; } ?>> <?=$arr_2['AMPHUR_NAME']?></option>
<?php 
}
}
?>

<?php if($result=='districts'){ ?>
<select name='districts' id='districts'>
	<?php
	$rstTemp=mysqli_query($conn, "select * from districts Where AMPHUR_ID ='".$select_id."' Order By DISTRICT_NAME ASC");
	
	/*$rstTemp=mysqli_query("select * from amphur Where PROVINCE_ID ='".$select_id."'  Order By AMPHUR_NAME ASC");*/
?>
	<option value="">-- เลือกตำบล --</option>
<?php
	while($arr_2=mysqli_fetch_array($rstTemp)){
	?>
    <option value="<?=$arr_2['DISTRICT_CODE']?>" <?php if($arr_2['DISTRICT_CODE']==$point_id){ echo "selected"; } ?>>  <?=$arr_2['DISTRICT_NAME']?></option>
	<?php }?>
</select>
<?php }?>

<?php if($result=='zipcode'){ ?>
<select name='zipcode' id='zipcode'>
	<?php
	$rstTemp=mysqli_query($conn, "select * from zipcodes Where district_code ='".$select_id."' Order By zipcode ASC");
	
	/*$rstTemp=mysqli_query("select * from amphur Where PROVINCE_ID ='".$select_id."'  Order By AMPHUR_NAME ASC");*/
?>
<?php
	while($arr_2=mysqli_fetch_array($rstTemp)){
	?>
    <option value="<?=$arr_2['zipcode']?>" <?php if($arr_2['zipcode']==$point_id){ echo "selected"; } ?>><?=$arr_2['zipcode']?></option>
	<?php }?>
</select>
<?php }?>

