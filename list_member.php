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
              <h3>ข้อมูลผู้ใช้งาน</h3>
              <div align="right"><a href="register_user.php"><button class="btn btn-success btn-sm" type="button"><i class="fa fa-plus"></i> เพิ่มข้อมูลผู้ใช้งาน</button></a></div>
              <br>
              <div class="col-xs-12">
                <?php
					$sql_member = "SELECT * FROM tb_member WHERE status = 'USER' ";
					$st_member = mysqli_query($conn, $sql_member);
					$row_member = mysqli_fetch_array($st_member);
					
				?>
					<table id="dynamic-table" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
                                	<th style="text-align:center; width:10%;">รูป</th>
									<th style="text-align:center; width:15%;">ชื่อผู้ใช้งาน</th>
									<th style="text-align:center; width:8%;">เบอร์โทร</th>
									<th style="text-align:center; width:10%;">อีเมล์</th>
                                    <th style="text-align:center; width:20%;">ที่อยู่</th>
									<th style="text-align:center; width:10%;">ตำแหน่ง</th>
									<th style="text-align:center; width:10%;">แก้ไข</th>
								</tr>
							</thead>
							<?php
								if($_GET['can'] == 'cancel'){
									$sq = "DELETE FROM tb_member WHERE id = '".$_GET['id']."'";
									$r = mysqli_query($conn, $sq);
								}

								$sql_order = "SELECT * FROM tb_member WHERE status != 'MEMBER' and status != 'C' ";
								$st_order = mysqli_query($conn, $sql_order);
								$num=1;
							?>

							<tbody>
								<?php 
									while($row_member = mysqli_fetch_array($st_order)){
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
								?>
								<tr>
									<td style="text-align:center;">
                                    	<?php if($row_member['pic'] == ''){ ?>
                                        <img src="img/user.png" width="100" />
                                        <?php }else{ ?>
                                        <img src="<?=$row_member['pic'];?>" width="100" />
                                        <?php } ?>
                                    </td>
									<td><?=$row_member['full_name'];?> <?=$row_member['last_name'];?></td>
									<td style="text-align:center;"><?=$row_member['mobile'];?></td>
									<td><?=$row_member['email'];?></td>
									<td>
									<?php
										echo $row_member['address'].' ต.'.$district_name.' อ.'.$amphur_name.' จ.'.$province_name.' '.$row_member['zipcode'];
									?>
									</td>
									<td style="text-align:center;">
										<?php
											if($row_member['status'] == 'USER'){
												echo 'พนักงาน';
											}else{
												echo 'ผู้ดูแลระบบ';
											}
										?>
									</td>
                                    <td style="text-align:center;">
                                        <a href="edit_user.php?id=<?=$row_member["id"];?>" class="btn btn-warning"><i class="ace-icon fa fa-pencil-square-o bigger-110"></i></a>
                                        <a href="JavaScript:if(confirm('คุณต้องการลบรายชื่อผู้ใช้งาน ?')==true){window.location='<?=$_SERVER["PHP_SELF"];?>?Action=cancel&id=<?=$row_member["id"];?>';}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
								</tr>
								<?php $num++; } ?>
						</tbody>
					</table>
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