<?php
@session_start();
		include "connectDb.php"; 
		$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
		mysqli_set_charset($conn, "utf8");
		error_reporting(~E_NOTICE);
?>



   <!-- start header bottom  -->
   <header id="aa-header">
    <!-- start header top  -->
    <div class="aa-header-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-top-area">
              <!-- start header top left -->
              <div class="aa-header-top-left">
              </div>
              <!-- / header top left -->
              <div class="aa-header-top-right">
              	<div class="aa-language">
                  <div class="dropdown">
                  <?php
				  	if($_SESSION["email"] == ''){
				  ?>
                  	<ul class="aa-head-top-nav-right">
                    	<li><a href="register.php"> <span class="fa fa-user"></span> สมัครสมาชิก</a></li>
                    	<li><a href="login.php"> <span class="fa fa-sign-out"></span> เข้าสู่ระบบ</a></li>
                    <ul>
                  <?php }else{ ?>
                  	<a class="btn dropdown-toggle" href="admin/profile_member.php" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <font color="#CCCCCC"><span class="fa fa-user"></span> <?=$_SESSION["fname"];?> <span class="fa fa-angle-double-down"></span></font></a>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <?php if($_SESSION["status"] == 'MEMBER'){ ?>
                      <li><a href="profile.php"><span class="fa fa-user"></span> ข้อมูลส่วนตัว</a></a></li>
                      <li><a href="list_order_mem.php?member=<?=$_SESSION["id_member"];?>"><span class="fa fa-dropbox"></span> การสั่งซื้อของฉัน</a></li>
                      <li><a href="logout.php"><span class="fa fa-power-off"></span> ออกจากระบบ</a></a></li>
                    <?php }else if($_SESSION["status"] == 'ADMIN'){ ?>
                    	<li><a href="shop.php"><span class="fa fa-home"></span> ข้อมูลร้าน</a></a></li>
                      <li><a href="logout.php"><span class="fa fa-power-off"></span> ออกจากระบบ</a></a></li>
                    <?php }else if($_SESSION["status"] == 'USER'){ ?>
                    	<li><a href="profile.php"><span class="fa fa-user"></span> ข้อมูลส่วนตัว</a></a></li>
                       	<li><a href="list_order.php"><span class="fa fa-dropbox"></span> การสั่งซื้อของสมาชิก</a></li>
                      <li><a href="logout.php"><span class="fa fa-power-off"></span> ออกจากระบบ</a></a></li>
                    <?php } ?>
                    </ul>
                   <?php } ?>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="aa-header-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-bottom-area">
              <!-- logo  -->
              <div class="aa-logo">
              <!-- Text based logo -->
              <a href="index.php">
                <img src="img/raim_retail.png" alt="Raim Shop Logo"  width = "50%" >
              </a>
              <!-- img based logo -->
              <!-- <a href="index.html"><img src="img/logo.jpg" alt="logo img"></a> -->
            </div>
              <!-- / logo  -->
               <!-- cart box -->
               <br />
              <?php //if($_SESSION["status"] == 'MEMBER'){ ?>
              <div class="aa-cartbox">
                <a class="aa-cart-link" href="show_cart.php">
                  <span class="fa fa-shopping-basket"></span>
                  <span class="aa-cart-title">สินค้าที่เลือก</span>
                  <?php if($_SESSION["sumQty"] != ''){ ?>
                  <span class="aa-cart-notify"><?php echo $_SESSION["sumQty"];?></span>
                  <?php } ?>
                </a>

              </div>
              <?php //} ?>
              <!-- / cart box -->
              <!-- search box -->
             <!-- <div class="aa-search-box">
                <form action="">
                  <input type="text" name="" id="" placeholder="Search">
                  <button type="submit"><span class="fa fa-search"></span></button>
                </form>
              </div> -->
              <!-- / search box -->             
            </div>
          </div>
        </div>
      </div>
    </div>
  