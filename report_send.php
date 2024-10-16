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
	<script src="module/editor/jscripts/tiny_mce/tiny_mce.js"></script>
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
  <?php include 'editor.php'; ?>
  <!-- catg header banner section -->
  <!-- / catg header banner section -->

  <!-- product category -->
  <section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
              <br><br><br>
              <h3>รายงานการส่งสินค้า</h3>
              <div class="col-xs-12">
              <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
              <h4 class="form-signin-heading" align="center"></h4>
                  <div class="form-group">
                       <label class="control-label col-sm-3">วันที่เริ่มต้น :</label>
                      <div class="col-sm-5">
                          <input type="date" class="form-control" name="start_date" required />
                      </div>
                  </div>
                  
                  <div class="form-group">
                       <label class="control-label col-sm-3">วันที่สิ้นสุด :</label>
                      <div class="col-sm-5">
                          <input type="date" class="form-control" name="end_date" required />
                      </div>
                  </div>
                  <div class="form-group">
              			<label class="control-label col-sm-3"></label>
                        <button class="btn btn-primary" type="submit">ออกรายงาน</button> 
                        <button type="button" class="btn btn-danger" onClick="window.history.back();">ย้อนกลับ</button>
                        </div>
                  </div>
            	</form>
                <br><br><br>
                
                <?php if($_POST['start_date'] != ''){ ?>

                	รายงานการส่งสินค้า วันที่ <?php echo date('d/m/Y', strtotime($_POST['start_date']));?> ถึงวันที่ <?php echo date('d/m/Y', strtotime($_POST['end_date']));?>
                
                	<table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                              <th style="width:12%; text-align:center;">เลขที่สั่งซื้อ</th>
                              <th style="width:10%; text-align:center;">วันที่สั่งซื้อ</th>
                              <th style="width:15%; text-align:center;">ชื่อ-นามสกุล</th>
                              <th style="width:8%; text-align:center;">เบอร์โทร</th>
                              <th style="width:10%; text-align:center;">การส่ง</th>
                              <th style="width:10%; text-align:center;">เลขที่ส่ง</th>
                              <!--<th style="width:10%; text-align:center;">ค่าส่ง</th>-->
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                        $num=1;
                        $sumtotal = 0;
                        $sql_order_list = "SELECT * FROM send_order WHERE DATE(date_send) BETWEEN '".$_POST['start_date']."' and '".$_POST['end_date']."' ";
                        $st_order_list = mysqli_query($conn, $sql_order_list);
                        while($row_order_list = mysqli_fetch_array($st_order_list)){
                            $sql_in = "SELECT * FROM  tb_invoice WHERE id_invoice = '".$row_order_list['id_invoice']."' ";
                            $st_in = mysqli_query($conn, $sql_in);
                            $row_in = mysqli_fetch_array($st_in);
							
							$sql_total = "SELECT * FROM orders WHERE OrderID = '".$row_in['id_order']."' ";
							$st_total = mysqli_query($conn, $sql_total);
							$row_total = mysqli_fetch_array($st_total);
							
                            $sql_product = "SELECT * FROM  product_detail WHERE id = '".$row_total['id_product']."' ";
                            $st_product = mysqli_query($conn, $sql_product);
                            $row_product = mysqli_fetch_array($st_product);
							
							$sql_member = "SELECT * FROM tb_member WHERE id = '".$row_total['id_member']."' ";
							  $st_member = mysqli_query($conn, $sql_member);
							  $row_member = mysqli_fetch_array($st_member);
							
							
                            
                            $sumtotal += $row_order_list['price'];
							$Qty += $row_order_list['Qty'];
							$ems += $row_total['ems'];
                    ?>
                        <tr>
                              <td style="text-align:center;"><?php echo $row_total['OrderID'];?></td>
                              <td style="text-align:center;"><?php echo date('d/m', strtotime($row_total['OrderDate']));?>/<?php echo date('Y', strtotime($row_total['OrderDate']))+543; ?></td>
                              <td><?php echo $row_member['full_name'];?> <?php echo $row_member['last_name'];?></td>
                              <td style="text-align:center;"><?php echo $row_member['mobile'];?></td>
                              <td>
                                <?php
                                    echo $row_order_list['send_company'];
									
                                ?>
                              </td>
                              <td style="text-align:center;"><?php echo $row_order_list['send_number'];?></td>
                              <!--<td style="text-align:right;"><?php echo number_format($row_total['ems'],2);?></td>-->
                              
                        </tr>
                     <?php
                        $num++; }
                     ?>
                        <!--<tr>
                            <td colspan="6" style="text-align:right;"><strong>รวม</strong></td>
                            <td style="text-align:right;"><strong><?php echo number_format($ems,2);?></strong></td>
                        </tr>-->
                    </tbody>
                </table>
                <?php } ?>
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