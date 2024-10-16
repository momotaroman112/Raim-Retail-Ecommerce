<?php
include ("mpdf/mpdf.php");
include("include/connectdb.php");
include("include/functions.php");
			$sel_sch = "select * from tb_scheme where sch_id = '".$_GET['schid']."' ";
			$query_sch = mysql_query($sel_sch);
			$showsch = mysql_fetch_array($query_sch);


?>
<meta charset="utf-8">
<title>ระบบจัดตารางโครงการ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-datepicker-custom/dist/css/bootstrap-datepicker.css"/>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="bootstrap-datepicker-custom/jquery-2.1.3.min.js"></script>
    <style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 900}

    /* Set gray background color and 100% height */
    .sidenav {

	  background-color: #95C1E8;
      height: 100%;
    }

    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }

    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;}
    }

	.style1 {
				font-family: "TH SarabunPSK";
				font-size: 18pt;
				font-weight: bold;
			}
	.style2 {
				font-family: "TH SarabunPSK";
				font-size: 16pt;
				font-weight: bold;
			}
	.style3 {
				font-family: "TH SarabunPSK";
				font-size: 16pt;
					}
					.contentbox {width:450px; word-wrap:break-word;}
  </style>

</head>
<body onLoad="window.print();" >
	<h3><div align="center">รายละเอียดโครงการ</div></h3>


	<table width="100%" class="table table-bordered">
		<tr>
          <td width="180" align="left" valign="top" class="style1" >รหัสโครงการ :</td>
          <td width="830" class="style3"><?php echo $showsch['sch_id']; ?> </td>
        </tr> <!--รหัสโครงการ-->

        <tr>
          <td width="180" height="29" valign="top"  class="style1" > ชื่อโครงการ :</td>
          <td  class="style3"><label for="name"></label>
            <div class="contentbox"><?php echo $showsch['sch_name']; ?></div></td>
          </tr> <!--ชื่อโครงการ-->

        <tr>
          <td height="30" valign="top"  class="style1" >ประเภทโครงการ:</td>
          <td  class="style3"><label for="select"></label>
              <?php
				  	$sel_schtype = "select * from tb_schemetype where id_schemetype = '".$showsch['sch_type']."' ";
				  	$query_schtype = mysql_query($sel_schtype);
               		$schtype = mysql_fetch_array($query_schtype);
               		echo $schtype['sch_typename'] ;
				?>
              </td>
          </tr><!-- ประเภทโครงการ-->

        <tr>
          <td height="31" valign="top"  class="style1" >หน่วยงานจัดโครงการ :</td>
          <td  class="style3">
          	<?php
				if($showsch['ins_type'] == 1){
					echo 'หน่วยงานภายในคณะ';
				}else if($showsch['ins_type'] == 2){
					echo 'หน่วยงานภายในมหาวิทยาลัย';
				}else if($showsch['ins_type'] == 3){
					echo 'หน่วยงานภายนอก';
				}
			?>

            <?php
					$sel_ins1 = "select * from tb_institute where ID = '".$showsch['ins_create']."'";
					$query_ins1 = mysql_query($sel_ins1);
					$ins1 = mysql_fetch_array($query_ins1);
						echo ' ('.$ins1['ins_name'].')';
				?>

              </td>
          </tr> <!--หน่วยงานที่จัด-->

        <tr>
          <td height="31" valign="top"  class="style1">วิทยากร :</td>
          <td  class="style3"> <?php
				  	 $l=1;
				  	 $sel_lecturer = "select * from tb_lecturer where sch_id = '".$_GET['schid']."'";
				  	 $query_lecturer = mysql_query($sel_lecturer);
                   	 while($lecturer = mysql_fetch_array($query_lecturer)){
						 	echo $l.". ".$lecturer['Name']; ?><br>

                  <?php $l++; } ?></td>


           </tr> <!--วิทยากร-->

        <tr>
          <td height="30" valign="top" class="style1">วัน / เวลาที่เริ่ม :</td>
          <td  class="style3">
            <?php
				$seldate = "select * from tb_timetable where sch_id = '".$showsch['sch_id']."' order by date";
				$qerytime = mysql_query($seldate);
				$nt = 1;
				while($showtime = mysql_fetch_assoc($qerytime))
				{
					echo $nt.". วันที่ ".showdaterevthai($showtime['date']). " เวลา ".$showtime['timebegin']." - ".$showtime['timeend']."<br>";
				$nt++; }
			?>
            </td>
        </tr> <!--วันที่เริ่ม--> <!--ค่าใช้จ่าย-->

        <tr>
          <td height="35" valign="top"  class="style1" > ผู้เข้าร่วมโครงการ :</td>
          <td valign="top"  class="style3">
             <?php
					$s=1;
			  		 $depart = "";
				 	 $sel_perjoin= "select * from tb_perjoin where sch_id = '".$_GET['schid']." ' order by department";
				  	 $query_perjoin = mysql_query($sel_perjoin);
                   	 while($perjoin = mysql_fetch_array($query_perjoin))
					 {


						 if($perjoin['department'] == $depart)
						 {
							  $depart = $perjoin['department'];

							  $sel_ins = "select * from tb_institute where ins_id = '".$perjoin['department']."' ";
							  $query_ins = mysql_query($sel_ins);
							  $showins = mysql_fetch_array($query_ins);
						  	  //echo 'สาขา '.$showins['ins_name'].'<br>';

							 $sel_personal= "select * from tb_personal where PerID = '".$perjoin['perid']."'";
							 $query_personal = mysql_query($sel_personal);
							 $personal = mysql_fetch_array($query_personal);
							 		if($personal['nametitle'] == 'mr')
									{ $tname = 'นาย'; }
									if($personal['nametitle'] == 'miss')
									{ $tname = 'นางสาว'; }
									if($personal['nametitle'] == 'mrs')
									{ $tname = 'นาง'; }
									if($personal['nametitle'] == 'assopro')
									{ $tname = 'รศ.'; }
									if($personal['nametitle'] == 'assipro')
									{ $tname = 'ผศ.'; }
							 echo $s.'.'.$tname." ".$personal['Name']." ".$personal['Surname'].'<br>';
							$s++;
						 }
						 else
						 {
							 $s=1;
							 $depart = $perjoin['department'];

							  $sel_ins = "select * from tb_institute where ins_id = '".$perjoin['department']."' ";
							  $query_ins = mysql_query($sel_ins);
							  $showins = mysql_fetch_array($query_ins);

						  	  echo  '<b>สาขา '.$showins['ins_name'].'</b><br>';

							 $sel_personal= "select * from tb_personal where PerID = '".$perjoin['perid']."'";
							 $query_personal = mysql_query($sel_personal);
							 $personal = mysql_fetch_array($query_personal);
							 	if($personal['nametitle'] == 'mr')
									{ $tname = 'นาย'; }
								if($personal['nametitle'] == 'miss')
									{ $tname = 'นางสาว'; }
								if($personal['nametitle'] == 'mrs')
									{ $tname = 'นาง'; }
									if($personal['nametitle'] == 'assopro')
									{ $tname = 'รศ.'; }
									if($personal['nametitle'] == 'assipro')
									{ $tname = 'ผศ.'; }
							 echo $s.'.'.$tname." ".$personal['Name']." ".$personal['Surname'].'<br>';
							$s++;

						 }

                	}
				?>
          </td>
          </tr> <!--ผู้เข้าร่วม-->
					<tr>
	        <td valign="top">บุคคลภายนอก :</td>
	          <td><?php
								$s=1;
				  		 $depart = "";
					 		 $sel_outsider= "select * from tb_outsider where sch_id = '".$_GET['schid']."' order by ID";
							 //echo $sel_perjoin;
							 $query_outsider = mysql_query($sel_outsider);
				  			$numrow_outsider = mysql_num_rows($query_outsider);
				  			if($numrow_outsider < 1)
							{ echo "-";}
				  			else
							{
				  			while($outsider = mysql_fetch_array($query_outsider))
								 {
											echo $s.". คุณ ".$outsider['Outsider_Name'].'<br>';
										$s++;

			                	}
							}
					?></td>
	        </tr>
        <tr>
          <td valign="top" height="35"  class="style1">สถานที่จัดโครงการ :</td>
          <td  class="style3"> <?php  if($showsch['location'] == "") {echo '-';} else {echo $showsch['location']; } ?></td>
        </tr>

        <tr>
          <td valign="top" height="35"  class="style1">รายละเอียด :</td>
          <td class="style3"><?php  if($showsch['detail'] == "") {echo '-';} else {echo $showsch['detail']; } ?></td>
        </tr>
      </table>


 </font>
</body>
</html>
<br>
<?php
$d = date('d'); $m = date('m'); $y = date('Y')+543;
$html = ob_get_contents();
$pdf = new mPDF('th', 'A4', '0', 'THSaraban'); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
//$pdf->setAutoTopMargin = 'stretch';
//$pdf->SetHTMLHeader($header);
//$pdf->setFooter('{PAGENO}');
$stylesheet = file_get_contents('bootstrap/css/bootstrap.min.css');
$pdf->WriteHTML($stylesheet,1);
$pdf->WriteHTML($html);
//$pdf->Output();
$pdf->Output("filepdf/SchemeDetail_".$showsch['sch_id'].".pdf");
?>
