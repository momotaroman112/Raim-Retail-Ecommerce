<?php
	session_start();
	include 'connectDb.php';

	$strProductID = $_POST["tProductID"];
	$strQty = $_POST["tQty"];	
	
	function random_char($len){
	  $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	  $ret_char = "";
	  $num = strlen($chars);
	  for($i = 0; $i < $len; $i++) {
		  $ret_char.= $chars[rand()%$num];
		  $ret_char.=""; 
	  }
	  return $ret_char; 
	}
	$random_order = random_char(9); 

		$strSQL_or = "SELECT OrderID FROM tb_orders where SID = '".session_id()."' ";
		$objQuery_or = mysql_query($strSQL_or)  or die(mysql_error());
		$numrow = mysql_num_rows($objQuery_or);
		$row_or = mysql_fetch_array($objQuery_or);
		if($numrow != ''){
			$maxOrder =  $row_or[OrderID];
		}else{
			$maxOrder = $random_order;
		}
	

	if($strProductID != "" and $strQty  != "")
	{
		$strSQL_cart = "SELECT * FROM tb_orders  WHERE protype_id = '".$strQty."' and SID = '".session_id()."' ";
		$objQuery_cart = mysql_query($strSQL_cart) or die ("Error Query [".$strSQL_cart."]");
		$objResult_cart = mysql_fetch_array($objQuery_cart);
		$numrow = mysql_num_rows($objQuery_cart);
		//echo $numrow;
		$strSQL_in = "SELECT * FROM product_detail  
			inner join product_type on (product_type.protype_id = product_detail.protype_id)
			WHERE id = '".$strProductID."' ";
		$objQueryPro_in = mysql_query($strSQL_in) or die ("Error Query [".$strSQL_in."]");
		$objResultPro_in = mysql_fetch_array($objQueryPro_in);
		
		$product_code = sprintf("%02d",$objResultPro_in[product_code]+1);
		$strSQL_ty = "SELECT * FROM product_type WHERE product_code = '".$product_code."' ";
		$objQueryPro_ty = mysql_query($strSQL_ty);
		$row_ty = mysql_fetch_array($objQueryPro_ty);
		
		
		if($numrow == ''){
			$strSQL = "INSERT INTO tb_orders(SID,OrderID,OrderDate,pro_main,protype_id,id_product,Qty,price,status_pay) VALUES ('".session_id()."','".$maxOrder."', NOW(),'SP','".$strQty."', '".$strProductID."', '1', '".$objResultPro_in[price]."','W') ";
			$objQuery = mysql_query($strSQL);
		}else{
			$strSQL = "update tb_orders set id_product = '".$strProductID."' WHERE protype_id = '".$strQty."' and OrderID = '".$objResult_cart[OrderID]."' ";
			$objQuery = mysql_query($strSQL);
			?>
        	<!--<script>
				alert("ลูกค้าได้มีการเลือกสินค้าชนิด <?=$objResultPro_in[protype_name];?> ไปแล้ว");
				window.location.href = "product.php?menu=<?=$objResultPro_in[protype_id];?>";
			</script>-->
        	<?
		}
	?>
    	<script>
			//alert("ลูกค้าได้มีการเลือกสินค้าชนิด <?=$numrow;?> ไปแล้ว");
			window.location.href = "product.php?menu=<?=$row_ty[protype_id];?>&id_product=<?=$strProductID;?>";
		</script>
    <?
	}

?>
<h3>รายการจัดสเปก</h3>
<table width="100%" border="3" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" width="155">ลำดับ</td>
    <td align="center" width="592">สินค้า</td>
    <td align="center" width="246">ราคา</td>
    <td align="center" width="102">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="3" cellspacing="0" cellpadding="0">
  <!--<tr>
    <td width="80%" height="26"><div align="center">สินค้า</div></td>
    <td width="20%"><div align="center">ราคา</div></td>
  </tr>-->
<?php
$intSumTotal = 0;
$intRows = 0;

if($_GET["Action"] == "Del")
{
	$strSQL = "DELETE FROM tb_orders WHERE id_product = '".$_GET["id"]."' ";
	$stmt = mysql_query($strSQL);
?>
  <script>
		window.location.href = "product.php?menu=6";
	</script>
<?
}

$strSQL = "SELECT * FROM tb_orders  WHERE SID = '".session_id()."' ";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
while($objResult = mysql_fetch_array($objQuery))
{
	$intRows ++;
	//*** Product ***//
	$strSQL = "SELECT * FROM product_detail  WHERE id = '".$objResult["id_product"]."' ";
	$objQueryPro = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
	$objResultPro = mysql_fetch_array($objQueryPro);
	
	$strSQL_type = "SELECT * FROM product_type  WHERE protype_id = '".$objResultPro["protype_id"]."' ";
	$objQueryPro_type = mysql_query($strSQL_type);
	$objResultPro_type = mysql_fetch_array($objQueryPro_type);
	
	$intTotal = $objResultPro["price"];
	$intSumTotal = $intSumTotal + $intTotal;
?>


  <tr>
  	<td align="center" width="1"> <? echo $intRows; ?> </td>
    <td><a href="product_detail.php?id_product=<?=$objResultPro["id"];?>" style="font-size:9px;"><font color="#000000"><strong><?=$objResultPro_type[protype_name];?></strong></font><br><?=$objResultPro["name_product"];?><?=number_format($objResultPro["price"],2);?></a></td>
    <td align="center">
    	<?=number_format($objResultPro["price"],2);?>
    </td>
    <td><a href="<?=$_SERVER["PHP_SELF"];?>?Action=Del&id=<?=$objResultPro["id"];?>"><font color="#FF0000"><strong>&nbsp;X</strong></font></a>&nbsp;</td>
  </tr>
  <tr>
  </tr>
  
<?php
}
?> 
<? if($intSumTotal > 0){ ?>   
  <tr>
     <td width="54" bgcolor="#CCCCCC">
     </td>
    <td height="30" colspan="0" bgcolor="#CCCCCC"><div align="right"><font color="#990000"><strong>ราคารวม&nbsp;&nbsp;</strong></div></td>
    <td align="center" bgcolor="#CCCCCC">
	<div align="right"><font color="#990000"><strong><?=number_format($intSumTotal,2);?></strong></font></div></td>
    <td align="center" bgcolor="#CCCCCC"><font color="#990000">฿</font></td>
  </tr>
<? } ?>
</table>
<?php
if($intSumTotal > 0)
{
?>
<br><input name="btnCheckOut" type="submit" id="btnCheckOut" value="สั่งสเปคคอม >>" class="aa-add-to-cart-btn" onClick="JavaScript:CheckOut();">
<br><br>
<?php
}
?>
