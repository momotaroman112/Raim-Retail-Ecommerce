<?php
ob_start();
session_start();
include 'connectDb.php';
$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
mysqli_set_charset($conn, "utf8");
error_reporting(~E_NOTICE);
	
  $_SESSION["sumQty"] = 0;
  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
  {

	  $strSQL = "SELECT * FROM product_detail WHERE id = '".$_SESSION["strProductID"][$i]."' ";
	  $objQuery = mysqli_query($conn, $strSQL)  or die(mysqli_error());
	  $objResult = mysqli_fetch_array($objQuery);
	  if($objResult['amount'] < $_SESSION["strQty"][$i]){
		 // $_SESSION["sumQty"] += $objResult['amount'];
		  $_SESSION["strQty"][$i] = 1;
		  
?>	
		  <script>
			  alert("จำนวนสินค้าไม่เพียงพอ");
			  window.location.href = "show_cart.php";
		  </script>	
<?php
	  }else{
	  
		 // $_SESSION["sumQty"] += $_SESSION["strQty"][$i];
		  $_SESSION["strQty"][$i] = $_POST["txtQty".$i];
?>	
		  <script>
			  //alert("จำนวนสินค้าไม่เพียงพอ");
			  window.location.href = "show_cart.php";
		  </script>	
<?php
	  }
	  $_SESSION["sumQty"] += $_SESSION["strQty"][$i];
  }
	
	

?>