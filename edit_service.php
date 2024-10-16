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

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
  <? include 'top_menu.php'; ?>
  <!-- / header section -->
  <!-- menu -->
  <? include 'bar_menu.php'; ?>
  <!-- / menu -->  
 

 <!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
			<h2>แก้ไขรายละเอียดแจ้งซ่อมสินค้า</h2>
            	<?
					$sql = "SELECT * FROM service WHERE service_id = '".$_GET['service_id']."' ";
					$stmt =  mysql_query($sql);
					$row = mysql_fetch_array($stmt);
				?>
			  <form action="update_service.php" class="form-horizontal" role="form" method="post"  enctype="multipart/form-data">		
              		<input type="hidden" value="<?=$row[service_id];?>" name="service_id" required />
                  <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> ชื่อสินค้าที่ต้องการซ่อม </label>

                      <div class="col-sm-6">
                      	<input type="text" class="form-control" style="width:100%;" value="<?=$row[serviec_name];?>" name="serviec_name" required />
                      </div>
                  </div>
                  

                  <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> รายละเอียดอาการ </label>
                      <div class="col-sm-9">
                      <textarea name="service_detail" rows="10" class="form-control" ><?=$row[service_detail];?></textarea>
                      </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> ชื่อ-นามสกุล </label>
                      <div class="col-sm-9">
                      	<input type="text" class="form-control" name="full_name" value="<?=$row[full_name];?>" style="width:60%;" placeholder="ชื่อ-นามสกุล" required >
                      </div>                             
                  </div>
                  
                  <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> ที่อยู่</label>
                      <div class="col-sm-9">
                      <textarea name="address" rows="5" class="form-control" ><?=$row[address];?></textarea>
                      </div>                             
                  </div>
                  
                  <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> เบอร์โทรศัพท์</label>
                      <div class="col-sm-9">
                      	<div class="aa-checkout-single-bill">
                          <input name="mobile" type="text" class="form-control" id="mobile" value="<?=$row[mobile];?>" style="width:30%;" placeholder="เบอร์โทรศัพท์" maxlength="10" >
                        </div> 
                      </div>                             
                  </div>

                  <div class="space-4"></div>

                  <div class="clearfix form-actions">
                      <div class="col-md-offset-3 col-md-9">
                          <button class="btn btn-success" type="submit">
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

  </body>
</html>