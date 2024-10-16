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

          <form action="update_edit_profile.php" method="post" enctype="multipart/form-data" onSubmit="return fncSubmit(this);">
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
                            <strong>กรอกข้อมูลโดยละเอียด</strong>
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                         	<div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="full_name" id="full_name" value="<?=$row_member['full_name'];?>" placeholder="ชื่อ" required>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="last_name" id="last_name" value="<?=$row_member['last_name'];?>" placeholder="นามสกุล" required>
                              </div>
                            </div>
                            
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="mobile" id="mobile" placeholder="เบอร์ติดต่อ" OnKeyPress="return chkNumber(this)" maxlength="10" value="<?=$row_member['mobile'];?>" required>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <select name="sex" id="sex" required>
                                    <option value="ชาย" <?php if($row_member['sex'] == 'ชาย'){ echo 'selected'; } ?>>ชาย</option>
                                    <option value="หญิง" <?php if($row_member['sex'] == 'หญิง'){ echo 'selected'; } ?>>หญิง</option>
                                </select>
                              </div>
                            </div>
                          </div> 
                          
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="address" id="address" value="<?=$row_member['address'];?>" placeholder="ที่อยู่" required>
                              </div>                             
                            </div>                            
                          </div> 
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                 <select id="provinces" name="provinces" class="form-control" required onchange="data_show(this.value,'amphures','');document.getElementById('districts').innerHTML = '<option value=>-- เลือกอำเภอ --</option>';">
									  <?php
                                      $strSQLg = "SELECT * FROM provinces ORDER BY provinces.PROVINCE_NAME ASC ";
                                      $objQueryg = mysqli_query($conn, $strSQLg) or die ("Error Query [".$strSQLg."]");
                                      while($objResultg = mysqli_fetch_array($objQueryg))
                                      {
                                      ?>
                                      <option value="<?php echo $objResultg['PROVINCE_ID'];?>" <?php if($objResultg['PROVINCE_ID'] == $row_member['provinces']){echo 'selected'; } ?> ><?php echo $objResultg['PROVINCE_NAME'];?></option>
                                      <?php
                                      }
                                      ?>
                                  </select>
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <select name='amphures' id='amphures' class="form_select" onchange="data_show(this.value,'districts','');">
                                    <option value="">กรุณาเลือก</option>
                                </select>
                              </div>
                            </div>
                          </div> 
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <select name='districts' class="form_select" id='districts' onchange="data_show(this.value,'zipcode');">
                                    <option value="">กรุณาเลือก</option>
                                </select>
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <select name='zipcode' class="form_select" id='zipcode'>
                                    <option value="">กรุณาเลือก</option>
                                </select>
                              </div>
                            </div>
                         </div>   
                            <div class="row">
                                <div class="col-md-3">
                                  <div class="aa-checkout-single-bill">
                                    เลือกรูปโปรไฟล์
                                  </div>                             
                                </div>
                                <div class="col-md-9">
                                  <div class="aa-checkout-single-bill">
                                  	<input type="hidden" name="hdnOldFile" value="<?=$row_member['pic'];?>">
                                    <input type="file" name="pic" id="pic" >
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
                  <h2>แก้ไขข้อมูลส่วนตัว</h2>
                  <div class="aa-order-summary-area">
                  <?php if($row_member['pic'] != ''){ ?>
                    <img src="<?=$row_member['pic'];?>" style="width:50%;">
                  <?php }else{ ?>
                    <img src="img/user.png"  style="width:50%;">
                  <?php } ?>
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
		var url = 'data.php?select_id='+select_id+'&result='+result+'&point_id='+point_id;
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