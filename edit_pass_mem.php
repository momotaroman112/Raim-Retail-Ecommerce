<?php 
session_start();
include 'connectDb.php';
$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
		mysqli_set_charset($conn, "utf8");
		error_reporting(~E_NOTICE);
$strSQL = "SELECT * FROM tb_member WHERE id = '".$_GET['id_member']."' ";
			$stmt =  mysqli_query($conn, $strSQL);
			$row_member = mysqli_fetch_array($stmt);
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <link rel="icon" href="img/tapbar_logo.png" type="image/png"> <!-- For PNG format -->    
    <title>Raim Retail</title>
    
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
 
 
 <script type="text/javascript">
	function checkID(id)
	{
		if(id.length != 13) return false;
		for(i=0, sum=0; i < 12; i++)
		sum += parseFloat(id.charAt(i))*(13-i); if((11-sum%11)%10!=parseFloat(id.charAt(12)))
		return false; return true;
	}
	function chkNumber(ele)
	  {
		var vchar = String.fromCharCode(event.keyCode);
		 if ((vchar<'0' || vchar>'9') && (vchar != '.')){
			alert("กรุณากรอกเฉพาะตัวเลขเท่านั้น");
			return false;
		 }else{
			ele.onKeyPress=vchar;
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
    <!--<a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>-->
  <!-- END SCROLL TOP BUTTON -->


  <!-- Start header section -->
  <?php include 'top_menu.php'; ?> 
    <!-- / header top  -->

    <!-- start header bottom  -->
    <!-- / header bottom  -->
  <!-- / header section -->
  <!-- menu -->
<?php include 'bar_menu.php'; ?>  <!-- / menu -->  
 
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
    
    <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="checkout">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="checkout-area">
        <?php
			
			
		?>
          <form action="update_pass.php" method="post" enctype="multipart/form-data" onSubmit="return fncSubmit(this);">
          <input type="hidden" name="id_member" value="<?=$_GET['id_member'];?>">
            <div class="row">
              <div class="col-md-6">
                <div class="checkout-left">
                  <div class="panel-group" id="accordion">
                    <!-- Shipping Address -->
                    <div class="panel panel-default aa-checkout-billaddress">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <strong>เปลี่ยนรหัสผ่าน</strong>
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                         	<div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <input type="password" name="password_old" id="password_old" placeholder="รหัสผ่านเดิม" class="col-xs-10 col-sm-5" required  />
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <input type="password" name="password" id="password" placeholder="รหัสผ่านใหม่" class="col-xs-10 col-sm-5" required  />
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <input type="password" name="password2" id="password2" placeholder="ยืนยันรหัสผ่าน" class="col-xs-10 col-sm-5" required  />
                              </div>
                            </div>
                          </div>
                          <input type="submit" value="บันทึก" class="aa-browse-btn" />
                         </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="checkout-right">
                  <h2>แก้ไขรหัสผ่าน</h2>
                  <div class="aa-order-summary-area">
                    <img src="img/pass.png" class="img-responsive">
                  </div>
                </div>
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
    
    <script language="javascript">
	// Start XmlHttp Object
	function uzXmlHttp(){
		var xmlhttp = false;
		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
			try{
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}
	 
		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
		return xmlhttp;
	}
	// End XmlHttp Object
	
	function data_show(select_id,result,point_id){
		var url = 'data_edit.php?select_id='+select_id+'&result='+result+'&point_id='+point_id;
		//alert(url);
		
		xmlhttp = uzXmlHttp();
		xmlhttp.open("GET", url, false);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
		xmlhttp.send(null);
		document.getElementById(result).innerHTML =  xmlhttp.responseText;
	}
	window.onLoad=data_show('<?=$row_member['provinces']?>','amphures','<?=$row_member['amphures']?>'); 
	window.onLoad=data_show('<?=$row_member['amphures']?>','districts','<?=$row_member['districts']?>'); 
	window.onLoad=data_show('<?=$row_member['districts']?>','zipcode','<?=$row_member['zipcode']?>');
	</script>
  </body>
</html>