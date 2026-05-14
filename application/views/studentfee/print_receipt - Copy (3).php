<!DOCTYPE html>


<?php 

if($_GET['copy']=='2'){

?>
 
  
  
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fee Receipt</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    @media print {
		/* Dynamic Orientation via body class */
		body.a4.portrait {
			page: A4Portrait;
		}
		body.a4.landscape {
			page: A4Landscape;
		}
		body.a5.portrait {
			page: A5Portrait;
		}
		body.a5.landscape {
			page: A5Landscape;
		}
		@page A4Portrait {
			size: A4 portrait;
			margin-left: 10mm;
			margin-right: 5mm;
		}
		@page A4Landscape {
			size: A4 landscape;
			margin-left: 10mm;
			margin-right: 5mm;
		}
		@page A5Portrait {
			size: A5 portrait;
			margin-left: 10mm;
			margin-right: 5mm;
		}
		@page A5Landscape {
			size: A5 landscape;
			margin-left: 10mm;
			margin-right: 5mm;
		}

	  body * {
		visibility: hidden;
		font-family: arial;
	  }
	  body.A4 * {
		font-size: 11px !important;
	  }
	  body.A5 * {
		font-size: 9px !important;
	  }

	  #print-area, #print-area * {
		visibility: visible;
		margin: 0 !important;
		line-height: 1.3 !important;
	  }

	  #print-area {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		display: flex;
		flex-wrap: wrap;
	  }

	  .card-footer,
	  .print-options {
		display: none !important;
	  }

	  /* ========================= */
	  /* 🎯 ALWAYS 2 COPIES */
	  /* ========================= */

	  .receipt-card {
		width: 100% !important;
		max-width: 100% !important;
		box-sizing: border-box;
		padding: 5mm !important;
	  }

	  /* TABLE FIX */
	  .table th, .table td {
		padding: 1pt !important;
	  }

	  h5, span {
		padding: 0 !important;
	  }

	  .accountant-sign {
		padding-top: 1.5rem;
		text-align: right;
		padding-right: 0 !important;
	  }

	  .abd {
		padding: 0 !important;
	  }

	  .footer-content {
		padding: 0 !important;
	  }
	  
	  body.a4 .note-font {
		font-size: 13px !important;
	  }
	  body.a5 .note-font {
		font-size: 11px !important;
	  }
	  body.a4 .head-image {
		height:100px;
	  }
	  body.a5 .head-image {
		height:70px;
	  }
	}

</style>
</head>
<body class="<?php echo $result->fee_receipt_page_size; ?> <?php echo ($result->fee_receipt_print_mode == 2) ? 'portrait' : 'landscape'; ?>">
	<div class="card receipt-card">
		<div class="card-body">
			<div id="print-area">
				<div class="row">
					<div class="col-sm-6" style="padding-left: 0px; padding-top:10px">
						<div  style="border:1px solid;" >
						<?php if($result->rcpt_common_header == 1 && !empty($header_image)){ ?>
							<div class="text-center p-3 pb-0">
								<img src="<?php echo base_url(); ?>/uploads/print_headerfooter/student_receipt/<?php echo $header_image; ?>" class="head-image" style="width:100%">		
							</div>
						<?php } else if($result->rcpt_common_header == 0 && $result->rcpt_header_height != 0) { ?>
							<div style="border:0px; height:<?php echo $result->rcpt_header_height; ?>px"></div>
						<?php } else { ?>
							<?php if ($result->rcpt_student_name) { ?>
							<h5><b><?=$student['firstname']?> <?=$student['middlename']?> <?=$student['lastname']?></b></h5>
							<?php } if ($result->rcpt_address) { ?>
							<span><?=$student['current_address'] ?></span> <br>
							<?php } if ($result->rcpt_mobile_no) { ?>
							<span><b>Phone No.</b>: <?=$student['mobileno']?></span>, 
							<?php } if ($result->rcpt_dob) { ?>
							<span><b>DOB</b>: <?=date('d-m-Y',strtotime($student['dob']))?></span>, 
							<?php } ?>
							<span><b>Email Id.</b>: <?=$student['email']?></span> <br>
							<span><strong>Session: <?=$this->session_model->get($this->setting_model->getCurrentSession())['session']?></strong></span> <br>
						<?php } ?>

							<table class="table mt-1 mb-1" style="border-top:1px solid #000000; border-bottom:1px solid #000000;">
								<thead>
									<tr>
										<th>Rec. No.: <?=$fees[0]->receipt_no?></th>
										<th>School Copy</th>
										<th class="text-end">Date: <?=date('d-m-Y',strtotime($fees[0]->date_time))?></th>
									</tr>
								</thead>
							</table> 

							<div class="d-flex justify-content-between mt-1">
								<div class="p-3 pt-0 pb-0">
								<?php if ($result->rcpt_admission_no) { ?>
									<span><strong style="width:90px; display:inline-block;">Adm. No.</strong> <?=$student['admission_no']?></span> <br>
								<?php } if ($result->rcpt_student_name) { ?>
									<span><strong style="width:90px; display:inline-block;">Student</strong> <?=$student['firstname']?> <?=$student['middlename']?> <?=$student['lastname']?></span> <br>
								<?php } if ($result->rcpt_father && $student['father_name']) { ?>
									<span><strong style="width:90px; display:inline-block;">Father</strong> <?=$student['father_name']?></span> <br>
								<?php } if ($result->rcpt_mother && $student['mother_name']) { ?>
									<span><strong style="width:90px; display:inline-block;">Mother</strong> <?=$student['mother_name']?></span> <br>
								<?php } if ($result->rcpt_class_section) { ?>
									<span><strong style="width:90px; display:inline-block;">Class & Sec</strong> <?=$student['class']?> (<?=$student['section']?>)</span> <br>
								<?php } if ($result->rcpt_fee_months) { ?>
									<?php if($fees[0]->fee_head_name != 'Ledger Amount'){ ?>
									<span><strong style="width:90px; display:inline-block;">Fee Months</strong> <?=sort_by_custom_month_order($month_names)?></span> <br>
									<?php } ?>
								<?php } ?>
								</div>
								<?php if ($result->rcpt_photo) { ?>
								<div class="p-3" style="display: flex; align-items: center;">
									<img src="<?php echo base_url() . $student['image']; ?>" height="85" style="border: 1px solid #fff;outline: 1px solid #000000; width: auto;">
								</div>
								<?php } ?>
							</div>

							<div style="padding:1px">
								<table class="table mt-1 mb-1" >
									<thead>
										<tr style="border-top:1px solid;border-bottom:1px solid">
											<th>Sr.</th>
											<th>Particulars</th>
											<th class="text-end">Total Amt.</th>
										</tr>
									</thead>
									<tbody>
									<?php 
										$i=1; 
										$pay=0;

										foreach($fees as $list)
										{ 
									?>
										<tr>
											<td><?=$i++?></td>
											<td <?php echo $fees[0]->fee_head_name == 'Ledger Amount' ? 'style="font-weight:bold"' : ''; ?>><?=$list->fee_head_name?></td>
											<?php if($list->fee_head_name != 'Ledger Amount') { ?>
											<td class="text-end"><?=$list->total?></td>
											<?php } else { ?>
												<td <?php echo $fees[0]->fee_head_name == 'Ledger Amount' ? 'style="font-weight:bold"' : ''; ?> class="text-end"><?=$list->ledger_amt?></td>
											<?php } ?>
										</tr>
									<?php 
											if($list->fee_head_name != 'Ledger Amount')
											{
												$pay+=$list->total; 
											}
											else{
												$pay = $list->ledger_amt; 
											}
										}
									?>
									<?php if($fees[0]->fee_head_name != 'Ledger Amount'){ ?>
										<tr> 
											<td><?=$i?></td>
											<td >Old Balance</td>
											<td class="text-end"><?=$fees[0]->ledger_amt?></td>
										</tr>
									<?php } ?>
									<?php if ($result->rcpt_total_amt) { ?>
										<tr style="border-top:1px solid">
											<td colspan="2" class="text-end"><strong>Total Amount</strong></td>
											<?php if($fees[0]->fee_head_name!='Ledger Amount'){ ?>
											<td class="text-end"><h6><b><?=$pay+$fees[0]->ledger_amt?></b></h6></td>
											<?php }else{ ?>
											<td class="text-end"><h6><b><?=$pay?></b></h6></td>
											<?php } ?>
										</tr>
									<?php } if ($result->rcpt_late_fee) { ?>
										<tr>
											<td colspan="2" class="text-end">+ Late/Other Fee (If Any)</td>
											<td class="text-end"><?=$fees[0]->late_fees??0?></td>
										</tr>
									<?php } if ($result->rcpt_discount_amt) { ?>
										<tr>
											<td colspan="2" class="text-end">- Discount Amount (If Any)</td>
											<td class="text-end"><?=$fees[0]->discount_amt?></td>
										</tr>
									<?php } if ($result->rcpt_net_amt) { ?>
										<tr style="border-top:1px solid">
											<td colspan="2" class="text-end"><strong>Net Fees</strong></td>
											<td class="text-end"><strong><h6><b>
											<?php
											$ledger = $fees[0]->ledger_amt ?? 0;
											$late   = $fees[0]->late_fees ?? 0;
											$disc   = $fees[0]->discount_amt ?? 0;
											if($fees[0]->fee_head_name!='Ledger Amount'){ 
											  echo $total  = (int)$pay + (int)$ledger + (int)$late - (int)$disc;
											}else{
											  echo $total  = (int)$pay + (int)$late - (int)$disc;
											}
											?>
											</b></h6></strong></td>
										</tr>
									<?php } if ($result->rcpt_received_amt) { ?>
										<tr>
											<td colspan="2" class="text-end">Received Amount</td>
											<td class="text-end"><?=$fees[0]->receipt_amt?></td>
										</tr>
									<?php } if ($result->rcpt_balance_amt) { ?>
										<tr>
											<td colspan="2" class="text-end">Balance Amount</td>
											<td class="text-end"><?=$fees[0]->balance_amt?></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
							<?php if ($result->rcpt_amt_in_words) { ?>
							<div class="row">
								<div class="col-12"><h6><b>Received</b> : <?=number_to_words($fees[0]->receipt_amt);?> Only</h6></div>
							</div>
							<?php } ?>
							<div class="row">
								<div class="col-8">
									<div class="abd">
									<?php if ($result->rcpt_pay_mode) { ?>
										<h5><strong>Payment Mode :  <?=$fees[0]->mode?> </strong></h5>
									<?php } if ($result->rcpt_remark) { ?>
										<span><strong>Remark:</strong> <?=$fees[0]->remarks?></span> <br>
									<?php } if ($result->rcpt_created_by) { ?>  
									   <label class="f12_new" for=""><b>Created By</b> : <span><?= implode(' ', array_filter([$create_by->name ?? '',$create_by->surname ?? ''])); ?> (<?=$create_by->employee_id?>)</span></label>
									<?php } ?>
									</div>
								</div>
								<div class="col-4">
									<div class="accountant-sign">
										<h6>Accountant Sign</h6>
									</div>
								</div>
							</div>
							<?php if ($result->rcpt_note) { ?>
							<div class="row">
								<div class="col-12">
									<div class="footer-content">
										<label class="f12_new" for="">
										<?php
											if (!empty($footer_text)) {
												echo $footer_text;
											} else {
												echo '<b>Note</b> : <span style="note-font">This is a System Generated Slip Not Required Stamp.</span>';
											}
										?>
										</label>
									</div>
								</div>
							</div>
							<?php } ?>
							<?php if($result->rcpt_common_header == 0 && $result->rcpt_footer_height != 0) { ?>
							<div style="height:<?php echo $result->rcpt_footer_height; ?>px"></div>
							<?php } ?>
						</div>
					</div>
					<div class="col-sm-6" style="padding-left: 0px;  padding-top:10px">
						<div  style="border:1px solid;" >
						<?php if($result->rcpt_common_header == 1 && !empty($header_image)){ ?>
							<div class="text-center p-3 pb-0">
								<img src="<?php echo base_url(); ?>/uploads/print_headerfooter/student_receipt/<?php echo $header_image; ?>" style="height:100px;width:100%">		
							</div>
						<?php } else if($result->rcpt_common_header == 0 && $result->rcpt_header_height != 0) { ?>
							<div style="border:0px; height:<?php echo $result->rcpt_header_height; ?>px"></div>
						<?php } else { ?>
							<?php if ($result->rcpt_student_name) { ?>
							<h5><b><?=$student['firstname']?> <?=$student['middlename']?> <?=$student['lastname']?></b></h5>
							<?php } if ($result->rcpt_address) { ?>
							<span><?=$student['current_address'] ?></span> <br>
							<?php } if ($result->rcpt_mobile_no) { ?>
							<span><b>Phone No.</b>: <?=$student['mobileno']?></span>, 
							<?php } if ($result->rcpt_dob) { ?>
							<span><b>DOB</b>: <?=date('d-m-Y',strtotime($student['dob']))?></span>, 
							<?php } ?>
							<span><b>Email Id.</b>: <?=$student['email']?></span> <br>
							<span><strong>Session: <?=$this->session_model->get($this->setting_model->getCurrentSession())['session']?></strong></span> <br>
						<?php } ?>
							<table class="table mt-1 mb-1">
								<thead>
									<tr style="border-top:1px solid #000000; border-bottom:1px solid #000000;">
										<th>Rec. No.: <?=$fees[0]->receipt_no?></th>
										<th>Parent Copy</th>
										<th class="text-end">Date: <?=date('d-m-Y',strtotime($fees[0]->date_time))?></th>
									</tr>
								</thead>
							</table>
							<div class="d-flex justify-content-between mt-1">
								<div class="p-3 pt-0 pb-0">
								<?php if ($result->rcpt_admission_no) { ?>
									<span><strong style="width:90px; display:inline-block;">Adm. No.</strong> <?=$student['admission_no']?></span> <br>
								<?php } if ($result->rcpt_student_name) { ?>
									<span><strong style="width:90px; display:inline-block;">Student</strong> <?=$student['firstname']?> <?=$student['middlename']?> <?=$student['lastname']?></span> <br>
								<?php } if ($result->rcpt_father && $student['father_name']) { ?>
									<span><strong style="width:90px; display:inline-block;">Father</strong> <?=$student['father_name']?></span> <br>
								<?php } if ($result->rcpt_mother && $student['mother_name']) { ?>
									<span><strong style="width:90px; display:inline-block;">Mother</strong> <?=$student['mother_name']?></span> <br>
								<?php } if ($result->rcpt_class_section) { ?>
									<span><strong style="width:90px; display:inline-block;">Class & Sec</strong> <?=$student['class']?> (<?=$student['section']?>)</span> <br>
								<?php } if ($result->rcpt_fee_months) { ?>
									<?php if($fees[0]->fee_head_name != 'Ledger Amount'){ ?>
									<span><strong style="width:90px; display:inline-block;">Fee Months</strong> <?=sort_by_custom_month_order($month_names)?></span> <br>
									<?php } ?>
								<?php } ?>
								</div>
								<?php if ($result->rcpt_photo) { ?>
									<div class="p-3" style="display: flex; align-items: center;">
										<img src="<?php echo base_url() . $student['image']; ?>" height="85" style="border: 1px solid #fff;outline: 1px solid #000000; width: auto;">
									</div>
								<?php } ?>
							</div>
							<div style="padding:1px">
								<table class="table mt-1 mb-1" >
									<thead>
										<tr style="border-top:1px solid;border-bottom:1px solid">
											<th>Sr.</th>
											<th>Particulars</th>
											<th class="text-end">Total Amt.</th>
										</tr>
									</thead>
									<tbody>
									<?php $i=1; $pay=0; foreach($fees as $list){ ?>
										<tr>
											<td><?=$i++?></td>
											<td <?php echo $fees[0]->fee_head_name == 'Ledger Amount' ? 'style="font-weight:bold"' : ''; ?>><?=$list->fee_head_name?></td>
											<?php if($list->fee_head_name != 'Ledger Amount') { ?>
											<td class="text-end"><?=$list->total?></td>
											<?php } else { ?>
											<td <?php echo $fees[0]->fee_head_name == 'Ledger Amount' ? 'style="font-weight:bold"' : ''; ?> class="text-end"><?=$list->ledger_amt?></td>
											<?php } ?>
										</tr>
									<?php 
											if($list->fee_head_name != 'Ledger Amount')
											{
												$pay+=$list->total; 
											}
											else{
												$pay = $list->ledger_amt; 
											}
										} 
									?>
									<?php if($fees[0]->fee_head_name != 'Ledger Amount'){ ?>
										<tr> 
											<td><?=$i?></td>
											<td >Old Balance</td>
											<td class="text-end"><?=$fees[0]->ledger_amt?></td>
										</tr>
									<?php } ?>
									<?php if ($result->rcpt_total_amt) { ?>
										<tr style="border-top:1px solid">
											<td colspan="2" class="text-end"><strong>Total Amount</strong></td>
											<?php if($fees[0]->fee_head_name!='Ledger Amount'){ ?>
											<td class="text-end"><h6><b><?=$pay+$fees[0]->ledger_amt?></b></h6></td>
											<?php }else{ ?>
											<td class="text-end"><h6><b><?=$pay?></b></h6></td>
											<?php } ?>
										</tr>
									<?php } if ($result->rcpt_late_fee) { ?>
										<tr>
											<td colspan="2" class="text-end">+ Late/Other Fee (If Any)</td>
											<td class="text-end"><?=$fees[0]->late_fees??0?></td>
										</tr>
									<?php } if ($result->rcpt_discount_amt) { ?>
										<tr>
											<td colspan="2" class="text-end">- Discount Amount (If Any)</td>
											<td class="text-end"><?=$fees[0]->discount_amt?></td>
										</tr>
									<?php } if ($result->rcpt_net_amt) { ?>
										<tr style="border-top:1px solid">
											<td colspan="2" class="text-end"><strong>Net Fees</strong></td>
											<td class="text-end"><strong><h6><b>
											<?php
												$ledger = $fees[0]->ledger_amt ?? 0;
												$late   = $fees[0]->late_fees ?? 0;
												$disc   = $fees[0]->discount_amt ?? 0;
												if($fees[0]->fee_head_name!='Ledger Amount'){ 
													echo $total  = (int)$pay + (int)$ledger + (int)$late - (int)$disc;
												}else{
													echo $total  = (int)$pay + (int)$late - (int)$disc;
												}
											?>
											</b></h6></strong></td>
										</tr>
									  <?php } if ($result->rcpt_received_amt) { ?>
										<tr>
											<td colspan="2" class="text-end">Received Amount</td>
											<td class="text-end"><?=$fees[0]->receipt_amt?></td>
										</tr>
									  <?php } if ($result->rcpt_balance_amt) { ?>
										<tr>
											<td colspan="2" class="text-end">Balance Amount</td>
											<td class="text-end"><?=$fees[0]->balance_amt?></td>
										</tr>
									  <?php } ?>
									</tbody>
								</table>
							</div>
							<?php if ($result->rcpt_amt_in_words) { ?>
							<div class="row">
								<div class="col-12"><h6><b>Received</b> : <?=number_to_words($fees[0]->receipt_amt);?> Only</h6></div>
							</div>
							<?php } ?>
							<div class="row">
								<div class="col-8">
									<div class="abd">
									<?php if ($result->rcpt_pay_mode) { ?>
										<h5><strong>Payment Mode :  <?=$fees[0]->mode?> </strong></h5>
									<?php } if ($result->rcpt_remark) { ?>
										<span><strong>Remark:</strong> <?=$fees[0]->remarks?></span> <br>
									<?php } if ($result->rcpt_created_by) { ?>
										<label class="f12_new" for=""><b>Created By</b> : <span><?= implode(' ', array_filter([$create_by->name ?? '',$create_by->surname ?? ''])); ?> (<?=$create_by->employee_id?>)</span></label>
									<?php } ?>
									</div>
								</div>
								<div class="col-4">
									<div class="accountant-sign">
										<h6>Accountant Sign</h6>
									</div>
								</div>
							</div>
							<?php if ($result->rcpt_note) { ?>
							<div class="row">
								<div class="col-12">
									<div class="footer-content">
										<label class="f12_new" for="">
										<?php
											if (!empty($footer_text)) {
												echo $footer_text;
											} else {
												echo '<b>Note</b> : <span style="note-font">This is a System Generated Slip Not Required Stamp.</span>';
											}
										?>
										</label>
									</div>
								</div>
							</div>
							<?php } ?>
							<?php if($result->rcpt_common_header == 0 && $result->rcpt_footer_height != 0) { ?>
								<div style="height:<?php echo $result->rcpt_footer_height; ?>px"></div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<div class="print-options mt-4">
				<p><strong>Print Copy:</strong></p>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" name="copy" id="one" value="1"
					onclick="setCopyValue(1)" <?= ($_GET['copy'] ?? '') == '1' ? 'checked' : 'checked' ?>>
				  <label class="form-check-label" for="one">One Copy</label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" name="copy" id="two" value="2"
					onclick="setCopyValue(2)" <?= ($_GET['copy'] ?? '') == '2' ? 'checked' : '' ?>>
				  <label class="form-check-label" for="two">Two Copy</label>
				</div>
			</div>
		</div>

		<div class="card-footer d-flex justify-content-end gap-2">
			<!-- <button class="btn btn-secondary">Cancel</button> -->
			<a href="<?=base_url()?>studentfee"><button class="btn btn-success">Back</button></a>
			<button class="btn btn-primary"  onclick="window.print()" >Print</button>
		</div>
	</div>
</body>
</html>

<script>
  function setCopyValue(val) {
    const url = new URL(window.location.href);
    url.searchParams.set('copy', val);
    window.location.href = url.toString();
  }
</script>


<?php

}else{
  ?>
  
  
  
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fee Receipt</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    @media print {

	  /* 🔥 Dynamic Orientation via body class */
		body.a4.portrait {
			page: A4Portrait;
		}
		body.a4.landscape {
			page: A4Landscape;
		}
		body.a5.portrait {
			page: A5Portrait;
		}
		body.a5.landscape {
			page: A5Landscape;
		}
		@page A4Portrait {
			size: A4 portrait;
			margin-left: 10mm;
			margin-right: 10mm;
		}
		@page A4Landscape {
			size: A4 landscape;
			margin-left: 10mm;
			margin-right: 10mm;
		}
		@page A5Portrait {
			size: A5 portrait;
			margin-left: 10mm;
			margin-right: 10mm;
		}
		@page A5Landscape {
			size: A5 landscape;
			margin-left: 10mm;
			margin-right: 10mm;
		}

	  body * {
		visibility: hidden;
		font-family: arial;
	  }
	  body.A4 * {
		font-size: 11px !important;
	  }
	  body.A5 * {
		font-size: 9px !important;
	  }

	  #print-area, #print-area * {
		visibility: visible;
		margin: 0 !important;
		line-height: 1.3 !important;
	  }

	  #print-area {
		position: absolute;
		top: 0;
		left: 0;
		width: 50%;
		display: flex;
		flex-wrap: wrap;
	  }

	  .card-footer,
	  .print-options {
		display: none !important;
	  }

	  /* ========================= */
	  /* 🎯 ALWAYS 1 COPY */
	  /* ========================= */

	  .receipt-card {
		  width: 100% !important;
		  max-width: 100% !important;
		  box-sizing: border-box;
		  padding: 5mm !important;
		  page-break-after: always;   /* 🔥 Important */
		  break-after: page;          /* modern support */
		}
		.receipt-card:last-child {
		  page-break-after: auto;
		}

	  /* TABLE FIX */
	  .table th, .table td {
		padding: 1pt !important;
	  }

	  body.A4 h5, span {
		font-size: 11px !important;
		padding: 0 !important;
	  }
	  body.A5 h5, span {
		font-size: 9px !important;
		padding: 0 !important;
	  }

	  .accountant-sign {
		padding-top: 1.5rem;
		text-align: right;
		padding-right: 0 !important;
	  }

	  .abd {
		padding: 0 !important;
	  }

	  .footer-content {
		padding: 0 !important;
	  }
		body.a4 .note-font {
		font-size: 13px !important;
	  }

	  /* A5 */
	  body.a5 .note-font {
		font-size: 11px !important;
	  }
	  
	  body.a4 .head-image {
		height:100px;
	  }
	  body.a5 .head-image {
		height:70px;
	  }
	}

  </style>
</head>
<body class="<?php echo $result->fee_receipt_page_size; ?> <?php echo ($result->fee_receipt_print_mode == 2) ? 'portrait' : 'landscape'; ?>">
  <div class="card receipt-card">
   
  

    <div class="card-body">
      <!-- <div class="student-name">Nitya Sharma D/o Durgesh Sharma</div> -->

     <?php //echo '<pre>'; print_r($result); echo '</pre>';?>

    <div id="print-area">
        <div  style="padding-left: 0px; padding-right: 0px; padding-top:10px" >
            <div  style="border:1px solid;" >
				<?php if($result->rcpt_common_header == 1 && !empty($header_image)){ ?>
					<div class="text-center p-3 pb-0">
						<img src="<?php echo base_url(); ?>/uploads/print_headerfooter/student_receipt/<?php echo $header_image; ?>" class="head-image" style="width:100%">		
					</div>
				<?php } else if($result->rcpt_common_header == 0 && $result->rcpt_header_height != 0) { ?>
					<div style="border:0px; height:<?php echo $result->rcpt_header_height; ?>px"></div>
				<?php } else { ?>
					<?php if ($result->rcpt_student_name) { ?>
					<h5><b><?=$student['firstname']?> <?=$student['middlename']?> <?=$student['lastname']?></b></h5>
					<?php } if ($result->rcpt_address) { ?>
					<span><?=$student['current_address'] ?></span> <br>
					<?php } if ($result->rcpt_mobile_no) { ?>
					<span><b>Phone No.</b>: <?=$student['mobileno']?></span>, 
					<?php } if ($result->rcpt_dob) { ?>
					<span><b>DOB</b>: <?=date('d-m-Y',strtotime($student['dob']))?></span>, 
					<?php } ?>
					<span><b>Email Id.</b>: <?=$student['email']?></span> <br>
					<span><strong>Session: <?=$this->session_model->get($this->setting_model->getCurrentSession())['session']?></strong></span> <br>
				<?php } ?>


                    <table class="table mt-1 mb-1">
                        <thead>
                            <tr style="border-top:1px solid #000000; border-bottom:1px solid #000000;">
                                <th>Rec. No.: <?=$fees[0]->receipt_no?></th>
								<th>Parent Copy</th>
                                <th class="text-end">Date: <?=date('d-m-Y',strtotime($fees[0]->date_time))?></th>
                            </tr>
                        </thead>
                    </table> 

                    <div class="d-flex justify-content-between mt-1">
                      <div class="p-3 pt-0 pb-0">
						<?php if ($result->rcpt_admission_no) { ?>
                          <span><strong style="width:90px; display:inline-block;">Adm. No.</strong> <?=$student['admission_no']?></span> <br>
						<?php } if ($result->rcpt_student_name) { ?>
                          <span><strong style="width:90px; display:inline-block;">Student</strong> <?=$student['firstname']?> <?=$student['middlename']?> <?=$student['lastname']?></span> <br>
						<?php } if ($result->rcpt_father && $student['father_name']) { ?>
                          <span><strong style="width:90px; display:inline-block;">Father</strong> <?=$student['father_name']?></span> <br>
						<?php } if ($result->rcpt_mother && $student['mother_name']) { ?>
                          <span><strong style="width:90px; display:inline-block;">Mother</strong> <?=$student['mother_name']?></span> <br>
						<?php } if ($result->rcpt_class_section) { ?>
                          <span><strong style="width:90px; display:inline-block;">Class & Sec</strong> <?=$student['class']?> (<?=$student['section']?>)</span> <br>
						<?php } if ($result->rcpt_fee_months) { ?>
                           <?php if($fees[0]->fee_head_name != 'Ledger Amount'){ ?>
                          <span><strong style="width:90px; display:inline-block;">Fee Months</strong> <?=sort_by_custom_month_order($month_names)?></span> <br>
                          <?php } ?>
                        <?php } ?>
                          <!-- <span><strong style="width:90px; display:inline-block;">Note</strong> This is a System Generated Slip Not Required Stamp.</span>  -->
                      </div>
					  <?php if ($result->rcpt_photo) { ?>
						  <div class="p-3" style="display: flex; align-items: center;">
							<img src="<?php echo base_url() . $student['image']; ?>" height="85" style="border: 1px solid #fff;outline: 1px solid #000000; width: auto;">
						  </div>
						<?php } ?>
                    </div>

                    <div style="padding:1px">

                            
                    <table class="table mt-1 mb-1" >
                        <thead>
                        <?php if($fees[0]->fee_head_name == 'Ledger Amount'){ ?>
                        <!--<tr> 
                            <th></th>
                            <th class="text-end">Old Balance</th>
                            <th class="text-end"><?=$fees[0]->ledger_amt?></th>
                        </tr>-->
                        <?php } ?>
                        <tr style="border-top:1px solid;border-bottom:1px solid">
                            <th>Sr.</th>
                            <th>Particulars</th>
                            <th class="text-end">Total Amt.</th>
                        </tr>
                        </thead>
                        <tbody>


                        <?php $i=1; $pay=0; foreach($fees as $list){ ?>
                        <tr>
                            <td><?=$i++?></td>
                            <td <?php echo $fees[0]->fee_head_name == 'Ledger Amount' ? 'style="font-weight:bold"' : ''; ?>><?=$list->fee_head_name?></td>
							<?php 
								if($list->fee_head_name != 'Ledger Amount')
								{
								?>
								<td class="text-end"><?=$list->total?></td>
								<?php 
								}
								else{
								?>
									<td <?php echo $fees[0]->fee_head_name == 'Ledger Amount' ? 'style="font-weight:bold"' : ''; ?> class="text-end"><?=$list->ledger_amt?></td>
								<?php 
								}
							?>
                        </tr>
                        <?php 
							if($list->fee_head_name != 'Ledger Amount')
							{
								$pay+=$list->total; 
							}
							else{
								$pay = $list->ledger_amt; 
							}
						} 
						?>
                         <?php if($fees[0]->fee_head_name != 'Ledger Amount'){ ?>
                        <tr> 
                            <td><?=$i?></td>
                            <td >Old Balance</td>
                            <td class="text-end"><?=$fees[0]->ledger_amt?></td>
                        </tr>
                        <?php } ?>
						<?php if ($result->rcpt_total_amt) { ?>
                        <tr style="border-top:1px solid">
                            <td colspan="2" class="text-end"><strong>Total Amount</strong></td>
                            <?php if($fees[0]->fee_head_name!='Ledger Amount'){ ?>
                            <td class="text-end"><h6><b><?=$pay+$fees[0]->ledger_amt?></b></h6></td>
                            <?php }else{ ?>
                            <td class="text-end"><h6><b><?=$pay?></b></h6></td>
                            <?php } ?>
                        </tr>
						<?php } if ($result->rcpt_late_fee) { ?>
                        <tr>
                            <td colspan="2" class="text-end">+ Late/Other Fee (If Any)</td>
                            <td class="text-end"><?=$fees[0]->late_fees??0?></td>
                        </tr>
						<?php } if ($result->rcpt_discount_amt) { ?>
                        <tr>
                            <td colspan="2" class="text-end">- Discount Amount (If Any)</td>
                            <td class="text-end"><?=$fees[0]->discount_amt?></td>
                        </tr>
						<?php } if ($result->rcpt_net_amt) { ?>
                        <tr style="border-top:1px solid">
                            <td colspan="2" class="text-end"><strong>Net Fees</strong></td>
                            <td class="text-end"><strong><h6><b>
                            <?php
                            $ledger = $fees[0]->ledger_amt ?? 0;
                            $late   = $fees[0]->late_fees ?? 0;
                            $disc   = $fees[0]->discount_amt ?? 0;
                            if($fees[0]->fee_head_name!='Ledger Amount'){ 
                              echo $total  = (int)$pay + (int)$ledger + (int)$late - (int)$disc;
                            }else{
                              echo $total  = (int)$pay + (int)$late - (int)$disc;
                            }
                            
                            ?>
                            </b></h6></strong></td>
                        </tr>
						<?php } if ($result->rcpt_received_amt) { ?>
                        <tr>
                            <td colspan="2" class="text-end">Received Amount</td>
                            <td class="text-end"><?=$fees[0]->receipt_amt?></td>
                        </tr>
						<?php } if ($result->rcpt_balance_amt) { ?>
                        <tr>
                            <td colspan="2" class="text-end">Balance Amount</td>
                            <td class="text-end"><?=$fees[0]->balance_amt?></td>
                        </tr>
						<?php } ?>
                        </tbody>
                    </table>

                    </div>


					<?php if ($result->rcpt_amt_in_words) { ?>
					<div class="row">
						<div class="col-12"><h6><b>Received</b> : <?=number_to_words($fees[0]->receipt_amt);?> Only</h6></div>
					</div>
					<?php } ?>
                    <div class="row">
                      <div class="col-8">
                        <div class="abd">
						  <?php if ($result->rcpt_pay_mode) { ?>
                          <h5><strong>Payment Mode :  <?=$fees[0]->mode?> </strong></h5>
						  <?php } if ($result->rcpt_remark) { ?>
                          <span><strong>Remark:</strong> <?=$fees[0]->remarks?></span> <br>
                          <?php } if ($result->rcpt_created_by) { ?>
						    <label class="f12_new" for=""><b>Created By</b> : <span>
							<?= implode(' ', array_filter([
								$create_by->name ?? '',
								$create_by->surname ?? ''
							])); ?> (<?=$create_by->employee_id?>)</span></label>
							<?php } ?>
                          </div>
                      </div>

                      
						<div class="col-4">
							<div class="accountant-sign">
								<h6>Accountant Sign</h6>
							</div>
						</div>

                    </div>
					<?php if ($result->rcpt_note) { ?>
					<div class="row">
						<div class="col-12">
						<div class="footer-content">
						  <label class="f12_new" for="">
						  <?php
							if (!empty($footer_text)) {
								echo $footer_text;
							} else {
								echo '<b>Note</b> : <span class="note-font">This is a System Generated Slip Not Required Stamp.</span>';
							}
						  ?>
						   </label>
						</div>
						</div>
					</div>
					<?php } ?>
					<?php if($result->rcpt_common_header == 0 && $result->rcpt_footer_height != 0) { ?>
						<div style="height:<?php echo $result->rcpt_footer_height; ?>px"></div>
					<?php } ?>
                
        </div>

		</div>
    </div>









      <div class="print-options mt-4">
        <p><strong>Print Copy:</strong></p>
        
        
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="copy" id="one" value="1"
            onclick="setCopyValue(1)" <?= ($_GET['copy'] ?? '') == '1' ? 'checked' : 'checked' ?>>
          <label class="form-check-label" for="one">One Copy</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="copy" id="two" value="2"
            onclick="setCopyValue(2)" <?= ($_GET['copy'] ?? '') == '2' ? 'checked' : '' ?>>
          <label class="form-check-label" for="two">Two Copy</label>
        </div>
        <!-- <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="copy" id="three" value="3"
            onclick="setCopyValue(3)" <?= ($_GET['copy'] ?? '') == '3' ? 'checked' : '' ?>>
          <label class="form-check-label" for="three">Three Copy</label>
        </div> -->
      </div>
    </div>









    <div class="card-footer d-flex justify-content-end gap-2">
      <!-- <button class="btn btn-secondary">Cancel</button> -->
      <a href="<?=base_url()?>studentfee"><button class="btn btn-success">Back</button></a>
      <button class="btn btn-primary"  onclick="window.print()" >Print</button>
    </div>
  </div>
</body>
</html>

<script>
  function setCopyValue(val) {
    const url = new URL(window.location.href);
    url.searchParams.set('copy', val);
    window.location.href = url.toString();
  }
</script>

  
  
  
  
  <?php
} 

?>
