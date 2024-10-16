<?php
		session_start();
		header('Content-Type: text/html; charset=UTF-8');
		include "connectDb.php"; 
		$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
		mysqli_set_charset($conn, "utf8");
		error_reporting(~E_NOTICE);

		
		/*$sur = strrchr($_FILES['applicant_files']['name'], ".");
		$newfilename = (Date("dmy_His").$sur); 
		copy($_FILES["applicant_files"]["tmp_name"],"profile/".$newfilename); 
		$file_img = "profile/".$newfilename;*/
		
		if($_POST['address'] != ''){
			$strSQL = "UPDATE tb_member SET address = '".$_POST['address']."', districts = '".$_POST['districts']."', amphures = '".$_POST['amphures']."', provinces = '".$_POST['provinces']."', zipcode = '".$_POST['zipcodes']."' WHERE id = '".$_POST['id_member']."' ";  							
			$objQuery = mysqli_query($conn, $strSQL);	
			if (!$objQuery) {
				die('Invalid query: ' . mysqli_error($strSQL));
			}
		}
		
		$strSQL_Order = "SELECT MAX(OrderID) AS maxOrder FROM tb_orders ";
		$objQuery_Order = mysqli_query($conn, $strSQL_Order)  or die(mysqli_error());
		$row_Order = mysqli_fetch_array($objQuery_Order);
		$maxOrder = substr($row_Order['maxOrder'],-4)+1;
		
		$strSQL_or = "INSERT INTO orders (id,OrderID,OrderDate,id_member, id_add, status_pay) VALUES (NULL, '".date('Ym').$maxOrder."', NOW(), '".$_POST['id_member']."', '".$_POST['id_add']."', 'W')";
		$objQuery_or = mysqli_query($conn, $strSQL_or);	
		
		$Total = 0;
  		$SumTotal = 0;
		
		 for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
		  {
			  if($_SESSION["strProductID"][$i] != "")
			  {
					  $strSQL2 = "INSERT INTO tb_orders (id,OrderID, id_product,Qty,price) VALUES (NULL, '".date('Ym').$maxOrder."', '".$_SESSION["strProductID"][$i]."','".$_SESSION["strQty"][$i]."', '".$_POST['price'.$i]."')";
					  $objQuery2 = mysqli_query($conn, $strSQL2);	
					  if (!$objQuery2) {
						  die('Invalid query: ' . mysqli_error($strSQL2));
					  }
					//  mysqli_query($strSQL);
			  }
			  //echo $strSQL2;
		  }
		
		
		$sql_pro = "SELECT * FROM tb_orders WHERE OrderID = '".date('Ym').$maxOrder."' ";
		$st_pro = mysqli_query($conn, $sql_pro);
		while($row_pro = mysqli_fetch_array($st_pro)){
			$sql_pro_list = "SELECT * FROM product_detail WHERE id = '".$row_pro['id_product']."' ";
			$st_pro_list = mysqli_query($conn, $sql_pro_list);
			$row_pro_list = mysqli_fetch_array($st_pro_list);
			
			$buy_product = $row_pro_list['buy_product']+$row_pro['Qty'];
			$list_amount = $row_pro_list['amount']-$row_pro['Qty'];
		
			$sq_pro = "UPDATE product_detail SET buy_product = '".$buy_product."', amount = '".$list_amount."' WHERE id = '".$row_pro['id_product']."' ";
			$r_pro = mysqli_query($conn, $sq_pro);
		}
		
		//echo $strSQL2;
		
		$_SESSION["intLine"]='';
		$_SESSION["strProductID"]='';
		$_SESSION["strQty"]='';
		$_SESSION["numProduct"] = 0;
		$_SESSION["sumQty"] = '';
?>		
    	<script>
			alert("ยืนยันการสั่งซื้อเรียบร้อย");
			window.location.href = "list_order_mem.php";
        </script>
