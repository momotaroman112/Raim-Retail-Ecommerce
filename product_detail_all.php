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
    <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
    

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
    <!-- / header top  -->
  <!-- / header section -->
  <!-- menu -->
	<?php include 'bar_menu.php'; ?>
  <!-- / menu -->  
 
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <div class="aa-catg-head-banner-area">
   </div>
  </section>
  <!-- / catg header banner section -->

  <!-- product category -->
  <?php

	  $sql_product = "SELECT * FROM product_detail WHERE id = '".$_GET['id_product']."' ";
	  $st_product = mysqli_query($conn, $sql_product);
	  $row_product = mysqli_fetch_array($st_product);
  ?>
  <section id="aa-product-details">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-product-details-area">
            <div class="aa-product-details-content">
              <div class="row">
                <!-- Modal view slider -->
                <div class="col-md-5 col-sm-5 col-xs-12">                              
                  <div class="aa-product-view-slider">                                
                    <div id="demo-1">
                      <div>
                        <div><img src="<?php echo $row_product['pic'];?>" class="simpleLens-big-image" style="width:80%;"></div>
                      </div>
                      <!--<div class="simpleLens-thumbnails-container">
                          <a data-big-image="<?=$row_product['pic'];?>" data-lens-image="<?=$row_product['pic'];?>" class="simpleLens-thumbnail-wrapper" href="#">
                          	<img src="<?=$row_product['pic'];?>" width="50">
                          </a>
                      </div>-->
                    </div>
                  </div>
                </div>
                <!-- Modal view content -->
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <div class="aa-product-view-content">
                    <h3><?php echo $row_product['name_product'];?></h3>
                    <div class="aa-price-block">
                      <!--<span class="aa-product-view-price"><font color="#970001" size="+2"><strong>200 บาท</strong></font></span>-->
                    </div>
                    <p>
                    <?php if($row_product['price_pro'] != 0){ ?>
                    <h2><?php echo number_format($row_product['price_pro'],2);?> บาท</h2>
                    <?php }else{ ?>
                    <h2><?php echo number_format($row_product['price'],2);?> บาท</h2>
                    <?php } ?>
                    <!--<table class="table table-responsive" align="center" bordercolor="#EFEFEF"><div align="center">
                      <tbody>
                        <tr> 
                          <td width="auto"  bgcolor="#EFEFEF"><div align="center"><strong><font size="2">ราคา</font></strong></div></td>
                          </tr>
                            <tr> 
                              <td><div align="center"><font size="2"><?=number_format($row_product['price'],2);?> บาท</font></div>
                              </td>
                            </tr>
                      </tbody></table>-->
                    </p>
                    <form action="order.php" method="post">
                        <div class="aa-prod-quantity">
                          <input type="hidden" name="txtProductID" value="<?php echo $row_product["id"];?>">
                          <label class="col-sm-2 no-padding-right">จำนวน : </label>
                          <input class="form-control" min="1" type="number" name="txtQty" value="1" style="width:80px;" max="<?php echo $row_product['amount'];?>" onkeyup="javascript:intOnly(this);">
                          <p class="aa-prod-category">
                            <font color="#990000">มีสินค้าทั้งหมด : <?php echo $row_product['amount'];?> ชิ้น</font>
                          </p>
                          
                        </div>
                        
                        <div class="aa-prod-view-bottom">
                         <?php if($row_product['amount'] != 0){ ?>
                          <input type="submit" class="aa-add-to-cart-btn" value="สั่งซื้อสินค้า">
                         <?php } ?>
                        </div>
                    </form>
                    <br><br>
                  </div>
                </div>
              </div>
            </div>
            <div class="aa-product-details-bottom">
              <ul class="nav nav-tabs" id="myTab2">
                <li><a href="#description" data-toggle="tab"><font color="#FFFFFF" size="6">รายละเอียดสินค้า</font></a></li>
                <!--<li><a href="#review" data-toggle="tab">Reviews</a></li> -->               
              </ul>
			
              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane fade in active" id="description">
                
                
                  <?php echo str_replace("picture/editor/","picture/editor/",$row_product['detail_product']);?>

                </div>
                <div style="height:150px;"></div>
                <br><br>
                <div class="tab-pane fade " id="review">
                 <div class="aa-product-review-area">
                   <h4>2 Reviews for T-Shirt</h4> 
                   <ul class="aa-review-nav">
                     <li>
                        <div class="media">
                          <div class="media-left">
                            <a href="#">
                              <img class="media-object" src="img/testimonial-img-3.jpg" alt="girl image">
                            </a>
                          </div>
                          <div class="media-body">
                            <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March 26, 2016</span></h4>
                            <div class="aa-product-rating">
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star-o"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="media">
                          <div class="media-left">
                            <a href="#">
                              <img class="media-object" src="img/testimonial-img-3.jpg" alt="girl image">
                            </a>
                          </div>
                          <div class="media-body">
                            <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March 26, 2016</span></h4>
                            <div class="aa-product-rating">
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star-o"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                          </div>
                        </div>
                      </li>
                   </ul>
                   <h4>Add a review</h4>
                   <div class="aa-your-rating">
                     <p>Your Rating</p>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                   </div>
                   <!-- review form -->
                   <form action="" class="aa-review-form">
                      <div class="form-group">
                        <label for="message">Your Review</label>
                        <textarea class="form-control" rows="3" id="message"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name">
                      </div>  
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="example@gmail.com">
                      </div>

                      <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
                   </form>
                 </div>
                </div>            
              </div>
            </div>
            <!-- Related product -->
              <!-- quick view modal -->                  
           
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