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
    <title><?php echo $_SESSION["title"];?></title>
    
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
  <?php include 'top_menu.php'; ?>
  <!-- / header section -->
  <!-- menu -->
  <?php include 'bar_menu.php'; ?>
  <!-- / menu -->  
 
  <!-- catg header banner section -->
  <!-- / catg header banner section -->

  <!-- product category -->
  <section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
              <br><br><br>
              <h3>ข้อมูลการสั่งซื้อสินค้า</h3>
              <div class="col-xs-12">
                <?php
					$sql_member = "SELECT * FROM tb_member WHERE id = '".$_SESSION["id_member"]."' ";
					$st_member = mysqli_query($conn, $sql_member);
					$row_member = mysqli_fetch_array($st_member);
					
				?>
					<table id="dynamic-table" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th style="text-align:center; width:15%;">เลขที่สั่งซื้อ</th>
									<th style="text-align:center; width:8%;">วันที่สั่งซื้อ</th>
									<th style="text-align:center; width:10%;">ราคารวม</th>
                                    <!--<th style="text-align:center; width:10%;">การชำระ</th>-->
                                    <th style="text-align:center; width:10%;">เอกสารการชำระ</th>
									<th style="text-align:center; width:10%;">สถานะสินค้า</th>
									<th style="text-align:center; width:20%;">ข้อมูลการสั่งซื้อ</th>
								</tr>
							</thead>
							<?php
								if($_GET['can'] == 'cancel'){
									$sq = "UPDATE tb_orders SET status_pay = 'C' WHERE id = '".$_GET['id']."'";
									$r = mysqli_query($conn, $sq);
								}
								
								$sumtotal = 0;
								$sql_order = "SELECT *, sum(price) as sum_order FROM orders 
									inner join tb_orders on tb_orders.OrderID = orders.OrderID
									WHERE orders.id_member = '".$_GET["id"]."' GROUP by tb_orders.OrderID ORDER by tb_orders.id DESC  ";
								$st_order = mysqli_query($conn, $sql_order);
								$num=1;
							?>

							<tbody>
								<?php 
									while($row_order = mysqli_fetch_array($st_order)){ 
									
									$sql_product = "SELECT * FROM  product_detail WHERE id = '".$row_order['id_product']."' ";
									$st_product = mysqli_query($conn, $sql_product);
									$row_product = mysqli_fetch_array($st_product);
									
									$sumtotal = $row_order['sum_order'];
									
									$sql_invoice = "SELECT * FROM tb_invoice where id_order = '$row_order[OrderID]'  ";
									$st_invoice = mysqli_query($conn, $sql_invoice);
									$row_invoice = mysqli_fetch_array($st_invoice);
							?>

								<tr>
									<td style="text-align:center;"><a href="invoice.php?OrderID=<?=$row_order['OrderID'];?>"><font color="#0066FF"><?=$row_order['OrderID'];?></font></a></td>
									<td style="text-align:center;"><?php echo date('d/m', strtotime($row_order['OrderDate']));?>/<?php echo date('Y', strtotime($row_order['OrderDate']))+543; ?></td>
									</td>
									<td style="text-align:right;"><?php echo number_format($sumtotal+$row_order['ems'],2);?></td>
                                    <!--<td style="text-align:center;">
                                    <?php
										if($row_order['pay'] == 1){
											echo 'บัตรเครดิต/เดบิต';
										}else if($row_order['pay'] == 2){
											echo 'โอนผ่านธนาคาร';
										}else if($row_order['pay'] == 3){
											echo 'ชำระผ่าน ATM';
										}
									?>
                                    </td>-->
									<td style="text-align:center;">
                                    	<?php if($row_invoice['file_invoice'] != ''){ ?>
                                    	<a href="<?php echo $row_invoice['file_invoice'];?>" target="_blank" class="btn btn-default">เอกสารการเงิน</a> 
                                        <?php } ?>
                                    </td>
									<td style="text-align:center;">
									<?php
										if($row_order['status_pay'] == 'W'){
											echo '<font color="#FF6600">รอการชำระเงิน</font>';
										}else if($row_order['status_pay'] == 'C'){
											echo '<font color="#000000">ยกเลิกสินค้า</font>';
										}else if($row_order['status_pay'] == 'S'){
											echo '<font color="#FF6600">รอตรวจสอบยอดชำระ</font>';
										}else if($row_invoice['status_send'] == ''){
											echo '<font color="#0066FF">สินค้ากำลังส่ง</font>';
										}else{
											echo '<font color="#006600">จัดส่งสินค้าเรียบร้อย</font>';
										}
									?>
									</td>
									<td style="text-align:center;">
										<?php
										if($row_order['status_pay'] == 'W'){
										?>
											<a href="form_add_invoice.php?OrderID=<?php echo $row_order['OrderID'];?>">
											<button class="btn btn-xs btn-success">
												<i class="ace-icon glyphicon glyphicon-ok bigger-110"></i>
												ชำระเงิน
											</button>
											</a>
											<a href="JavaScript:if(confirm('ยืนยันการยกเลิกการสั่งซื้อ?')==true){window.location='<?php echo $_SERVER["PHP_SELF"];?>?can=cancel&id=<?php echo $row_order["id"];?>';}">
											<button class="btn btn-xs btn-danger">
												<i class="ace-icon glyphicon glyphicon-remove bigger-110"></i>
												ยกเลิก
											</button>
											</a>
                                            
										 <?php 
											}else if($row_order['status_pay'] == 'C'){ 
											 	echo '<font color="#000000">ยกเลิกสินค้า</font>';
										?>
										<?php } ?>
                                        
                                        <?php if($row_order['status_pay'] != 'C'){ ?>
                                        <a href="view_status.php?OrderID=<?php echo $row_order['OrderID'];?>">
											<button class="btn btn-xs btn-primary">
												<i class="ace-icon glyphicon glyphicon-search bigger-110"></i>
												รายละเอียด
											</button>
										</a>
                                        <?php } ?>
									</td>
								</tr>
								<?php $num++; } ?>
						</tbody>
					</table>
                <br>
                <p style="text-align:center;">
                    <button onclick="window.history.back();" class="btn btn-danger"><i class="glyphicon glyphicon-chevron-left"></i> ย้อนกลับ</button>
                    </p>
                
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
  <?php include 'footer.php'; ?>
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