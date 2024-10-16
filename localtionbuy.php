<?php
    header('Content-Type: text/html; charset=UTF-8');
    header ("Expires: Wed, 21 Aug 2013 13:13:13 GMT");
    header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");

    include "connectDb.php";
   // conndb();

    $data = $_GET['data'];
    $val = $_GET['val'];
	$em = $_GET['em'];


         if ($data=='provinces') { 
              echo "<select name='provinces' id='provinces' onChange=\"dochange('amphures', this.value)\" required=\"required\" >";
              echo "<option value=''>- เลือกจังหวัด -</option>\n";
              $result=mysql_query("select * from provinces order by PROVINCE_NAME");
			  mysql_query("SET NAMES TIS620");
              while($row = mysql_fetch_array($result)){
                   echo "<option value='$row[PROVINCE_ID]' >$row[PROVINCE_NAME]</option>" ;
              }
         } else if ($data=='amphures') {
              echo "<select name='amphures' id='amphures' onChange=\"dochange('districts', this.value)\" required=\"required\" >";
              echo "<option value=''>- เลือกอำเภอ -</option>\n";                             
              $result=mysql_query("SELECT * FROM amphures WHERE PROVINCE_ID= '$val' ORDER BY AMPHUR_NAME");
              while($row = mysql_fetch_array($result)){
                   echo "<option value=\"$row[AMPHUR_ID]\" >$row[AMPHUR_NAME]</option> " ;
              }
         } else if ($data=='districts') {
              echo "<select name='districts' id='districts' onChange=\"dochange('zipcodes', this.value)\" required=\"required\" >";
              echo "<option value=''>- เลือกตำบล -</option>\n";
              $result=mysql_query("SELECT * FROM districts WHERE AMPHUR_ID= '$val' ORDER BY DISTRICT_NAME");
              while($row = mysql_fetch_array($result)){
                   echo "<option value=\"$row[DISTRICT_CODE]\" >$row[DISTRICT_NAME]</option> \n" ;
              }
         } else if ($data=='zipcodes') {
              echo "<select name='zipcodes' required=\"required\">\n";
              echo "<option value='0'>- รหัสไปรษณีย์ -</option>\n";
              $result=mysql_query("SELECT * FROM zipcodes WHERE district_code = '$val' ORDER BY zipcode");
              while($row = mysql_fetch_array($result)){
                   echo "<option value=\"$row[zipcode]\" selected=\"selected\" >$row[zipcode]</option> \n" ;
              }
		 }
         echo "</select>\n";

        echo mysql_error();
      //  closedb();
?>