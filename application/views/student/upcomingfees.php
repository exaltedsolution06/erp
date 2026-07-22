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
										<h5>
											<input type="checkbox" class="prev-checkbox" id="prev-checkbox" value="<?= format_amount($student_data['previous_session_balance']) ?>">
											<label style="font-size: 12px;font-weight: bold;" for="prev-checkbox">PREV AMT : Rs. <?=format_amount($student_data['previous_session_balance'])?></label>
										</h5>
                                        <h5>
											<input type="checkbox" class="ledger-checkbox" id="ledger-checkbox" value="<?= format_amount($student_data['fees_discount']) ?>">
											<label style="font-size: 12px;font-weight: bold;" for="ledger-checkbox">LEDG AMT : Rs. <?=format_amount($student_data['fees_discount'])?></label>
										</h5>
										
                                        <!--<h4>LEDGER AMT</h4>
                                        <h5>
											<input type="checkbox" class="ledger-checkbox" id="ledger-checkbox" value="<?= format_amount($student_data['fees_discount']) ?>">
											<label for="ledger-checkbox">Rs. <?=format_amount($student_data['fees_discount'])?></label>
										</h5>-->
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
                        </div>

                </div>


            </div>
            <div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header ptbnull">
						<h3 class="box-title titlefix"><i class="fa fa-users"></i> Due Fees Card</h3>
						<div class="box-tools pull-right"></div>
					</div>
					<div class="box-body">
						<div class="" style="border: 2px solid #f2f2f2; padding: 0rem;margin-top:10px;margin-bottom:10px">
							<?php
								$column_totals = array_fill(0, count($months_data), 0);
								$final_total = 0;

								/*
								|--------------------------------------------------------------------------
								| Calculate Column Totals First
								|--------------------------------------------------------------------------
								*/

								foreach ($data_list as $row)
								{
									$db_months = json_decode($row->months);

									foreach($months_data as $key => $value)
									{
										$amount = ($this->db->get_where('receipts', [
											'student_id' => $student_data['id'],
											'months' => $value,
											'fee_head_name' => $row->fees_heading
										])->row()) ? $this->db->get_where('receipts', [
											'student_id' => $student_data['id'],
											'months' => $value,
											'fee_head_name' => $row->fees_heading
										])->row()->fees_received : 0;

										if ($amount == 0 && in_array($value, $db_months))
										{
											if (is_array($row->amount))
											{
												$amt = isset($row->amount[$value])
													? (float)$row->amount[$value]
													: 0;
											}
											else
											{
												$amt = $row->amount;
											}

											$column_totals[$key] += $amt;
											$final_total += $amt;
										}
									}
								}

								foreach ($route_data_list as $row)
								{
									$db_months = json_decode($row->months);

									foreach($months_data as $key => $value)
									{
										$amount = ($this->db->get_where('receipts', [
											'student_id' => $student_data['id'],
											'months' => $value,
											'fee_head_name' => $row->fees_heading
										])->row()) ? $this->db->get_where('receipts', [
											'student_id' => $student_data['id'],
											'months' => $value,
											'fee_head_name' => $row->fees_heading
										])->row()->receipt_amt : 0;

										if ($amount == 0 && in_array($value, $db_months))
										{
											if (is_array($row->amount))
											{
												$amt = $row->amount[$value];
											}
											else
											{
												$amt = $row->amount;
											}

											$column_totals[$key] += $amt;
											$final_total += $amt;
										}
									}
								}

							?>
							<table class="table table-bordered">
								<thead class="header">
									
									<tr>
										<th>
											<!-- <input type="checkbox" checked id="select_all_data"/><br> -->
										</th>
										<th>Fees Head</th>
										<?php foreach($months_data as $key=>$value){
											if($column_totals[$key] > 0){
										?>
										<th style="text-align: right;">
											<input type="checkbox" id="month_<?= $value ?>" class="month-checkbox" data-month="<?= $value ?>">
											<label for="month_<?= $value ?>"><strong><?=$value?> </strong></label>
										</th>
										<?php
											} 
										} 
										?>
										<!--<th style="text-align: right;">Total</th>
										 <th>Discount</th>
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
									$column_total = array_fill(0, count($months_data), 0); // initialize column totals

									// Loop for $data_list
									foreach ($data_list as $row) {
										$db_months = json_decode($row->months);
										$total = 0;
										$statusNew++;
								?>
									<tr>
										<td></td>
										<td><b><?= $row->fees_heading ?></b></td>
										<?php foreach($months_data as $key => $value):
												if($column_totals[$key] <= 0) continue;
										?>
											<?php
												$tdAmount = 0;
												$amount = ($this->db->get_where('receipts', [
													'student_id' => $student_data['id'],
													'months' => $value,
													'fee_head_name' => $row->fees_heading
												])->row()) ? $this->db->get_where('receipts', [
													'student_id' => $student_data['id'],
													'months' => $value,
													'fee_head_name' => $row->fees_heading
												])->row()->fees_received : 0;

												if ($amount == 0 && in_array($value, $db_months)) {
													
													if (is_array($row->amount)) 
													{
														$amount = isset($row->amount[$value]) ? (float)$row->amount[$value] : 0;
														$tdAmount = $amount;
														$total += $amount;
														$column_total[$key] += $row->amount[$value];
													}
													else
													{
													$tdAmount = $row->amount;
													$total += $row->amount;
													$column_total[$key] += $row->amount;
													}
												}
											?>   
											<td style="text-align: right;" class="month-amount" data-month="<?= $value ?>" data-amount="<?= $tdAmount ?>">
											<?= format_amount($tdAmount); ?>
											</td>
										<?php endforeach; ?>
										<!--<td style="text-align: right;"><b><?= $total ?></b></td>-->
									</tr>
								<?php
										$final_total += $total;
										$aa++;
									}
										// echo '<pre>';print_r($column_totals);exit;

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
										<?php foreach($months_data as $key => $value):
												if($column_totals[$key] <= 0) continue;
										?>
											<?php 
												$tdAmount = 0;
												$amount = ($this->db->get_where('receipts', [
													'student_id' => $student_data['id'],
													'months' => $value,
													'fee_head_name' => $row->fees_heading
												])->row()) ? $this->db->get_where('receipts', [
													'student_id' => $student_data['id'],
													'months' => $value,
													'fee_head_name' => $row->fees_heading
												])->row()->receipt_amt : 0;

												if ($amount == 0 && in_array($value, $db_months)) {
													if (is_array($row->amount)) {
													$tdAmount = $row->amount[$value];
													$total += $row->amount[$value];
													$column_total[$key] += $row->amount[$value];
													}
													else{
													$tdAmount = $row->amount;
													$total += $row->amount;
													$column_total[$key] += $row->amount;
													}
												}
											?> 
											<td style="text-align: right;" class="month-amount" data-month="<?= $value ?>" data-amount="<?= $tdAmount ?>"> 
												<?= format_amount($tdAmount); ?>											
											</td>
										<?php endforeach; ?>
										<!--<td style="text-align: right;"><b><?= $total ?> </b></td>-->
									</tr>
									
								<?php
										$final_total += $total;
									}

									if(!empty($final_total)){
								?>
								<tr>
										<td></td>
										<td><b>Total</b></td>
										<?php 
											foreach ($column_total as $col_total):
												if($col_total <= 0) continue;
										?>
											<td style="text-align: right;"><b><?= $col_total ?></b></td>
										<?php endforeach; ?>
										<!--<td style="text-align: right;"><b><?= $final_total ?></b></td>-->
									</tr>
									<?php } } ?>

								</tbody>



							</table>
							<div class="text-right" style="margin: 0 0 10px 0">
								<button type="button" class="btn btn-sm btn-primary">Total Rs.<span id="total">0</span></button>
							</div>
						</div>
					</div><!--./box-body-->
				</div>
            </div>
            <!--/.col (left) -->

        </div>

    </section>

</div>
<script>
function calculateTotal()
{
    let total = 0;

    // Month checkbox totals
    $('.month-checkbox:checked').each(function () {
        let month = $(this).data('month');
        $('.month-amount[data-month="' + month + '"]').each(function () {
            total += parseFloat($(this).data('amount')) || 0;
        });
    });

    // Ledger checkbox total
    $('.ledger-checkbox:checked').each(function () {
        total += parseFloat($(this).val()) || 0;
    });

    // Previous checkbox total
    $('.prev-checkbox:checked').each(function () {
        total += parseFloat($(this).val()) || 0;
    });

    // $('#total').text(total.toFixed(2));
	$('#total').text(Number.isInteger(total) ? total : total.toFixed(2));
}

// Month checkbox
$('.month-checkbox').on('change', function () {
    calculateTotal();
});

// Ledger checkbox
$('.ledger-checkbox').on('change', function () {
    calculateTotal();
});
// Previous checkbox
$('.prev-checkbox').on('change', function () {
    calculateTotal();
});
</script>
