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
  <? include 'top_menu.php'; ?>
  <!-- / header section -->
  <!-- menu -->
  <? include 'bar_menu.php'; ?>
  <!-- / menu -->  
 
  <!-- catg header banner section -->
  <!-- / catg header banner section -->

  <!-- product category -->
  <section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
              <br><br><br>
              <h3>ใบสั่งซื้อ</h3>
              <div class="col-xs-12">
              <?
				  $sql_order = "SELECT * FROM buy WHERE buy_id = '".$_GET[buy_id]."'  ";
				  $st_order = mysql_query($sql_order);
				  $row_buy = mysql_fetch_assoc($st_order);
									  
				  $sql_member = "SELECT * FROM dealer WHERE dealer_id = '".$row_buy[dealer_id]."' ";
				  $st_member = mysql_query($sql_member);
				  $row_dealer = mysql_fetch_array($st_member);
				  
				  $sql_1 = "SELECT * FROM provinces WHERE PROVINCE_ID = '".$row_dealer['provinces']."' ";
				  $result_1 = mysql_query($sql_1);
				  $row_1 = mysql_fetch_array($result_1);
				  $province_name = $row_1['PROVINCE_NAME'];
			  
				  $sql_2 = "SELECT * FROM amphures WHERE AMPHUR_ID =  '".$row_dealer['amphures']."'  ";
				  $result_2 = mysql_query($sql_2);
				  $row_2 = mysql_fetch_array($result_2);
				  $amphur_name = $row_2['AMPHUR_NAME'];
			  
				  $sql_3 = "SELECT * FROM districts WHERE DISTRICT_CODE =  '".$row_dealer['districts']."'  ";
				  $result_3 = mysql_query($sql_3);
				  $row_3 = mysql_fetch_array($result_3);
				  $district_name = $row_3['DISTRICT_NAME'];
				  
				  $address = $row_dealer[address].' ต.'.$district_name.' อ.'.$amphur_name.' จ.'.$province_name.' '.$row_dealer['zipcode'];
			  ?>
              <br>
              <div id="print_table">
              <div class="row">
              
              <div class="col-xs-8">
              <table class="table table-bordered">
                  <tr>
                    <td>
                    	<h4><?=$row_dealer[dealer_name];?></h4>
                        <p>
                        <?=$address;?><br>
                        โทร. <?=$row_dealer[mobile];?>
                        </p>
                    </td>
                  </tr>
                </table>
              </div>
              
              <div class="col-xs-4">
              <table class="table table-bordered">
                  <tr>
                    <td style="text-align:center;">วันที่</td>
                    <td style="text-align:center;">เลขที่</td>
                  </tr>
                  <tr>
                    <td><?=date('d/m/Y', strtotime($row_buy[buy_date]));?></td>
                    <td><?=$row_buy[buy_id];?></td>
                  </tr>
                </table>
              </div>
              
              
			 <div class="col-xs-12">
				<table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th style="width:10%; text-align:center;">รหัสสินค้า</th>
                  <th style="width:50%; text-align:center;">รายการสินค้า</th>
                  <th style="width:10%; text-align:center;">ราคา/หน่วย</th>
                  <th style="width:10%; text-align:center;">จำนวน</th>
                  <th style="width:10%; text-align:center;">ยอดรวม</th>
                </tr>
              </thead>
              <tbody>
              <?
				  $num=1;
				  $strSQL = "SELECT * FROM buy_detail where buy_id = '$_GET[buy_id]' ";
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
                </tr>
              <? } ?>
              	<?
					$vat = $total*.07;
				?>
              	<tr>
                	<td colspan="4" style="text-align:right"><strong>ยอดสุทธิ</strong></td>
                    <td style="text-align:right"><strong><?=number_format($total,2);?></strong></td>
                </tr>
                <tr>
                	<td colspan="4" style="text-align:right"><strong>VAT 7%</strong></td>
                    <td style="text-align:right"><strong><?=number_format($vat,2);?></strong></td>
                </tr>
                <tr>
                	<td colspan="4" style="text-align:right"><strong>เงินรวมทั้งสิ้น</strong></td>
                    <td style="text-align:right"><strong><?=number_format($total+$vat,2);?></strong></td>
                </tr>
              </tbody>
            </table>
			</div>										
            
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
						</div><!-- /.row -->
					</div><!-- /.page-content -->
                    </div>
                    <p style="text-align:center;"><button OnClick="printTable('print_table');" class="btn btn-default"><i class="glyphicon glyphicon-print"></i> พิมพ์ใบสั่งซื้อ</button>
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