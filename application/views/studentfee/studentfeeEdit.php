<style type="text/css">
    .checkbox-inline+.checkbox-inline, .radio-inline+.radio-inline {
    margin-left: 8px;}
</style>
<?php
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

                                            <h4>LEDGER AMT</h4>
                                            <h5>Rs. <?=$ledger_total? $ledger_total : $student['fees_discount']; ?>
											<?//=$ledger_total ? number_format($fees_received,2) : number_format($ledger_amt,2); ?>
											<?//=$ledger_total ? number_format($fees_received,2) : number_format($ledger_amt,2); ?>
											
											<?//=$ledger_amt ? number_format($ledger_amt,2) : number_format($student['fees_discount'],2); ?><?//=number_format($student['fees_discount'],2)?></h5>
                                        </div>

                                        <div class="col-md-10">
                                            <div class="row">
                                                <table class="table table-striped mb0 font13">
                                                    <tbody>

                                                        <tr>
                                                            <td onclick="changeDate(this)"> <b>Date : </b> <input type="date" id="dateInput" value="<?php echo $date_time; ?>"></td>
                                                            <td>Receipt No. <b><?=$receipt_no?></b> </td>
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
                                                                        $this->db->where('id', $student['vehroute_id']);
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
                                                    <div class="col-sm-12" style="text-align: -webkit-right;;">
                                                        <a href="<?=base_url('student/view/'.$student['id'])?>">Edit</a>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <input class="form-check-input month-check" type="checkbox" id="select_all">
                                                        <label for="select_all">Select All</label>
                                                    </div>
                                                    <hr>
                                                    <?php
													//echo '<pre>'; print_r($months_data);echo '</pre>';
														$months = ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "Mar"];

														// Find earliest (first) paid month index; -1 if none paid
														$firstPaidIndex = -1;
														foreach ($months as $index => $month) {
															if (in_array($month, $pay_mounth)) {
																$firstPaidIndex = $index;
																break; // stop at first occurrence (earliest in the array order)
															}
														}

														foreach ($months as $index => $month):
															$isPaid = in_array($month, $pay_mounth);                // already paid
															$isSelected = $isPaid || in_array($month, $months_data);// selected if paid or previously selected
															// disable only months that are strictly before the earliest paid month
															$isDisabled = ($firstPaidIndex >= 0 && $index < $firstPaidIndex);
														?>
															<div class="col-sm-3 col-md-3 p-0 m-0 month-checkbox">
																<input
																	class="form-check-input month-check input-mounth"
																	type="checkbox"
																	name="months[]"
																	value="<?= $month ?>"
																	id="<?= strtolower($month) ?>"
																	<?= $isSelected ? 'checked' : '' ?>
																	<?= $isDisabled ? 'disabled' : '' ?>
																>
																<label for="<?= strtolower($month) ?>" style="<?= $isDisabled ? 'color:#aaa;' : '' ?>">
																	<?= $month ?>
																</label>
															</div>
														<?php endforeach; ?>

                                                    <div class="col-sm-12" style="text-align: -webkit-right;;">
                                                        <button type="submit" name="action" value="go" class="btn btn-info">Go</button>
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

                        <form action="<?=base_url('studentfee/editFee')?>" id="ledger_form" method="post">

                        <input type="hidden" name="date_time" id="outputInput" value="<?=$date_time?>" readonly >
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
                            <input type="hidden"  value="<?=$receipt_no?>" name="receipt_no">
                            <input type="hidden"  value="<?=$student['id']?>" name="student_id">
                            <input type="hidden"  value="<?=$sr_no?>" name="sr_no">
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
                                            <th>Discount</th>
                                            <th>Received</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $statusNew=0;
                                            $final_total = 0;
                                            $aa=1;
                                            foreach($data_list as $row){
                                                $db_months = json_decode($row->months);
                                                $total = 0;
                                                $statusNew++;
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
                                                                echo $row->amount;
                                                                $total += $row->amount;
                                                                ?><input type="hidden" name="month_total[<?=$value?>][]" value="<?=$row->amount?>"><?php
                                                            } else {
                                                                echo 0;
                                                                ?><input type="hidden" name="month_total[<?=$value?>][]" value="0"><?php
                                                            }
                                                        ?>   
                                                    </th>
                                                <?php endforeach; ?>

                                                <th><?= $total ?> <input type="hidden" name="total[]" value="<?=$total?>"> </th>
                                                <th><input type="text" style="width: 100px;" class="rec_discount" name="rec_discount[]" id="total_get_discount_<?=$aa?>" oninput="calculateDisData(this,<?=$aa?>)" value="<?=$rec_discount[$row->id];?>"></th>
                                                <th><input type="text" style="width: 100px;" class="rec_amount" name="rec_amount[]" id="total_rec_discount_<?=$aa?>" oninput="calculateData(this,<?=$aa?>)" value="<?=$received_amount[$row->id] ? $received_amount[$row->id] : ($total-$rec_discount[$row->id]);?>"></th>
                                                <th><?=$balance_amount[$row->id] ? $balance_amount[$row->id] : 0;?></th>
                                            </tr>
                                            <?php
                                                $final_total += $total;
                                                $aa++;
                                            }

                                            // $aa++;
                                            foreach($route_data_list as $row){

                                                $db_months = json_decode($row->months);
                                                $total = 0;
                                                $aa++;
                                                $statusNew++;
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
                                                                echo $row->amount;
                                                                $total += $row->amount;
                                                                ?><input type="hidden" name="month_total[<?=$value?>][]" value="<?=$row->amount?>"><?php
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
                                                <th><input type="text" style="width:100px;" class="rec_discount" name="rec_discount[]"  id="total_get_discount_<?=$aa?>"   oninput="calculateDisData(this,<?=$aa?>)" value="<?=$rec_discount[$row->id];?>"></th>				
                                                <th><input type="text" style="width:100px;" class="rec_amount" name="rec_amount[]" id="total_rec_discount_<?=$aa?>" oninput="calculateData(this,<?=$aa?>)" value="<?=$received_amount[$row->id] ? $received_amount[$row->id] : ($total-$rec_discount[$row->id]);?>"></th>
                                                <th><?=$balance_amount[$row->id] ? $balance_amount[$row->id] : 0;?></th>
                                            </tr>
                                            <?php
                                                $final_total += $total;
                                            }
                                            ?>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="card-footer"  style="padding: 10px;">
                            <div class="container" style="overflow-x: auto; max-width: 100%;">
                                <div class="row">
                                    
                                    
                                    <?php 
                                    
                                    if($statusNew==0) {
                                    
                                    ?>
                                    
                                    <div class="col-sm-2">
                                        <label for="fees_received">Ledger Total</label>
                                        <input style="width: 100%;" type="text" id="fees_received" class="form-control" value="<?=$ledger_total? $ledger_total : $student['fees_discount']; ?>" name="fees_received" readonly />
                                    </div>
                                    <?php }else{
                                    
                                    ?>
                                    
                                    <div class="col-sm-2">
                                        <label for="fees_received">Estimated Total</label>
                                        <input style="width: 100%;" type="text" id="fees_received" class="form-control" value="<?=$final_total?>" name="fees_received" readonly />
                                    </div>
                                    
                                    <?php
                                    
                                    } ?>
                                    
                                    
                                    <div class="col-sm-2">
                                        <label for="late_fees">Late/Other Fee</label>
                                        <input style="width: 100%;" type="text" id="late_fees" class="form-control" name="late_fees" value="<?php echo $late_fees;?>"/>
                                    </div>
                                  
                                        
                                         
                                        <input style="width: 100%;" type="hidden" id="old_ledger_amt"  name="old_ledger_amt" readonly value="<?=$ledger_total? $ledger_total : $student['fees_discount']; ?>"  />
									<?php 
                                    $ledger_total = $ledger_total? $ledger_total : $student['fees_discount'];
                                    if($statusNew==0) {
                                    
                                    ?>
                                          
                                          <?php
                                    }else{
                                        ?>
                                          <div class="col-sm-2">
                                        <input style="width: 100%;" type="hidden" id="ttyp" readonly value="mounth"  />
                                        <label for="ledger_amt">Ledger Amt</label>
                                        <input style="width: 100%;" type="text" id="ledger_amt" class="form-control" readonly name="ledger_amt" value="<?=$ledger_total? $ledger_total : $student['fees_discount']; ?>" min="0"   max="<?= $student['fees_discount'] ?>"  />
                                        </div>
										<?php

                                    }
                                    
                                    
                                    ?>
                                    <div class="col-sm-2">
                                        <label for="total_fees">Total Fees</label>
                                        <input style="width: 100%;" type="text" id="total_fees" class="form-control" name="total_fees" readonly value="<?=$total_fees ? $total_fees : (int)$late_fees+(int)$ledger_total+(int)$final_total; ?>" />
                                    </div>
									<?php 
                                    
                                    if($statusNew==0) {
                                    
                                    ?>
                                     <div class="col-sm-2">
                                        <label for="discount_amt">Discount Amt</label>
                                        <input style="width: 100%;" type="text" id="discount_amt" class="form-control" name="discount_amt" value="<?php echo $discount_amt;?>"  />
                                    </div>
                               <?php
                                    }else{
                                        ?>
                                        
                                         <div class="col-sm-2">
                                        
                                        <label for="discount_amt">Discount Amt</label>
                                        <input style="width: 100%;" type="text" id="discount_amt" class="form-control" name="discount_amt" value="<?php echo $discount_amt;?>" readonly  />
                                    </div>
                                        <?php
                                    }
                                    
                                    
                                    ?>
                                    <?php
										if(empty($net_fees) && !empty($months_data)){
											$net_fees = (int)$ledger_total + (int) $final_total + (int) $late_fees - (int)$discount_amt;
										} if(empty($receipt_amt)){
											//$receipt_amt = (int)$student['fees_discount'] + (int)$final_total + (int)$late_fees - (int)$discount_amt;
											$receipt_amt = (int)$ledger_total + (int)$final_total + (int)$late_fees - (int)$discount_amt;
										}
										
										//$balance_amt = (int)$net_fees - (int)$receipt_amt;
										if(empty($net_fees) && empty($months_data)){
											//$net_fees = (int) $student['fees_discount'];
											$net_fees = $late_fees+$ledger_total+$final_total;
											$balance_amt = 0;
										}
									?>
                                   
                                    <div class="col-sm-2">
                                        <label for="net_fees">Net Fees</label>
                                        <input style="width: 100%;" type="text" id="net_fees" class="form-control" name="net_fees" value="<?=$net_fees; ?>" readonly />
                                    </div>
                                </div>
                                <div class="row " style="margin-top: 10px !important;">
<?php 
                                    
                                    if($statusNew==0) {
                                        ?>
                                        
                                        <div class="col-sm-2">
                                        
                                        <input style="width: 100%;" type="hidden" id="ttyp" readonly value="lager"  />
                                       
                                        <label for="ledger_amt">Ledger Amt</label>
                                        <input style="width: 100%;" type="text" id="ledger_amt" class="form-control" name="ledger_amt" value="<?=$ledger_amt? $fees_received : $ledger_amt; ?>" min="0"   max="<?= $student['fees_discount'] ?>"  />
                                         <label id="error_message" style="color: red; display:block;font-size:10px !important"></label>
                                         <input style="width: 100%;" type="hidden" id="receipt_amt" class="form-control" name="receipt_amt" value="<?= $student['fees_discount'] ?>" readonly  />
                                       
                                    </div>
                                        
                                        <?php
                                    }else{
                                        ?>
                                        <div class="col-sm-2">
                                            <label for="receipt_amt">Receipt Amt</label>
                                            <input style="width: 100%;" type="text" id="receipt_amt" class="form-control" name="receipt_amt" value="<?=$receipt_amt; ?>" readonly  />
                                        </div>
                                    <?php
                                        
                                    }
                                    
                                    ?>
                                    <div class="col-sm-2">
                                        <label for="balance_amt">Balance Amt</label>
										<input style="width: 100%;" type="hidden" class="form-control" name="prev_balance_amt" value="<?php echo $balance_amt; ?>" />
                                        <input style="width: 100%;" type="text" id="balance_amt" class="form-control" name="balance_amt" readonly value="<?php echo $balance_amt; ?>" />
                                    </div>
                                
                                    <div class="col-sm-2">
                                        <label for="mode">Mode</label>
                                        <select autofocus=""  name="mode" id="mode" name="class_id" class="form-control" >
                                            <option value="Online" <?php echo $mode == 'Online' ? 'selected' : ''; ?>>Online</option>
                                            <option value="Cash" <?php echo $mode == 'Cash' ? 'selected' : ''; ?>>Cash</option>
                                            <option value="Other" <?php echo $mode == 'Other' ? 'selected' : ''; ?>>Other</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="remarks">Remarks</label>
                                        <input style="width: 100%;" type="text" id="remarks" class="form-control" name="remarks" value="<?php echo $remarks; ?>" />
                                    </div>
                                    <div class="col-sm-2">
                                        <span><br></span>
                                        <button type="submit" style="margin-top:5px" id="submit_btn" style="width: 100%;">Update</button>
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



    function calculateData(input,id) {
        let cleanedValue = input.value.replace(/[^0-9.]/g, '');
        const parts = cleanedValue.split('.');
        if (parts.length > 2) {
            cleanedValue = parts[0] + '.' + parts[1];
        }
        if (cleanedValue === '') {
            cleanedValue = 0;
        }
        input.value = cleanedValue;
        
        if (cleanedValue !== '') {

            const number = parseFloat(cleanedValue);
            const row = input.closest('tr');
            const cells = row.querySelectorAll('th, td');
            const len = cells.length;

            // Get last 3 cell values
            const val1 = cells[len - 4].innerText;
            const val2 = number;
            const val3 = cells[len - 1].innerText;
            let element1 = document.getElementById("total_get_discount_" + id).value;
            cells[len - 1].innerText = Number(val1) - (Number(element1) + Number(val2));

        }


        let sum = 0;
        document.querySelectorAll('.rec_amount').forEach(el => {
            const val = parseFloat(el.value);
            if (!isNaN(val)) {
                sum += val;
            }
        });

        // alert(sum);
        
        let ledger_amt = parseFloat(document.querySelector('[name="ledger_amt"]').value) || 0;
        document.querySelector('[name="receipt_amt"]').value = sum+ledger_amt;
        let feesReceived = parseFloat(document.querySelector('[name="net_fees"]').value) || 0;
        let balanceAmt = feesReceived - sum;
		//alert(balanceAmt);
        document.querySelector('[name="balance_amt"]').value = parseFloat(balanceAmt).toFixed(2);;
        FinalcalculateFees();
    }


    function calculateDisData(input,id){
        // alert(id);
        let cleanedValue = input.value.replace(/[^0-9.]/g, '');
        const parts = cleanedValue.split('.');
        if (parts.length > 2) {
            cleanedValue = parts[0] + '.' + parts[1];
        }
        if (cleanedValue === '') {
            cleanedValue = 0;
        }
        input.value = cleanedValue;
        
        // alert(cleanedValue);

        if (cleanedValue !== '') {
            const number = parseFloat(cleanedValue);
            const row = input.closest('tr');
            const cells = row.querySelectorAll('th, td');
            const len = cells.length;
            // Get last 3 cell values
            const val1 = cells[len - 4].innerText;
            const val2 = number;
            const val3 = cells[len - 1].innerText;
            
            // alert(val1-val2);
            var dis_amt=val1-val2;
            let element = document.getElementById("total_rec_discount_" + id);
            // alert(element);
            element.value = dis_amt-val3;

        }

        let sum = 0;
        document.querySelectorAll('.rec_discount').forEach(el => {
            const val = parseFloat(el.value);
            if (!isNaN(val)) {
                sum += val;
            }
        });
        //alert(sum);
        // let ledger_amt = parseFloat(document.querySelector('[name="ledger_amt"]').value) || 0;
        // document.querySelector('[name="receipt_amt"]').value = sum+ledger_amt;
        // let feesReceived = parseFloat(document.querySelector('[name="net_fees"]').value) || 0;
        // let balanceAmt = feesReceived - sum;
        
        document.querySelector('[name="discount_amt"]').value = sum;
        FinalcalculateFees();
        // calculateDataDiscount(id);
    }



    // function calculateDataDiscount(id){
       
    //     const row = $("#total_rec_discount_"+id).closest('tr');
    //     const cells = row.find('th, td'); // jQuery .find()
    //     const len = cells.length;

    //     const val1 = cells[len - 4].innerText;
    //     const val3 = cells[len - 1].innerText;

      


    // }




function DeleteRowData(checkbox,id) {
    // Find the row
    const row = checkbox.closest('tr');
    const input = row.querySelector('.rec_amount');
    if (!input) return;

    if (!checkbox.checked) {
        $("#payvalue_"+id).val('unpaid');
        input.dataset.originalValue = input.value;
        input.value = 0;
        input.readOnly = true;
    } else {
        $("#payvalue_"+id).val('paid');
        input.value = input.dataset.originalValue || '';
        input.readOnly = false;
    }

    // rec_discount

    const input1 = row.querySelector('.rec_discount');
    if (!input1) return;

    if (!checkbox.checked) {
        input1.dataset.originalValue = input1.value;
        input1.value = 0;
        input1.readOnly = true;
        
    } else {
        
        input1.value = input1.dataset.originalValue || '';
        input1.readOnly = false;
    }

    if (!checkbox.checked) {
    
        const cells = row.querySelectorAll('th, td');
        const len = cells.length;
        cells[len - 1].innerText = 0;

    }else{
        const cells = row.querySelectorAll('th, td');
        const len = cells.length;
        const val1 = cells[len - 4].innerText;
        cells[len - 1].innerText =  Number(val1) - (Number(input.dataset.originalValue) + Number(input1.dataset.originalValue));
    }

   calculateDataCheckBox(checkbox,id);


}





// document.addEventListener('DOMContentLoaded', function () {

//     const inputs = document.querySelectorAll('[name="discount_amt"],[name="ledger_amt"]');
//     inputs.forEach(input => {
//         input.addEventListener('keyup', calculateFees);
//     });
    
    

//     function calculateFees() {

        

        
//         let old_ledger_amt = parseFloat(document.querySelector('[name="old_ledger_amt"]').value) || 0;
//         let feesReceived = parseFloat(document.querySelector('[name="fees_received"]').value) || 0;
//         let ledgerAmt = parseFloat(document.querySelector('[name="ledger_amt"]').value) || 0;
//         let lateFees = parseFloat(document.querySelector('[name="late_fees"]').value) || 0;
//         let totalFees = parseFloat(document.querySelector('[name="total_fees"]').value) || 0;
//         let discountAmt = parseFloat(document.querySelector('[name="discount_amt"]').value) || 0;



//         let receiptAmt1 = old_ledger_amt;

//         document.querySelector('[name="receipt_amt"]').value = Number(receiptAmt1)+Number(lateFees);
//         let receiptAmt = parseFloat(document.querySelector('[name="receipt_amt"]').value) || 0;

//         let netFees = lateFees +ledgerAmt;
        
        
//         document.querySelector('[name="total_fees"]').value = netFees;
        
//         // document.querySelector('[name="net_fees"]').value = netFees;

//         // let balanceAmt = netFees - Number(receiptAmt);
//         // document.querySelector('[name="balance_amt"]').value = balanceAmt;
        
        
        
//     }
// });









document.addEventListener('DOMContentLoaded', function () {



    const inputs = document.querySelectorAll('[name="fees_received"], [name="discount_amt"],[name="ledger_amt"],[name="late_fees"], [name="total_fees"], [name="receipt_amt"]');
    inputs.forEach(input => {
        input.addEventListener('keyup', calculateFees);
    });
    
    
    
    
    const ttyp=$("#ttyp").val();

    function calculateFees() {


        let sum = 0;
        document.querySelectorAll('.rec_amount').forEach(el => {
            const val = parseFloat(el.value);
            if (!isNaN(val)) {
                sum += val;
            }
        });


        
        let old_ledger_amt = parseFloat(document.querySelector('[name="old_ledger_amt"]').value) || 0;
        let feesReceived = parseFloat(document.querySelector('[name="fees_received"]').value) || 0;
        let feesReceived_1 = parseFloat(document.querySelector('[name="fees_received"]').value) || 0;
        let ledgerAmt = parseFloat(document.querySelector('[name="ledger_amt"]').value) || 0;
        let lateFees = parseFloat(document.querySelector('[name="late_fees"]').value) || 0;
        let totalFees = parseFloat(document.querySelector('[name="total_fees"]').value) || 0;
        let discountAmt = parseFloat(document.querySelector('[name="discount_amt"]').value) || 0;

        
       

        if(ttyp=='lager'){ 
            
            //  alert(ttyp);
            feesReceived=0;
            // console.log(feesReceived);
    
            let netFees = old_ledger_amt + lateFees;
            
            //   alert(netFees);
            document.querySelector('[name="total_fees"]').value = netFees;
           
            document.querySelector('[name="net_fees"]').value = netFees-discountAmt;
            
            
            document.querySelector('[name="receipt_amt"]').value = netFees;
            
            
            let net_fees = parseFloat(document.querySelector('[name="net_fees"]').value) || 0;
    
            let balanceAmt = Number(net_fees) - Number(ledgerAmt);
            
            // alert(balanceAmt);
            
            document.querySelector('[name="balance_amt"]').value = parseFloat(balanceAmt).toFixed(2);;
            
        }else{

            let receiptAmt1 = sum+ledgerAmt;
    
            document.querySelector('[name="receipt_amt"]').value = Number(receiptAmt1)+Number(lateFees);
            let receiptAmt = parseFloat(document.querySelector('[name="receipt_amt"]').value) || 0;
    
            let netFees = (feesReceived + lateFees + ledgerAmt);
			//console.log(feesReceived,lateFees,ledgerAmt);
            
            if(discountAmt==''){
                document.querySelector('[name="total_fees"]').value = netFees;
            }
            document.querySelector('[name="net_fees"]').value = netFees-discountAmt;
    
            //let balanceAmt = netFees - Number(receiptAmt);//es
            let balanceAmt = netFees - Number(receiptAmt) - Number(discountAmt);
            document.querySelector('[name="balance_amt"]').value = parseFloat(balanceAmt).toFixed(2);;
        
        }
        
        
        
        
        
        
        
        
    }
});









    // document.addEventListener('DOMContentLoaded', function () {
        
    //     const inputs = document.querySelectorAll('[name="discount_amt"],[name="ledger_amt"]');
    
    //     inputs.forEach(input => {
    //         input.addEventListener('input', calculateFees);
    //     });
    
    //     function calculateFees() {
            
    //         const getVal = name => parseFloat(document.querySelector(`[name="${name}"]`)?.value) || 0;
    
    
    //         const old_ledger_amt = getVal('old_ledger_amt');
    //         const feesReceived = getVal('fees_received');
    //         const ledgerAmt = getVal('ledger_amt');
    //         const lateFees = getVal('late_fees');
    //         const totalFees = getVal('total_fees');
    //         const discountAmt = getVal('discount_amt');
    //         const net_fees_1 = getVal('net_fees');
        
        
    //         var bakaya=totalFees - discountAmt;
    //       console.log(bakaya);
        
        
    //         const receiptAmt = ledger_amt + lateFees - discountAmt;
    //         const netFees = lateFees + ledgerAmt + discountAmt;
    
    //         const receiptField = document.querySelector('[name="receipt_amt"]');
    //         const totalFeesField = document.querySelector('[name="total_fees"]');
    //         const balance_amt = document.querySelector('[name="balance_amt"]');
    //         const net_fees = document.querySelector('[name="net_fees"]');
            
    //         //alert(netFees);
    //         if (receiptField) receiptField.value = totalFees-discountAmt;
    //         if (totalFeesField) totalFeesField.value = ledgerAmt+lateFees;
    //         if (balance_amt) balance_amt.value = (old_ledger_amt +lateFees) - bakaya;
    //         if (net_fees) net_fees.value = totalFees-discountAmt;
            
            
    //     }
        
    // });











function FinalcalculateFees(){

    let sum1 = 0;
    document.querySelectorAll('.rec_discount').forEach(el => {
        const val = parseFloat(el.value);
        if (!isNaN(val)) {
            sum1 += val;
        }
    });
    document.querySelector('[name="discount_amt"]').value = Number(sum1);


    let sum = 0;
    document.querySelectorAll('.rec_amount').forEach(el => {
        const val = parseFloat(el.value);
        if (!isNaN(val)) {
            sum += val;
        }
    });
    

    let lateFees = parseFloat(document.querySelector('[name="late_fees"]').value) || 0;
    let ledgerAmt1 = parseFloat(document.querySelector('[name="ledger_amt"]').value) || 0;
    //let balanceAmt1 = parseFloat(document.querySelector('[name="balance_amt"]').value) || 0;
	
	
    //document.querySelector('[name="receipt_amt"]').value = Number(sum)+Number(ledgerAmt1)+Number(lateFees)-Number(balanceAmt1);
    document.querySelector('[name="receipt_amt"]').value = Number(sum)+Number(ledgerAmt1)+Number(lateFees);


    let feesReceived = parseFloat(document.querySelector('[name="fees_received"]').value) || 0;
    let ledgerAmt = parseFloat(document.querySelector('[name="ledger_amt"]').value) || 0;
    
    let totalFees = parseFloat(document.querySelector('[name="total_fees"]').value) || 0;
    let discountAmt = parseFloat(document.querySelector('[name="discount_amt"]').value) || 0;
    let receiptAmt = parseFloat(document.querySelector('[name="receipt_amt"]').value) || 0;


    //let netFees = Number(totalFees) + Number(lateFees) - Number(discountAmt);
    let netFees = Number(totalFees) - Number(discountAmt);
    console.log(totalFees, lateFees, discountAmt);
    if(discountAmt==''){
        document.querySelector('[name="total_fees"]').value = netFees;
    }
    document.querySelector('[name="net_fees"]').value = netFees;
	//let balanceAmt = 0;
	//if(netFees > 0) {
		let balanceAmt = netFees - receiptAmt;
	//}
    document.querySelector('[name="balance_amt"]').value = parseFloat(balanceAmt).toFixed(2);;
   
}


function calculateDataCheckBox(checkbox,id){



    const row = checkbox.closest('tr');
    // const row = this.closest('tr');
    const cells = row.querySelectorAll('th, td');
    const len = cells.length;

    // Get last 3 cell values
    const val1 = cells[len - 4].innerText;
    // const val2 = cells[len - 2].innerText;
    const val3 = cells[len - 1].innerText;

    if (!checkbox.checked) {
        let feesReceived = parseFloat(document.querySelector('[name="fees_received"]').value) || 0;
            feesReceived=parseInt(feesReceived)-parseInt(val1);
        document.querySelector('[name="fees_received"]').value = feesReceived;


        let total_fees = parseFloat(document.querySelector('[name="total_fees"]').value) || 0;
        total_fees=parseInt(total_fees)-parseInt(val1);
        document.querySelector('[name="total_fees"]').value = total_fees;



    }else{
        let feesReceived = parseFloat(document.querySelector('[name="fees_received"]').value) || 0;
            feesReceived=parseInt(feesReceived)+parseInt(val1);
        document.querySelector('[name="fees_received"]').value = feesReceived;

        let total_fees = parseFloat(document.querySelector('[name="total_fees"]').value) || 0;
        total_fees=parseInt(total_fees)+parseInt(val1);
        document.querySelector('[name="total_fees"]').value = total_fees;
    }


    FinalcalculateFees();
    
    
    // let balance_amt = parseFloat(document.querySelector('[name="balance_amt"]').value) || 0;
    //     balance_amt=parseInt(balance_amt)-parseInt(val1);
    // document.querySelector('[name="balance_amt"]').value = balance_amt.toFixed(2);

    // let net_fees = parseFloat(document.querySelector('[name="net_fees"]').value) || 0;
    //     net_fees=parseInt(net_fees)-parseInt(val1);
    // document.querySelector('[name="net_fees"]').value = net_fees.toFixed(2);


}


    //document.getElementById('dateInput').value = new Date().toISOString().split('T')[0];



</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ledgerAmtInput = document.getElementById('ledger_amt');
        // const oldLedgerAmt = parseInt(document.getElementById('net_fees').value, 10);
        const oldLedgerAmt = parseFloat(document.getElementById('net_fees').value);

        const errorMessage = document.getElementById('error_message');
        const submitBtn = document.getElementById('submit_btn');

        function validateLedgerAmount() {
            const value = parseFloat(ledgerAmtInput.value)??1.1;
            // const oldLedgerAmt = parseInt(document.getElementById('net_fees').value, 10);
            const oldLedgerAmt = parseFloat(document.getElementById('net_fees').value);

            if (isNaN(value) || value < 0 || value > oldLedgerAmt) {
                // alert(value);
                errorMessage.textContent = `Amount must be between 0 and ${oldLedgerAmt}.`;
                errorMessage.style.display = 'block';
                submitBtn.disabled = true;


                if (!isNaN(value) && ledgerAmtInput.value.trim() !== '') {
                    document.querySelector('[name="ledger_amt"]').value = oldLedgerAmt;
                    // errorMessage.style.display = 'none';
                    submitBtn.disabled = false;
                }


            } else {
                errorMessage.style.display = 'none';
                submitBtn.disabled = false;
            }
        }

        // Validate on input change
        ledgerAmtInput.addEventListener('input', validateLedgerAmount);

        // Initial validation on page load
        validateLedgerAmount();
    });



    const dateInput = document.getElementById('dateInput');
    const outputInput = document.getElementById('outputInput');
    dateInput.addEventListener('change', function () {
      outputInput.value = this.value;
    });


  </script>