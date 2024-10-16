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
	<script>
		function search_user(value){
	
				$.ajax({
					type:"POST",
					url:"data_order.php",
					data:{value:value},
					success:function(data){
						$(".OrderID").html(data);
					}
				});

			return false;
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
  <!-- / header section -->
  <!-- menu -->
  <?php include 'bar_menu.php'; ?>
  <!-- / menu -->  
 

 <!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
			<h2>กรอกรายละเอียดการชำระเงิน</h2>
            <?php
								$sumtotal = 0;
								$sql_order = "SELECT * FROM tb_orders WHERE OrderID = '".$_GET['OrderID']."'   ";
								$st_order = mysqli_query($conn, $sql_order);
								$num=1;
							?>

								<?php 
									while($row_order = mysqli_fetch_array($st_order)){ 
									
									$sql_member = "SELECT * FROM tb_member WHERE id = '".$row_order['id_member']."' ";
									$st_member = mysqli_query($conn, $sql_member);
									$row_member = mysqli_fetch_array($st_member);
									
									$sql_product = "SELECT id,name_product FROM  product_detail WHERE id = '".$row_order['id_product']."' ";
									$st_product = mysqli_query($conn, $sql_product);
									$row_product = mysqli_fetch_array($st_product);
									
									$sumtotal = $row_order['price']*$row_order['Qty'];
									}
								?>
								<!-- PAGE CONTENT BEGINS -->
								<form action="add_invoice.php" class="form-horizontal" role="form" method="post"  enctype="multipart/form-data">
                                <input type="hidden" name="id_order" id="id_order" value="<?=$_GET['OrderID'];?>" />
                                <input type="hidden" name="id_member" id="id_member" value="<?=$row_member['id'];?>" />
                                <input type="hidden" name="user" id="user" value="<?=$_SESSION["fname"];?>" />
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> เลขที่สั่งซื้อ </label>

										<div class="col-sm-9">
											<?php echo $_GET['OrderID'];?>
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> วันที่ชำระเงิน </label>
										<?php
											$startdate = date('Y-m-d');
											$mindate = date('Y-m-d', strtotime('-7 day', strtotime($startdate)));
										?>
										<div class="col-sm-2">
											<input class="form-control" type="date" name="date_invoice" min="<?php echo $mindate;?>" value="<?php echo date('Y-m-d');?>" required>
										</div>
									</div>
           <div class="form-group"> 
           	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"></label>
           <div class="col-sm-10"> 
           	<h4>ชื่อบัญชี : Raim retail</h4>  
           <img src="img/qrpayment.jpg" width="25%"><br></br>
									</div>
                                    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-right" for="form-field-2"> สลิปชำระเงิน </label>
                                        <script language="JavaScript">
											function showPreview(ele)
											{
													$('#imgAvatar').attr('src', ele.value); // for IE
													if (ele.files && ele.files[0]) {
													
														var reader = new FileReader();
														
														reader.onload = function (e) {
															$('#imgAvatar').attr('src', e.target.result);
														}
										
														reader.readAsDataURL(ele.files[0]);
													}
											}
										</script>

										<div class="col-sm-4">
                                        	<input type="hidden" name="numproduct" value="4" />
											<input type="file" id="input-dim-1" name="file_invoice" accept="image/*" OnChange="showPreview(this)" required ><span class="ace-file-container" data-title="เลือกไฟล์ภาพ"><span class="ace-file-name" data-title="No File ..."></span></span>
                                            <img id="imgAvatar" width="300">
										</div>
									</div>
                                    </div>

									<div class="form-group">
                                    	<label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> หมายเหตุ </label>
										<div class="col-sm-6">
                                        <textarea name="detail" cols="50" rows="3" class="area-full" ></textarea>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												บันทึก
											</button>
                                            
											&nbsp; &nbsp; &nbsp;
											<button class="btn btn-danger" type="button" onClick="window.history.back();">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												ยกเลิก
											</button>
										</div>
									</div>
									</form>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->



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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
    
    <script>
	$("#input-dim-1").fileinput({
		uploadUrl: "/file-upload-batch/2",
		allowedFileExtensions: ["jpg", "png", "gif"],
		minImageWidth: 50,
		minImageHeight: 50
	});
	</script>

  </body>
</html>