<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
//echo "<pre>";print_r($data_list);die;
//echo "<pre>";print_r($route_data_list);die;
?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box removeboxmius">
                    <div class="box-header ptbnull">
						<h4>Fee Discount</h4>
					</div>
                    <div class="">
                        <div class="box-header ptbnull row">
                            <div class="form-group col-md-8" style="position: relative;">
                                <label>Student Search</label>
                                <input type="text" id="searchInput" name="search_text" class="form-control" placeholder="Search By Student Name, Roll Number, Enroll Number, National Id, Local Id Etc." value="<?= $src_name ?>">
                                <ul id="suggestionsList" class="list-group" style="position: absolute; z-index: 1000; width: 100%; display: none;"></ul>
                            </div>
                        </div> 
						<?php if (!empty($student_data)){ ?>
                        <div class="box-body" style="padding-top: 20px;">
                            <div class="row mb-2 mt-5">
                                <!-- Student Information Section -->
                                <div class="col-md-12">
                                    <div  style="border: 2px solid #f2f2f2; padding: 0rem;">
                                        <table class="table table-bordered table-striped">
                                            <tbody>                                                
                                                <tr>
                                                    <td rowspan="4">
                                                        <img width="90" height="90" class="round5" src="<?php
                                                        if (!empty($student_data['image'])) {
                                                            echo base_url() . $student_data['image'];
                                                        } else {
                                                            echo base_url() . "uploads/student_images/no_image.png";
                                                        }
                                                        ?>" alt="No Image">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Name</strong></td>
                                                    <td><strong>Father</strong></td>
                                                    <td><strong>Mother</strong></td>
                                                </tr>
                                                <tr>
                                                    <td id="studentName"><?=$student_data['firstname']?> <?=$student_data['lastname']?></td>
                                                    <td id="fatherName"><?=$student_data['father_name']?></td>
                                                    <td><?=$student_data['mother_name']?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Class</strong> - <?=$student_data['class']?></td>
                                                    <td><strong>Section</strong> - <?=$student_data['section']?></td>
                                                    <td><strong>Contact No.</strong>  <?=$student_data['guardian_phone']?></td>
                                                </tr>
                                                 <tr>
                                                    <td><strong>Ledger Amt </strong> <br> Rs. <?=$student_data['fees_discount']?></td>
                                                    <td><strong>Route</strong> - <?php
                                                                        $this->db->where('id', $student_data['vehroute_id']);
                                                                        $query = $this->db->get('route_head')->row_array();
                                                                        echo (($query['fees_heading']));
                                                                    ?></td>
                                                    <td><strong>Category</strong> -  <?php
                                                                foreach ($categorylist as $value) {
                                                                    if ($student_data['category_id'] == $value['id']) {
                                                                        echo $value['name'];
                                                                    }
                                                                }
                                                                ?></td>
                                                    <td> <strong>Admission NO.</strong> <?=$student_data['admission_no']?> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
							<?php if ($this->session->flashdata('success')): ?>
								<div class="alert alert-success" id="successMsg">
									<?= $this->session->flashdata('success'); ?>
								</div>
								<?php $this->session->unset_userdata('success'); ?>
							<?php endif; ?>

							<?php if ($this->session->flashdata('error')): ?>
								<div class="alert alert-danger">
									<?= $this->session->flashdata('error'); ?>
								</div>
								<?php $this->session->unset_userdata('error'); ?>
							<?php endif; ?>

							<form method="POST" action="<?php echo base_url('admin/fee_discount/submit'); ?>">
							<input type="hidden" name="student_session_id" value="<?=$student_data['student_session_id']?>">
							<input type="hidden" name="student_id" value="<?=$student_data['id']?>">
                            <div class="row mt-5 mb-5">
                                <div class="col-sm-12">
									<div class="" style="border: 2px solid #f2f2f2; padding: 0rem;margin-top:10px;margin-bottom:10px">
										<table class="table table-bordered">
											<thead class="header">
												<tr>
													<th></th>
													<th>Fees Head</th>
													<?php foreach($months_data as $key=>$value){?>
													<th class="text-center"><?=$value?> </th>
													<?php } ?>
													<th style="text-align: right;">Total</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$col=1;
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
															$amount = 0;
															$existFeeHeadMonth = false;
															if (in_array($value, $db_months)) {
																if (is_array($row->amount)) {
																	$amount = isset($row->amount[$value]) ? (float)$row->amount[$value] : 0;
																} else {
																	$amount = (float)$row->amount;
																}

																$amount = (floor($amount) == $amount) ? (int)$amount : $amount;

																$existFeeHeadMonth = true;
																$total += $amount;
																$column_totals[$key] += $amount;
															}
														?>  
														<input type="text" name="fee[<?=$row->id ?>][<?= $value ?>]" id="textval-<?= $aa ?>-<?= $key+1 ?>" data-col="<?= $key+1 ?>" data-row="<?= $aa ?>" class="form-control inputtext" value="<?php echo $amount; ?>" <?php echo ($existFeeHeadMonth === false) ? 'readonly style="background-color:#eee; pointer-events: none;"' : ''; ?>>	
													</td>
													<?php endforeach; ?>
													<td style="text-align: right;"><b><span id="fees-tot-<?= $aa; ?>"><?= $total ?></span></b></td>
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
															$routecol =1;
													?>
												<tr>
													<td></td>
													<td><b><?= $row->fees_heading ?></b></td>
													<?php foreach($months_data as $key => $value): ?>
													<td style="text-align: right;">
													<?php 
														$rAmount = 0;
														$existRouteHeadMonth = false;
														if (in_array($value, $db_months)) {
															
															if (is_array($row->amount)) {
																$rAmount = isset($row->amount[$value]) ? (float)$row->amount[$value] : 0;
															} else {
																$rAmount = (float)$row->amount;
															}

															$rAmount = (floor($rAmount) == $rAmount) ? (int)$rAmount : $rAmount;

															$existRouteHeadMonth = true;
															$total += $rAmount;
															$column_totals[$key] += $rAmount;
														}
													?>   
													<input type="text" name="route[<?=$row->id ?>][<?= $value ?>]" class="form-control inputtext" data-col="<?= $key+1 ?>" data-row="<?= $aa ?>" value="<?php echo $rAmount; ?>" <?php echo ($existRouteHeadMonth === false) ? 'readonly style="background-color:#eee; pointer-events: none;"' : ''; ?> id="textroute-<?= $routecol ?>">	
													</td>
													<?php $routecol++;endforeach; ?>
													<td style="text-align: right;" data-col="<?= $routecol; ?>"><b><span id="route-tot-<?= $routecol ?>"><?= $total ?> </span></b></td>
												</tr>
												<?php
														$final_total += $total;
														
													}
													if(!empty($final_total)) {
												?>
												<tr>
													<td></td>
													<td><b>Total</b></td>
													<?php foreach ($column_totals as $col_total): ?>
													<td style="text-align: right;"><b><span id="col-tot<?= $col ?>"><?= $col_total ?></span></b></td>
													<?php $col++; endforeach; ?>
													<td style="text-align: right;"><b><span id="final-total-text"><?= $final_total ?></span></b></td>
												</tr>
												<?php } } ?>

											</tbody>
										</table>
									</div>									
                                </div>
                            </div>
							<div class="row">
								<div class="col-md-10 col-sm-8 col-xs-12" style="margin-top: 5px;">
									<textarea style="min-height:45px" name="remarks" class="form-control" placeholder="Remarks"><?php echo $remarks; ?></textarea>
								</div>
								<div class="col-md-2 col-sm-4 col-xs-12 text-right" style="margin-top: 5px;">
									<button type="submit" class="btn btn-lg btn-primary">Update Fees</button>
								</div>
							</div>
							</form>
                        </div>
						<?php } ?>
                    </div>
					<input type="hidden" id="feedHeads" value="<?= count($data_list) ?>">
					<input type="hidden" id="routeList" value="<?=count($route_data_list) ?>">
					<input type="hidden" id="issubmit" value="<?= $issubmit ?>">
                </div>
            </div>
        </div>   
    </section>
</div>
<script>
	document.getElementById('searchInput').addEventListener('input', function () {
		const query = this.value;
		const suggestionsList = document.getElementById('suggestionsList');

		if (query.length < 2) {
			suggestionsList.style.display = 'none';
			return;
		}
		//alert(encodeURIComponent);
		fetch("<?=base_url()?>/report/search_api?query=" + encodeURIComponent(query))
			.then(response => response.json())
			.then(data => {
				suggestionsList.innerHTML = '';
				if (data.length > 0) {
					data.forEach(item => {
						// console.log(item);
						const li = document.createElement('li');
						li.className = 'list-group-item list-group-item-action';
						li.textContent = item.name + ' s/o '+ item.father +' ('+item.class+')';;
						li.onclick = function () {
							document.getElementById('searchInput').value = item.name + ' s/o '+ item.father +' ('+item.class+')';
							suggestionsList.style.display = 'none';
							//alert(item.id);
							$('#successMsg').hide();
							const currentUrl = "<?=base_url()?>admin/fee-discount";
							const urlWithQuery = currentUrl.includes('?') ? 
							 `${currentUrl}&id=${item.id})` :
							 `${currentUrl}?id=${item.id}`;
							 
							 console.log(urlWithQuery);
		
							window.location.href = urlWithQuery;
							// Set form field values
							// document.getElementById('admissionNo').html = item.admission_no || '';
							// document.getElementById('fromDate').html = item.from_date || '';
							// document.getElementById('toDate').html = item.to_date || '';
							// document.getElementById('studentName').html = item.name || '';
							// document.getElementById('fatherName').html = item.father || '';
							// document.getElementById('studentClass').html = item.class || '';
							// document.getElementById('ledgerBalance').html = item.ledger_balance || '';
						};
						suggestionsList.appendChild(li);
					});
					suggestionsList.style.display = 'block';
				} else {
					suggestionsList.style.display = 'none';
				}
			});
	});
	
	$(document).on('keyup', '.inputtext', function() {
		let feeheads = $('#feedHeads').val();
		let routeList = $('#routeList').val();
		//alert($(this).val());
		let colsum = 0;
		let colTotal = 0;
		let col = $(this).data('col');
		let row = $(this).data('row');
		//alert(row);
		let value = 0;
		
		// column calculation
		for(var i=1; i<=feeheads; i++)
		{
			let textvalId = 'textval-' + i + '-'+ col;
			value = $('#' + textvalId).val();
			colsum = parseInt(colsum) + parseInt(value); 
			
		}
		//alert(colsum);
		if(routeList != 0)
		{
			value = $('#textroute-' +  col).val();
			colsum = parseInt(colsum) + parseInt(value); 
			
		}
		//alert(colsum);
		$('#col-tot' + col).html(colsum);
		//--------------------
		// row calculation fees
		let rowsumFees = 0;
		for(var i=1; i<=12; i++)
		{
			let value =  $('#textval-' + row + '-' +  i).val();
			rowsumFees = parseInt(rowsumFees) + parseInt(value); 
		}
		$('#fees-tot-' + row).html(rowsumFees);
		
		// row calculation route
		let rowsum = 0;
		if(routeList != 0)
		{
			
			for(var i=1; i<=12; i++)
			{
				let value =  $('#textroute-' +  i).val();
				rowsum = parseInt(rowsum) + parseInt(value); 
			}
			//alert(rowsum);
			$('#route-tot-' + 13).html(rowsum);
		}
		
		// final total 
		let finalsum = 0;
		for(var i=1; i<=12; i++)
		{
			let finamvalue =  $('#col-tot' +  i).html();
			finalsum = finalsum + parseInt(finamvalue);
			
		}
		//alert(finalsum);
		$('#final-total-text').html(finalsum);
		
	});
	
	let issubmit = $('#issubmit').val();
	if(issubmit == 1)
	{
		setTimeout(function () {
			$('#successMsg').fadeOut('slow');
		}, 3000);
	}
	
</script>