<style type="text/css">
    .checkbox-inline+.checkbox-inline, .radio-inline+.radio-inline {
    margin-left: 8px;}
</style>
<lable?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
$language = $this->customlib->getLanguage();
$language_name = $language["short_code"];
?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <section class="content-header">
                <h1>
                    <i class="fa fa-money"></i> <?php echo $this->lang->line('fees_collection'); ?><small><?php echo $this->lang->line('student_fee'); ?></small></h1>
            </section>
            
        </div> 
        <div>
            <a id="sidebarCollapse" class="studentsideopen"><i class="fa fa-navicon"></i></a>
            <aside class="studentsidebar">
                <div class="stutop" id="">
                    <!-- Create the tabs -->
                    <div class="studentsidetopfixed">
                        <p class="classtap"><?php echo $student["class"]; ?> <a href="#" data-toggle="control-sidebar" class="studentsideclose"><i class="fa fa-times"></i></a></p>
                        <ul class="nav nav-justified studenttaps">
                            <?php foreach ($class_section as $skey => $svalue) {
                                ?>
                                <li <?php
                                if ($student["section_id"] == $svalue["section_id"]) {
                                    echo "class='active'";
                                }
                                ?> ><a href="#section<?php echo $svalue["section_id"] ?>" data-toggle="tab"><?php print_r($svalue["section"]); ?></a></li>
                                <?php } ?>
                        </ul>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <?php foreach ($class_section as $skey => $snvalue) {
                            ?>
                            <div class="tab-pane <?php
                            if ($student["section_id"] == $snvalue["section_id"]) {
                                echo "active";
                            }
                            ?>" id="section<?php echo $snvalue["section_id"]; ?>">
                                 <?php
                                 foreach ($studentlistbysection as $stkey => $stvalue) {
                                     if ($stvalue['section_id'] == $snvalue["section_id"]) {
                                         ?>
                                        <div class="studentname">
                                            <a class="" href="<?php echo base_url() . "studentfee/addfee/" . $stvalue["id"] ?>">
                                                <div class="icon"><img src="<?php echo base_url() . $stvalue["image"]; ?>" alt="User Image"></div>
                                                <div class="student-tittle"><?php echo $stvalue["firstname"] . " " . $stvalue["lastname"]; ?></div></a>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        <?php } ?>
                        <div class="tab-pane" id="sectionB">
                            <h3 class="control-sidebar-heading">Recent Activity 2</h3>
                        </div>

                        <div class="tab-pane" id="sectionC">
                            <h3 class="control-sidebar-heading">Recent Activity 3</h3>
                        </div>
                        <div class="tab-pane" id="sectionD">
                            <h3 class="control-sidebar-heading">Recent Activity 3</h3>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                </div>
            </aside>
        </div></div>
    <!-- /.control-sidebar -->
    <section class="content">
           <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3 class="box-title"><?php echo $this->lang->line('student_fees'); ?></h3>
                                </div>
                                <div class="col-md-8">
                                    <div class="btn-group pull-right">
                                        <a href="<?php echo base_url() ?>studentfee" type="button" class="btn btn-primary btn-xs">
                                        <i class="fa fa-arrow-left"></i> <?php echo $this->lang->line('back'); ?></a>
                                    </div>
                                </div>

                            </div>
                        </div><!--./box-header-->
                        <div class="box-body" style="padding-top:0;">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="sfborder">
                                        <div class="col-md-2 text-center">
                                            <img width="115" height="115" class="round5" src="<?php
                                            if (!empty($student['image'])) {
                                                echo base_url() . $student['image'];
                                            } else {
                                                echo base_url() . "uploads/student_images/no_image.png";
                                            }
                                            ?>" alt="No Image">

                                            <h5 style="font-size: 12px;font-weight: bold;">LEDG AMT : Rs. <?=format_amount($student['fees_discount'])?></h5>
                                            <h5 style="font-size: 12px;font-weight: bold;">PREV AMT : Rs. <?=format_amount($student['previous_session_balance'])?></h5>
                                        </div>

                                        <div class="col-md-10">
                                            <div class="row">
                                                <table class="table table-striped mb0 font13">
                                                    <tbody>

                                                        <tr>
                                                            <td onclick="changeDate(this)"> <b>Date : </b> <input type="date" id="dateInput"></td>
                                                            <td>
															<?php if(!empty($existing_deleted_receipt)) { ?>
															<a href="#existingReceiptModal" class="btn btn-default btn-xs"  data-toggle="modal" title="Existing Receipt" data-placement="left"><i class="fa fa-th-list" aria-hidden="true"></i></a>
															<?php } ?>
															Receipt No. <b id="show_receipt"><?=$receipt_no?></b> 
															</td>
                                                            <td>Admission No.  <b><?=$student['admission_no']?></b> </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Student Name</th>
                                                            <th>Father Name</th>
                                                            <th>Mother Name</th>
                                                        </tr>
                                                        <tr>
                                                            <td><?=$student['firstname']?> <?=$student['middlename']?> <?=$student['lastname']?></td>
                                                            <td><?=$student['father_name']?></td>
                                                            <td><?=$student['mother_name']?></td>
                                                        </tr>

                                                        <!-- 2 -->

                                                    
                                                    

                                                        <!-- 3 -->
                                                        <tr>
                                                            <th>Class - <?=$student['class']?> </th>
                                                            <th>Section. - <?=$student['section']?></th>
                                                            <th>Contact No. - <?=$student['mobileno']?></th>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <th>Route - <?php
                                                                        $this->db->where('id', $student['route_id']);
                                                                        $query = $this->db->get('route_head')->row_array();
                                                                        echo (($query['fees_heading']));
                                                                    ?></th>
                                                            <th>Category - <?php
                                                                foreach ($categorylist as $value) {
                                                                    if ($student['category_id'] == $value['id']) {
                                                                        echo $value['name'];
                                                                    }
                                                                }
                                                                ?></th>
                                                            <th>City - <?=$student_data['city']?></th>
                                                        </tr>
                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="sfborder p-5">
                                    

                                        <form action="" method="post">
                                            <div class="col-md-12 p-5" style="padding:1rem !important">
                                                <div class="row ">
												<?php if ($this->rbac->hasPrivilege('student_full_details', 'can_view')) { ?>
                                                    <div class="col-sm-12" style="text-align: -webkit-right;;">
                                                        <a href="<?=base_url('student/view/'.$student['id'])?>">Edit</a>
                                                    </div>
												<?php } ?>
                                                    <div class="col-sm-12">
                                                        <input class="form-check-input month-check" type="checkbox" id="select_all"  >
                                                        <label for="select_all">Select All</label>
                                                    </div>
                                                    <hr>
													<input type="hidden"  value="<?=$receipt_no?>" name="page_receipt_no" class="receipt_no">
                                                    <?php
                                                    // var_dump($pay_mounth);

                                                    $months = [ "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec","Jan", "Feb", "Mar"];
                                                    foreach ($months as $month): ?>
                                                    <div class="col-sm-3 col-md-3 p-0 m-0 month-checkbox">
                                                        

                                                        <?php
                                                            if (in_array($month, $pay_mounth)) {  // Check if month exists in $pay_mounth array
                                                                // If the month exists in $pay_mounth, disable the checkbox and make it unchecked
                                                                ?>
                                                                <input class="form-check-input month-check" type="checkbox" name="months[]" value="<?= $month ?>" id="<?= strtolower($month) ?>" disabled>
                                                                <label for="<?= strtolower($month) ?>"><?= $month ?></label>
                                                                <?php
                                                            } else {
                                                                // If the month does not exist in $pay_mounth, show the checkbox as usual
                                                                if(in_array($month,$months_data)){ ?>
                                                                    <input class="form-check-input month-check input-mounth" checked="" type="checkbox" name="months[]" value="<?= $month ?>" id="<?= strtolower($month) ?>">
                                                                    <label for="<?= strtolower($month) ?>"><?= $month ?></label>
                                                                    <?php }else{
                                                                    ?>
                                                                    <input class="form-check-input month-check input-mounth" type="checkbox" name="months[]" value="<?= $month ?>" id="<?= strtolower($month) ?>">
                                                                    <label for="<?= strtolower($month) ?>"><?= $month ?></label>
                                                                    <?php
                                                                } 
                                                            }
                                                            ?>
                                                        
                                                       
                                                        
                                                    </div>
                                                    <?php endforeach; ?>

                                                    <div class="col-sm-12" style="text-align: -webkit-right;;">
                                                        <button type="submit" class="btn btn-info">Go</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </form>


                                </div>
                                <div class="col-md-12">
                                    <div style="background: #dadada; height: 1px; width: 100%; clear: both; margin-bottom: 10px;"></div>
                                </div>
                            </div>
                        </div>  

                        <form action="<?=base_url('studentfee/saveFee')?>" id="ledger_form" method="post">

                        <input type="hidden" name="date_time" id="outputInput" value="<?=date('Y-m-d')?>" readonly >
                         <div class="card-body" style="padding: 10px;">
                            <div class="row no-print">
                                <div class="col-md-12 mDMb10">
                                    <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?> 
                                    <!-- <a href="#" class="btn btn-sm btn-info printSelected"><i class="fa fa-print"></i> <?php echo $this->lang->line('print_selected'); ?> </a>

                                    <button type="button" class="btn btn-sm btn-warning collectSelected" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo $this->lang->line('please_wait')?>"><i class="fa fa-money"></i> <?php echo $this->lang->line('collect') . " " . $this->lang->line('selected') ?></button>

                                    <span class="pull-right"><?php echo $this->lang->line('date'); ?>: <?php echo date($this->customlib->getSchoolDateFormat()); ?></span> -->

                                    <!-- <input class="form-check-input month-check" type="checkbox" name="months[]" > -->
                                    
                                </div>
                            </div>
                            
                            
                            <input type="hidden"  value="<?=$back_id?>" name="back_id">
                            <input type="hidden"  value="<?=$addfee?>" name="addfee">
                            <input type="hidden"  value="<?=$receipt_no?>" name="receipt_no" class="receipt_no">
                            <input type="hidden"  value="<?=$student['id']?>" name="student_id">
                            <input type="hidden"  value="<?=$student['previous_student_session_id']?>" name="previous_student_session_id">
                            <div class="table-responsive">
                                <div class="download_label "><?php echo $this->lang->line('student_fees') . ": " . $student['firstname'] . " " . $student['lastname'] ?> </div>
                                <table class="table table-bordered">
                                    <thead class="header">
                                        
                                        <tr>
                                            <th>
                                                <!-- <input type="checkbox" checked id="select_all_data"/><br> -->
                                            </th>
                                            <th>Fees Head</th>
                                            <?php foreach($months_data as $key=>$value){
                                            ?>
                                            <th><?=$value?> <input type="hidden" name="months[]" value="<?=$value?>" > </th>
                                            <?php
                                            } 
                                            ?>
                                            <th>Total</th>
											<?php if ($this->rbac->hasPrivilege('assign_discount', 'can_add')) { ?>
                                            <th>Discount</th>
											<?php } ?>
                                            <th>Received</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $statusNew=0;
                                            $final_total = 0;
                                            $fees_total = 0;
                                            $aa=1;
										
										$total = $pre_bal_total = format_amount($student['previous_session_balance']);
										if($total > 0){
										$final_total += $total;
										?>
										<tr>
											<th><input type="checkbox" class="row_selector" onchange="DeleteRowData(this,<?=$aa?>)" checked />
											</th>
											<th>PREV AMT</th>
											<?php foreach($months_data as $key=>$value){
											?>
											<th></th>
											<?php
											} 
											?>
											<th><?=$total?> <input type="hidden" name="total[]" value="<?=$total?>"></th>
											<?php if ($this->rbac->hasPrivilege('assign_discount', 'can_add')) { ?>
											<th><input type="text" style="width: 100px;" class="rec_discount" name="prev_rec_discount" id="total_get_discount_<?=$aa?>" value=""></th>
											<?php } ?>
											<th><input type="text" style="width: 100px;" class="rec_amount" name="prev_rec_amount" id="total_rec_discount_<?=$aa?>" value="<?=$total?>"></th>
											<th><input type="text" class="row_balance" name="prev_row_balance" value="0" readonly style="width:100px;"></th>
										</tr>
										<?php
										$aa++;
										}
										$statusNew++;
										$total = $ledg_total = format_amount($student['fees_discount']);
										if($total > 0){
										$final_total += $total;
										?>
										<tr>
											<th><input type="checkbox" class="row_selector" onchange="DeleteRowData(this,<?=$aa?>)" checked />
											</th>
											<th>LEDG AMT</th>
											<?php foreach($months_data as $key=>$value){
											?>
											<th></th>
											<?php
											} 
											?>
											<th><?=$total?> <input type="hidden" name="total[]" value="<?=$total?>"></th>
											<?php if ($this->rbac->hasPrivilege('assign_discount', 'can_add')) { ?>
											<th><input type="text" style="width: 100px;" class="rec_discount" name="ledg_rec_discount" id="total_get_discount_<?=$aa?>" value=""></th>
											<?php } ?>
											<th><input type="text" style="width: 100px;" class="rec_amount" name="ledg_rec_amount" id="total_rec_discount_<?=$aa?>" value="<?=$total?>"></th>
											<th><input type="text" class="row_balance" name="ledg_row_balance" value="0" readonly style="width:100px;"></th>
										</tr>
										<?php
										}										
                                            foreach($data_list as $row){
                                                $db_months = json_decode($row->months);
                                                $total = 0;
                                                $statusNew++;
                                                $aa++;
                                        ?>
                                            <tr>
                                                <th>
                                                    <input type="checkbox" checked onchange="DeleteRowData(this,<?=$aa?>)" disabled />
                                                    <input type="hidden"  name="pay[]" value="paid" id="payvalue_<?=$aa?>">
                                                    <input type="hidden"  name="fee_head[]" value="<?=$row->id?>" >
                                                    <input type="hidden"  name="fee_head_type[]" value="fees" >
                                                    <input type="hidden"  name="fee_head_name[]" value="<?= $row->fees_heading ?>" >
                                                </th>
                                                <th><?= $row->fees_heading ?></th>
                                                <?php foreach($months_data as $key => $value): ?>
                                                    <th>
                                                        <?php 
                                                            if(in_array($value, $db_months)){
																if (is_array($row->amount)) 
																{
																	$amount = isset($row->amount[$value]) ? (float)$row->amount[$value] : 0;
																	echo format_amount($amount);
																	$total += $amount;
																	?>
																	<input type="hidden" name="month_total[<?=$value?>][]" value="<?=$row->amount[$value]?>">
																<?php
																}
																else{
																	echo format_amount($row->amount);
																	$total += $row->amount;
																	?>
																	<input type="hidden" name="month_total[<?=$value?>][]" value="<?=$row->amount?>">
																<?php
																}
                                                            } else {
                                                                echo 0;
                                                                ?><input type="hidden" name="month_total[<?=$value?>][]" value="0"><?php
                                                            }
                                                        ?>   
                                                    </th>
                                                <?php endforeach; ?>

                                                <th><?= $total ?> <input type="hidden" name="total[]" value="<?=$total?>"> </th>
												<?php if ($this->rbac->hasPrivilege('assign_discount', 'can_add')) { ?>
                                                <th><input type="text" style="width: 100px;" class="rec_discount" name="rec_discount[]" id="total_get_discount_<?=$aa?>" value=""></th>
												<?php } ?>
                                                <th><input type="text" style="width: 100px;" class="rec_amount" name="rec_amount[]" id="total_rec_discount_<?=$aa?>" value="<?= $total ?>"></th>
                                                <th><input type="text" class="row_balance" name="row_balance[]" value="0" readonly style="width:100px;"></th>
                                            </tr>
                                            <?php
                                                $fees_total += $total;
                                                $final_total += $total;
                                            }

                                            // $aa++;
                                            foreach($route_data_list as $row){

                                                $db_months = json_decode($row->months);
                                                $total = 0;
                                                $statusNew++;
                                                $aa++;
                                            ?>
                                            <tr>
                                                <th><input type="checkbox"  onchange="DeleteRowData(this,<?=$aa?>)" checked disabled />
                                                    <input type="hidden"  name="pay[]" value="paid" id="payvalue_<?=$aa?>">
                                                     <input type="hidden"  name="fee_head[]" value="<?=$row->id?>" >
                                                     <input type="hidden"  name="fee_head_type[]" value="route" >
                                                     <input type="hidden"  name="fee_head_name[]" value="<?= $row->fees_heading ?>" >
                                                </th>
                                                <th><?= $row->fees_heading ?></th>
                                                <?php foreach($months_data as $key => $value): ?>
                                                    <th>
                                                        <?php 
                                                            if(in_array($value, $db_months)){
																
																if (is_array($row->amount)) {
																	echo format_amount($row->amount[$value]);
                                                                $total += $row->amount[$value];
                                                                ?><input type="hidden" name="month_total[<?=$value?>][]" value="<?=$row->amount[$value] ?>">
																<?php
																}
																else
																{
                                                                echo format_amount($row->amount);
                                                                $total += $row->amount;
                                                                ?><input type="hidden" name="month_total[<?=$value?>][]" value="<?=$row->amount?>"><?php
																}
                                                            } else {
                                                                echo 0;
                                                                ?>
                                                                <input type="hidden" name="month_total[<?=$value?>][]" value="0">
                                                                <?php
                                                            }
                                                        ?>   
                                                        
                                                    </th>
                                                <?php endforeach; ?>
                                                <th><?= $total ?> <input type="hidden" name="total[]" value="<?=$total?>"> </th>
                                                <th><input type="text" style="width:100px;" class="rec_discount" name="rec_discount[]"  id="total_get_discount_<?=$aa?>" value=""></th>
                                                <th><input type="text" style="width:100px;" class="rec_amount" name="rec_amount[]" id="total_rec_discount_<?=$aa?>" value="<?= $total ?>"></th>
                                                <th><input type="text" class="row_balance" name="row_balance[]" value="0" readonly style="width:100px;"></th>
                                            </tr>
                                            <?php
                                                $fees_total += $total;
                                                $final_total += $total;
                                            }
											?>
											<input type="hidden" name="hid_fees_received" value="<?php echo $fees_total;?>">
                                        </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="card-footer"  style="padding: 10px;">
                            <div class="container" style="overflow-x: auto; max-width: 100%;">
                                <div class="row">
                                                     
									<?php
                                    if($pre_bal_total > 0){
									?>
									<div class="col-sm-2">
                                        <label for="pre_bal_total">Prev. Received</label>
                                        <input style="width: 100%;" type="text" id="pre_bal_total" class="form-control" value="<?=format_amount($pre_bal_total)?>" readonly />
                                    </div>
									<?php } ?>
									<?php
                                    if($ledg_total > 0){
									?>
									<div class="col-sm-2">
                                        <label for="ledg_total">Ledg. Received</label>
                                        <input style="width: 100%;" type="text" id="ledg_total" class="form-control" value="<?=format_amount($ledg_total)?>" readonly />
                                    </div>
									<?php } ?>
													 
                                    <div class="col-sm-2">
                                        <label for="fees_received">Estimated Total</label>
                                        <input style="width: 100%;" type="text" id="fees_received" class="form-control" value="<?=$final_total?>" name="fees_received" readonly />
                                    </div>
                                    
                                    
                                    <div class="col-sm-2">
                                        <label for="late_fees">Late/Other Fee</label>
                                        <input style="width: 100%;" type="text" id="late_fees" class="form-control" name="late_fees" />
                                    </div>
                                  
                                        
                                         
                                        <input style="width: 100%;" type="hidden" id="old_ledger_amt"  name="old_ledger_amt" readonly value="<?=$student['fees_discount']?>"  />
                                        <input style="width: 100%;" type="hidden" id="old_prev_amt"  name="old_prev_amt" readonly value="<?=$student['previous_session_balance']?>"  />
                                        
                                        
                                    
                                    <div class="col-sm-2">
                                        
                                        <label for="discount_amt">Discount Amt</label>
                                        <input style="width: 100%;" type="text" id="discount_amt" class="form-control" name="discount_amt" value="" readonly  />
                                    </div>
                               
                                    
                                    
                                    <div class="col-sm-2">
                                        <label for="net_fees">Net Fees</label>
                                        <input style="width: 100%;" type="text" id="net_fees" class="form-control" name="net_fees" value="<?=$final_total?>" readonly />
                                    </div>
                                </div>
                                <div class="row " style="display:flex; margin-top: 10px !important;">

									<div class="col-sm-2">
										<label for="receipt_amt">Receipt Amt</label>
										<input style="width: 100%;" type="text" id="receipt_amt" class="form-control" name="receipt_amt" value="<?=$final_total?>"/>
										<label id="error_message_rcpt" style="color: red; display:block;font-size:10px !important">Amount must be between 0 and <?=$final_total ?>.</label>
										<input type="hidden" value="<?=$final_total?>" name="hid_receipt_amt" id="hid_receipt_amt">
									</div>
                                    
                                    <div class="col-sm-2">
                                        <label for="balance_amt">Balance Amt</label>
                                        <input style="width: 100%;" type="text" id="balance_amt" class="form-control" name="balance_amt" readonly value="0" />
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="mode">Mode</label>
                                        <select autofocus=""  name="mode" id="mode" name="class_id" class="form-control" >
                                            <option value="Online">Online</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="remarks">Remarks</label>
                                        <input style="width: 100%;" type="text" id="remarks" class="form-control" name="remarks" />
                                    </div>
                                    <div class="col-sm-1">
                                        <span><br></span>
                                        <button type="submit" style="margin-top:5px" id="submit_btn" style="width: 100%;">Save</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                               </form>
                    </div> 


                </div>
                <!--/.col (left) -->

            </div>

    </section>

</div>

<div id="existingReceiptModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Existing Receipt</h4>
            </div>
            <div class="modal-body">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="exampleInputEmail1">Receipt</label><small class="req"> *</small>
							<select id="existing_receipt_no" class="form-control">
								<option value="">Select</option>
								<?php 
								foreach($existing_deleted_receipt as $existing_deleted_receipt_val){ 
								?>
								<option value="<?php echo $existing_deleted_receipt_val; ?>"><?php echo $existing_deleted_receipt_val; ?></option>
								<?php } ?>
							</select>
							<span class="text-danger" id="err_existing_receipt_no"></span>
						</div>
					</div>
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
				<button type="button" class="btn cfees apply_existing_reseipt" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> <?php echo $this->lang->line('apply'); ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myFeesModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title title text-center fees_title"></h4>
            </div>
            <div class="modal-body pb0">
                <div class="form-horizontal balanceformpopup">
                    <div class="box-body">

                        <input  type="hidden" class="form-control" id="std_id" value="<?php echo $student["student_session_id"]; ?>" readonly="readonly"/>
                        <input  type="hidden" class="form-control" id="parent_app_key" value="<?php echo $student['parent_app_key'] ?>" readonly="readonly"/>
                        <input  type="hidden" class="form-control" id="guardian_phone" value="<?php echo $student['guardian_phone'] ?>" readonly="readonly"/>
                        <input  type="hidden" class="form-control" id="guardian_email" value="<?php echo $student['guardian_email'] ?>" readonly="readonly"/>
                        <input  type="hidden" class="form-control" id="student_fees_master_id" value="0" readonly="readonly"/>
                        <input  type="hidden" class="form-control" id="fee_groups_feetype_id" value="0" readonly="readonly"/>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label"><?php echo $this->lang->line('date'); ?></label>
                            <div class="col-sm-9">
                                <input  id="date" name="admission_date" placeholder="" type="text" class="form-control date_fee"  value="<?php echo date($this->customlib->getSchoolDateFormat()); ?>" readonly="readonly"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('amount'); ?><small class="req"> *</small></label>
                            <div class="col-sm-9">

                                <input type="text" autofocus="" class="form-control modal_amount" id="amount" value="0"  >

                                <span class="text-danger" id="amount_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"> <?php echo $this->lang->line('discount'); ?> <?php echo $this->lang->line('group'); ?></label>
                            <div class="col-sm-9">
                                <select class="form-control modal_discount_group" id="discount_group">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                </select>

                                <span class="text-danger" id="amount_error"></span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('discount'); ?><small class="req"> *</small></label>
                            <div class="col-sm-9">
                                <div class="row">  
                                    <div class="col-md-5 col-sm-5">
                                        <div class="">
                                            <input type="text" class="form-control" id="amount_discount"  value="0">

                                            <span class="text-danger" id="amount_discount_error"></span></div>
                                    </div>
                                    <div class="col-md-2 col-sm-2 ltextright">

                                        <label for="inputPassword3" class="control-label"><?php echo $this->lang->line('fine'); ?><small class="req">*</small></label>
                                    </div>
                                    <div class="col-md-5 col-sm-5">
                                        <div class="">
                                            <input type="text" class="form-control" id="amount_fine" value="0">

                                            <span class="text-danger" id="amount_fine_error"></span>
                                        </div>
                                    </div>
                                </div>  
                            </div><!--./col-sm-9-->
                        </div>




                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('mode'); ?></label>
                            <div class="col-sm-9">
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="Cash" checked="checked"><?php echo $this->lang->line('cash'); ?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="Cheque"><?php echo $this->lang->line('cheque'); ?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="DD"><?php echo $this->lang->line('dd'); ?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="bank_transfer"><?php echo $this->lang->line('bank_transfer'); ?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="upi"><?php echo $this->lang->line('upi'); ?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="payment_mode_fee" value="card"><?php echo $this->lang->line('card'); ?>
                                </label>
                                <span class="text-danger" id="payment_mode_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('note'); ?></label>

                            <div class="col-sm-9">
                                <textarea class="form-control" rows="3" id="description" placeholder=""></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                <button type="button" class="btn cfees save_button" id="load" data-action="collect" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> <?php echo $currency_symbol; ?> <?php echo $this->lang->line('collect_fees'); ?> </button>
                <button type="button" class="btn cfees save_button" id="load" data-action="print" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> <?php echo $currency_symbol; ?> <?php echo $this->lang->line('collect') . " & " . $this->lang->line('print') ?></button>

            </div>
        </div> 

    </div>
</div>



<div class="modal fade" id="myDisApplyModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title title text-center discount_title"></h4>
            </div>
            <div class="modal-body pb0">
                <div class="form-horizontal">
                    <div class="box-body">
                        <input  type="hidden" class="form-control" id="student_fees_discount_id"  value=""/>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('payment_id'); ?> <small class="req">*</small></label>
                            <div class="col-sm-9">

                                <input type="text" class="form-control" id="discount_payment_id" >

                                <span class="text-danger" id="discount_payment_id_error"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label"><?php echo $this->lang->line('description'); ?></label>

                            <div class="col-sm-9">
                                <textarea class="form-control" rows="3" id="dis_description" placeholder=""></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                <button type="button" class="btn cfees dis_apply_button" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> <?php echo $this->lang->line('apply_discount'); ?></button>
            </div>
        </div>

    </div>
</div>


<div class="delmodal modal fade" id="confirm-discountdelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('confirmation'); ?></h4>
            </div>

            <div class="modal-body">

                <p><?php echo $this->lang->line('are_you_sure_want_to_revert'); ?> <b class="discount_title"></b> <?php echo $this->lang->line('discount_this_action_is_irreversible');?></p>
                <p><?php echo $this->lang->line('do_you_want_to_proceed')?></p>
                <p class="debug-url"></p>
                <input type="hidden" name="discount_id"  id="discount_id" value="">

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                <a class="btn btn-danger btn-discountdel"><?php echo $this->lang->line('revert'); ?></a>
            </div>
        </div>
    </div>
</div>


<div class="delmodal modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('confirmation'); ?></h4>
            </div>

            <div class="modal-body">

                <p><?php echo $this->lang->line('are_you_sure_want_to_delete'); ?> <b class="invoice_no"></b> <?php echo $this->lang->line('invoice_this_action_is_irreversible')?></p>
                 <p><?php echo $this->lang->line('do_you_want_to_proceed')?></p>
                <p class="debug-url"></p>
                <input type="hidden" name="main_invoice"  id="main_invoice" value="">
                <input type="hidden" name="sub_invoice" id="sub_invoice"  value="">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                <a class="btn btn-danger btn-ok"><?php echo $this->lang->line('revert'); ?></a>
            </div>
        </div>
    </div>
</div>


<div class="norecord modal fade" id="confirm-norecord" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">


                <p><?php echo $this->lang->line('no_record_found'); ?></p>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>

            </div>
        </div>
    </div>
</div>



<div id="listCollectionModal" class="modal fade">
    <div class="modal-dialog">
        <form action="<?php echo site_url('studentfee/addfeegrp'); ?>" method="POST" id="collect_fee_group">
            <div class="modal-content">
                <!-- //================ -->
                <input  type="hidden" class="form-control" id="group_std_id" name="student_session_id" value="<?php echo $student["student_session_id"]; ?>" readonly="readonly"/>
                <input  type="hidden" class="form-control" id="group_parent_app_key" name="parent_app_key" value="<?php echo $student['parent_app_key'] ?>" readonly="readonly"/>
                <input  type="hidden" class="form-control" id="group_guardian_phone" name="guardian_phone" value="<?php echo $student['guardian_phone'] ?>" readonly="readonly"/>
                <input  type="hidden" class="form-control" id="group_guardian_email" name="guardian_email" value="<?php echo $student['guardian_email'] ?>" readonly="readonly"/>
                <!-- //================ -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php echo $this->lang->line('collect') . " " . $this->lang->line('fees'); ?></h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary payment_collect" data-loading-text="<i class='fa fa-spinner fa-spin '></i><?php echo $this->lang->line('processing')?>"><i class="fa fa-money"></i> <?php echo $this->lang->line('pay'); ?></button>
                </div>
            </div>
        </form>
    </div>
</div>



<script>
function changeDate(td) {
    const dateSpan = td.querySelector('#admissionDate');

    // Create a date input
    const input = document.createElement('input');
    input.type = 'date';
    input.style.width = '150px';

    // Convert DD::MM::YYYY --> YYYY-MM-DD
    input.value = formatToInputDate(dateSpan.innerText);

    // Replace span with input
    td.innerHTML = 'Date ';
    td.appendChild(input);

    // When input loses focus, convert back
    input.addEventListener('blur', function() {
        const selectedDate = formatToDisplayDate(input.value);
        td.innerHTML = ' <b> Date : </b> <span id="admissionDate">' + selectedDate + '</span>';
    });
}

// Convert "26::04::2025" -> "2025-04-26" (for input type="date")
function formatToInputDate(dateStr) {
    const parts = dateStr.split('-');
    if (parts.length === 3) {
        return `${parts[2]}-${parts[1]}-${parts[0]}`;
    }
    return ''; // fallback if bad format
}

// Convert "2025-04-26" -> "26::04::2025" (for showing again)
function formatToDisplayDate(inputDateStr) {
    const parts = inputDateStr.split('-');
    if (parts.length === 3) {
        return `${parts[2]}-${parts[1]}-${parts[0]}`;
    }
    return '';
}
</script>




<script type="text/javascript">
    $(document).ready(function () {
            $(document).on('click', '.printDoc', function () {
            var main_invoice = $(this).data('main_invoice');
            var sub_invoice = $(this).data('sub_invoice');
            var student_session_id = '<?php echo $student['student_session_id'] ?>';
            $.ajax({
                url: '<?php echo site_url("studentfee/printFeesByName") ?>',
                type: 'post',
                data: {'student_session_id': student_session_id, 'main_invoice': main_invoice, 'sub_invoice': sub_invoice},
                success: function (response) {
                    Popup(response);
                }
            });
        });
        $(document).on('click', '.printInv', function () {
            var fee_master_id = $(this).data('fee_master_id');
            var fee_session_group_id = $(this).data('fee_session_group_id');
            var fee_groups_feetype_id = $(this).data('fee_groups_feetype_id');
            $.ajax({
                url: '<?php echo site_url("studentfee/printFeesByGroup") ?>',
                type: 'post',
                data: {'fee_groups_feetype_id': fee_groups_feetype_id, 'fee_master_id': fee_master_id, 'fee_session_group_id': fee_session_group_id},
                success: function (response) {
                    Popup(response);
                }
            });
        });
    });
</script>


<script type="text/javascript">
    $(document).on('click', '.save_button', function (e) {
        var $this = $(this);
        var action = $this.data('action');
        $this.button('loading');
        var form = $(this).attr('frm');
        var feetype = $('#feetype_').val();
        var date = $('#date').val();
        var student_session_id = $('#std_id').val();
        var amount = $('#amount').val();
        var amount_discount = $('#amount_discount').val();
        var amount_fine = $('#amount_fine').val();
        var description = $('#description').val();
        var parent_app_key = $('#parent_app_key').val();
        var guardian_phone = $('#guardian_phone').val();
        var guardian_email = $('#guardian_email').val();
        var student_fees_master_id = $('#student_fees_master_id').val();
        var fee_groups_feetype_id = $('#fee_groups_feetype_id').val();
        var payment_mode = $('input[name="payment_mode_fee"]:checked').val();
        var student_fees_discount_id = $('#discount_group').val();
        $.ajax({
            url: '<?php echo site_url("studentfee/addstudentfee") ?>',
            type: 'post',
            data: {action: action, student_session_id: student_session_id, date: date, type: feetype, amount: amount, amount_discount: amount_discount, amount_fine: amount_fine, description: description, student_fees_master_id: student_fees_master_id, fee_groups_feetype_id: fee_groups_feetype_id, payment_mode: payment_mode, guardian_phone: guardian_phone, guardian_email: guardian_email, student_fees_discount_id: student_fees_discount_id, parent_app_key: parent_app_key},
            dataType: 'json',
            success: function (response) {
                $this.button('reset');
                if (response.status === "success") {
                    if (action === "collect") {
                        location.reload(true);
                    } else if (action === "print") {
                        Popup(response.print, true);
                    }
                } else if (response.status === "fail") {
                    $.each(response.error, function (index, value) {
                        var errorDiv = '#' + index + '_error';
                        $(errorDiv).empty().append(value);
                    });
                }
            }
        });
    });
</script>


<script>
    var base_url = '<?php echo base_url() ?>';

    function Popup(data, winload = false)
    {
        var frame1 = $('<iframe />').attr("id", "printDiv");
        frame1[0].name = "frame1";
        frame1.css({"position": "absolute", "top": "-1000000px"});
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title></title>');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
        frameDoc.document.write('</head>');
        frameDoc.document.write('<body>');
        frameDoc.document.write(data);
        frameDoc.document.write('</body>');
        frameDoc.document.write('</html>');
        frameDoc.document.close();
        setTimeout(function () {
        document.getElementById('printDiv').contentWindow.focus();
        document.getElementById('printDiv').contentWindow.print();
            // frame1.remove();
            if (winload) {
                window.location.reload(true);
            }
        }, 500);


        return true;
    }
    $(document).ready(function () {
        $('.delmodal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        });
        $('#listCollectionModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        });

        $('#confirm-delete').on('show.bs.modal', function (e) {
            $('.invoice_no', this).text("");
            $('#main_invoice', this).val("");
            $('#sub_invoice', this).val("");

            $('.invoice_no', this).text($(e.relatedTarget).data('invoiceno'));
            $('#main_invoice', this).val($(e.relatedTarget).data('main_invoice'));
            $('#sub_invoice', this).val($(e.relatedTarget).data('sub_invoice'));


        });

        $('#confirm-discountdelete').on('show.bs.modal', function (e) {
            $('.discount_title', this).text("");
            $('#discount_id', this).val("");
            $('.discount_title', this).text($(e.relatedTarget).data('discounttitle'));
            $('#discount_id', this).val($(e.relatedTarget).data('discountid'));
        });

        $('#confirm-delete').on('click', '.btn-ok', function (e) {
            var $modalDiv = $(e.delegateTarget);
            var main_invoice = $('#main_invoice').val();
            var sub_invoice = $('#sub_invoice').val();

            $modalDiv.addClass('modalloading');
            $.ajax({
                type: "post",
                url: '<?php echo site_url("studentfee/deleteFee") ?>',
                dataType: 'JSON',
                data: {'main_invoice': main_invoice, 'sub_invoice': sub_invoice},
                success: function (data) {
                    $modalDiv.modal('hide').removeClass('modalloading');
                    location.reload(true);
                }
            });


        });

        $('#confirm-discountdelete').on('click', '.btn-discountdel', function (e) {
            var $modalDiv = $(e.delegateTarget);
            var discount_id = $('#discount_id').val();


            $modalDiv.addClass('modalloading');
            $.ajax({
                type: "post",
                url: '<?php echo site_url("studentfee/deleteStudentDiscount") ?>',
                dataType: 'JSON',
                data: {'discount_id': discount_id},
                success: function (data) {
                    $modalDiv.modal('hide').removeClass('modalloading');
                    location.reload(true);
                }
            });


        });


        $(document).on('click', '.btn-ok', function (e) {
            var $modalDiv = $(e.delegateTarget);
            var main_invoice = $('#main_invoice').val();
            var sub_invoice = $('#sub_invoice').val();

            $modalDiv.addClass('modalloading');
            $.ajax({
                type: "post",
                url: '<?php echo site_url("studentfee/deleteFee") ?>',
                dataType: 'JSON',
                data: {'main_invoice': main_invoice, 'sub_invoice': sub_invoice},
                success: function (data) {
                    $modalDiv.modal('hide').removeClass('modalloading');
                    location.reload(true);
                }
            });


        });
        $('.detail_popover').popover({
            placement: 'right',
            title: '',
            trigger: 'hover',
            container: 'body', 
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
    var fee_amount = 0;
</script>
<script type="text/javascript">
    $("#myFeesModal").on('shown.bs.modal', function (e) {
        e.stopPropagation();
        var discount_group_dropdown = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        var data = $(e.relatedTarget).data();
        var modal = $(this);
        var type = data.type;
        var amount = data.amount;
        var group = data.group;
        var fee_groups_feetype_id = data.fee_groups_feetype_id;
        var student_fees_master_id = data.student_fees_master_id;
        var student_session_id = data.student_session_id;

        $('.fees_title').html("");
        $('.fees_title').html("<b>" + group + ":</b> " + type);
        $('#fee_groups_feetype_id').val(fee_groups_feetype_id);
        $('#student_fees_master_id').val(student_fees_master_id);



        $.ajax({ 
            type: "post",
            url: '<?php echo site_url("studentfee/geBalanceFee") ?>',
            dataType: 'JSON',
            data: {'fee_groups_feetype_id': fee_groups_feetype_id,
                'student_fees_master_id': student_fees_master_id,
                'student_session_id': student_session_id
            },
            beforeSend: function () {
                $('#discount_group').html("");
                $("span[id$='_error']").html("");
                $('#amount').val("");
                $('#amount_discount').val("0");
                $('#amount_fine').val("0");
                modal.addClass('modal_loading');
            },
            success: function (data) {

                if (data.status === "success") {
                    fee_amount = data.balance;

                    $('#amount').val(data.balance);
                    $('#amount_fine').val(data.remain_amount_fine);


                    $.each(data.discount_not_applied, function (i, obj)
                    {
                        discount_group_dropdown += "<option value=" + obj.student_fees_discount_id + " data-disamount=" + obj.amount + ">" + obj.code + "</option>";
                    });
                    $('#discount_group').append(discount_group_dropdown);




                }
            },
            error: function (xhr) { // if error occured
                alert("Error occured.please try again");

            },
            complete: function () {
                modal.removeClass('modal_loading');
            }
        });


    });

</script>

<script type="text/javascript">
    $(document).ready(function () {
        $.extend($.fn.dataTable.defaults, {
            searching: false,
            ordering: false,
            paging: false,
            bSort: false,
            info: false
        });
    });
    $(document).ready(function () {
        $('.table-fixed-header').fixedHeader();
    });

//  $(window).on('resize', function () {
//    $('.header-copy').width($('.table-fixed-header').width())
//});

    (function ($) {

        $.fn.fixedHeader = function (options) {
            var config = {
                topOffset: 50
                        //bgColor: 'white'
            };
            if (options) {
                $.extend(config, options);
            }

            return this.each(function () {
                var o = $(this);

                var $win = $(window);
                var $head = $('thead.header', o);
                var isFixed = 0;
                var headTop = $head.length && $head.offset().top - config.topOffset;

                function processScroll() {
                    if (!o.is(':visible')) {
                        return;
                    }
                    if ($('thead.header-copy').size()) {
                        $('thead.header-copy').width($('thead.header').width());
                    }
                    var i;
                    var scrollTop = $win.scrollTop();
                    var t = $head.length && $head.offset().top - config.topOffset;
                    if (!isFixed && headTop !== t) {
                        headTop = t;
                    }
                    if (scrollTop >= headTop && !isFixed) {
                        isFixed = 1;
                    } else if (scrollTop <= headTop && isFixed) {
                        isFixed = 0;
                    }
                    isFixed ? $('thead.header-copy', o).offset({
                        left: $head.offset().left
                    }).removeClass('hide') : $('thead.header-copy', o).addClass('hide');
                }
                $win.on('scroll', processScroll);

                // hack sad times - holdover until rewrite for 2.1
                $head.on('click', function () {
                    if (!isFixed) {
                        setTimeout(function () {
                            $win.scrollTop($win.scrollTop() - 47);
                        }, 10);
                    }
                });

                $head.clone().removeClass('header').addClass('header-copy header-fixed').appendTo(o);
                var header_width = $head.width();
                o.find('thead.header-copy').width(header_width);
                o.find('thead.header > tr:first > th').each(function (i, h) {
                    var w = $(h).width();
                    o.find('thead.header-copy> tr > th:eq(' + i + ')').width(w);
                });
                $head.css({
                    margin: '0 auto',
                    width: o.width(),
                    'background-color': config.bgColor
                });
                processScroll();
            });
        };

    })(jQuery);


    $(".applydiscount").click(function () {
        $("span[id$='_error']").html("");
        $('.discount_title').html("");
        $('#student_fees_discount_id').val("");
        var student_fees_discount_id = $(this).data("student_fees_discount_id");
        var modal_title = $(this).data("modal_title");


        $('.discount_title').html("<b>" + modal_title + "</b>");

        $('#student_fees_discount_id').val(student_fees_discount_id);
        $('#myDisApplyModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    });




    $(document).on('click', '.apply_existing_reseipt', function (e) {
        var $this = $(this);
        $this.button('loading');
		
		var existing_receipt_no = $('#existing_receipt_no').val();
		if(existing_receipt_no == ''){
			$('#err_existing_receipt_no').text('Please select a receipt');
		}else{
			$('#err_existing_receipt_no').text('');
			$('#show_receipt').text(existing_receipt_no);
			$('.receipt_no').val(existing_receipt_no);
			$('#existingReceiptModal').modal('hide');
		}
		$this.button('reset');
	});
    $(document).on('click', '.dis_apply_button', function (e) {
        var $this = $(this);
        $this.button('loading');

        var discount_payment_id = $('#discount_payment_id').val();
        var student_fees_discount_id = $('#student_fees_discount_id').val();
        var dis_description = $('#dis_description').val();

        $.ajax({
            url: '<?php echo site_url("admin/feediscount/applydiscount") ?>',
            type: 'post',
            data: {
                discount_payment_id: discount_payment_id,
                student_fees_discount_id: student_fees_discount_id,
                dis_description: dis_description
            },
            dataType: 'json',
            success: function (response) {
                $this.button('reset');
                if (response.status === "success") {
                    location.reload(true);
                } else if (response.status === "fail") {
                    $.each(response.error, function (index, value) {
                        var errorDiv = '#' + index + '_error';
                        $(errorDiv).empty().append(value);
                    });
                }
            }
        });
    });

</script>

<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.printSelected', function () {
            var array_to_print = [];
            $.each($("input[name='fee_checkbox']:checked"), function () {
                var fee_session_group_id = $(this).data('fee_session_group_id');
                var fee_master_id = $(this).data('fee_master_id');
                var fee_groups_feetype_id = $(this).data('fee_groups_feetype_id');
                item = {};
                item ["fee_session_group_id"] = fee_session_group_id;
                item ["fee_master_id"] = fee_master_id;
                item ["fee_groups_feetype_id"] = fee_groups_feetype_id;

                array_to_print.push(item);
            });
            if (array_to_print.length === 0) {
                alert("<?php echo $this->lang->line('no_record_selected'); ?>");
            } else {
                $.ajax({
                    url: '<?php echo site_url("studentfee/printFeesByGroupArray") ?>',
                    type: 'post',
                    data: {'data': JSON.stringify(array_to_print)},
                    success: function (response) {
                        Popup(response);
                    }
                });
            }
        });


        $(document).on('click', '.collectSelected', function () {
            var $this = $(this);
            var array_to_collect_fees = [];
            $.each($("input[name='fee_checkbox']:checked"), function () {
                var fee_session_group_id = $(this).data('fee_session_group_id');
                var fee_master_id = $(this).data('fee_master_id');
                var fee_groups_feetype_id = $(this).data('fee_groups_feetype_id');
                item = {};
                item ["fee_session_group_id"] = fee_session_group_id;
                item ["fee_master_id"] = fee_master_id;
                item ["fee_groups_feetype_id"] = fee_groups_feetype_id;

                array_to_collect_fees.push(item);
            });

            $.ajax({
                type: 'POST',
                url: base_url + "studentfee/getcollectfee",
                data: {'data': JSON.stringify(array_to_collect_fees)},
                dataType: "JSON",
                beforeSend: function () {
                    $this.button('loading');
                },
                success: function (data) {

                    $("#listCollectionModal .modal-body").html(data.view);
                 
                    $("#listCollectionModal").modal('show');
                    $this.button('reset');
                },
                error: function (xhr) { // if error occured
                    alert("Error occured.please try again");

                },
                complete: function () {
                    $this.button('reset');
                }
            });

        });

    });


    $(function () {
        $(document).on('change', "#discount_group", function () {
            var amount = $('option:selected', this).data('disamount');

            var balance_amount = (parseFloat(fee_amount) - parseFloat(amount)).toFixed(2);
            if (typeof amount !== typeof undefined && amount !== false) {
                $('div#myFeesModal').find('input#amount_discount').prop('readonly', true).val(amount);
                $('div#myFeesModal').find('input#amount').val(balance_amount);

            } else {
                $('div#myFeesModal').find('input#amount').val(fee_amount);
                $('div#myFeesModal').find('input#amount_discount').prop('readonly', false).val(0);
            }

        });
    });

    $("#collect_fee_group").submit(function (e) {
        var form = $(this);
        var url = form.attr('action');
        var smt_btn = $(this).find("button[type=submit]");
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'JSON',
            data: form.serialize(), // serializes the form's elements.
            beforeSend: function () {
                smt_btn.button('loading');
            },
            success: function (response) {

                if (response.status === 1) {

                    location.reload(true);
                } else if (response.status === 0) {
                    $.each(response.error, function (index, value) {
                        var errorDiv = '#form_collection_' + index + '_error';
                        $(errorDiv).empty().append(value);
                    });
                }
            },
            error: function (xhr) { // if error occured

                alert("Error occured.please try again");

            },
            complete: function () {
                smt_btn.button('reset');
            }
        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });

    $("#select_all").change(function () {  //"select all" change 
        $('input:checkbox.input-mounth').not(this).prop('checked', this.checked);
        // $(".checkbox").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
    });


    
</script>


<script>
$(document).ready(function () {

    function formatAmount(value) {
        value = parseFloat(value) || 0;
        return Number.isInteger(value) ? value : value.toFixed(2);
    }

    function updateMainBalance() {

        let rowBalanceTotal = 0;

        $('.row_balance').each(function () {
            rowBalanceTotal += parseFloat($(this).val()) || 0;
        });

        let autoReceiptAmt = parseFloat($('#hid_receipt_amt').val()) || 0;
        let manualReceiptAmt = parseFloat($('#receipt_amt').val()) || 0;

        let finalBalance = rowBalanceTotal + (autoReceiptAmt - manualReceiptAmt);

        $('#balance_amt').val(formatAmount(finalBalance));
    }

    function updateFooterTotals() {

        let totalDiscount = 0;
        let totalReceipt = 0;
        let totalBalance = 0;
        let estimatedTotal = 0;

        $('tbody tr').each(function () {

            let checkbox = $(this).find('.row_selector');

            if (checkbox.length && !checkbox.is(':checked')) {
                return true;
            }

            let totalField = $(this).find('input[name="total[]"]');

            if (totalField.length) {
                estimatedTotal += parseFloat(totalField.val()) || 0;
            }

            let discountField = $(this).find('.rec_discount');

            if (discountField.length) {
                totalDiscount += parseFloat(discountField.val()) || 0;
            }

            let recField = $(this).find('.rec_amount');

            if (recField.length) {
                totalReceipt += parseFloat(recField.val()) || 0;
            }

            let balField = $(this).find('.row_balance');

            if (balField.length) {
                totalBalance += parseFloat(balField.val()) || 0;
            }
        });

        let lateFees = parseFloat($('#late_fees').val()) || 0;

        let netFees = estimatedTotal + lateFees - totalDiscount;
        let receiptAmt = totalReceipt + lateFees;

        $('#fees_received').val(formatAmount(estimatedTotal));
        $('#discount_amt').val(formatAmount(totalDiscount));
        $('#net_fees').val(formatAmount(netFees));

        if (!$('#receipt_amt').data('manual')) {
            $('#receipt_amt').val(formatAmount(receiptAmt));
        }

        $('#hid_receipt_amt').val(formatAmount(receiptAmt));

        $('#error_message_rcpt').text(
            'Amount must be between 0 and ' +
            formatAmount(receiptAmt) +
            '.'
        );

        // Logic A
        $('#balance_amt').val(formatAmount(totalBalance));
    }

    // Discount Change
    $(document).on('input', '.rec_discount', function () {

        let row = $(this).closest('tr');

        let total = parseFloat(
            row.find('input[name="total[]"]').val()
        ) || 0;

        let discount = parseFloat($(this).val()) || 0;

        if (discount < 0) {
            discount = 0;
        }

        if (discount > total) {
            discount = total;
        }

        $(this).val(formatAmount(discount));

        let payable = total - discount;

        row.find('.rec_amount').val(formatAmount(payable));
        row.find('.row_balance').val('0');
		
		if ($(this).attr('name') === 'prev_rec_discount') {
			$('#pre_bal_total').val(formatAmount(payable));
		}
		if ($(this).attr('name') === 'ledg_rec_discount') {
			$('#ledg_total').val(formatAmount(payable));
		}

        updateFooterTotals();
    });

    // Received Amount Change
    $(document).on('input', '.rec_amount', function () {

        let row = $(this).closest('tr');

        let total = parseFloat(
            row.find('input[name="total[]"]').val()
        ) || 0;

        let discount = parseFloat(
            row.find('.rec_discount').val()
        ) || 0;

        let payable = total - discount;

        let received = parseFloat($(this).val()) || 0;

        if (received < 0) {
            received = 0;
        }

        if (received > payable) {
            received = payable;
        }

        $(this).val(formatAmount(received));

        let balance = payable - received;

        row.find('.row_balance').val(formatAmount(balance));

        $('#receipt_amt').removeData('manual');
		
		if ($(this).attr('name') === 'prev_rec_amount') {
			$('#pre_bal_total').val(formatAmount(received));
		}
		if ($(this).attr('name') === 'ledg_rec_amount') {
			$('#ledg_total').val(formatAmount(received));
		}

        updateFooterTotals();
    });

    // Late Fee Change
    $(document).on('input', '#late_fees', function () {

        $('#receipt_amt').removeData('manual');

        updateFooterTotals();
    });

    // Manual Receipt Amount Change
    $(document).on('input', '#receipt_amt', function () {

        $(this).data('manual', true);

        updateMainBalance();
    });

    // Checkbox Change
    $(document).on('change', '.row_selector', function () {

        let row = $(this).closest('tr');

        let total = parseFloat(
            row.find('input[name="total[]"]').val()
        ) || 0;

        if ($(this).is(':checked')) {

            row.find('.rec_discount').prop('disabled', false);
            row.find('.rec_amount').prop('disabled', false);

            row.find('.rec_discount').val('');

            row.find('.rec_amount').val(formatAmount(total));

            row.find('.row_balance').val('0');
			
			if (row.find('.rec_discount[name="prev_rec_discount"]').length) {
				$('#pre_bal_total').val(formatAmount(total));
			}
			if (row.find('.rec_discount[name="ledg_rec_discount"]').length) {
				$('#ledg_total').val(formatAmount(total));
			}

        } else {

            row.find('.rec_discount')
                .val('')
                .prop('disabled', true);

            row.find('.rec_amount')
                .val('0')
                .prop('disabled', true);

            row.find('.row_balance')
                .val('0');
				
			if (row.find('.rec_discount[name="prev_rec_discount"]').length) {
				$('#pre_bal_total').val('0');
			}
			if (row.find('.rec_discount[name="ledg_rec_discount"]').length) {
				$('#ledg_total').val('0');
			}	
        }

        $('#receipt_amt').removeData('manual');

        updateFooterTotals();
    });

    updateFooterTotals();

});
</script>