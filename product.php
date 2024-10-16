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

    <script language="JavaScript">
	   var HttPRequest = false;

	   function doCallAjax(ProductID,Qty) {
		  HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 
		  
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
	
		  var url = 'AjaxPHPShoppingCart2.php';
		  var pmeters = "tProductID=" + ProductID+
						"&tQty=" + Qty;
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
			
			
			HttPRequest.onreadystatechange = function()
			{

				 if(HttPRequest.readyState == 3)  // Loading Request
				  {
				   document.getElementById("mySpan").innerHTML = "Now is Loading...";
				  }

				 if(HttPRequest.readyState == 4) // Return Request
				  {			  
					  document.getElementById('mySpan').innerHTML = HttPRequest.responseText;
				  }				
			}

	   }
	   
	   function CheckOut()
	   {
	   window.location = 'show_cart_sp.php';
	   }
	</script>

  </head>
  <!-- !Important notice -->
  <!-- Only for product page body tag have to added .productPage class -->
  <body class="productPage" onLoad="JavaScript:doCallAjax('','')">  
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
        <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
          <div class="aa-product-catg-content">
            <div class="aa-product-catg-head">
              <div class="aa-product-catg-head-left">
                <form action="" class="aa-sort-form">
                  <label for="">ค้นหาสินค้า : </label>
                  <input type="text" placeholder="" name="sProduct" >
                  <input name="" type="submit" value="ค้นหา">
                </form>
              </div>
              <div class="aa-product-catg-head-right">
                <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
              </div>
            </div>
            <div class="aa-product-catg-body">
              <ul class="aa-product-catg">
                <!-- start single product item -->
                <?
					$perpage = 12;
					 if (isset($_GET['page'])) {
					 $page = $_GET['page'];
					 } else {
					 $page = 1;
					 }
					 $start = ($page - 1) * $perpage;
 					
					if($_GET[id_product] != ''){
						if($menu != '5' && $menu != '10'){
							/*$sql_product = "SELECT * FROM product_detail_join 
								inner join product_detail on product_detail.id = product_detail_join.product_join
								WHERE product_detail.protype_id = '".$menu."' and product_detail_join.product_id = '$_GET[id_product]' group by product_detail_join.product_join ";*/
								//echo $sql_product.'333333333333333333333333' ;
							$sql_order = "SELECT * FROM tb_orders where tb_orders.SID = '".session_id()."' and protype_id = '".$menu."'";
							$st_order = mysql_query($sql_order);
							$num_order = mysql_num_rows($st_order);
							$row_order = mysql_fetch_array($st_order);
							if($num_order == ''){
								$sql_product = "SELECT * FROM product_detail_join 
									inner join product_detail on product_detail.id = product_detail_join.product_join
									WHERE product_detail.protype_id = '".$menu."' and (product_detail_join.product_id = '$_GET[id_product]' or product_detail_join.product_id = '$_GET[id_product]') group by product_detail_join.product_join ";
								//echo $sql_product.'dddd';
							}else{
								$sql_product = "SELECT * FROM product_detail_join 
									inner join product_detail on product_detail.id = product_detail_join.product_join
									WHERE product_detail.protype_id = '".$menu."' and product_detail_join.SID = '".session_id()."' group by product_detail_join.product_join ";
									//echo $sql_product;
							}
						}else{
							$sql_product = "SELECT * FROM product_detail WHERE protype_id = '".$menu."' AND product_detail.status != 'C' ORDER BY id DESC limit {$start} , {$perpage}  ";
						}
					}else{
						//echo session_id();
						$sql_order = "SELECT * FROM tb_orders where tb_orders.SID = '".session_id()."' and protype_id = '".$menu."'";
						$st_order = mysql_query($sql_order);
						$num_order = mysql_num_rows($st_order);
						$row_order = mysql_fetch_array($st_order);
						
						$sql_order0 = "SELECT * FROM tb_orders where tb_orders.SID = '".session_id()."'";
						$st_order0 = mysql_query($sql_order0);
						$num_order0 = mysql_num_rows($st_order0);
						
						if($num_order == ''){
							if($menu != '5' && $menu != '10'){
								if($num_order0 !=0){
									$sql_product = "SELECT * FROM product_detail_join 
										inner join product_detail on product_detail.id = product_detail_join.product_join
										WHERE product_detail.protype_id = '".$menu."' group by product_detail_join.product_join ";
									//echo $sql_product;
								}else{
									$sql_product = "SELECT * FROM product_detail WHERE protype_id = '".$menu."' AND product_detail.status != 'C' ORDER BY id DESC limit {$start} , {$perpage}  ";
								}
							}else{
								$sql_product = "SELECT * FROM product_detail WHERE protype_id = '".$menu."' AND product_detail.status != 'C' ORDER BY id DESC limit {$start} , {$perpage}  ";
							}
						}else{
							$sql_product = "SELECT * FROM product_detail WHERE protype_id = '".$menu."' AND product_detail.status != 'C' ORDER BY id DESC limit {$start} , {$perpage}  ";
						}
					}
					
					
					$st_product = mysql_query($sql_product);
					$numrow = mysql_num_rows($st_product);
					
					$intRows = 0;
					if($numrow != ''){
					while($row_product = mysql_fetch_array($st_product)){
					$intRows++;
				?>
                <li>
                  <figure>
                    <a class="aa-product-img" href="product_detail.php?id_product=<?=$row_product[id];?>"><img src="admin/<?=$row_product[pic];?>" width="270" height="180"></a>
                    <!--<a class="aa-add-card-btn" href="product_detail.php?id_product=<?=$row_product[id];?>">
                    <span class="fa fa-shopping-cart"></span>สั่งซื้อ</a>-->
                    <a class="aa-add-card-btn" href="product_detail.php?id_product=<?=$row_product["id"];?>" ><span class="fa fa-shopping-cart"></span>สั่งซื้อ</a>
                    <input type="text" id="txt<?=$intRows;?>" value="<?=$row_product[protype_id];?>" style="width:20px; border:none; color:#FFF;">
                    <!--<input type="button" value="Add" onClick="JavaScript:doCallAjax('<?=$row_product["id"];?>', document.getElementById('txt<?=$intRows;?>').value);">-->
                    <figcaption>
                      <h4 class="aa-product-title"><a href="product_detail.php?id_product=<?=$row_product[id];?>"><?=$row_product[name_product];?></a></h4>
                      <span class="aa-product-price"><?=number_format($row_product[price],2);?> บาท</span> 
                    </figcaption>
                  </figure>                         
                 
                  <!-- product badge -->
                  <?
				  	$dis = $row_product[price_member]-$row_product[price_vip];
					$sale = ($dis*100)/$row_product[price_member];
				  ?>
                 <? if($sale != 0){ ?>
                 <span class="aa-badge aa-sale" href="#">-<?=number_format($sale,0);?>%</span>
                 <? } ?>
                </li>
                <? } ?>
                <? }else{
					$menushow = "SELECT * FROM product_type WHERE protype_id = '$menu'";
					$st_show = mysql_query($menushow);
					$rshow = mysql_fetch_array($st_show);
				?>
                <div align="center"><h3>---ไม่มีรายการ <?=$rshow[protype_name]; ?> ที่เข้ากันได้---</h3></div>
                <? } ?>
                <!-- start single product item -->
              </ul>
             
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
            
             <?php
			  		$sql_product2 = "SELECT * FROM product_detail where protype_id = '$_GET[menu]' ORDER BY id DESC ";
					$st_product2 = mysql_query($sql_product2);

				 $total_record = mysql_num_rows($st_product2);
				 $total_page = ceil($total_record / $perpage);
			 ?>
            
            <div class="aa-product-catg-pagination">
              <nav>
                <ul class="pagination">
                  <li>
                    <a href="product.php?menu=<?=base64_encode($menu);?>&page=1" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <?php for($i=1;$i<=$total_page;$i++){ ?>
                     <li><a href="product.php?menu=<?=base64_encode($menu);?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                 <?php } ?>

                  <li>
                    <a href="product.php?menu=<?=base64_encode($menu);?>&page=<?php echo $total_page;?>" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
          <aside class="aa-sidebar">
            <!-- single sidebar -->
            <span id="mySpan"></span>
            
            <div class="aa-sidebar-widget">
              <h3>จัดสเปก</h3>
              <ul class="aa-catg-nav">
              <?
				$menu = 'SELECT * FROM product_type WHERE protype_status != "C" ORDER BY product_code ASC  ';
				$st = mysql_query($menu);
				while($rmenu = mysql_fetch_array($st)){
					$product_code = sprintf("%02d",$rmenu[product_code]-1);
					//echo $product_code;
					if($product_code == 11){
						$product_code = 10;
					}else{
						$product_code = $product_code;
					}
					
					$strSQL_ty = "SELECT * FROM product_type WHERE product_code = '".$product_code."' ";
					$objQueryPro_ty = mysql_query($strSQL_ty);
					$row_ty = mysql_fetch_array($objQueryPro_ty);
					//echo $row_ty[protype_id];
					
					$sql_orderm = "SELECT * FROM tb_orders where tb_orders.SID = '".session_id()."' and protype_id = '$rmenu[protype_id]' ";
					$st_orderm = mysql_query($sql_orderm);
					$rmenum = mysql_fetch_array($st_orderm);
					//echo $sql_orderm;
					if($rmenu[protype_id] != 4){
						$strSQL_4 = "SELECT * FROM tb_orders  WHERE protype_id = '4' and SID = '".session_id()."' ";
						$objQuery_4 = mysql_query($strSQL_4) or die ("Error Query [".$strSQL_cart."]");
						$objResult_4 = mysql_fetch_array($objQuery_4);
			  ?>
                	<li><a href="product.php?menu=<?=$rmenu[protype_id];?>&id_product=<?=$objResult_4[id_product];?>"><?=$rmenu[protype_name];?></a></li>
              <?	}else{ ?>
              		<li><a href="product.php?menu=<?=$rmenu[protype_id];?>&id_product=<?=$rmenum[id_product];?>"><?=$rmenu[protype_name];?></a></li>
              <?	} ?>
			  
              <? } ?>
              </ul>
            <br><br>   
               
            </div>
           

          </aside>
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