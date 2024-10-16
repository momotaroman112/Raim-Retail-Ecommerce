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
<script language=Javascript>
        function Inint_AJAX() {
           try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
           try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
           try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
           alert("XMLHttpRequest not supported");
           return null;
        };

        function dochange(src, val) {
             var req = Inint_AJAX();
             req.onreadystatechange = function () { 
                  if (req.readyState==4) {
                       if (req.status==200) {
                            document.getElementById(src).innerHTML=req.responseText; //รับค่ากลับมา
                       } 
                  }
             };
             req.open("GET", "localtionbuy.php?data="+src+"&val="+val); //สร้าง connection
             req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
             req.send(null); //ส่งค่า
        }

        window.onLoad=dochange('provinces', -1);     
    </script>
    
    <script language="JavaScript">
		function chkNumber(ele)
		{
			var vchar = String.fromCharCode(event.keyCode);
			if ((vchar<'0' || vchar>'9')){
				 alert("กรอกเฉพาะตัวเลขเท่านั้น !!");
				 document.service.mobile.focus();
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
			<h2>รายละเอียดแจ้งซ่อมสินค้า</h2>
            <?
			  $sql_ser = "SELECT * FROM service WHERE service_id = '".$_GET[service_id]."' ";
			  $st_ser = mysql_query($sql_ser);
			  $row_ser = mysql_fetch_array($st_ser);
			?>
            	<div class="col-md-2"></div>
            	<label>ชื่อผู้แจ้ง : </label> <?=$row_ser[full_name];?><br>
                <div class="col-md-2"></div>
                <label>เบอร์โทร : </label> <?=$row_ser[mobile];?><br>
                <div class="col-md-2"></div>
                <label>ที่อยุ่ :  </label> <?=$row_ser[address];?>
                <br><br>
         <?
		 	  $num=1;
			  if($_GET["Action"] == "Can")
			  {
				  $strSQL = "update service_detail set service_status = 'N' WHERE serdetail_id = '".$_GET["serdetail_id"]."' ";
				  $stmt = mysql_query($strSQL);
				  
				  $sql_service2 = "SELECT * FROM service_detail WHERE service_id = '".$_GET[service_id]."' and service_status = 'Q' ";
				  $st_service2 = mysql_query($sql_service2);
				  $romnum = mysql_num_rows($st_service2);
				  if($romnum == ''){
					  $sql_service3 = "SELECT * FROM service_detail WHERE service_id = '".$_GET[service_id]."' and service_status = 'A'";
				  	  $st_service3 = mysql_query($sql_service3);
					  $romnum3 = mysql_num_rows($st_service3);
					  if($romnum3 == ''){
						  $sql2 = "UPDATE service SET service_status = 'C' WHERE service_id = '".$_GET['service_id']."' ";		
						  $objQuery2 = mysql_query($sql2);	
					  }else{
						  $sql2 = "UPDATE service SET service_status = '' WHERE service_id = '".$_GET['service_id']."' ";		
						  $objQuery2 = mysql_query($sql2);	
					  }
				  }
		?>
				<script>
                    window.location.href = "view_service_detail.php?service_id=<?=$_GET['service_id'];?>";
                </script>
        <?
			  }
			  if($_GET["Action"] == "Con")
			  {
				  $strSQL = "update service_detail set service_status = 'A' WHERE serdetail_id = '".$_GET["serdetail_id"]."' ";
				  $stmt = mysql_query($strSQL);
				  
				  $sql_service2 = "SELECT * FROM service_detail WHERE service_id = '".$_GET[service_id]."' and service_status = 'Q' ";
				  $st_service2 = mysql_query($sql_service2);
				  $romnum = mysql_num_rows($st_service2);
				  if($romnum == ''){
					  $sql2 = "UPDATE service SET service_status = '' WHERE service_id = '".$_GET['service_id']."' ";		
					  $objQuery2 = mysql_query($sql2);	
				  }
		?>
				<script>
                    window.location.href = "view_service_detail.php?service_id=<?=$_GET['service_id'];?>";
                </script>
        <?
			  }
		 	  $sql_service = "SELECT * FROM service_detail WHERE service_id = '".$_GET[service_id]."' and service_status != 'C' ";
			  $st_service = mysql_query($sql_service);
			  
			  $rownum = mysql_num_rows($st_service);
			  if($rownum != ''){
		 ?>
         <table width="100%" class="table table-bordered">
          <tr>
            <th style="width:5%; text-align:center;">ลำดับ</th>
            <th style="width:20%; text-align:center;">ชื่อสินค้า</th>
            <th style="width:35%; text-align:center;">อาการซ่อม</th>
            <th style="width:10%; text-align:center;">ค่าซ่อม</th>
            <th style="width:20%; text-align:center;">จัดการ</th>
          </tr>
          <? while($row_service = mysql_fetch_array($st_service)){ ?>
          <tr>
            <td><?=$num;?></td>
            <td style="text-align:left;"><?=$row_service[serviec_name];?></td>
            <td style="text-align:left;"><?=$row_service[service_detail];?></td>
            <td>
            	<?
					if($row_service[price_service] == 0){
						echo '<div align="center"><span class="label label-warning">รอประเมินราคา</span></div>';
					}else{
						echo '<div align="right">'.number_format($row_service[price_service],2).'</div>';
					}
				?>
            </td>
            <td>
            	<?
					if($row_service[service_status] == 'Q'){
				?>
                	<a href="JavaScript:if(confirm('คุณต้องการยืนยันการซ่อม ?')==true){window.location='<?=$_SERVER["PHP_SELF"];?>?Action=Con&serdetail_id=<?=$row_service["serdetail_id"];?>&service_id=<?=$row_service['service_id'];?>';}" class="btn btn-success btn-xs"><i class="fa fa-check"></i> ยืนยันซ่อม</a>
                    <a href="JavaScript:if(confirm('คุณต้องการยกเลิกการซ่อม ?')==true){window.location='<?=$_SERVER["PHP_SELF"];?>?Action=Can&serdetail_id=<?=$row_service["serdetail_id"];?>&service_id=<?=$row_service['service_id'];?>';}" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i> ยกเลิกซ่อม</a>
               	<?  
					}else if($row_service[service_status] == 'A'){ 
						echo '<div align="center"><span class="label label-success">ยืนยันซ่อม</span></div>';
					}else if($row_service[service_status] == 'N'){ 
						echo '<div align="center"><span class="label label-danger">ยกเลิกซ่อม</span></div>';
					}else if($row_service[service_status] == 'S'){ 
						echo '<div align="center"><span class="label label-warning">รอประเมินราคา</span></div>';
					}
				?>
                
                	
            </td>
          </tr>
          <? $num++; } ?>
        </table>
		 <? } ?>
        <a href="s_list_service.php?search_type=0&service_id=<?=$row_ser['service_id'];?>">
        <button class="btn btn-danger" type="button">
            <i class="ace-icon fa fa-undo bigger-110"></i>
            ย้อนกลับ
        </button>
        </a>
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