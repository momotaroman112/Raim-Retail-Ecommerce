<?php 
@session_start();
include 'connectDb.php';
$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
mysqli_set_charset($conn, "utf8");
error_reporting(~E_NOTICE);
 ?>
<section id="menu">
    <div class="container">
      <div class="menu-area">
        <!-- Navbar -->
        <div class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">เมนู</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>          
          </div>
          <div class="navbar-collapse collapse">
            <!-- Left nav -->
            <ul class="nav navbar-nav">
            <?php  if($_SESSION["status"] == 'MEMBER'){ ?>
                  <li><a href="index.php">หน้าหลัก</a></li>
                  <li><a href="product_all.php">สินค้าทั้งหมด</a></li>
                  <?php
					$sql_type = "SELECT * FROM product_type where protype_status != 'C' ";
					$st_type = mysqli_query($conn, $sql_type);
					while($row_type = mysqli_fetch_array($st_type)){
				  ?>
				  <li><a href="product_all.php?menu=<?=$row_type['protype_id'];?>"><?=$row_type['protype_name'];?></a></li>
				  <?php } ?>
                  <li><a href="contact.php">ติดต่อเรา</a></li>
             <?php }else if($_SESSION["status"] == 'ADMIN'){ ?>

                  <li class=""><a href="#" class="has-submenu" id="sm-16320482134034775-1" aria-haspopup="true" aria-controls="sm-16320482134034775-2" aria-expanded="false">ข้อมูลการสั่งซื้อ <span class="caret"></span></a>
                    <ul class="dropdown-menu sm-nowrap" id="sm-16320482134034775-2" role="group" aria-hidden="true" aria-labelledby="sm-16320482134034775-1" aria-expanded="false" style="width: auto; min-width: 10em; display: none; max-width: 20em; top: auto; left: 0px; margin-left: 0px; margin-top: 0px;">  
                      <li><a href="list_order.php?status_pay=W"><i class="glyphicon glyphicon-chevron-right"></i> รอชำระเงิน</a></li>
                      <li><a href="list_order.php?status_pay=S"><i class="glyphicon glyphicon-chevron-right"></i> รอตรวจสอบยอดชำระ</a></li>
                      <li><a href="list_order.php?status_pay=Y"><i class="glyphicon glyphicon-chevron-right"></i> ชำระแล้ว</a></li>
                      <li><a href="list_order.php?status_pay=C"><i class="glyphicon glyphicon-chevron-right"></i> ยกเลิก</a></li>
                    </ul>
                  </li>
                  
                  
                  
                  <li><a href="list_payment.php">ข้อมูลการชำระเงิน</a></li>
                  <li><a href="list_send.php">ข้อมูลการจัดส่ง</a></li>
                  <li><a href="list_customer.php">ข้อมูลลูกค้า</a></li>
                  
                  <li><a href="list_product.php">ข้อมูลสินค้า</a></li>
                  <li><a href="list_type_product.php">ข้อมูลประเภทสินค้า</a></li>
                  <!--<li><a href="list_user.php">ข้อมูลผู้ใช้งาน</a></li>-->
                  
                  <li><a href="list_report.php">ออกรายงาน</a></li>
             <?php }else if($_SESSION["status"] == 'USER'){ ?>
                  <li class=""><a href="#" class="has-submenu" id="sm-16320482134034775-1" aria-haspopup="true" aria-controls="sm-16320482134034775-2" aria-expanded="false">ข้อมูลการสั่งซื้อ <span class="caret"></span></a>
                    <ul class="dropdown-menu sm-nowrap" id="sm-16320482134034775-2" role="group" aria-hidden="true" aria-labelledby="sm-16320482134034775-1" aria-expanded="false" style="width: auto; min-width: 10em; display: none; max-width: 20em; top: auto; left: 0px; margin-left: 0px; margin-top: 0px;">  
                      <li><a href="list_order.php?status_pay=W"><i class="glyphicon glyphicon-chevron-right"></i> รอชำระเงิน</a></li>
                      <li><a href="list_order.php?status_pay=S"><i class="glyphicon glyphicon-chevron-right"></i> รอตรวจสอบยอดชำระ</a></li>
                      <li><a href="list_order.php?status_pay=Y"><i class="glyphicon glyphicon-chevron-right"></i> ชำระแล้ว</a></li>
                      <li><a href="list_order.php?status_pay=C"><i class="glyphicon glyphicon-chevron-right"></i> ยกเลิก</a></li>
                    </ul>
                  </li>
                  <li><a href="list_product.php">ข้อมูลสินค้า</a></li>
                  <li><a href="list_payment.php">ข้อมูลการชำระเงิน</a></li>
                  <li><a href="list_send.php">ข้อมูลการจัดส่ง</a></li>
             <?php }else{ ?>
             	  <li><a href="index.php">หน้าหลัก</a></li>
                  <li><a href="product_all.php">สินค้าทั้งหมด</a></li>
                  <?php
					$sql_type = "SELECT * FROM product_type where protype_status != 'C' ";
					$st_type = mysqli_query($conn, $sql_type);
					while($row_type = mysqli_fetch_array($st_type)){
				  ?>
				  <li><a href="product_all.php?menu=<?=$row_type['protype_id'];?>"><?=$row_type['protype_name'];?></a></li>
				  <?php } ?>
                  <li><a href="contact.php">ติดต่อเรา</a></li>
             <?php } ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>       
    </div>
  </section>