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
              <h3>จัดราคาโปรโมชั่น</h3>
              <div class="col-xs-12">
              <?php
				  $sql_product = "SELECT * FROM  product_detail WHERE id = '".$_GET['id_product']."' ";
				  $st_product = mysqli_query($conn, $sql_product);
				  $row_product = mysqli_fetch_array($st_product)
			  ?>
              <form action="update_product_pro.php" class="form-horizontal" role="form" method="post"  enctype="multipart/form-data">
               <input type="hidden" name="id_product" id="id_product" value="<?=$row_product['id'];?>">  
                 <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right" for="form-field-2"> รหัสสินค้า </label>
                      <div class="col-sm-3">
                          <input type="text" name="code_product" id="code_product" value="<?=$_GET['id_product'];?>" placeholder="รหัสสินค้า" class="col-xs-10 col-sm-5 form-control" readonly />
                      </div>
                  </div>
              	
               	  <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> ชื่อสินค้า</label>

                      <div class="col-sm-6">
                          <input type="text" name="name_product" id="name_product" placeholder="ชื่อสินค้า" value="<?=$row_product['name_product'];?>" class="form-control" readonly />
                      </div>
                  </div>
                  
                  <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> รายละเอียดสินค้า </label>
                          <div class="col-sm-5">
                          
                          <textarea class="area-full" rows="3" name="detail_product" readonly><?=$row_product['detail_product'];?></textarea>
                      </div>
                  </div>

                  <div class="space-4"></div>
                
                  <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right" for="form-field-2"> ราคาปกติ </label>

                      <div class="col-sm-3">
                          <input type="number" placeholder="0.00" name="price" class="col-xs-10 col-sm-5 form-control" value="<?=$row_product['price'];?>" readonly />
                      </div>
                  </div>
                  
                  <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right" for="form-field-2"> ราคาโปรโมชั่น </label>

                      <div class="col-sm-3">
                          <input type="number" placeholder="0.00" name="price_pro" class="col-xs-10 col-sm-5 form-control" value="<?=$row_product['price_pro'];?>" required />
                      </div>
                  </div>
                  
                  <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right" for="form-field-2"> เริ่มวันที่ </label>

                      <div class="col-sm-3">
                          <input type="date" name="start_date" class="col-xs-10 col-sm-5 form-control" min="<?=date('Y-m-d');?>" required />
                      </div>
                  </div>
                  
                  <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right" for="form-field-2"> สิ้นสุดวันที่ </label>

                      <div class="col-sm-3">
                          <input type="date" name="end_date" class="col-xs-10 col-sm-5 form-control" min="<?=date('Y-m-d');?>" required />
                      </div>
                  </div>
                  
                  <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right" for="form-field-2"> จำนวน </label>

                      <div class="col-sm-3">
                          <input type="number" placeholder="0.00" name="amount" class="col-xs-10 col-sm-5 form-control" value="<?=$row_product['amount'];?>" readonly />
                      </div>
                  </div>
                  
                  <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right" for="form-field-2"> รูปสินค้า </label>
                      <img id="imgAvatar" src="<?=$row_product['pic'];?>" width="180">
                  </div>

                  <div class="space-4"></div>

                  <div class="clearfix form-actions">
                      <div class="col-md-offset-3 col-md-9">
                          <button class="btn btn-info" type="submit">
                              <i class="ace-icon fa fa-check bigger-110"></i>
                              บันทึก
                          </button>
                          <button class="btn btn-danger" type="button" onClick="window.history.back();">
                              <i class="ace-icon fa fa-undo bigger-110"></i>
                              ยกเลิก
                          </button>
                      </div>
                  </div>
                  </form>
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