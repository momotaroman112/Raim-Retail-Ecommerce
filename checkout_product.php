<?php 
session_start();
include 'connectDb.php';
$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
		mysqli_set_charset($conn, "utf8");
		error_reporting(~E_NOTICE);
 ?>
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
    <script language=Javascript>
        function Inint_AJAX() {
           try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
           try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
           try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
           alert("XMLHttpRequest not supported");
           return null;
        };

        function dochange(src, val) {
             var req = Inint_AJAX();
             req.onreadystatechange = function () { 
                  if (req.readyState==4) {
                       if (req.status==200) {
                            document.getElementById(src).innerHTML=req.responseText; //รับค่ากลับมา
                       } 
                  }
             };
             req.open("GET", "localtion.php?data="+src+"&val="+val); //สร้าง connection
             req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
             req.send(null); //ส่งค่า
        }

        window.onLoad=dochange('provinces', -1);     
    </script>
    
    <script language="JavaScript">

			function addCommas(nStr)
			{
				nStr += '';
				x = nStr.split('.');
				x1 = x[0];
				x2 = x.length > 1 ? '.' + x[1] : '';
				var rgx = /(\d+)(\d{3})/;
				while (rgx.test(x1)) {
					x1 = x1.replace(rgx, '$1' + ',' + '$2');
				}
				return x1 + x2;
			}
	</script>

  </head>
  <body>  
   <!-- wpf loader Two -->
    <div id="wpf-loader-two">          
      <div class="wpf-loader-two-inner">
        <span>Loading</span>
      </div>
    </div> 
    <!-- / wpf loader Two -->       
 <!-- SCROLL TOP BUTTON -->
    <!--<a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>-->
  <!-- END SCROLL TOP BUTTON -->


  <!-- Start header section -->
  <?php include 'top_menu.php'; ?> 
    <!-- / header top  -->

    <!-- start header bottom  -->
    <!-- / header bottom  -->
  <!-- / header section -->
  <!-- menu -->
  <?php include 'bar_menu.php'; ?>  <!-- / menu -->  
 
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
    
    <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="checkout">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="checkout-area">
        <?php
			if($_SESSION["status"] == ''){
		?>
				<script>
                    alert("กรุณาเข้าสู่ระบบ");
                    window.location.href = "login.php";
                </script>
        <?php
            }
				/*$sql = "SELECT * FROM tb_member WHERE id = '".$_SESSION['id_member']."' ";
				$smt = mysqli_query($conn, $sql) or die ("Error Query [".$sql."]");
				$row = mysqli_fetch_array($smt);*/
				//echo $sql;
				$sql = "SELECT * FROM tb_member 
					inner join provinces on provinces.PROVINCE_ID = tb_member.provinces
					inner join districts on districts.DISTRICT_CODE = tb_member.districts
					inner join amphures on amphures.AMPHUR_ID = tb_member.amphures
					WHERE tb_member.id = '".$_SESSION[id_member]."' ";
				$smt = mysqli_query($conn, $sql) ;
				$row = mysqli_fetch_array($smt);
		?>
          <form action="save_checkout_cart.php" method="post" enctype="multipart/form-data" name="show_cart" id="show_cart" onSubmit="return fncSubmit(this);">
          <input type="hidden" name="id_member" value="<?php echo $_SESSION['id_member'];?>">
            <div class="row">
              <div class="col-md-12">
               <div class="checkout-left">
                  <div class="panel-group" id="accordion">

                    <!-- Shipping Address -->
                    <div class="panel panel-default aa-checkout-billaddress">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <strong>ที่อยู่ในการจัดส่ง</strong>
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">

                         	<div class="row">
                            	<div class="col-md-12">
                                <?
									
									
									$sql_count = "SELECT count(id_member) as count_user FROM member_add where id_member = '".$_SESSION["id_member"]."' ";
									$smt_count = mysqli_query($conn, $sql_count) or die ("Error Query [".$sql_count."]");
									$row_count = mysqli_fetch_array($smt_count);
								?>
                                <? if($row_count[count_user] < 3){ ?>
                                <a href="form_member_add.php?id_member=<?=$_SESSION["id_member"];?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> เพิ่มที่อยู่ในการจัดส่ง</a><br><br>
                                <? } ?>
                                	<table width="100%" class="table table-bordered">
                                      <tr>
                                        <th style="text-align:center;">เลือก</th>
                                        <th style="text-align:center;">ที่อยู่</th>
                                        <th style="text-align:center;">แก้ไข</th>
                                      </tr>
                                      
                                      <?
											$sql_mem = "SELECT * FROM member_add 
												inner join provinces on provinces.PROVINCE_ID = member_add.provinces
												inner join districts on districts.DISTRICT_CODE = member_add.districts
												inner join amphures on amphures.AMPHUR_ID = member_add.amphures
												WHERE member_add.id_member = '".$_SESSION[id_member]."' ";
											$smt_mem = mysqli_query($conn,$sql_mem) or die ("Error Query [".$sql_mem."]");
											//echo $sql_mem;
											while($row_mem = mysqli_fetch_array($smt_mem)){
									  ?>
                                      		<tr>
                                                <td style="text-align:center;"><input name="id_add" type="radio" value="<?=$row_mem[id];?>" <? if($_GET[id_mem] == $row_mem[id]){ echo 'checked'; } ?> required></td>
                                                <td>
                                                    <?=$row_mem[address];?><br>
                                                    <?
														if($row_mem[PROVINCE_ID] == 1){
															$text_d = "แขวง";
															$text_a = "เขต";
														}else{
															$text_d = "ตำบล";
															$text_a = "อำเภอ";
														}
													?>
                                                    <? echo $text_d.$row_mem[DISTRICT_NAME].'<br>'.$text_a.$row_mem[AMPHUR_NAME].' '.$row_mem[PROVINCE_NAME].' '.$row_mem['zipcode']; ?>
                                                </td>
                                                <td style="text-align:center;"><a href="edit_member_add.php?id_mem=<?=$row_mem[id];?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> แก้ไข</a></td>
                                           </tr>
                                     <?
											}
									 ?>
                                    </table>

                                    <br>
                                </div>
                            </div>
                        </div>
                      </div>
                   </div>

                   
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="checkout-right">
                  <h4>รายการสินค้าที่สั่งซื้อ</h4>
                  <div class="aa-order-summary-area">
                    <table class="table table-responsive">
                      <thead>
                        <tr>
                          <th width="10%">รูป</th>
                          <th width="60%">สินค้า</th>
                          <th width="10%">ราคา:หน่วย</th>
                          <th width="10%">จำนวน</th>
                          <th width="10%">ราคา</th>
                        </tr>
                      </thead>
                      <?php

						  $Total = 0;
						  $SumTotal = 0;
						  $_SESSION["numProduct"]=0;
						  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
						  {
							  
							  if($_SESSION["strProductID"][$i] != "")
							  {
								$_SESSION["numProduct"] = $_SESSION["numProduct"]+1;
								$strSQL = "SELECT * FROM product_detail WHERE id = '".$_SESSION["strProductID"][$i]."' ";
								$objQuery = mysqli_query($conn, $strSQL)  or die(mysqli_error());
								$objResult = mysqli_fetch_array($objQuery);
								
								if($objResult['price_pro'] != 0){
									$Total = $_SESSION["strQty"][$i]*$objResult["price_pro"];
								}else{
									$Total = $_SESSION["strQty"][$i]*$objResult["price"];
								}
								$SumTotal = $SumTotal + $Total;
					?>
                      
                      <tbody>
                        <tr>
                          <td><div align="center"><img src="<?php echo $objResult['pic'];?>" width="80"></div></td>
                          <td><div align="left"><?php echo $objResult['name_product'];?></div></td>
                          <td><div align="right">
                          <?php if($objResult['price_pro'] != 0){ ?>
						  <?php echo number_format($objResult["price_pro"],2);?>
                          <?php }else{ ?>
                          <?php echo number_format($objResult["price"],2);?>
                          <?php } ?>
                          <input type="hidden" name="price<?php echo $i;?>" value="<?php echo $Total;?>"></div></td>
                          <td><?php echo $_SESSION["strQty"][$i];?></td>
                          <td><div align="right"><?php echo number_format($Total,2);?><input type="hidden" name="price<?php echo $i;?>" value="<?php echo $Total;?>"></div></td>
                        </tr>
                        <?php
							  }
						  }
					  ?>
                      	<tr>
                          <th colspan="4"><div align="right">รวมทั้งหมด</div></th>
                          <td><div align="right"><b>
                          <input type="hidden" value="<?php echo $SumTotal;?>" style="text-align:right; border:none;" id="SumTotal" readonly>
                          <input class="" value="<?php echo number_format($SumTotal-$discount,2);?>" style="text-align:right; border:none;" id="total_ems" readonly>
                          </b></div></td>
                        </tr>
                      </tbody>
                      <tfoot>

                      
                        
                      </tfoot>
                    </table>
                  </div>
                  <div align="right">
                    <input type="submit" value="ยืนยันการสั่งซื้อ" class="aa-browse-btn">
                    <a href="show_cart.php" class="aa-browse-btn">ย้อนกลับ</a>    
                   </div>        
                  </div>
                </div>
              </div>
            </div>
          </form>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->

  <!-- footer -->  
  <?php include 'footer.php'; ?>
  <!-- / footer -->
  <!-- Login Modal -->  


	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.js"></script>  
	<!-- SmartMenus jQuery plugin -->
	<script type="text/javascript" src="js/jquery.smartmenus.js"></script>
	<!-- SmartMenus jQuery Bootstrap Addon -->
	<script type="text/javascript" src="js/jquery.smartmenus.bootstrap.js"></script>  
	<!-- Product view slider -->
	<script type="text/javascript" src="js/jquery.simpleGallery.js"></script>
	<script type="text/javascript" src="js/jquery.simpleLens.js"></script>
	<!-- slick slider -->
	<script type="text/javascript" src="js/slick.js"></script>
	<!-- Price picker slider -->
	<script type="text/javascript" src="js/nouislider.js"></script>
	
	<!-- Custom js -->
	<script src="js/custom.js"></script> 
    
  </body>
</html>