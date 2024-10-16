<? 
session_start();
include 'connectDb.php';
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
  </head>
  <!-- !Important notice -->
  <!-- Only for product page body tag have to added .productPage class -->
  <body class="productPage">  
   <!-- wpf loader Two -->
    <div id="wpf-loader-two">          
      <div class="wpf-loader-two-inner">
        <span>Loading</span>
      </div>
    </div> 
    <!-- / wpf loader Two -->       
 <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->


  <!-- Start header section -->
  <? include 'top_menu.php'; ?>
  <!-- / header section -->
  <!-- menu -->
  <? include 'bar_menu.php'; ?>
  <!-- / menu -->  
 <? include 'editor.php'; ?>
  <!-- catg header banner section -->
  <!-- / catg header banner section -->

  <!-- product category -->
  <section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
              <br><br><br>
              <div class="col-xs-12">
              <div class="row-fluid">
  <div class="span5">
  	<h2>เพิ่มรายการสินค้า</h2>
    <?
		if($_GET["Action"] == "Can")
		  {
			  $strSQL1 = "DELETE FROM received WHERE received_id = '".$_GET["received_id"]."' ";
			  mysql_query($strSQL1);
			  
			  $strSQL2 = "DELETE FROM received_detail WHERE received_id = '".$_GET["received_id"]."' ";
			  mysql_query($strSQL2);
	?>
			<script>
				window.location.href = "list_inbox.php";
			</script>
	<?
		  }
	?>
        <div class="widget-box">
          <div class="widget-content nopadding">

            <form action="add_buy_list.php" name="inbox" method="post" class="form-horizontal">
            <input type="hidden" class="form-control" name="buy_id" value="<?=$_GET["buy_id"];?>" required />
              
              		<div class="form-group">
                       <label class="control-label col-sm-3">รายการสินค้า :</label>
                      <div class="col-sm-5">
                           <select name="pro_name" class="form-control" onchange="window.location='?buy_id=<?=$_GET[buy_id];?>&pro_id='+this.value" required>
                                <option value="">-- เลือกรายการสินค้า --</option>
                                <?
                                    $strSQL_pro = "SELECT * FROM product_detail  where status = '' ";
                                    $stmt_pro  = mysql_query($strSQL_pro);
                                    while($row_pro = mysql_fetch_array($stmt_pro)){
                                ?>
                                <option value="<?=$row_pro[id];?>" <? if($row_pro[id] == $_GET[pro_id]){ echo 'selected'; } ?>>[<?=$row_pro[id];?>] <?=$row_pro[name_product];?></option>
                                <?	} ?>
                              </select>
                      </div>
                  </div>
              
              <?
			  	$sqlrs="Select * from product_detail Where id='".$_GET["pro_id"]."' ";
				$rs=mysql_query($sqlrs);
				$rowrs = mysql_fetch_array($rs)
			  ?>
              
              	<div class="form-group">
                       <label class="control-label col-sm-3">คงเหลือ :</label>
                      <div class="col-sm-5">
                          <input type="number" min="1" class="form-control" value="<?=$rowrs[amount];?>" readonly />
                      </div>
                  </div>
                
                <div class="form-group">
                       <label class="control-label col-sm-3">จำนวน :</label>
                      <div class="col-sm-5">
                          <input type="number" min="1" class="form-control" placeholder="0" name="qty" id="qty" OnKeyPress="return chkNumber(this)" required />
                      </div>
                  </div>
				
                <div class="form-group">
                       <label class="control-label col-sm-3">ราคา/หน่วย :</label>
                      <div class="col-sm-5">
                          <input type="number" min="1" class="form-control" placeholder="0.00" name="price" id="price" OnKeyPress="return chkNumber(this)" required />
                      </div>
                  </div>
                  
                   <div class="form-group">
                       <label class="control-label col-sm-3"></label>
                      <div class="col-sm-5">
                          <button type="submit" class="btn btn-success">เพิ่มรายการ</button>
                      </div>
                  </div>

              <br><br><br><br>
              <div class="form-actions">
                
                <!--<a href="form_inbox.php"><button type="button" class="btn btn-danger">ย้อนกลับ</button></a>-->
              </div>
            </form>
          </div>
        </div>
  </div>

    <div class="row-fluid">
      <div class="span6">
      <h2>รายการสินค้า [<?=$_GET["buy_id"];?>]</h2>
            <div class="widget-box">
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th style="width:10%; text-align:center;">รหัสสินค้า</th>
                  <th style="width:60%; text-align:center;">รายการสินค้า</th>
                  <th style="width:10%; text-align:center;">ราคา/หน่วย</th>
                  <th style="width:10%; text-align:center;">จำนวน</th>
                  <th style="width:10%; text-align:center;">ยอดรวม</th>
                  <th style="width:20%; text-align:center;">-</th>
                </tr>
              </thead>
              <tbody>
              <?
				  if($_GET["Action"] == "Del")
				  {
					  $strSQL = "DELETE FROM buy_detail WHERE id = '".$_GET["id"]."' ";
					  $stmt = mysql_query($strSQL);
			?>
					<script>
						window.location.href = "form_list_buy.php?buy_id=<?=$_GET["buy_id"];?>";
					</script>
            <?
				  }

				  $num=1;
				  if($_GET[buy_id] != ''){
				  	$strSQL = "SELECT * FROM buy_detail where buy_status = 'W' and buy_id = '$_GET[buy_id]' ";
				  }else{
					$strSQL = "SELECT * FROM buy_detail where buy_status = 'W' ";  
				  }
				  $stmt  = mysql_query($strSQL);
				  while($row = mysql_fetch_array($stmt)){
					  	$strSQL_pro = "SELECT * FROM product_detail where id = '$row[pro_name]' ";
					  	$stmt_pro  = mysql_query($strSQL_pro);
						$row_pro = mysql_fetch_array($stmt_pro);
						
						$qty += $row[qty];
						$total += ($row[price]*$row[qty]);
			  ?>
                <tr class="gradeX">
                  <td style="text-align:center;"><?=$row_pro[id];?></td>
                  <td><?=$row_pro[name_product];?></td>
                  <td style="text-align:right;"><?=number_format($row[price],2);?></td>
                  <td style="text-align:center;"><?=$row[qty];?></td>
                  <td style="text-align:right;"><?=number_format($row[price]*$row[qty],2);?></td>
                  <td style="text-align:center;">
                    <a href="JavaScript:if(confirm('คุณต้องการลบรายการสินค้า ?')==true){window.location='<?=$_SERVER["PHP_SELF"];?>?Action=Del&id=<?=$row["id"];?>&buy_id=<?=$row["buy_id"];?>';}" class="btn btn-danger btn-sm">ลบ</a>
                   </td>
                </tr>
              <? } ?>
              	<tr>
                	<td colspan="3" style="text-align:right"><strong>จำนวนรวม</strong></td>
                    <td style="text-align:center"><strong><?=$qty;?></strong></td>
                    <td style="text-align:right"><strong><?=number_format($total,2);?></strong></td>
                    <td style="text-align:right"></td>
                </tr>
              </tbody>
            </table>
            <div align="center">
      			<a href="con_buy.php?buy_id=<?=$_GET["buy_id"];?>&num=<?=$num;?>" class="btn btn-primary btn-sm">ยืนยันการสั่งซื้อ</a>
         	</div>
          </div>
        </div>
      </div>
                <br><br><br>
                
              </div>
           </div> 
              <!-- quick view modal -->                  
              <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">                      
                    <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <div class="row">
                        <!-- Modal view slider -->
                        <div class="col-md-6 col-sm-6 col-xs-12">                              
                          <div class="aa-product-view-slider">                                
                            <div class="simpleLens-gallery-container" id="demo-1">
                              <div class="simpleLens-container">
                                  <div class="simpleLens-big-image-container">
                                      <a class="simpleLens-lens-image" data-lens-image="img/view-slider/large/polo-shirt-1.png">
                                          <img src="img/view-slider/medium/polo-shirt-1.png" class="simpleLens-big-image">
                                      </a>
                                  </div>
                              </div>
                              <div class="simpleLens-thumbnails-container">
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-1.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-1.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-1.png">
                                  </a>                                    
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-3.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-3.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-3.png">
                                  </a>

                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-4.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-4.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-4.png">
                                  </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Modal view content -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="aa-product-view-content">
                            <h3>T-Shirt</h3>
                            <div class="aa-price-block">
                              <span class="aa-product-view-price">$34.99</span>
                              <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis animi, veritatis quae repudiandae quod nulla porro quidem, itaque quis quaerat!</p>
                            <h4>Size</h4>
                            <div class="aa-prod-view-size">
                              <a href="#">S</a>
                              <a href="#">M</a>
                              <a href="#">L</a>
                              <a href="#">XL</a>
                            </div>
                            <div class="aa-prod-quantity">
                              <form action="">
                                <select name="" id="">
                                  <option value="0" selected="1">1</option>
                                  <option value="1">2</option>
                                  <option value="2">3</option>
                                  <option value="3">4</option>
                                  <option value="4">5</option>
                                  <option value="5">6</option>
                                </select>
                              </form>
                              <p class="aa-prod-category">
                                Category: <a href="#">Polo T-Shirt</a>
                              </p>
                            </div>
                            <div class="aa-prod-view-bottom">
                              <a href="#" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <a href="#" class="aa-add-to-cart-btn">View Details</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                        
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div>
              <!-- / quick view modal -->   
            </div>

          </div>
        </div>
       
      </div>
    </div>
  </section>
  <!-- / product category -->



  <!-- footer -->  
  <? include 'footer.php'; ?>
  <!-- / footer -->
  <!-- Login Modal -->  
  <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">                      
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4>Login or Register</h4>
          <form class="aa-login-form" action="">
            <label for="">Username or Email address<span>*</span></label>
            <input type="text" placeholder="Username or email">
            <label for="">Password<span>*</span></label>
            <input type="password" placeholder="Password">
            <button class="aa-browse-btn" type="submit">Login</button>
            <label for="rememberme" class="rememberme"><input type="checkbox" id="rememberme"> Remember me </label>
            <p class="aa-lost-password"><a href="#">Lost your password?</a></p>
            <div class="aa-register-now">
              Don't have an account?<a href="account.html">Register now!</a>
            </div>
          </form>
        </div>                        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>


    
  <!-- jQuery library -->
  <script src="js/jquery.min.js"></script>
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