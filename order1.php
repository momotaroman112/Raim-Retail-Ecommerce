<? 
session_start();
include 'connectDb.php';
?>
 <div id="print_table" style="display:none;">

					<div class="page-content">
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="space-6"></div>
                                <?
									$sql_order = "SELECT * FROM tb_orders inner join tb_member on (tb_member.id = tb_orders.id_member)
						  	WHERE tb_orders.id != '' $search GROUP by tb_orders.OrderID  ";
									$st_order = mysql_query($sql_order);
									$row_order = mysql_fetch_assoc($st_order);
														
									$sql_member = "SELECT * FROM tb_member WHERE id = '".$row_order[id_member]."' ";
									$st_member = mysql_query($sql_member);
									$row_member = mysql_fetch_array($st_member);
								?>

								<div class="row">
									<div class="col-sm-10 col-sm-offset-1">
										<div class="widget-box transparent">
											<div class="widget-header widget-header-large">
                                            	
												<h3 class="widget-title grey lighter">
													<!--<a href="#"><i class="ace-icon fa fa-print"></i></a>-->
                                                    <img src="img/logow.jpg" width="150">
                                                        <div align="right">
                                                            <?=date('d/m/Y');?><br>
                                                            เลขที่ใบสั่งซื้อ : <?=$row_order[OrderID];?>
                                                        </div>
												</h3>
												<div align="center"><h3>ใบสั่งซื้อสินค้า</h3></div>
												<div class="widget-toolbar no-border invoice-info">
													<br>
                                                    <span class="invoice-info-label">วันที่ทำการสั่งซื้อ:</span>
													<span class="red"><?=date('d/m', strtotime($row_order[OrderDate]));?>/<?=date('Y', strtotime($row_order[OrderDate]))+543; ?></span>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-24">
													<div class="row">
														<div class="col-sm-8">

															<div>
																<ul class="list-unstyled spaced">
																	<li>
																		ชื่อลูกค้า : <?=$row_member[fname].' '.$row_member[lname];?>
																	</li>

																	<li>
																		
                                                                        <?
																			$sql_1 = "SELECT * FROM provinces WHERE PROVINCE_ID = '".$row_member['provinces']."' ";
																			$result_1 = mysql_query($sql_1);
																			$row_1 = mysql_fetch_array($result_1);
																			$province_name = $row_1['PROVINCE_NAME'];
																		
																			$sql_2 = "SELECT * FROM amphures WHERE AMPHUR_ID =  '".$row_member['amphures']."'  ";
																			$result_2 = mysql_query($sql_2);
																			$row_2 = mysql_fetch_array($result_2);
																			$amphur_name = $row_2['AMPHUR_NAME'];
																		
																			$sql_3 = "SELECT * FROM districts WHERE DISTRICT_CODE =  '".$row_member['districts']."'  ";
																			$result_3 = mysql_query($sql_3);
																			$row_3 = mysql_fetch_array($result_3);
																			$district_name = $row_3['DISTRICT_NAME'];
																			
																			echo 'ที่อยู่ : '.$row_member[address].' ต.'.$district_name.' อ.'.$amphur_name.' จ.'.$province_name.' '.$row_member['zipcode'];
																		?>
																	</li>

																</ul>
															</div>
														</div><!-- /.col -->

														<div class="col-sm-4">
															<div>
																<ul class="list-unstyled  spaced">
																	<li>
																		เบอร์มือถือ : <?=$row_member[mobile];?>
																	</li>
																</ul>
															</div>
														</div><!-- /.col -->
                                                        
                                                        <div class="col-sm-4">
															<div>
																<ul class="list-unstyled  spaced">
																	<li>
																		E-mail : <?=$row_member[email];?>
																	</li>
																</ul>
															</div>
														</div><!-- /.col -->
                                                        
													</div><!-- /.row --><br>

													<div class="space"></div>

													<div>
														<table class="table table-bordered">
															<thead>
																<tr>
																	<td style="text-align:center;">ลำดับ</td>
																	<td style="text-align:center;">รายการสินค้า</td>
                                                                    <td style="text-align:center;">จำนวน</td>
                                                                    <td style="text-align:center;">ราคาต่อหน่วย</td>
																	<td style="text-align:center;">ราคารวม</td>
																</tr>
															</thead>

															<tbody>
                                                            <?
																$num=1;
																$sumtotal = 0;
																$total = 0 ;
																$sql_order_list = "SELECT * FROM tb_orders 
																	inner join tb_member on (tb_member.id = tb_orders.id_member)
						  											WHERE tb_orders.id != '' $search  ";
																$st_order_list = mysql_query($sql_order_list);
																while($row_order_list = mysql_fetch_array($st_order_list)){
																	if($row_order_list[pro_main] == 'SP'){
																		$tb = 'product_detail';
																	}else{
																		$tb = 'product_detail_pc';
																	}
																	$sql_product = "SELECT id,name_product FROM  $tb WHERE id = '".$row_order_list[id_product]."' ";
																	$st_product = mysql_query($sql_product);
																	$row_product = mysql_fetch_array($st_product);
																	
																	$sumtotal = $row_order_list[price];
																	$total = $total+$sumtotal;
																	
																	$Qtytotal = $sumtotal/$row_order_list[Qty];
															?>
																<tr>
																	<td style="text-align:center;"><?=$num ;?></td>
                                                                    <td>
																		<?=$row_product[name_product];?>
                                                                    </td>
                                                                    <td style="text-align:center;"><?=$row_order_list[Qty];?> ชิ้น</td>
                                                                    <td style="text-align:center;"><?=number_format($Qtytotal,2);?></td>

																	<td><div align="right"><?=number_format($sumtotal,2);?></div></td>
																</tr>
                                                             <?
																$num++; }
															 ?>
															</tbody>
														</table>
													</div>

													<div class="hr hr8 hr-double hr-dotted"></div>

																											
                                                        <div class="row">
														<div class="col-sm-6 pull-right">
															<h4 class="pull-right">
																ราคาสุทธิ (รวม VAT) : 
																<span class="red"><?=number_format($total,2);?> บาท<br>
                                                 <?PHP
												 
													class hk_baht{
														public $result;
														public function __construct( $num ){
															$this->result=$this->toBaht( $num , true );
														}
														public function toBaht($number ){
															if( !preg_match( '/^[0-9]+(?:\.[0-9]{2}){0,1}$/' , $number=str_replace(',', '', $number) )){
																return 'This is not currency format';
																
														}
														$num = explode(".", $number);
														$convert = $this->cv( $num[0]) . 'บาท' . ( $st = $this->cv( $num[1]) ) . ($st>''? 'สตางค์' : '');
														return $convert;
														}
														private function cv( $num ){
															$th_num = array('', array('หนึ่ง', 'เอ็ด'), array('สอง', 'ยี่'),'สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ');
														$th_digit = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน');
														$ln=strlen($num);
														$t='';
														for($i=$ln; $i>0;$i--){
															$x=$i-1;
															$n = substr($num, $ln-$i,1);
															$digit=$x % 6;
														if($n!=0){
														if( $n==1 ){ $t .= $digit==1? '' : $th_num[1][$digit==0? 1 : 0]; }
														elseif( $n==2 ){  $t .= $th_num[2][$digit==1? 1 : 0]; }
														else{ $t .= $th_num[$n]; }
														$t .= $th_digit[($digit==0 && $x>0 ? 6 : $digit )];
													}else{
														$t .= $th_digit[ $digit==0 && $x>0 ? 6 : 0 ];
													}
													
														}
													return $t;
														}
														
													}
													## วิธีใช้งาน
													
													$a=number_format($total,2);
													
													$x = new hk_baht( $y );
													echo '(';
													echo  $x->toBaht( $a );
													echo 'ถ้วน';
													echo ')';
													?>
                                                                </span>
															</h4>
														</div>
													</div>

													<div class="space-6"></div>
                                                    
													<div class="well">
														หมายเหตุ : บัญชีธนาคาร บริษัท เพลิน คอมพิวเตอร์ จำกัด<br>
                                                        		<img src="img/kbank.jpg" width="50">
                                                        		ธนาคารกสิกรไทย 	หมายเลขบัญชี 001-2-34567-8<br>
                                                                <img src="img/bangkokbank.jpg" width="50">
                                                                ธนาคารกรุงเทพ หมายเลขบัญชี 987-6-54321-0<br>
                                                                <img src="img/scb.jpg" width="50">
                                                                ธนาคารไทยพาณิชย์ หมายเลขบัญชี 112-3-45678-9
                                                                <br><br>
                                                                 สินค้าจะถูกจัดส่งหลังจากชำระเงิน 3 วัน <br>
                                                                    <div class="row">
														<div class="col-sm-6 pull-right">
															<h5 class="pull-right">
																หากมีข้อสงสัยหรือสอบถามติดต่อเบอร์ : 089-4498900 คุณ เพลิน</h5>
                                                                
                                                                </div>
                                                                </div>
                                                </div>
												</div>
                                                 <div class="hr hr8 hr-double hr-dotted"></div>												
                                                     
											</div>
										</div>
									</div>
								</div>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
                    </div>