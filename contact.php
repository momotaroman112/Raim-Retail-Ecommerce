<?php
session_start();
include 'connectDb.php';
?>
<!DOCTYPE html>
<html>
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
    
    <style>
    .form-group h2 {
    margin-bottom: 1px; /* เพิ่มระยะห่างด้านล่างของข้อความ */
    font-size: 18px; /* ปรับขนาดตัวหนังสือ */
    font-weight: bold; /* ตั้งให้ตัวหนังสือหนาขึ้น */
    }

    .form-group iframe {
    width: 100%; /* ทำให้ iframe ขยายตามขนาดของ div ที่ครอบ */
}
    </style>
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
  <header id="aa-header">
    <?php include 'top_menu.php'; ?> 

  </header>
  <!-- / header section -->
  <!-- menu -->
  <?php  include 'bar_menu.php'; ?>
  <!-- / menu -->  
 
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
    <!--<img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">-->
    <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
      <!-- สมัครสมาชิก-->
        <!--<ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>                   
          <li class="active">Account</li>
        </ol>-->
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">         
            <div class="row">
              <div class="col-md-12">
                <h4>ติดต่อเรา</h4>
                <br><br>
                  <?php
				  $sql_product = "SELECT * FROM  shop WHERE shop_id = 1 ";
				  $st_product = mysqli_query($conn, $sql_product);
				  $row_product = mysqli_fetch_array($st_product)
			  ?>
              <form action="update_shop.php" class="form-horizontal" role="form" method="post"  enctype="multipart/form-data">
                  <div class="form-group">
                       <h2><i class="fa fa-phone "></i> : <?=$row_product['shop_tel'];?></h2>
                  </div>
                  
                  <div class="form-group">
                  	  <h2 ><i class="fa fa-home "></i> : <?=$row_product['shop_add'];?></h2>
            
                  </div>

               	  <div class="form-group">
					            <h2 ><i class="fa fa-envelope-o "></i> : <?=$row_product['shop_email'];?></h2>
                  </div>
                  
                  <div class="form-group">
                      <a href="https://web.facebook.com/?_rdc=1&_rdr" ><h2  ><i class="fa fa-facebook "></i>&nbsp :  <?=$row_product['shop_fb'];?></h2></a>
                  </div>
                  
                  <div class="form-group">
                      <a href="https://www.instagram.com/?hl=en"><h2 ><i class="fa fa-comment-o"></i> : <?=$row_product['shop_line'];?></h2></a>
                  </div>
                  <div class="form-group">
                      <h2><i class="fa fa-map-o"></i> : แผนที่ร้าน</h2>
                      
                      <div style="text-align: center;">
                          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1898.4805503515734!2d99.3363022059202!3d17.887272380186925!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30d95244131a6329%3A0xad3ac344cce493b4!2z4Lia4Lij4Lij4LiI4LiH4Lih4Lit4LmA4LiV4Lit4Lij4LmM!5e0!3m2!1sth!2sth!4v1697337755830!5m2!1sth!2sth" width="900" height="600" style="border: 1px;;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                      </div>
                  </div>

                  <div class="space-4"></div>

                  </form>
              </div>
            </div>          
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

  

  </body>
</html>