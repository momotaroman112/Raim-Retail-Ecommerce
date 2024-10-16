<?php
ob_start();
session_start();
include 'connectDb.php';

require('admin/fpdf.php');
	
	define('FPDF_FONTPATH','font/');
	
	$pdf=new FPDF();	
	$pdf=new FPDF( 'L' , 'mm' , 'A5' );
	$pdf->SetAutoPageBreak(false);	
	$pdf->AddPage();
	$pdf->SetMargins(6,5,5);
	$pdf->AddFont('THSarabun','','THSarabun.php');
	$pdf->AddFont('THSarabun','B','THSarabun Bold.php');
		
	$new_Y = 21;
	$num = 1;
	
	$sql_data = "SELECT * FROM service WHERE service_id = '".$_GET['service_id']."' ";
	$stmt_data =  mysql_query($sql_data);
	$row_data = mysql_fetch_array($stmt_data);
	
	$sql_send = "SELECT * FROM  send_service WHERE service_id = '".$row_data[service_id]."' ";
	$st_send = mysql_query($sql_send);
	$row_send = mysql_fetch_array($st_send);
	
			
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
				$pdf->Cell(0,0,iconv('UTF-8','TIS-620',"บริษัท เพลิน คอมพิวเตอร์ จำกัด"),0,0,"C");
				
				$pdf->SetY(22);
				//$pdf->SetX(15);
				$pdf->SetFont('THSarabun','B',18);
				$pdf->Cell(0,0,iconv('UTF-8','TIS-620',"ใบแจ้งซ่อมสินค้า"),0,0,"C");

				$pdf->SetFont('THSarabun','B',14);
				$pdf->SetY(29);
				$pdf->SetX(15);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',"ชื่อ-นามสกุล"),0,0,"L");
				$pdf->SetFont('THSarabun','',14);
				$pdf->SetY(29);
				$pdf->SetX(40);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',$row_data[full_name]),0,0,"L");
				
				$pdf->SetFont('THSarabun','B',14);
				$pdf->SetY(29);
				$pdf->SetX(140);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',"เลขที่ใบแจ้งซ่อม"),0,0,"L");
				$pdf->SetFont('THSarabun','',14);
				$pdf->SetY(29);
				$pdf->SetX(165);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',$row_data[service_id]),0,0,"L");
				
				$pdf->SetFont('THSarabun','B',14);
				$pdf->SetY(36);
				$pdf->SetX(15);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',"เบอร์โทร"),0,0,"L");
				$pdf->SetFont('THSarabun','',14);
				$pdf->SetY(36);
				$pdf->SetX(40);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',$row_data[mobile]),0,0,"L");
				
				$pdf->SetFont('THSarabun','B',14);
				$pdf->SetY(36);
				$pdf->SetX(156);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',"วันที่"),0,0,"L");
				$pdf->SetFont('THSarabun','',14);
				$pdf->SetY(36);
				$pdf->SetX(165);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',date('d/m/Y', strtotime($row_data[service_date]))),0,0,"L");
				
				$pdf->SetFont('THSarabun','B',14);
				$pdf->SetY(43);
				$pdf->SetX(15);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',"ที่อยู่"),0,0,"L");
				
				$pdf->SetFont('THSarabun','',14);
				$pdf->SetY(43);
				$pdf->SetX(40);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620',$row_data[address]),0,0,"L");

				$pdf->SetFont('THSarabun','',14);
				$pdf->SetY(45);
				$pdf->SetX(15);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','_______________________________________________________________________________________________________'),0,0,"L");
				
				
				$pdf->SetFont('THSarabun','B',14);
				$pdf->SetY(51);
				$pdf->Cell(0,0,iconv('UTF-8','TIS-620','รายการแจ้งซ่อม'),0,0,"C");
				/*$pdf->SetX(115);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','จำนวน'),0,0,"L");
				$pdf->SetX(140);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','ราคา:หน่วย'),0,0,"L");
				$pdf->SetX(175);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','ราคารวม'),0,0,"L");*/
				
				$pdf->SetFont('THSarabun','',14);
				$pdf->SetY(53);
				$pdf->SetX(15);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','_______________________________________________________________________________________________________'),0,0,"L");
				
				$pdf->SetFont('THSarabun','',14);
				
				$y=60;
				$numd=1;
				$sql_ser = "SELECT * FROM service_detail WHERE service_id = '".$_GET['service_id']."' and service_status != 'C' ";
				$stmt_ser =  mysql_query($sql_ser);
				while($row_ser = mysql_fetch_array($stmt_ser)){
	
					$pdf->SetY($y);
					$pdf->SetX(15);
					$pdf->Cell(100,0,iconv('UTF-8','TIS-620',$numd),0,0,"L");
					$pdf->SetX(20);
					$pdf->Cell(100,0,iconv('UTF-8','TIS-620',$row_ser[serviec_name]),0,0,"L");
					
					$pdf->SetX(80);
					$pdf->Cell(100,0,iconv('UTF-8','TIS-620','อาการเสีย: '.$row_ser[service_detail]),0,0,"L");
					$numd++;
					$y=$y+7;
				}
				$rowy = $y+7;	
				
				$pdf->SetFont('THSarabun','',14);
				$pdf->SetY($rowy);
				$pdf->SetX(15);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','_______________________________________________________________________________________________________'),0,0,"L");
				
				$pdf->SetY(127);
				$pdf->SetX(15);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','ลงชื่อผู้รับสินค้า .................................................................'),0,0,"L");
				$pdf->SetY(134);
				$pdf->SetX(30);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','(........................................................)'),0,0,"L");
				$pdf->SetY(141);
				$pdf->SetX(40);
				$pdf->SetFont('THSarabun','',16);
				$pdf->Cell(100,0,iconv('UTF-8','TIS-620','......./........../......'),0,0,"L");
				
				}
	
	// footer
	$pdf->SetFont('THSarabun','',10);
	$pdf->SetY('207');
	//$pdf->Cell(0,0,iconv( 'UTF-8','TIS-620','รายงาน'),0,0,"R");
	///////////////////////////////	
	$pdf->Output();
?> 