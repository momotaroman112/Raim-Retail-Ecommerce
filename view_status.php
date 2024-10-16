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
	<script type="text/javascript"> 
            function printTable(tableprint) { 
                var printContents = document.getElementById(tableprint).innerHTML; 
                var originalContents = document.body.innerHTML; 
                document.body.innerHTML = printContents; 
                window.print(); 
                document.body.innerHTML = originalContents; 
            } 
        </script>
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
              <div class="col-xs-12">
              <?php
				  $sql_order = "SELECT * FROM orders WHERE OrderID = '".$_GET['OrderID']."'  ";
				  $st_order = mysqli_query($conn, $sql_order);
				  $row_order = mysqli_fetch_assoc($st_order);
				  
				  $sql_member = "SELECT * FROM member_add WHERE id = '".$row_order[id_add]."' ";
				  $st_member = mysqli_query($conn, $sql_member);
				  $row_member = mysqli_fetch_array($st_member);
									  
				  $sql_mem = "SELECT * FROM tb_member WHERE id = '".$row_member['id_member']."' ";
				  $st_mem = mysqli_query($conn, $sql_mem);
				  $row_mem = mysqli_fetch_array($st_mem);
				  
				  $sql_in = "SELECT * FROM tb_invoice WHERE id_order = '".$row_order['OrderID']."' ";
				  $st_in = mysqli_query($conn, $sql_in);
				  $row_in = mysqli_fetch_array($st_in);
				  
				  $sql_send = "SELECT * FROM send_order WHERE id_invoice = '".$row_in['id_invoice']."' ";
				  $sql_send = "SELECT * FROM send_order WHERE id_invoice = '".$row_in['id_invoice']."' ";
				  $st_send= mysqli_query($conn, $sql_send);
				  $row_send= mysqli_fetch_array($st_send);
			  ?>
              
              			<div class="row">
									<div class="col-sm-10 col-sm-offset-1">
										<div class="widget-box transparent">
											<div class="widget-header widget-header-large">
												<h4 class="widget-title grey lighter">
													หมายเลขคำสั่งซื้อ <?=$_GET['OrderID'];?>
												</h4>

												<div class="widget-toolbar no-border invoice-info">
													<br>
                                                    <span class="invoice-info-label">วันที่:</span>
													<span class="red"><?=date('d/m', strtotime($row_order['OrderDate']));?>/<?=date('Y', strtotime($row_order['OrderDate']))+543; ?></span>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-24">
													<div class="row">
														<div class="col-sm-8">

															<div>
																<ul class="list-unstyled spaced">
																	<li>
																		ชื่อลูกค้า: <?=$row_mem['full_name'];?> <?=$row_mem['last_name'];?>
																	</li>

																	<li>
																		ที่อยู่:
                                                                        <?php
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
																			
																			echo $row_member['address'];
																		?>
																	</li>

																	<li>
																		<font color="#FFFFFF">ที่อยู่:</font>
                                                                        <?php
																			echo 'ต.'.$district_name.' อ.'.$amphur_name.' จ.'.$province_name.' '.$row_member['zipcode'];
																		?>
																	</li>
																</ul>
															</div>
														</div><!-- /.col -->

														<div class="col-sm-4">
															<div>
																<ul class="list-unstyled  spaced">
																	<li>
																		Email: <?=$row_mem['email'];?>
																	</li>

																	<li>
																		เบอร์โทร: <?=$row_mem['mobile'];?>
																	</li>
																</ul>
															</div>
														</div><!-- /.col -->
													</div><!-- /.row -->

													<div class="space"></div>

													<div>
														<table class="table table-striped table-bordered">
															<thead>
																<tr>
																	<th style="text-align:center;">รหัสสินค้า</th>
																	<th style="text-align:center;">รายการสินค้า</th>
                                                                    <th style="text-align:center;">จำนวน</th>
																	<th style="text-align:center;">ราคา</th>
																</tr>
															</thead>

															<tbody>
                                                            <?php
																$num=1;
																$sumtotal = 0;
																$sql_order_list = "SELECT * FROM tb_orders WHERE OrderID = '".$_GET['OrderID']."'  ";
																$st_order_list = mysqli_query($conn, $sql_order_list);
																while($row_order_list = mysqli_fetch_array($st_order_list)){
																	
																	$sql_product = "SELECT * FROM  product_detail WHERE id = '".$row_order_list['id_product']."' ";
																	$st_product = mysqli_query($conn, $sql_product);
																	$row_product = mysqli_fetch_array($st_product);
																	
																	$sumtotal += $row_order_list['price'];
																	$Qty += $row_order_list['Qty'];
																	$ems = $row_order_list['ems'];
															?>
																<tr>
																	<td style="text-align:center;"><?=$row_product['id'];?></td>
                                                                    <td><?=$row_product['name_product'];?></td>
                                                                    <td style="text-align:center;"><?=$row_order_list['Qty'];?></td>
																	<td><div align="right"><?=number_format($row_order_list['price'],2);?></div></td>
																</tr>
                                                             <?php
																$num++; }
															 ?>
                                                                <tr>
                                                                	<td colspan="3" style="text-align:right;"><strong>รวม</strong></td>
                                                                    <td style="text-align:right;"><strong><?=number_format($sumtotal+$ems,2);?></strong></td>
                                                                </tr>
															</tbody>
														</table>
													</div>

                                                    <hr>

													<div class="space-6"></div>
                                                    
													<!--<div class="well">
														Thank you for choosing Ace Company products.
				We believe you will be satisfied by our services.
													</div>-->
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
                            
                            <br>

                  <div class="col-xs-12">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td style="text-align:center; width:25%;">
                            <?php if($row_order['status_pay'] == 'S'){ ?>
                            	<font color="#66CC99"><i class="fa fa-info-circle fa-5x"></i></font>
                            <?php }else{ ?>
                            	<font color="#66CC99"><i class="fa fa-info-circle fa-5x"></i></font>
                            <?php } ?>
                            
                            <br>
                            <font size="7"><strong>รอตรวจสอบยอดเงิน</strong></font>
                            <p><font color="#BEBEBE"><?php echo date('d-m-Y', strtotime($row_order['OrderDate']));?></font></p>
                        </td>
                        <td style="text-align:center; width:25%;">
                         	<?php if($row_order['status_pay'] == 'Y'){ ?>
                            	<font color="#66CC99"><i class="fa fa-clock-o fa-5x"></i></font>
                            <?php }else{ ?>
                            	<font color="#999999"><i class="fa fa-clock-o fa-5x"></i></font>
                            <?php } ?>
                            <br>
                            <font size="7"><strong>ชำระเงินแล้ว <?=number_format($sumtotal+$ems,2);?> ฿ </strong></font>
                            <?php if($row_in['date_invoice'] != ''){ ;?>
                            <p><font color="#BEBEBE"><?php echo date('d-m-Y', strtotime($row_in['date_invoice']));?></font></p>
                            <?php } ?>
                        </td>
                        <td style="text-align:center; width:25%;">
                        	<?php if($row_in['status_send'] != ''){ ?>
                            	<font color="#66CC99"><i class="fa fa-truck fa-5x"></i></font>
                            <?php }else{ ?>
                            	<font color="#999999"><i class="fa fa-truck fa-5x"></i></font>
                            <?php } ?>
                            <br>
                            <font size="7"><strong>เตรียมจัดส่ง</strong></font>
                            <?php if($row_in['status_send'] != ''){ ?>
                            <p><font color="#BEBEBE"><?php echo date('d-m-Y', strtotime($row_in['date_save']));?></font></p>
                            <?php } ?>
                         </td>
                         <td style="text-align:center; width:25%;">
                            <?php if($row_send['send_number'] == ''){ ?>
                            	<font color="#999999"><i class="fa fa-cube fa-5x"></i></font>
                            <?php }else{ ?>
                            	<font color="#66CC99"><i class="fa fa-cube fa-5x"></i></font>
                            <?php } ?>
                            <br>
                            <font size="7"><strong>หมายเลขพัส</strong></font>
                            <p><font color="#BEBEBE">
                            <?php if($row_send['date_send'] != ''){ ?>
							<?php echo date('d-m-Y', strtotime($row_send['date_send']));?> เลขพัสดุ :
                            	<? if($row_send['send_company'] == 'ไปรษณีย์ไทย'){ ?>
                               	<a href="https://track.thailandpost.co.th/" target="_blank"><?=$row_send['send_number'];?>
                                <? }else if($row_send['send_company'] == 'Kerry Express'){ ?>
                                <a href="https://th.kerryexpress.com/th/track/" target="_blank"><?=$row_send['send_number'];?>
                                <? }else if($row_send['send_company'] == 'Flash Express'){ ?>
                                <a href="https://www.flashexpress.co.th/tracking/" target="_blank"><?=$row_send['send_number'];?>
                                <? } ?>
                            <?php } ?>
                            </font></p>
                        </td>
                      </tr>
                    </table>
                   </div>
                   
						</div><!-- /.row -->
					</div><!-- /.page-content -->
                    </div>
                    <p style="text-align:center;">
                    <button onClick="window.history.back();" class="btn btn-danger"><i class="glyphicon glyphicon-chevron-left"></i> ย้อนกลับ</button>
                    </p>
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