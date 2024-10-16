<?php ob_start();?>
<?php

@session_start();
include 'connectDb.php';
$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
mysqli_set_charset($conn, "utf8");
error_reporting(~E_NOTICE);

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
	$stmt_data =  mysqli_query($conn, $sql_data);
	$row_data = mysqli_fetch_array($stmt_data);
	
	$sql_order = "SELECT * FROM orders WHERE OrderID = '".$row_data[id_order]."'  ";
	$st_order = mysqli_query($conn, $sql_order);
	$row_order = mysqli_fetch_assoc($st_order);
	
	$sql_member = "SELECT * FROM member_add WHERE id = '".$row_order[id_add]."' ";
	$st_member = mysqli_query($conn, $sql_member);
	$row_member = mysqli_fetch_array($st_member);
	 
	$strSQL = "SELECT * FROM tb_member WHERE id = '".$row_member['id_member']."' ";
	$stmt =  mysqli_query($conn, $strSQL);
	$row = mysqli_fetch_array($stmt);
	
			
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
				$pdf->Image('img/raim_retail.png', 80, 10, 50); 
				
				
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
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',$row['full_name'].' '.$row['last_name']),0,0,"L");
				
				$pdf->SetFont('THSarabun','B',14);
				$pdf->SetY(50);
				$pdf->SetX(145);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',"เลขที่ใบเสร็จ"),0,0,"L");
				$pdf->SetFont('THSarabun','',14);
				$pdf->SetY(50);
				$pdf->SetX(165);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',$row_data['id_invoice']),0,0,"L");
				
				$pdf->SetFont('THSarabun','B',14);
				$pdf->SetY(57);
				$pdf->SetX(156);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',"วันที่"),0,0,"L");
				$pdf->SetFont('THSarabun','',14);
				$pdf->SetY(57);
				$pdf->SetX(165);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',date('d/m/Y', strtotime($row_data['date_save']))),0,0,"L");
				
				$pdf->SetFont('THSarabun','B',14);
				$pdf->SetY(57);
				$pdf->SetX(15);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',"ที่อยู่"),0,0,"L");
				
				$sql_1 = "SELECT * FROM provinces WHERE PROVINCE_ID = '".$row_member['provinces']."' ";
				$result_1 = mysqli_query($conn, $sql_1);
				$row_1 = mysqli_fetch_array($result_1);
				$province_name = $row_1['PROVINCE_NAME'];
			
				$sql_2 = "SELECT * FROM amphures WHERE AMPHUR_ID =  '".$row_member['amphures']."'  ";
				$result_2 = mysqli_query($conn, $sql_2);
				$row_2 = mysqli_fetch_array($result_2);
				$amphur_name = $row_2['AMPHUR_NAME'];
			
				$sql_3 = "SELECT * FROM districts WHERE DISTRICT_CODE =  '".$row_member['districts']."'  ";
				$result_3 = mysqli_query($conn, $sql_3);
				$row_3 = mysqli_fetch_array($result_3);
				$district_name = $row_3['DISTRICT_NAME'];
				
				$text_add =  $row_member['address'];
				$text_add2 =  'แขวง/ตำบล '.$district_name.'เขต/อำเภอ '.$amphur_name.' '.$province_name.' '.$row_member['zipcode'];
				
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
				$sql_order = "SELECT * FROM tb_orders WHERE OrderID = '".$row_data['id_order']."' ";
				$st_order = mysqli_query($conn, $sql_order);
				while($row_order = mysqli_fetch_assoc($st_order)){
					$sql_product = "SELECT * FROM  product_detail WHERE id = '".$row_order['id_product']."' ";
					$st_product = mysqli_query($conn, $sql_product);
					$row_product = mysqli_fetch_array($st_product);
					$sumtotal += $row_order['price'];
					$total_invoice = $total_invoice+$sumtotal;

					$name_product = $row_product['name_product'];
					
					$pdf->SetFont('THSarabun','',14);
					$pdf->SetY($y);
					$pdf->SetX(15);
					$pdf->Cell(100,0,iconv('UTF-8','TIS-620',$name_product),0,0,"L");
					$pdf->SetX(120);
					$pdf->Cell(100,0,iconv('UTF-8','TIS-620',$row_order['Qty']),0,0,"L");
					$pdf->SetX(57);
					$pdf->Cell(100,0,iconv('UTF-8','TIS-620',number_format($row_order['price']/$row_order['Qty'],2)),0,0,"R");
					$pdf->SetX(89);
					$pdf->Cell(100,0,iconv('UTF-8','TIS-620',number_format($row_order['price'],2)),0,0,"R");
					
					$y=$y+7;
				}
				
				$pdf->SetFont('THSarabun','',14);
				$pdf->SetY(213);
				$pdf->SetX(15);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','_______________________________________________________________________________________________________'),0,0,"L");
				
				$pdf->SetFont('THSarabun','',13);
				$pdf->SetY(227);
				$pdf->SetX(15);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','หมายเหตุ: '.$row_data['detail']),0,0,"L");
				
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
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',date('d/m/Y', strtotime($row_data['date_save']))),0,0,"L");
				}
	
	// footer
	$pdf->SetFont('THSarabun','',10);
	$pdf->SetY('207');
	//$pdf->Cell(0,0,iconv( 'UTF-8','TIS-620','รายงาน'),0,0,"R");
	///////////////////////////////	
	$pdf->Output();
?> 