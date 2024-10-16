<?	
	include ("config.inc.php");
	include ("function.inc.php");
	 $Card=$_POST['trimtxtbox'];
										$select=select("member","Card='".$Card."'");
										$num_fields=mysql_num_fields($select);
										$arrResult=array();
										while($member=mysql_fetch_array($select)){
											$arrCol=array();
												for($i=0;$i<$num_fields;$i++){
													$arrCol[mysql_field_name($select,$i)]=$member[$i];
													$arrCol['Field']="Card";
												}
											array_push($arrResult,$arrCol);
										}
	echo json_encode($arrResult);
?>