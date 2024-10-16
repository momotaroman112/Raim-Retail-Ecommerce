<?php
	ob_start();
	session_start();
	header('Content-Type: text/html; charset=UTF-8');

	(int)$Line = (int)$_GET["Line"];
	(string)$_SESSION["strProductID"][$Line] = '';
	(int)$_SESSION["strQty"][$Line] = '';
	$_SESSION["sumQty"] = $_SESSION["sumQty"]-$_GET["txtQty".$Line];
	
	/*$_SESSION["sumQty"] = 0;
	  for($i=0;$i<=(int)$_GET["Line"];$i++)
	  {
		  if($_SESSION["strProductID"][$i] != "")
		  {
				$_SESSION["strQty"][$i] = 0;
				
				$_SESSION["sumQty"] = $_SESSION["sumQty"]-$_SESSION["strQty"][$i];
		  }
	  }*/
	

	//header("location:show_cart.php");
	if($_SESSION["sumQty"] == 0){
?>

		<script>
			alert("ยังไม่มีรายการสั่งซื้อ");
			window.location.href = "product_all.php";
        </script>
<?php
	}else{
?>
		<script>
			window.location.href = "show_cart.php";
        </script>
<?php } ?>