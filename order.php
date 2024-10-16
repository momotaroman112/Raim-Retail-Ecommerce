<?php
ob_start();
session_start();
	
if(!isset($_SESSION["intLine"]))
{
	if(isset($_POST["txtProductID"]))
	{
		 $_SESSION["intLine"] = 0;
		 $_SESSION["strProductID"][0] = $_POST["txtProductID"];
		 $_SESSION["strQty"][0] = $_POST["txtQty"];
		 $_SESSION["sumQty"] = $_POST["txtQty"];
		 header("location:show_cart.php");
	}
}
else
{
	
	$key = array_search($_POST["txtProductID"], $_SESSION["strProductID"]);
	if((string)$key != "")
	{
		 (int)$_SESSION["strQty"][$key] = (int)$_SESSION["strQty"][$key] + $_POST["txtQty"];
	}
	else
	{
		
		 (int)$_SESSION["intLine"] = (int)$_SESSION["intLine"] + 1;
		 (int)$intNewLine = (int)$_SESSION["intLine"];
		 (string)$_SESSION["strProductID"][$intNewLine] = $_POST["txtProductID"];
		 (int)$_SESSION["strQty"][$intNewLine] = $_POST["txtQty"];
		 (int)$_SESSION["sumQty"] += (int)$_POST["txtQty"];
		 
	}
	
	 header("location:show_cart.php");

}
?>
