<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <section class="content-header">
                <h1>
                    <i class="fa fa-money"></i> <?php echo $this->lang->line('fees_collection'); ?><small><?php echo $this->lang->line('student_fee'); ?></small></h1>
            </section>
        </div>
    </div>
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
                            <div class="col-md-8 ">
                                <div class="btn-group pull-right">
                                    <a href="<?php echo base_url() ?>user/user/dashboard" type="button" class="btn btn-primary btn-xs">
                                        <i class="fa fa-arrow-left"></i> <?php echo $this->lang->line('back'); ?></a>
                                </div>
                            </div>

                        </div>

                    </div><!--./box-header-->

                    <div class="box-body" style="padding-top:0;">
                        <div class="row">
                            <?php echo $this->session->flashdata('error') ?>
                            <div class="col-md-9">
                                <div class="sfborder">
                                    <div class="col-md-2 text-center">
                                        <?php if($sch_setting->student_photo){
                                            ?>
                                            <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url() . $student['image'] ?>" alt="User profile picture">
                                            <?php
                                        }?>
                                        <h5 style="font-size: 12px;font-weight: bold;">PREV AMT : Rs. <?=format_amount($student_data['previous_session_balance'])?></h5>
                                        <h5 style="font-size: 12px;font-weight: bold;">LEDG AMT : Rs. <?=format_amount($student_data['fees_discount'])?></h5>
                                    </div>
									<div class="col-md-10">
										<div class="row">
											<table class="table table-striped mb0 font13">
												<tbody>

													<tr>
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
																if ($student_data['category_id'] == $value['id']) {
																	echo $value['name'];
																}
															}
															?></th>
														<!--<th>City - <?=$student_data['city']?></th>-->
														<?php if(!empty($last_receipt_date)){ ?>
														<th>Last Receipt Date - <?= date('d-m-Y',strtotime($last_receipt_date->created_at)) ?></th>
														<?php } ?>
													</tr>
												
												</tbody>
											</table>
										</div>
									</div>
                                    <!--<div class="col-md-10">
                                        <div class="row">

                                            <table class="table table-striped mb0 font13">
                                                <tbody>
                                                    <tr>
                                                        <th class="bozero"><?php echo $this->lang->line('name'); ?></th>
                                                        <td class="bozero"><?php echo $this->customlib->getFullName($student['firstname'],$student['middlename'],$student['lastname'],$sch_setting->middlename,$sch_setting->lastname); ?></td>

                                                        <th class="bozero"><?php echo $this->lang->line('class_section'); ?></th>
                                                        <td class="bozero"><?php echo $student['class'] . " (" . $student['section'] . ")" ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <?php if ($sch_setting->father_name) { ?>
                                                            <th><?php echo $this->lang->line('father_name'); ?></th>
                                                            <td><?php echo $student['father_name']; ?></td>
                                                        <?php }
                                                        ?>

                                                        <th><?php echo $this->lang->line('admission_no'); ?></th>
                                                        <td><?php echo $student['admission_no']; ?></td>

                                                    </tr>
                                                    <tr>
                                                        <?php if ($sch_setting->mobile_no) { ?>
                                                            <th><?php echo $this->lang->line('mobile_no'); ?></th>
                                                            <td><?php echo $student['mobileno']; ?></td>
                                                        <?php } if ($sch_setting->roll_no) { ?>
                                                            <th><?php echo $this->lang->line('roll_no'); ?></th>
                                                            <td> <?php echo $student['roll_no']; ?> </td>
                                                        <?php } ?>
                                                    </tr>
                                                    <tr>
                                                        <?php if ($sch_setting->category) { ?>
                                                            <th><?php echo $this->lang->line('category'); ?></th>
                                                            <td>
                                                                <?php
                                                                foreach ($categorylist as $value) {
                                                                    if ($student['category_id'] == $value['id']) {
                                                                        echo $value['category'];
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                        <?php } if ($sch_setting->rte) { ?>
                                                            <th><?php echo $this->lang->line('rte'); ?></th>
                                                            <td><b class="text-danger"> <?php echo $student['rte']; ?> </b>
                                                            </td>
                                                        <?php } ?>
                                                    </tr>

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>-->


                                </div>
							</div>
							<div class="col-md-3">
								<div class="sfborder p-5">
								

									<form action="" method="post">
										<div class="col-md-12 p-5" style="padding:1rem !important">
											<div class="row ">
												<?php
												// var_dump($months_data);

												$months = [ "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec","Jan", "Feb", "Mar"];
												foreach ($months as $month): ?>
												<div class="col-sm-3 col-md-3 p-0 m-0 month-checkbox">
													

													<?php
														if (in_array($month, $pay_mounth)) {  // Check if month exists in $pay_mounth array
															// If the month exists in $pay_mounth, disable the checkbox and make it unchecked
															?>
															<i class="fa fa-check"></i>
															<label for="<?= strtolower($month) ?>"><?= $month ?></label>
															<?php
														} else {
															// If the month does not exist in $pay_mounth, show the checkbox as usual
															if(in_array($month,$months_data)){ ?>
																<i class="fa fa-times"></i>
																<label for="<?= strtolower($month) ?>"><?= $month ?></label>
																<?php }else{
																?>
																<i class="fa fa-times"></i>
																<label for="<?= strtolower($month) ?>"><?= $month ?></label>
																<?php
															} 
														}
														?>
													
												   
													
												</div>
												<?php endforeach; ?>
											</div>
											</div>
										</div>
									</form>


							</div>	
                            <!--<div class="col-md-12">
                                <div style="background: #dadada; height: 1px; width: 100%; clear: both; margin-bottom: 10px;"></div>
                            </div>-->
                        </div>

                        <!--<div class="table-responsive">
                            <div class="download_label"><?php echo $this->lang->line('student_fees') . ": " . $student['firstname'] . " " . $student['lastname'] ?> </div>
                            <?php
                            if (empty($student_due_fee)) {
                                ?>
                                <div class="alert alert-danger">
                                    No fees Found.
                                </div>
                                <?php
                            } else {
                                ?>
                                <table class="table table-striped table-bordered table-hover  table-fixed-header">
                                    <thead>
                                        <tr>
                                            <th align="left"><?php echo $this->lang->line('fees_group'); ?></th>
                                            <th align="left"><?php echo $this->lang->line('fees_code'); ?></th>
                                            <th align="left" class="text text-center"><?php echo $this->lang->line('due_date'); ?></th>
                                            <th align="left" class="text text-left"><?php echo $this->lang->line('status'); ?></th>
                                            <th class="text text-right"><?php echo $this->lang->line('amount') ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                            <th class="text text-left"><?php echo $this->lang->line('payment_id'); ?></th>
                                            <th class="text text-left"><?php echo $this->lang->line('mode'); ?></th>
                                            <th class="text text-left"><?php echo $this->lang->line('date'); ?></th>
                                            <th class="text text-right" ><?php echo $this->lang->line('discount'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                            <th class="text text-right"><?php echo $this->lang->line('fine'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                            <th class="text text-right"><?php echo $this->lang->line('paid'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                            <th class="text text-right"><?php echo $this->lang->line('balance'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                            <th class="text text-right"><?php echo $this->lang->line('action'); ?></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total_amount = "0";
                                        $total_deposite_amount = "0";
                                        $total_fine_amount = "0";
                                        $total_discount_amount = "0";
                                        $total_balance_amount = "0";
										$total_fees_fine_amount = 0;

                                        foreach ($student_due_fee as $key => $fee) {

                                            foreach ($fee->fees as $fee_key => $fee_value) {


                                                $fee_paid = 0;
                                                $fee_discount = 0;
                                                $fee_fine = 0;
                                                $alot_fee_discount = 0;


                                                if (!empty($fee_value->amount_detail)) {
                                                    $fee_deposits = json_decode(($fee_value->amount_detail));

                                                    foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                                        $fee_paid = $fee_paid + $fee_deposits_value->amount;
                                                        $fee_discount = $fee_discount + $fee_deposits_value->amount_discount;
                                                        $fee_fine = $fee_fine + $fee_deposits_value->amount_fine;
                                                    }
                                                }
												if (($fee_value->due_date != "0000-00-00" && $fee_value->due_date != NULL) && (strtotime($fee_value->due_date) < strtotime(date('Y-m-d')))) {
                                           
                                                $total_fees_fine_amount=$total_fees_fine_amount+$fee_value->fine_amount;
                                           }
                                                $total_amount = $total_amount + $fee_value->amount;
                                                $total_discount_amount = $total_discount_amount + $fee_discount;
                                                $total_deposite_amount = $total_deposite_amount + $fee_paid;
                                                $total_fine_amount = $total_fine_amount + $fee_fine;
                                                $feetype_balance = $fee_value->amount - ($fee_paid + $fee_discount);
                                                $total_balance_amount = $total_balance_amount + $feetype_balance;
                                                ?>
                                                <?php
                                                if ($feetype_balance > 0 && strtotime($fee_value->due_date) < strtotime(date('Y-m-d'))) {
                                                    ?>
                                                    <tr class="danger font12">
                                                        <?php
                                                    } else {
                                                        ?>
                                                    <tr class="dark-gray">
                                                        <?php
                                                    }
                                                    ?>
                                                    <td align="left"><?php
                                                        echo $fee_value->name . " (" . $fee_value->type . ")";
                                                        ?></td>
                                                    <td align="left"><?php echo $fee_value->code; ?></td>
                                                    <td align="left" class="text text-center">

                                                        <?php
                                                        if ($fee_value->due_date == "0000-00-00") {
                                                            
                                                        } else {

                                                            echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($fee_value->due_date));
                                                        }
                                                        ?>
                                                    </td>
                                                    <td align="left" class="text text-left">
                                                        <?php
                                                        if ($feetype_balance == 0) {
                                                            ?><span class="label label-success"><?php echo $this->lang->line('paid'); ?></span><?php
                                                        } else if (!empty($fee_value->amount_detail)) {
                                                            ?><span class="label label-warning"><?php echo $this->lang->line('partial'); ?></span><?php
                                                        } else {
                                                            ?><span class="label label-danger"><?php echo $this->lang->line('unpaid'); ?></span><?php
                                                            }
                                                            ?>

                                                    </td>
                                                    <td class="text text-right"><?php echo $fee_value->amount;
 if (($fee_value->due_date != "0000-00-00" && $fee_value->due_date != NULL) && (strtotime($fee_value->due_date) < strtotime(date('Y-m-d')))) {
    ?>
<span class="text text-danger"><?php echo " + ".($fee_value->fine_amount); ?></span>
    <?php
          
            }

                                                     ?></td>

                                                    <td class="text text-left"></td>
                                                    <td class="text text-left"></td>
                                                    <td class="text text-left"></td>
                                                    <td class="text text-right"><?php
                                                        echo (number_format($fee_discount, 2, '.', ''));
                                                        ?></td>
                                                    <td class="text text-right"><?php
                                                        echo (number_format($fee_fine, 2, '.', ''));
                                                        ?></td>
                                                    <td class="text text-right"><?php
                                                        echo (number_format($fee_paid, 2, '.', ''));
                                                        ?></td>
                                                    <td class="text text-right">
                                                        <?php
                                                        $display_none = "ss-none";
                                                        if ($feetype_balance > 0) {
                                                            $display_none = "";
                                                            echo (number_format($feetype_balance, 2, '.', ''));
                                                        }
                                                        ?>

                                                    </td>

                                                    <td>
                                                        <div class="btn-group pull-right"> 
                                                            <?php
                                                            if ($payment_method) {

                                                                if ($feetype_balance > 0) {
                                                                    ?>
                                                                    <a href="<?php echo base_url() . 'students/payment/pay/' . $fee->id . "/" . $fee_value->fee_groups_feetype_id . "/" . $student['id'] ?>" class="btn btn-xs btn-primary pull-right myCollectFeeBtn"><i class="fa fa-money"></i> Pay</a>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>




                                                        </div>        
                                                    </td>


                                                </tr>

                                                <?php
                                                if (!empty($fee_value->amount_detail)) {

                                                    $fee_deposits = json_decode(($fee_value->amount_detail));

                                                    foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                                        ?>
                                                        <tr class="white-td">
                                                            <td align="left"></td>
                                                            <td align="left"></td>
                                                            <td align="left"></td>
                                                            <td align="left"></td>
                                                            <td class="text-right"><img src="<?php echo base_url(); ?>backend/images/table-arrow.png" alt="" /></td>
                                                            <td class="text text-left">


                                                                <a href="#" data-toggle="popover" class="detail_popover" > <?php echo $fee_value->student_fees_deposite_id . "/" . $fee_deposits_value->inv_no; ?></a>
                                                                <div class="fee_detail_popover" style="display: none">
                                                                    <?php
                                                                    if ($fee_deposits_value->description == "") {
                                                                        ?>
                                                                        <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <p class="text text-info"><?php echo $fee_deposits_value->description; ?></p>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>


                                                            </td>
                                                            <td class="text text-left"><?php echo $this->lang->line(strtolower($fee_deposits_value->payment_mode)); ?></td>
                                                            <td class="text text-left">

                                                                <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($fee_deposits_value->date)); ?>
                                                            </td>
                                                            <td class="text text-right"><?php echo ( number_format($fee_deposits_value->amount_discount, 2, '.', '')); ?></td>
                                                            <td class="text text-right"><?php echo ( number_format($fee_deposits_value->amount_fine, 2, '.', '')); ?></td>
                                                            <td class="text text-right"><?php echo ( number_format($fee_deposits_value->amount, 2, '.', '')); ?></td>
                                                            <td></td>


                                                            <td class="text text-right">

                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <?php
                                        if (!empty($student_discount_fee)) {

                                            foreach ($student_discount_fee as $discount_key => $discount_value) {
                                                ?>
                                                <tr class="dark-light">
                                                    <td align="left"> <?php echo $this->lang->line('discount'); ?> </td>
                                                    <td align="left">
                                                        <?php echo $discount_value['code']; ?>
                                                    </td>
                                                    <td align="left"></td>
                                                    <td align="left" class="text text-left">
                                                        <?php
                                                        if ($discount_value['status'] == "applied") {
                                                            ?>
                                                            <a href="#" data-toggle="popover" class="detail_popover" >

                                                                <?php echo $this->lang->line('discount_of') . " " . $currency_symbol . $discount_value['amount'] . " " . $this->lang->line($discount_value['status']) . " : " . $discount_value['payment_id']; ?>

                                                            </a>
                                                            <div class="fee_detail_popover" style="display: none">
                                                                <?php
                                                                if ($discount_value['student_fees_discount_description'] == "") {
                                                                    ?>
                                                                    <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <p class="text text-danger"><?php echo $discount_value['student_fees_discount_description'] ?></p>
                                                                    <?php
                                                                }
                                                                ?>

                                                            </div>
                                                            <?php
                                                        } else {
                                                            echo '<p class="text text-danger">' . $this->lang->line('discount_of') . " " . $currency_symbol . $discount_value['amount'] . " " . $this->lang->line($discount_value['status']);
                                                        }
                                                        ?>

                                                    </td>
                                                    <td></td>
                                                    <td class="text text-left"></td>
                                                    <td class="text text-left"></td>
                                                    <td class="text text-left"></td>
                                                    <td  class="text text-right">
                                                        <?php
                                                        $alot_fee_discount = $alot_fee_discount;
                                                        ?>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <tr class="box box-solid total-bg">
                                            <td align="left"></td>
                                            <td align="left"></td>
                                            <td align="left"></td>   
                                            <td align="left" class="text text-left" ><?php echo $this->lang->line('grand_total'); ?></td>
                                            <td class="text text-right"><?php
                                            echo $currency_symbol . number_format($total_amount, 2, '.', '')."<span class='text text-danger'>+".  number_format($total_fees_fine_amount, 2, '.', '')."</span>";
                                            ?></td>
                                            <td class="text text-left"></td>
                                            <td class="text text-left"></td>
                                            <td class="text text-left"></td>

                                            <td class="text text-right"><?php
                                                echo ($currency_symbol . number_format($total_discount_amount + $alot_fee_discount, 2, '.', ''));
                                                ?></td>
                                            <td class="text text-right"><?php
                                                echo ($currency_symbol . number_format($total_fine_amount, 2, '.', ''));
                                                ?></td>
                                            <td class="text text-right"><?php
                                                echo ($currency_symbol . number_format($total_deposite_amount, 2, '.', ''));
                                                ?></td>
                                            <td class="text text-right"><?php
                                                echo ($currency_symbol . number_format($total_balance_amount - $alot_fee_discount, 2, '.', ''));
                                                ?></td>  
                                            <td class="text text-right"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php } ?>
                        </div>-->
                    </div>
                    <!-- /.box-body -->
                </div>


            </div>
			<?php if (!empty($receipt_data)){ ?>
            <div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header ptbnull">
						<h3 class="box-title titlefix"><i class="fa fa-users"></i> Collect Fee List</h3>
						<div class="box-tools pull-right"></div>
					</div>
					<div class="box-body table-responsive table-header-sticky" style="overflow: auto;">

						<div class="download_label">Collect Fee List</div>
						<table class="table table-striped table-bordered table-hover example table-fixed-header sticky-col-5">
							<thead>

								<tr>
									<th style="width:50px !imortant">S.No</th>
									<th style="width:70px !imortant">Date</th>
									<th style="width:70px !imortant">Slip No</th>
									<th style="width:70px !imortant">Adm. No</th>
									<th >Student</th>
									<th >Father</th>
									<th >Class</th>
									<th >Sec.</th>
									<th >Fee Cat.</th>
									<th >Route</th>
									<th >Months</th>
									<th style="text-align: right;">Fee</th>
									<th style="text-align: right;">Ledger Amt</th>
									<th style="text-align: right;">Late/Other</th>
									<th style="text-align: right;">Total Fees</th>
									<th style="text-align: right;">Discount Amt</th>
									<th style="text-align: right;">Net Fees</th>
									<th style="text-align: right;">Receipt. Amt.</th>
									<th style="text-align: right;">Balance Amt</th>
									<th >Mode</th>
									<th >User</th>
								</tr>
							</thead>            
							<tbody>    
								<?php
								$sno = 1; 
								foreach ($receipt_data as $record) {
									$record=(array)$record; 
									if(!empty($record['fee_head'])){
									$fees_received_sum       += (float)$record["fees_received"];
									}else{
										$fees_received_sum       +=00.00;
									}
									$late_fees_sum    += (float)$record["late_fees"];
									$ledger_amt_sum   += (float)$record["ledger_amt"];
									$total_fees_sum     += (float)$record["total_fees"];
									$discount_amt_sum     += (float)$record["discount_amt"];
									$net_fees_sum  += (float)$record["net_fees"];
									$receipt_amt_sum  += (float)$record["receipt_amt"];
									$balance_amt_sum  += (float)$record["balance_amt"];
									?>
									<tr>
										<td style="width:50px !important"><?= $sno++ ?></td>
										<td style="width:100px !imortant"><?= date('d-m-Y',strtotime($record["date_time"])) ?></td>
										<td style="width:100px !imortant"><?= $record["receipt_no"] ?></td>
										<td ><?= $record["admission_no"] ?></td>
										<td ><?= $record["firstname"].' '.$record["middlename"].' '.$record["lastname"] ?></td>
										<td ><?= $record["father_name"] ?></td>
										<td ><?= $record["class"] ?></td>
										<td ><?= $record["section"] ?></td>
										<td ><?=  ($this->db->get_where('fee_groups', ['id' => $record['category_id']])->row()) ? $this->db->get_where('fee_groups', ['id' => $record['category_id']])->row()->name : 'N.A'; ?>  </td>
										<td ><?=  ($this->db->get_where('route_head', ['id' => $record['route_id']])->row()) ? $this->db->get_where('route_head', ['id' => $record['route_id']])->row()->fees_heading : 'N.A'; ?>  </td>
										<td>
											<?php
												if(!empty($record['fee_head'])){
													// echo $record["receipt_months"];
													$financial_year_order = ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'];

													$months = explode(',', $record["receipt_months"]);
													$months = array_map('trim', $months); // TRIM SPACES

													usort($months, function($a, $b) use ($financial_year_order) {
														return array_search($a, $financial_year_order) - array_search($b, $financial_year_order);
													});

													echo implode(', ', $months);
												}else{
													echo "Old Bal.";
												}
											?>
										</td>
										<?php
											 if(!empty($record['fee_head'])){
												?>
												<td style="text-align: right;"><?= sprintf('%.2f', $record["fees_received"]) ?></td>
												<?php
											 }else{
												?>
												<td style="text-align: right;">00.00</td>
												<?php
											 }
										?>
										<td style="text-align: right;"><?= sprintf('%.2f', $record["ledger_amt"]) ?></td>
										<td style="text-align: right;"><?= sprintf('%.2f', !empty($record["late_fees"]) ? $record["late_fees"] : 0) ?></td>
										<td style="text-align: right;"><?= sprintf('%.2f', $record["total_fees"]) ?></td>
										<td style="text-align: right;"><?= sprintf('%.2f', $record["discount_amt"]) ?></td>
										<td style="text-align: right;"><?= sprintf('%.2f', $record["net_fees"]) ?></td>
										<td style="text-align: right;"><?= sprintf('%.2f', $record["receipt_amt"]) ?></td>
										<td style="text-align: right;"><?= sprintf('%.2f', $record["balance_amt"]) ?></td>
										<td ><?= $record["mode"] ?></td>
										<td ><?= $record["create_by"] ?></td>
									</tr>
									<?php
								}
								$count++;
								?>
								<tr>                                           
									<th>Total - </th>
									<th>-</th>
									<th>-</th>
									<th>-</th>
									<th>-</th>
									<th>-</th>
									<th>-</th>
									<th>-</th>
									<th>-</th>
									<th>-</th>

									<th>-</th>
									<th style="text-align: right;"><?= sprintf('%.2f', $fees_received_sum) ?></th>

									<th style="text-align: right;"><?= sprintf('%.2f', $ledger_amt_sum) ?></th>
									<th style="text-align: right;"><?= sprintf('%.2f', $late_fees_sum) ?></th>
									<th style="text-align: right;"><?= sprintf('%.2f', $total_fees_sum) ?></th>
									<th style="text-align: right;"><?= sprintf('%.2f', $discount_amt_sum) ?></th>
									<th style="text-align: right;"><?= sprintf('%.2f', $net_fees_sum) ?></th>
									<th style="text-align: right;"><?= sprintf('%.2f', $receipt_amt_sum) ?></th>
									<th style="text-align: right;"><?= sprintf('%.2f', $balance_amt_sum) ?></th>
									<th>-</th>
									<th>-</th>
								</tr>
							</tbody>
						</table>
					</div><!--./box-body-->
				</div>
            </div>
			<?php } ?>
			<?php if (!empty($receipt_data)){ ?>
            <div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header ptbnull">
						<h3 class="box-title titlefix"><i class="fa fa-users"></i> <?php echo $this->lang->line('receipt_book');?></h3>
						<div class="box-tools pull-right"></div>
					</div>
					<div class="box-body table-responsive table-header-sticky" style="overflow: auto;">

						<div class="download_label"><?php echo $this->lang->line('receipt_book');?></div>
						<table class="table table-striped table-bordered table-hover example table-fixed-header sticky-col-5">
							<thead>

								<tr>
									<th>S.No</th>
									<th>Date</th>
									<th>Slip No</th>
									<th>Adm. No</th>
									<th>Student</th>
									<th>Father</th>
									<th>Class</th>
									<th>Sec.</th>
									<th style="text-align: right;">Rec. Amt.</th>
									<th>Mode</th>
									<th>User</th>
									<th>Remark</th>
                                    <th>Action</th>
								</tr>
							</thead>            
							<tbody>    
								<?php
								$total_amount = 0;
								$sno = 1;
								foreach ($receipt_data as $record) {
									$record = (array) $record;
                                    $total_amount += floatval($record["receipt_amt"]);
									?>
									<tr>
										<td><?= $sno++ ?></td>
										<td><?= date('d-m-Y', strtotime($record["date_time"])) ?></td>
										<td><?= $record["receipt_no"] ?></td>
										<td><?= $record["admission_no"] ?></td>
										<td><?= $record["firstname"] . ' ' . $record["middlename"] . ' ' . $record["lastname"] ?></td>
										<td><?= $record["father_name"] ?></td>
										<td><?= $record["class"] ?></td>
										<td><?= $record["section"] ?></td>
										<td style="text-align: right;"><?= sprintf('%.2f', $record["receipt_amt"]) ?></td>
										<td><?= $record["mode"] ?></td>
										<td><?= $record["create_by"] ?></td>
										<td><?= $record["remarks"] ?></td>
										<td>
											<a target="_blank" href="<?php echo base_url(); ?>user/user/callback_receipts_ids_by_receipt_no/
											<?= base64_encode($record["receipt_no"]); ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Print Receipt">
												<i class="fa fa-print"></i>
											</a>
										</td>
									</tr>
									<?php
								}
								$count++;
								?>
								<tr>
									<td class="text-end"><strong>Total</strong></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<th style="text-align: right;"><?= sprintf('%.2f', $total_amount) ?></th>
									<td></td>
									<td></td>
									<td></td>
                                    <td>-</td>
								</tr>
							</tbody>
						</table>
					</div><!--./box-body-->
				</div>
            </div>
			<?php } ?>
            <div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header ptbnull">
						<h3 class="box-title titlefix"><i class="fa fa-users"></i> Received Fees Card</h3>
						<div class="box-tools pull-right"></div>
					</div>
					<div class="box-body">
						<div class="" style="border: 2px solid #f2f2f2; padding: 0rem;margin-top:10px;margin-bottom:10px">
							<table class="table table-bordered">
								<thead class="header">
									
									<tr>
										<th>
											<!-- <input type="checkbox" checked id="select_all_data"/><br> -->
										</th>
										<th>Fees Head</th>
										<?php foreach($months_data as $key=>$value){
										?>
										<th style="text-align: right;"><?=$value?> </th>
										<?php
										} 
										?>
										<th style="text-align: right;">Total</th>
										<!-- <th>Discount</th>
										<th>Received</th>
										<th>Balance</th> -->
									</tr>
								</thead>
								<tbody>
								<?php 


										if(isset($months_data)){

									$statusNew = 0;
									$final_total = 0;
									$aa = 1;
									$column_totals = array_fill(0, count($months_data), 0); // initialize column totals

									// Loop for $data_list
									foreach ($data_list as $row) {
										$db_months = json_decode($row->months);
										$total = 0;
										$statusNew++;
								?>
									<tr>
										<td></td>
										<td><b><?= $row->fees_heading ?></b></td>
										<?php foreach($months_data as $key => $value): ?>
											<td style="text-align: right;">
												<?php 
													// $amount = 0;
													$amount = ($this->db->get_where('receipts', [
														'student_id' => $student_data['id'],
														'months' => $value,
														'fee_head_name' => $row->fees_heading
													])->row()) ? $this->db->get_where('receipts', [
														'student_id' => $student_data['id'],
														'months' => $value,
														'fee_head_name' => $row->fees_heading
													])->row()->fees_received : 0;

													if ($amount != 0 && in_array($value, $db_months)) {
														
														if (is_array($row->amount)) {
															$amount = isset($row->amount[$value]) ? (float)$row->amount[$value] : 0;
															echo $amount;
															$total += $amount;
															$column_totals[$key] += $row->amount[$value];
														}
														else
														{
														echo $row->amount;
														$total += $row->amount;
														$column_totals[$key] += $row->amount;
														}
													} else {
														echo 0;
													}
												?>   
											</td>
										<?php endforeach; ?>
										<td style="text-align: right;"><b><?= $total ?></b></td>
									</tr>
								<?php
										$final_total += $total;
										$aa++;
									}

									// Loop for $route_data_list
									foreach ($route_data_list as $row) {
										$db_months = json_decode($row->months);
										$total = 0;
										$aa++;
										$statusNew++;
								?>
									<tr>
										<td></td>
										<td><b><?= $row->fees_heading ?></b></td>
										<?php foreach($months_data as $key => $value): ?>
											<td style="text-align: right;">
												<?php 
													$amount = ($this->db->get_where('receipts', [
														'student_id' => $student_data['id'],
														'months' => $value,
														'fee_head_name' => $row->fees_heading
													])->row()) ? $this->db->get_where('receipts', [
														'student_id' => $student_data['id'],
														'months' => $value,
														'fee_head_name' => $row->fees_heading
													])->row()->receipt_amt : 0;

													if ($amount != 0 && in_array($value, $db_months)) {
														
														if (is_array($row->amount)) {
														echo $row->amount[$value];
														$total += $row->amount[$value];
														$column_totals[$key] += $row->amount[$value];
														}
														else{
														echo $row->amount;
														$total += $row->amount;
														$column_totals[$key] += $row->amount;
														}
													} else {
														echo 0;
													}
												?>   
											</td>
										<?php endforeach; ?>
										<td style="text-align: right;"><b><?= $total ?> </b></td>
									</tr>
									
								<?php
										$final_total += $total;
									}

									if(!empty($final_total)){
								?>
								<tr>
										<td></td>
										<td><b>Total</b></td>
										<?php foreach ($column_totals as $col_total): ?>
											<td style="text-align: right;"><b><?= $col_total ?></b></td>
										<?php endforeach; ?>
										<td style="text-align: right;"><b><?= $final_total ?></b></td>
									</tr>
									<?php } } ?>

								</tbody>



							</table>
						</div>
					</div><!--./box-body-->
				</div>
            </div>
            <!--/.col (left) -->

        </div>

    </section>

</div>
