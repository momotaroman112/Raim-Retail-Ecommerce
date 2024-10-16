<?php 
session_start();
include 'connectDb.php';
$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
		mysqli_set_charset($conn, "utf8");
		error_reporting(~E_NOTICE);
	if($_SESSION["sumQty"] == 0){
?>
	<script>
			alert("ยังไม่มีรายการสั่งซื้อ");
			window.location.href = "product_all.php";
        </script>
<?php } ?>
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

    <script src="http://code.jquery.com/jquery-1.11.1.js"></script>
	<script language="JavaScript">
		  
		function intOnly(input){
			var regExp = /^[0-9]*$/;
			if(!regExp.test(input.value)){
			input.value = "";
			}
		}
		
	</script>
    
  </head>
  <body>
   
   <!-- wpf loader Two -->
    <!--<div id="wpf-loader-two">          
      <div class="wpf-loader-two-inner">
        <span>Loading</span>
      </div>
    </div> -->
    <!-- / wpf loader Two -->       
 <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->


  <!-- Start header section -->
  <?php include 'top_menu.php'; ?>
  <!-- / header section -->
  <!-- menu -->
  <?php include 'bar_menu.php'; ?>
  <!-- / menu -->  
 

 <!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
			<h2>รายการการสั่งซื้อ</h2>
             <form action="update.php" method="post" name="myform1" id="myform1">
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                      	<th width="5%">ลำดับ</th>
                        <th width="10%">รูป</th>
                        <th width="20%">สินค้า</th>
                        <th width="10%">ราคา:หน่วย</th>
                        <th width="10%">จำนวน</th>
                        <th width="10%">ราคารวม</th>
                        <th width="5%">ยกเลิก</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
						  $intRows = 0;
						  $Total = 0;
						  $SumTotal = 0;
						  $sumram =0;
						  $sumdisk=0;
						  $totalqty=0;
						  $_SESSION["sumQty"]=0;
						  (int)$_SESSION["numProduct"]=0;
						  //$_SESSION["intLine"] = 0;
						  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
						  {
							  
							  if($_SESSION["strProductID"][$i] != "")
							  {
								(int)$_SESSION["numProduct"] = (int)$_SESSION["numProduct"]+1;
								$strSQL = "SELECT * FROM product_detail WHERE id = '".$_SESSION["strProductID"][$i]."' ";
								$objQuery = mysqli_query($conn, $strSQL)  or die(mysqli_error());
								$objResult = mysqli_fetch_array($objQuery);
								//echo $strSQL;
								if($objResult['price_pro'] != 0){ 
									$Total = ((int)$_SESSION["strQty"][$i]*$objResult["price_pro"]);
								}else{
									$Total = ((int)$_SESSION["strQty"][$i]*$objResult["price"]);
								}
								$SumTotal = $SumTotal + $Total;
								
								$totalqty += (int)$_SESSION["strQty"][$i];
								$_SESSION["sumQty"] += (int)$_SESSION["strQty"][$i];
					?>
                     <?php
					
						$intRows ++;
	
                    ?>
                      <tr>
                        <td align="center" width="1"> <?php echo $intRows; ?> </td>
<!-- title="<?=str_replace("picture/editor/","picture/editor/",$objResult['detail_product']);?>"-->
                       <td style="text-align:center;">
                        	<a href="#"><img src="<?php echo $objResult['pic'];?>" alt="img"><br></a>
                        </td>
                        <td style="text-align:left;"><?=$objResult['name_product'];?></td>
                        <td style="text-align:right;">
                        	<?php 
								if($objResult['price_pro'] != 0){ 
									echo number_format($objResult["price_pro"],2);
								}else{
									echo number_format($objResult["price"],2);
								}
						   	?>
                        </td>
                        <td>
                        	<input type="hidden" name="txtProductID<?=$i;?>" value="<?=$_SESSION["strProductID"][$i];?>">
                        	<input type="number" onChange='this.form.submit()' class="aa-cart-quantity" name="txtQty<?=$i;?>" id="txtQty<?=$i;?>" value="<?=$_SESSION["strQty"][$i];?>" min="1" max="<?php echo $objResult['amount'];?>">
                            <script>
							function myFunction() {
							  document.getElementById("txtQty<?=$i;?>").value = "<?php echo $objResult['amount'];?>";
							}
							</script>
                                                        
                        	<!--<input class="aa-cart-quantity" type="number" name="txtQty<?=$i;?>" value="<?=$_SESSION["strQty"][$i];?>">-->
                        </td>
                        <td style="text-align:right;"><?=number_format($Total,2);?></td>
                        <td><a class="remove" href="delete.php?Line=<?=$i;?>&txtProductID<?=$i;?>=<?=$_SESSION["strProductID"][$i];?>&txtQty<?=$i;?>=<?=$_SESSION["strQty"][$i];?>"><i class="fa fa-trash fa-2x"></i></a></td>
                      </tr>
                      <?php ////////////////////////////////////////////////////// ?>
                      <?php 
							  }
						  }
					  ?>
                      <tr>
                        <th colspan="5" style="text-align:right;">รวมทั้งหมด</th>
                        <td style="text-align:right;"><b><?=number_format($SumTotal+$sumram+$sumdisk,2);?></b></td>
                        <td><b>บาท</b></td>
                      </tr>
                      <tr>
                        <td colspan="9" class="aa-cart-view-bottom">
                          <!--<div class="aa-cart-coupon">
                            <input class="aa-coupon-code" type="text" placeholder="Coupon">
                            <input class="aa-cart-view-btn" type="submit" value="Apply Coupon">
                          </div>-->
                          <a href="product_all.php" class="aa-cart-view-btn"> <i class="fa fa-arrow-left"></i> เลือกซื้อสินค้าต่อ </a>
                          <a href="checkout_product.php" class="aa-cart-view-btn2">ดำเนินการสั่งซื้อ <i class="fa fa-arrow-right"></i></a>
                        </td>
                        
                      </tr>
                      </tbody>
                  </table>
                </div>
                <div style="height:100px;"></div>
             </form>
             
             <!-- Cart Total view -->
             <!--<div class="cart-view-total">
               <div align="left">
               <h5>จำนวนรายการที่สั่งซื้อ <?=$_SESSION["numProduct"];?> รายการ</h5>
               <h5>จำนวนสินค้า <?=$totalqty;?> ชิ้น</h5>
               </div>
               <table class="aa-totals-table">
                 <tbody>
                   <tr>
                     <th style="text-align:right;">รวมทั้งหมด</th>
                     <td style="text-align:right;">
                     	<b><?=number_format($SumTotal+$sumram+$sumdisk,2);?> บาท</b>
                     </td>
                   </tr>
                 </tbody>
               </table>
               
               
             </div>-->
           </div>
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
    
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
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