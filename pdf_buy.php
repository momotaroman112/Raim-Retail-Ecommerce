<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <link rel="icon" href="img/tapbar_logo.png" type="image/png"> <!-- For PNG format -->    
    <title><?=$_SESSION["title"];?></title>
    
    <!-- Font awesome -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">   
    <!-- SmartMenus jQuery Bootstrap Addon CSS -->
    <link href="css/jquery.smartmenus.bootstrap.css" rel="stylesheet">
    <!-- Product view slider -->
    <link rel="stylesheet" type="text/css" href="css/jquery.simpleLens.css">    
    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="css/slick.css">
    <!-- price picker slider -->
    <link rel="stylesheet" type="text/css" href="css/nouislider.css">
    <!-- Theme color -->
    <link id="switcher" href="css/theme-color/dark-red-theme.css" rel="stylesheet">
 

    <!-- Main style sheet -->
    <link href="css/style.css" rel="stylesheet">    

    <!-- Google Font -->
    <link href="css/fontcss.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

<? ob_start();?>
<?php

@session_start();
include 'connectDb.php';

require('fpdf.php');
	
	define('FPDF_FONTPATH','font/');
	
	$pdf=new FPDF();	
	//$pdf=new FPDF( 'L' , 'mm' , 'A4' );
	$pdf->SetAutoPageBreak(false);	
	$pdf->AddPage();
	$pdf->SetMargins(6,5,5);
	$pdf->AddFont('THSarabun','','THSarabun.php');
	$pdf->AddFont('THSarabun','B','THSarabun Bold.php');
		
	$new_Y = 21;
	$num = 1;
	
	$sql_data = "SELECT * FROM tb_invoice WHERE id_invoice = '".$_GET['id_invoice']."' ";
	$stmt_data =  mysql_query($sql_data);
	$row_data = mysql_fetch_array($stmt_data);
	 
	$strSQL = "SELECT * FROM tb_member WHERE id = '".$row_data['id_member']."' ";
	$stmt =  mysql_query($strSQL);
	$row = mysql_fetch_array($stmt);
	
			
			if($new_Y>200 or $new_Y == 21)
			{			
				if($new_Y>200)
				{
					$pdf->AddPage();
					$new_Y=21;
				}
				
				// header
				//$pic = "'".$row['pic']."'";
				$pdf->SetFont('THSarabun','B',20);
				//$pdf->Image('img/logow.jpg',15,10,40,20);
				
				$pdf->SetFont('THSarabun','B',20);
				$pdf->SetY(13);
				$pdf->SetX(15);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',"หจก.เจ. อาร์ แพทย์ภัณฑ์"),0,0,"L");
				
				$pdf->SetFont('THSarabun','',14);
				$pdf->SetY(20);
				$pdf->SetX(15);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',"เบอร์โทรศัพท์ : 053-125835"),0,0,"L");
				$pdf->SetY(27);
				$pdf->SetX(15);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',"เบอร์แฟกซ์ : 053-125836"),0,0,"L");
				
				$pdf->SetY(40);
				//$pdf->SetX(15);
				$pdf->SetFont('THSarabun','B',18);
				$pdf->Cell(0,0,iconv('UTF-8','TIS-620',"ใบกำกับภาษี/ใบเสร็จรับเงิน"),0,0,"C");

				$pdf->SetFont('THSarabun','B',14);
				$pdf->SetY(50);
				$pdf->SetX(15);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',"ชื่อ-นามสกุล"),0,0,"L");
				$pdf->SetFont('THSarabun','',14);
				$pdf->SetY(50);
				$pdf->SetX(40);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',$row[full_name].' '.$row[last_name]),0,0,"L");
				
				$pdf->SetFont('THSarabun','B',14);
				$pdf->SetY(50);
				$pdf->SetX(145);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',"เลขที่ใบเสร็จ"),0,0,"L");
				$pdf->SetFont('THSarabun','',14);
				$pdf->SetY(50);
				$pdf->SetX(165);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',$row_data[id_invoice]),0,0,"L");
				
				$pdf->SetFont('THSarabun','B',14);
				$pdf->SetY(57);
				$pdf->SetX(156);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',"วันที่"),0,0,"L");
				$pdf->SetFont('THSarabun','',14);
				$pdf->SetY(57);
				$pdf->SetX(165);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',date('d/m/Y', strtotime($row_data[date_save]))),0,0,"L");
				
				$pdf->SetFont('THSarabun','B',14);
				$pdf->SetY(57);
				$pdf->SetX(15);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',"ที่อยู่"),0,0,"L");
				
				$sql_1 = "SELECT * FROM provinces WHERE PROVINCE_ID = '".$row['provinces']."' ";
				$result_1 = mysql_query($sql_1);
				$row_1 = mysql_fetch_array($result_1);
				$province_name = $row_1['PROVINCE_NAME'];
			
				$sql_2 = "SELECT * FROM amphures WHERE AMPHUR_ID =  '".$row['amphures']."'  ";
				$result_2 = mysql_query($sql_2);
				$row_2 = mysql_fetch_array($result_2);
				$amphur_name = $row_2['AMPHUR_NAME'];
			
				$sql_3 = "SELECT * FROM districts WHERE DISTRICT_CODE =  '".$row['districts']."'  ";
				$result_3 = mysql_query($sql_3);
				$row_3 = mysql_fetch_array($result_3);
				$district_name = $row_3['DISTRICT_NAME'];
				
				$text_add =  $row['address'];
				$text_add2 =  'แขวง/ตำบล '.$district_name.'เขต/อำเภอ '.$amphur_name.' '.$province_name.' '.$row['zipcode'];
				
				$pdf->SetFont('THSarabun','',14);
				$pdf->SetY(57);
				$pdf->SetX(40);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',$text_add),0,0,"L");
				
				$pdf->SetFont('THSarabun','',14);
				$pdf->SetY(64);
				$pdf->SetX(40);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',$text_add2),0,0,"L");
				
				$pdf->SetFont('THSarabun','',14);
				$pdf->SetY(70);
				$pdf->SetX(15);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','_______________________________________________________________________________________________________'),0,0,"L");
				
				
				$pdf->SetFont('THSarabun','B',14);
				$pdf->SetY(77);
				$pdf->SetX(55);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','รายการ'),0,0,"L");
				$pdf->SetX(115);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','จำนวน'),0,0,"L");
				$pdf->SetX(140);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','ราคา:หน่วย'),0,0,"L");
				$pdf->SetX(175);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','ราคารวม'),0,0,"L");
				
				$pdf->SetFont('THSarabun','',14);
				$pdf->SetY(80);
				$pdf->SetX(15);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','_______________________________________________________________________________________________________'),0,0,"L");
				
				$sumtotal=0;
				$total_invoice=0;
				$y=87;
				$sql_order = "SELECT * FROM tb_orders WHERE OrderID = '".$row_data[id_order]."' ";
				$st_order = mysql_query($sql_order);
				while($row_order = mysql_fetch_assoc($st_order)){
					$sql_product = "SELECT * FROM  product_detail WHERE id = '".$row_order[id_product]."' ";
					$st_product = mysql_query($sql_product);
					$row_product = mysql_fetch_array($st_product);
					$sumtotal += $row_order[price];
					$total_invoice = $total_invoice+$sumtotal;

					$name_product = $row_product[name_product];
					
					$pdf->SetFont('THSarabun','',14);
					$pdf->SetY($y);
					$pdf->SetX(15);
					$pdf->Cell(100,0,iconv('UTF-8','TIS-620',$name_product),0,0,"L");
					$pdf->SetX(120);
					$pdf->Cell(100,0,iconv('UTF-8','TIS-620',$row_order[Qty]),0,0,"L");
					$pdf->SetX(57);
					$pdf->Cell(100,0,iconv('UTF-8','TIS-620',number_format($row_order[price]/$row_order[Qty],2)),0,0,"R");
					$pdf->SetX(89);
					$pdf->Cell(100,0,iconv('UTF-8','TIS-620',number_format($row_order[price],2)),0,0,"R");
					
					$y=$y+7;
				}
				
				$pdf->SetFont('THSarabun','',14);
				$pdf->SetY(213);
				$pdf->SetX(15);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','_______________________________________________________________________________________________________'),0,0,"L");
				
				$pdf->SetFont('THSarabun','',13);
				$pdf->SetY(227);
				$pdf->SetX(15);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','หมายเหตุ: '.$row_data[detail]),0,0,"L");
				
				/////////ยอดรวม/////////////
				
				$pdf->SetFont('THSarabun','B',16);
				$pdf->SetY(224);
				$pdf->SetX(140);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','ราคารวม: '),0,0,"L");
				
				
				
				$pdf->SetFont('THSarabun','',16);
				$pdf->SetY(224);
				$pdf->SetX(89);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',number_format($sumtotal,2)),0,0,"R");
				
				
				
				$pdf->SetY(270);
				$pdf->SetX(15);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','ลงชื่อผู้รับสินค้า .................................................................'),0,0,"L");
				$pdf->SetY(278);
				$pdf->SetX(30);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','(........................................................)'),0,0,"L");
				$pdf->SetY(286);
				$pdf->SetX(40);
				$pdf->SetFont('THSarabun','',16);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','......./........../......'),0,0,"L");
				
				$pdf->SetY(270);
				$pdf->SetX(120);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','ลงชื่อผู้รับเงิน .................................................................'),0,0,"L");
				$pdf->SetY(278);
				$pdf->SetX(140);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','   (........................................................)'),0,0,"L");
				$pdf->SetY(286);
				$pdf->SetX(150);
				$pdf->SetFont('THSarabun','',16);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',date('d/m/Y', strtotime($row_data[date_save]))),0,0,"L");
				}
	
	// footer
	$pdf->SetFont('THSarabun','',10);
	$pdf->SetY('207');
	//$pdf->Cell(0,0,iconv( 'UTF-8','TIS-620','รายงาน'),0,0,"R");
	///////////////////////////////	
	$pdf->Output();
?> 