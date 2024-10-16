<?
		session_start();
		header('Content-Type: text/html; charset=UTF-8');
		include "connectDb.php"; 
		
		$sumtotal=0;
		$total=0;
		$net=0;
		$Qtytotal=0;
		$sql_order1 = "SELECT sum(price) as sumprice FROM tb_orders WHERE OrderID = '$_POST[value]' group by OrderID ";
		$st_order1 = mysql_query($sql_order1);
		while($row_order1 = mysql_fetch_array($st_order1)){
			$sumtotal = $row_order1[sumprice];
		}
		$sql_order = "SELECT * FROM tb_orders WHERE OrderID = '$_POST[value]' group by OrderID ";
		$st_order = mysql_query($sql_order);
		while($row_order = mysql_fetch_array($st_order)){
			//$sumtotal += $row_order[price];
			if($row_order[send_product] == 1){
				$total = $total+$sumtotal;
				if($total < 1000){
					$net = $total+50;
				}else{
					$net = $total;
				}
			}else{
				$total = $total+$sumtotal;
				$net = $total;
			}
			$send_product = $row_order[send_product];
			$id_member = $row_order[id_member];
		
		
		$sql_member = "SELECT * FROM tb_member WHERE id = '$id_member'   ";
		$st_member = mysql_query($sql_member);
		$row_member = mysql_fetch_array($st_member);
		
		$numrow = mysql_num_rows($st_order);
		if($row_order[status_pay] == 'W'){
	?>	
    	<input type="hidden" name="id_member" id="id_member" value="<?=$id_member;?>" />
        <div class="form-group">
        	<label class="col-sm-2 control-label no-padding-right" for="form-field-2"> ชื่อ-นามสกุล </label>
            	<div class="col-sm-4">
                	<input type="text" class="form-control" value="<?=$row_member[fname];?> <?=$row_member[lname];?>" readonly="readonly" /> 
                </div>
       </div>
       <div class="form-group">
        	<label class="col-sm-2 control-label no-padding-right" for="form-field-2"> ราคาสินค้าทั้งหมด </label>
            	<div class="col-sm-4">
                	<input type="text" class="form-control" style="text-align:right;" value="<?=number_format($total,2);?>" readonly="readonly" /> 
                </div><strong>บาท</strong>
       </div>
       <? if($send_product == 1 && $total < 1000){ ?>
       	<div class="form-group">
        	<label class="col-sm-2 control-label no-padding-right" for="form-field-2"> ค่าขนส่ง </label>
            	<div class="col-sm-4">
                	<input type="text" class="form-control" style="text-align:right;" value="<?=number_format(50,2);?>" readonly="readonly" /> 
                </div><strong>บาท</strong>
       </div>
    	<div class="form-group">
        	<label class="col-sm-2 control-label no-padding-right" for="form-field-2"> <font color="#FF0000">ราคาที่ต้องชำระ </font></label>
            	<div class="col-sm-4">
                	<input type="text" class="form-control" style="text-align:right; color:#F00;" value="<?=number_format($net,2);?>" readonly="readonly" /> 
                </div><strong><font color="#FF0000">บาท</font></strong>
       </div>
       
       <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> วันที่ชำระเงิน </label>

                            <div class="col-sm-4">
                                <input class="form-control" type="date" placeholder="วันที่ชำระเงิน" value="<?=date('Y-m-d');?>" name="date_invoice">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> ประเภทการชำระ </label>

                            <div class="col-sm-4">
                                <select class="form-control" id="form-field-select-1" name="type_pay" required>
                                    <option value="slip" selected>โอนผ่านธนาคาร</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group"> 
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"></label>
                        <div class="col-sm-10"> 
                        <h4>ชื่อบัญชี : บริษัท เพลิน คอมพิวเตอร์ จำกัด </h4>   
                        <label><input type ="radio" name="bank" id="rdisend1" value="kbank" required="required"> <img src="img/logo_kbank.png" width="30"> ธนาคารกสิกรไทย 	 หมายเลขบัญชี 001-2-34567-8</label> </div><br>
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"></label>
                        <div class="col-sm-10">
                        <label><input type ="radio" name="bank" id="rdisend1" value="bbl" required="required"> <img src="img/bbl.png" width="30"> ธนาคารกรุงเทพ  หมายเลขบัญชี 987-6-54321-0</label> </div><br>
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"></label>
                        <div class="col-sm-10">
                        <label><input type ="radio" name="bank" id="rdisend1" value="scb" required="required"> <img src="img/SCB.png" width="30"> ธนาคารไทยพาณิชย์	หมายเลขบัญชี 112-3-45678-9</label> </div><br>
                            
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
                                <input type="file" id="input-dim-1" accept="image/*" name="file_invoice" OnChange="showPreview(this)"  required><span class="ace-file-container" data-title="เลือกไฟล์ภาพ"><span class="ace-file-name" data-title="No File ..."></span></span>
                                <img id="imgAvatar" width="300">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> หมายเหตุ </label>
                            <div class="col-sm-9">
                            <textarea name="detail" cols="20" rows="2" class="form-control" ></textarea>
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
                                <button class="btn btn-danger" type="submit" onClick="window.history.back();">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                    ยกเลิก
                                </button>
                            </div>
                        </div>
       
       
	   <? }else if($send_product == 1){ ?>
    	<div class="form-group">
        	<label class="col-sm-2 control-label no-padding-right" for="form-field-2"> <font color="#FF0000">ราคาที่ต้องชำระ </font></label>
            	<div class="col-sm-4">
                	<input type="text" class="form-control" style="text-align:right; color:#F00;" value="<?=number_format($net,2);?>" readonly="readonly" /> 
                </div><strong><font color="#FF0000">บาท</font></strong>
       </div>
       
       <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> วันที่ชำระเงิน </label>

                            <div class="col-sm-4">
                                <input class="form-control" type="date" placeholder="วันที่ชำระเงิน" value="<?=date('Y-m-d');?>" name="date_invoice">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> ประเภทการชำระ </label>

                            <div class="col-sm-4">
                                <select class="form-control" id="form-field-select-1" name="type_pay" required>
                                    <option value="slip" selected>โอนผ่านธนาคาร</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group"> 
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"></label>
                        <div class="col-sm-10"> 
                        <h4>ชื่อบัญชี : บริษัท เพลิน คอมพิวเตอร์ จำกัด </h4>   
                        <label><input type ="radio" name="bank" id="rdisend1" value="kbank" required="required"> <img src="img/logo_kbank.png" width="30"> ธนาคารกสิกรไทย 	 หมายเลขบัญชี 001-2-34567-8</label> </div><br>
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"></label>
                        <div class="col-sm-10">
                        <label><input type ="radio" name="bank" id="rdisend1" value="bbl" required="required"> <img src="img/bbl.png" width="30"> ธนาคารกรุงเทพ  หมายเลขบัญชี 987-6-54321-0</label> </div><br>
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"></label>
                        <div class="col-sm-10">
                        <label><input type ="radio" name="bank" id="rdisend1" value="scb" required="required"> <img src="img/SCB.png" width="30"> ธนาคารไทยพาณิชย์	หมายเลขบัญชี 112-3-45678-9</label> </div><br>
                            
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
                                <input type="file" id="input-dim-1" accept="image/*" name="file_invoice" OnChange="showPreview(this)"  required><span class="ace-file-container" data-title="เลือกไฟล์ภาพ"><span class="ace-file-name" data-title="No File ..."></span></span>
                                <img id="imgAvatar" width="300">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> หมายเหตุ </label>
                            <div class="col-sm-9">
                            <textarea name="detail" cols="20" rows="2" class="form-control" ></textarea>
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
                                <button class="btn btn-danger" type="submit" onClick="window.history.back();">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                    ยกเลิก
                                </button>
                            </div>
                        </div>
       
	   <? }else if($send_product == 2){ ?>
    	<div class="form-group">
        	<label class="col-sm-2 control-label no-padding-right" for="form-field-2"> <font color="#FF0000">ราคาที่ต้องชำระ </font></label>
            	<div class="col-sm-4">
                	<input type="text" class="form-control" style="text-align:right; color:#F00;" value="<?=number_format($net/2,2);?>" readonly="readonly" /> 
                </div><strong><font color="#FF0000">บาท</font></strong>
       </div>

       <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> วันที่ชำระเงิน </label>

                            <div class="col-sm-4">
                                <input class="form-control" type="date" placeholder="วันที่ชำระเงิน" value="<?=date('Y-m-d');?>" name="date_invoice">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> ประเภทการชำระ </label>

                            <div class="col-sm-4">
                                <select class="form-control" id="form-field-select-1" name="type_pay" required>
                                    <option value="slip" selected>โอนผ่านธนาคาร</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group"> 
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"></label>
                        <div class="col-sm-10"> 
                        <h4>ชื่อบัญชี : บริษัท เพลิน คอมพิวเตอร์ จำกัด </h4>   
                        <label><input type ="radio" name="bank" id="rdisend1" value="kbank" required="required"> <img src="img/logo_kbank.png" width="30"> ธนาคารกสิกรไทย 	 หมายเลขบัญชี 001-2-34567-8</label> </div><br>
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"></label>
                        <div class="col-sm-10">
                        <label><input type ="radio" name="bank" id="rdisend1" value="bbl" required="required"> <img src="img/bbl.png" width="30"> ธนาคารกรุงเทพ  หมายเลขบัญชี 987-6-54321-0</label> </div><br>
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"></label>
                        <div class="col-sm-10">
                        <label><input type ="radio" name="bank" id="rdisend1" value="scb" required="required"> <img src="img/SCB.png" width="30"> ธนาคารไทยพาณิชย์	หมายเลขบัญชี 112-3-45678-9</label> </div><br>
                            
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
                                <input type="file" id="input-dim-1" accept="image/*" name="file_invoice" OnChange="showPreview(this)"  required><span class="ace-file-container" data-title="เลือกไฟล์ภาพ"><span class="ace-file-name" data-title="No File ..."></span></span>
                                <img id="imgAvatar" width="300">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> หมายเหตุ </label>
                            <div class="col-sm-9">
                            <textarea name="detail" cols="20" rows="2" class="form-control" ></textarea>
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
                                <button class="btn btn-danger" type="submit" onClick="window.history.back();">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                    ยกเลิก
                                </button>
                            </div>
                        </div>
       
       <? } ?>
    <?
		}else if($row_order[status_pay] == 'S'){
	?>
    	<div class="form-group">
        	<label class="col-sm-2 control-label no-padding-right" for="form-field-2"></label>
            	<div class="col-sm-4">
                	<?
						$sql_invoice = "SELECT * FROM tb_invoice WHERE id_order = '$row_order[OrderID]'   ";
						$st_invoice = mysql_query($sql_invoice);
						$row_invoice = mysql_fetch_array($st_invoice);
						//$_SESSION[status] = 'N';
					?>
                    <img src="admin/<?=$row_invoice[file_invoice];?>" style="width:80%;" /><br /><br />
                    ชำระเงินแล้ว รอการตรวจสอบ
                </div>
       </div>
    <?
	
		}
		}
	 ?>