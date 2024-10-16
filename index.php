<?php
session_start();
include 'connectDb.php';
$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
mysqli_set_charset($conn, "utf8");
error_reporting(~E_NOTICE);
$_SESSION["title"] = "Raim Retail";

$sql_order = "SELECT * FROM orders where status_pay = 'W' ";
$st_order = mysqli_query($conn, $sql_order);
while($row_order = mysqli_fetch_array($st_order)){
	$pay_date = date('Y-m-d',strtotime("+2 day",strtotime($row_order['OrderDate']))); 
	if(date('Y-m-d') > $pay_date){
		$sql_order_up = "update orders set status_pay = 'C' where id = '".$row_order['id']."' ";
		$st_order_up = mysqli_query($conn, $sql_order_up);
		
		$sql_pro = "SELECT * FROM tb_orders WHERE OrderID = '".$row_order['OrderID']."' ";
		$st_pro = mysqli_query($conn, $sql_pro);
		while($row_pro = mysqli_fetch_array($st_pro)){
			$sql_pro_list = "SELECT * FROM product_detail WHERE id = '".$row_pro['id_product']."' ";
			$st_pro_list = mysqli_query($conn, $sql_pro_list);
			$row_pro_list = mysqli_fetch_array($st_pro_list);
			
			$buy_product = $row_pro_list['buy_product']-$row_pro['Qty'];
			$list_amount = $row_pro_list['amount']+$row_pro['Qty'];
		
			$sq_pro = "UPDATE product_detail SET buy_product = '".$buy_product."', amount = '".$list_amount."' WHERE id = '".$row_pro['id_product']."' ";
			$r_pro = mysqli_query($conn, $sq_pro);
		}
	}
}

$sql_promo = "SELECT * FROM product_detail where end_date < '".date('Y-m-d')."' ";
$st_promo = mysqli_query($conn, $sql_promo);
while($row_promo = mysqli_fetch_array($st_promo)){
	$sql_promo_up = "update product_detail set price_pro = 0, start_date = '0000-00-00', end_date = '0000-00-00' where id = '".$row_promo['id']."' ";
	mysqli_query($conn, $sql_promo_up);
}
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
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(window).load(function()
{
    $('#myModal').modal('show');
});
</script>

</head>
  <body>

<?php
  $today = date('Y-m-d');
  $set_date = date('2017-03-31');
  if($today <= $set_date){
?>
<div class="container">
  <!-- Modal -->
  <!--<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Pomotion </h4>
        </div>
        <div class="modal-body">
          <p><a href="http://www.kkaction.com/product_detail.php?id_product=<?=base64_encode('26');?>"><img src="img/promotion.jpg" width="100%"></a></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> -->
</div>
<?php } ?>  
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
  
    <!-- / header top  -->
<?php include 'top_menu.php'; ?> 
    <!-- / header bottom  -->
  </header>
  <!-- / header section -->
  <!-- menu -->
<?php include 'bar_menu.php'; ?>
  <!-- / menu -->
  <!-- Start Promo section -->
  
  <section id="aa-slider">
    <div class="aa-slider-area">
      <div id="sequence" class="seq">
         <script src="js/jssor.slider-22.2.0.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        jssor_1_slider_init = function() {

            var jssor_1_options = {
              $AutoPlay: true,
              $SlideDuration: 800,
              $SlideEasing: $Jease$.$OutQuint,
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*responsive code begin*/
            /*you can remove responsive code if you don't want the slider scales while window resizing*/
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 1920);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*responsive code end*/
        };
    </script>
    <style>
        /* jssor slider bullet navigator skin 05 css */
        /*
        .jssorb05 div           (normal)
        .jssorb05 div:hover     (normal mouseover)
        .jssorb05 .av           (active)
        .jssorb05 .av:hover     (active mouseover)
        .jssorb05 .dn           (mousedown)
        */
        .jssorb05 {
            position: absolute;
        }
        .jssorb05 div, .jssorb05 div:hover, .jssorb05 .av {
            position: absolute;
            /* size of bullet elment */
            width: 16px;
            height: 16px;
            background: url('img/b05.png') no-repeat;
            overflow: hidden;
            cursor: pointer;
        }
        .jssorb05 div { background-position: -7px -7px; }
        .jssorb05 div:hover, .jssorb05 .av:hover { background-position: -37px -7px; }
        .jssorb05 .av { background-position: -67px -7px; }
        .jssorb05 .dn, .jssorb05 .dn:hover { background-position: -97px -7px; }

        /* jssor slider arrow navigator skin 22 css */
        /*
        .jssora22l                  (normal)
        .jssora22r                  (normal)
        .jssora22l:hover            (normal mouseover)
        .jssora22r:hover            (normal mouseover)
        .jssora22l.jssora22ldn      (mousedown)
        .jssora22r.jssora22rdn      (mousedown)
        .jssora22l.jssora22lds      (disabled)
        .jssora22r.jssora22rds      (disabled)
        */
        .jssora22l, .jssora22r {
            display: block;
            position: absolute;
            /* size of arrow element */
            width: 40px;
            height: 58px;
            cursor: pointer;
            background: url('img/a22.png') center center no-repeat;
            overflow: hidden;
        }
        .jssora22l { background-position: -10px -31px; }
        .jssora22r { background-position: -70px -31px; }
        .jssora22l:hover { background-position: -130px -31px; }
        .jssora22r:hover { background-position: -190px -31px; }
        .jssora22l.jssora22ldn { background-position: -250px -31px; }
        .jssora22r.jssora22rdn { background-position: -310px -31px; }
        .jssora22l.jssora22lds { background-position: -10px -31px; opacity: .3; pointer-events: none; }
        .jssora22r.jssora22rds { background-position: -70px -31px; opacity: .3; pointer-events: none; }
    </style>
    <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:900px;height:400px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:rgba(0,0,0,0.7);">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:900px;height:400px;overflow:hidden;">
        	<div>
              <a href="#" target="_blank"><img data-u="image" src="img/slider3.jpeg" /></a>
          </div>
          <div>
              <a href="#" target="_blank"><img data-u="image" src="img/slider13.jpg" /></a>
          </div>
          <div>
              <a href="#" target="_blank"><img data-u="image" src="img/slider12.jpg" /></a>
          </div>
        </div>
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
            <!-- bullet navigator item prototype -->
            <div data-u="prototype" style="width:16px;height:16px;"></div>
        </div>
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora22l" style="top:0px;left:8px;width:40px;height:58px;" data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora22r" style="top:0px;right:8px;width:40px;height:58px;" data-autocenter="2"></span>
    </div>
    <script type="text/javascript">jssor_1_slider_init();</script>
    <!-- #endregion Jssor Slider End -->
      </div>
    </div>
  </section>
  <!-- / slider -->
  
  
  
  
  <!-- / Promo section -->
  <!-- Products section -->
  <section id="aa-product">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-product-area">
              <div class="aa-product-inner">
                <!-- start prduct navigation -->
                 <br>
                  <div class="col-md-8 col-md-offset-5">
                  <ul class="nav nav-pills">
 					 <h2>รายการสินค้า</h2>
				  </ul>
                  
                  </div><h3 class="page-header"></h3>
                   <br>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    <!-- Start men product category -->
                    <div class="tab-pane fade in active" id="men">
                      <ul class="aa-product-catg">
                        <!-- start single product item -->
                        <?php
							$sql_product = "SELECT * FROM product_detail 
								where product_detail.status != 'C' group by product_detail.id ORDER BY product_detail.id DESC LIMIT 0 , 8  ";
							$st_product = mysqli_query($conn, $sql_product);
							while($row_product = mysqli_fetch_array($st_product)){
								$total = $row_product['amount'];
						?>
                        
                        <li>
                          <figure>
                            <a class="aa-product-img" href="product_detail_all.php?id_product=<?=$row_product['id'];?>"><img src="<?=$row_product['pic'];?>" height="250" >
                            <?php if($row_product['amount'] != 0){ ?>
                            <a href="product_detail_all.php?id_product=<?=$row_product['id'];?>" class="aa-add-card-btn" ><span class="fa fa-shopping-cart"></span>สั่งซื้อ</a>
                            <?php } ?>
                              <figcaption>
                              <h4 class="aa-product-title"><a href="product_detail_all.php?id_product=<?=$row_product['id'];?>"><?=$row_product['name_product'];?></a></h4>
                              <span class="aa-product-price"><?=number_format($row_product['price'],2);?> บาท</span><br>
                              <?php if($total == 0){ ?>
                              <span class="aa-product-price"><font color="#FF0000">สินค้าหมด</font></span>
                              <?php }else{ ?>
                              <span class="aa-product-price"><font color="#999999">จำนวนสินค้า <?=number_format($total);?></font></span>
                              <?php } ?>
                            </figcaption>
                          </figure>    
                        </li>
                       <?php } ?>
                      </ul>
                      <a class="aa-browse-btn" href="product_all.php">ดูสินค้าทั้งหมด <span class="fa fa-long-arrow-right"></span></a>
                    </div><br><br>
                    <!-- / men product category -->
                    
                    
                    <!-- start women product category -->
                    
                  
                </div>
              </div>
            </div>
          </div>
        </div>    
      </div>
    </div>
  </section>

  <!-- / Latest Blog -->

  <!-- Client Brand -->

  <!-- / Client Brand -->
  

  <!-- footer -->  
  <?php include 'footer.php'; ?>
  <!-- / footer -->



  <!-- jQuery library -->
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
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