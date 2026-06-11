<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-money"></i> <?php echo $this->lang->line('fees_collection'); ?> <small> <?php echo $this->lang->line('filter_by_name1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php $this->load->view('reports/_finance'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box removeboxmius">
                    <div class="box-header ptbnull"></div>
               
                   


                    <div class="row">

                       

                            <div class="" id="transfee">
                                <div class="box-header ptbnull">
                                    <h3 class="box-title titlefix"><i class="fa fa-users"></i> Fee Day Book</h3>
                                </div>     
                                <div class="box-body" style="padding-top:0;">
                                    <div class="row">
                                    
                                    <div class="col-md-12">
                                        <div style="background: #dadada; height: 1px; width: 100%; clear: both; margin-bottom: 10px;"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            
                                            <form method="get"  action="">

                                    <!-- Per Page Dropdown -->
                                    <div class="form-group col-md-2">
                                        <label for="per_page">Records per page:</label>
                                        <select name="per_page" id="per_page" onchange="this.form.submit()" class="form-control">
                                            <option value="10" <?= ($this->input->get('per_page') == 10) ? 'selected' : '' ?>>10</option>
                                            <option value="25" <?= ($this->input->get('per_page') == 25) ? 'selected' : '' ?>>25</option>
                                            <option value="50" <?= ($this->input->get('per_page') == 50) ? 'selected' : '' ?>>50</option>
                                            <option value="100" <?= ($this->input->get('per_page') == 100) ? 'selected' : '' ?>>100</option>
                                            <option value="all" <?= ($this->input->get('per_page') == 'all') ? 'selected' : '' ?>>All</option>
                                        </select>
                                    </div>


                                    <!-- From Date -->
                                    <div class="form-group col-md-2">
                                        <label for="fromDate">From</label>
                                        <input type="date" class="form-control" id="fromDate" name="from_date" value="<?= $this->input->get('from_date') ?? date('Y-m-d') ?>" required>
                                    </div>

                                    <!-- To Date -->
                                    <div class="form-group col-md-2">
                                        <label for="toDate">To</label>
                                        <input type="date" class="form-control" id="toDate" name="to_date" value="<?= $this->input->get('to_date') ?? date('Y-m-d') ?>" required>
                                    </div>
									<div class="col-sm-2">
                                        <label for="mode">Mode</label>
                                        <select autofocus=""  name="mode" id="mode" name="class_id" class="form-control" >
                                            <option value="">All</option>
                                            <option value="Online" <?php echo $this->input->get('mode') == 'Online' ? 'selected' : ''; ?>>Online</option>
                                            <option value="Cash" <?php echo $this->input->get('mode') == 'Cash' ? 'selected' : ''; ?>>Cash</option>
                                            <option value="Other" <?php echo $this->input->get('mode') == 'Other' ? 'selected' : ''; ?>>Other</option>
                                        </select>
                                    </div>
									<!--<div class="form-group col-md-2 d-flex align-items-end">
                                        <div class="form-check" style="margin-top:25px">
                                            <input type="checkbox" name="route" class="form-check-input" <?php if(isset($_GET['route']) && $_GET['route']=='on') { echo 'checked="checked"'; } ?>>
                                            <label class="form-check-label">Include Route</label>
                                        </div>
                                    </div>-->
                                    <!-- Submit Button -->
                                    <div class="form-group col-md-2 d-flex align-items-end">
                                        <br>
                                        <button type="submit" class="btn btn-primary btn-sm">OK</button>
                                    </div>
                                </form>
                                            
                                        </div>
                                    </div>
                                    
                                </div>	
                                
                                


    



                                 <div class="table-responsive table-header-sticky">
                                    <div class="download_label"><?php echo $this->lang->line('fee_day_book');?></div>
                                    <table  cellpadding="8" cellspacing="0" class="table table-striped table-bordered table-hover example table-fixed-header sticky-col-5" style="width:1800px !important">
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
                                                <th>Fee Cat.</th>
                                                <th>Months</th>
												<?php //if(isset($_GET['route'])) { ?>
												<?php if(!empty($routes)) { ?>
                                                <th>Transport</th>
												<?php } foreach($fee_heads as $list){ ?>
                                                <th style="text-align:right"><?=$list['fees_heading']?></th>
                                                <?php } ?>


                                                <!-- <th >Fee</th>
                                                <th >Late Fees</th>
                                                <th >Ledger Amt</th>
                                                <th >Total Fees</th>
                                                <th >Discount Amt</th> -->
                                                <th  style="text-align: right;">Net Fees</th>
                                                <th  style="text-align: right;">Receipt. Amt.</th>
												<th style="text-align: right;">Discount Amt</th>
												<th style="text-align: right;">Prev Bal</th>
                                                <th style="text-align: right;">Balance Amt</th>


                                                <th>Mode</th>
                                                <th>User</th>
                                                <th>Remark</th>
                                            </tr>
                                        </thead>
                                       
                                       
                                    
                                    <tbody>
											
                                            <?php if (!empty($receipt_data)): ?>
												<?php $sno = 1; foreach ($receipt_data as $record): ?>
                                             <?php  
                                                $record=(array)$record; 
                                                $fees_received_sum       += (float)$record["fees_received"];
                                                $late_fees_sum    += (float)$record["late_fees"];
                                                $ledger_amt_sum   += (float)$record["ledger_amt"];
                                                $total_fees_sum     += (float)$record["total_fees"];
                                                $discount_amt_sum     += (float)$record["discount_amt"];
                                                $net_fees_sum  += (float)$record["net_fees"];
                                                $receipt_amt_sum  += (float)$record["receipt_amt"];
                                                $balance_amt_sum  += (float)$record["balance_amt"];
                                                $previous_balance_sum  += (float)$record["previous_balance"];
												
												//echo '<pre>'; print_r($record); echo '</pre>';
												
												
												$fees_months = [];
												if(!empty($record['fee_head'])){
                                                    // echo $record["receipt_months"];
													$financial_year_order = ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'];

													$fees_months = explode(',', $record["receipt_months"]);
													$fees_months = array_map('trim', $fees_months); // TRIM SPACES
													usort($fees_months, function($a, $b) use ($financial_year_order) {
														return array_search($a, $financial_year_order) - array_search($b, $financial_year_order);
													});
													
												}
												//echo '<pre>'; print_r($fees_months); echo '</pre>';
												
												$fees_month = []; 
												$cat_list_amount=[];
												
												//echo '<pre>'; print_r($fee_heads); echo '</pre>';die;
												foreach($fee_heads as $list){ 

													$class_id = $record['class_id'];
													$category_id = $record['category_id'];
													$fee_group_id = $list['fees_heading'];
												  
													//echo 'class_id-'.$class_id.'<br/>';
													//echo 'category_id-'.$category_id.'<br/>';
													//echo 'fee_group_id-'.$fee_group_id.'<br/>';
													$this->db->from('fee_head');
													$this->db->join('fees_plan', 'fee_head.id = fees_plan.fee_group_id');
													$this->db->where('fees_plan.fee_group_id', $list['id']);
													$this->db->where("JSON_CONTAINS(fees_plan.class_ids, '\"$class_id\"')", null, false);
													$this->db->where("JSON_CONTAINS(fees_plan.category_ids, '\"$category_id\"')", null, false);
													$query = $this->db->get();
													$amt_fee_heads = $query->row();
													
													//echo $this->db->last_query();

													$db_months = json_decode($list['months'] ?? '[]');
//echo '<pre>'; print_r($fees_months); echo '</pre>';
													$selected_months = $fees_months ?? [];
													if (!is_array($selected_months)) {
														$selected_months = [$selected_months];
													}
													
													$pay=0;
													//echo 'student_session_id'.$record['student_session_id'];die;
													$feeDiscountsArr = [];
													if ($record['student_session_id'] != null) {
														$feeDiscountsArr      = $this->fee_discount_model->get_all_fees($record['student_session_id']);
													}
													
													//echo '<pre>'; print_r($feeDiscountsArr); echo '</pre>';die;
													$monthMap = [
														"Apr" => "month_apr",
														"May" => "month_may",
														"Jun" => "month_jun",
														"Jul" => "month_jul",
														"Aug" => "month_aug",
														"Sep" => "month_sep",
														"Oct" => "month_oct",
														"Nov" => "month_nov",
														"Dec" => "month_dec",
														"Jan" => "month_jan",
														"Feb" => "month_feb",
														"Mar" => "month_mar"
													];
													if(!empty($feeDiscountsArr)){
														foreach ($feeDiscountsArr as $paid) {

															if ($paid['fee_type_id'] == $amt_fee_heads->id) {

																$months = json_decode($amt_fee_heads->months, true);

																if (!is_array($months)) continue;

																$amounts = [];

																foreach ($months as $month) {

																	$column = $monthMap[$month];

																	$amounts[$month] = isset($paid[$column])
																		? floatval($paid[$column])
																		: floatval($amt_fee_heads->amount); // fallback
																}

																// Replace amount with month-wise array
																$amt_fee_heads->amount = $amounts;
															}
														}
													}else{
														$months = json_decode($amt_fee_heads->months, true);
														if (!is_array($months)) continue;
														$amounts = [];
														foreach ($months as $month) {

															$column = $monthMap[$month];

															$amounts[$month] = floatval($amt_fee_heads->amount); // fallback
														}
														$amt_fee_heads->amount = $amounts;
													}
													
													foreach ($selected_months as $month) {
														// Check if this month is part of the allowed months in the fee plan
														if (!in_array($month, $db_months)) {
															continue; // Skip months not in the plan
														}

														// Fetch receipt for this student, fee heading, and month
														$this->db->where([
															'student_id' => $record["student_id"],
															'fee_head_name' => $fee_group_id,
															'fee_head_type' => 'fees',
															'months' => $month
														]);
														$receipt = $this->db->get('receipts')->row();
														//echo $this->db->last_query();
														// echo json_encode($receipt);
														// echo $amt_fee_heads->amount;
														if($list['fees_heading'] == 'Registration Fee'){
															// echo '<pre>'; print_r($amt_fee_heads);exit;
														}
														
														if (!empty($receipt)) {
															// $pay+= $amt_fee_heads->amount??0;
															
															$pay+= isset($amt_fee_heads->amount[$month]) ? (float)$amt_fee_heads->amount[$month] : 0;
															$fees_month[$month] = $month;
														} else {
															// $pay+=$receipt->fees_received;
															$pay+=0;
														}
													}
													// array_push($cat_list_amount,$pay);
													$cat_list_amount[$list['fees_heading']] = $pay;
													$final += $pay;
													
													//echo '<pre>'; print_r($cat_list_amount);
												}
												$routeFees=0;
												$routes_month = [];
												if(!empty($routes)) {
													/*$student_routes = $this->db->where('id', $record['route_id'])->get('route_head')->result_array();
														$pay=0;
													 foreach($student_routes as $list){*/ 
														

														
														$route = $this->db->get_where('route_head', ['id' => $record['route_id']])->row();
														if(!empty($route)){
														$class_id = $record['class_id'];
														$category_id = $record['category_id'];
														$fee_group_id = $route->fees_heading;

														$db_months = [];
														if ($route && !empty($route->months)) {
															$decoded = json_decode($route->months, true);
															$db_months = is_array($decoded) ? $decoded : [];
														}

														$this->db->from('route_head');
														$this->db->join('route_plan', 'route_head.id = route_plan.fee_group_id');
														$this->db->where("JSON_CONTAINS(route_plan.class_ids, '\"$class_id\"')", null, false);
														$this->db->where("JSON_CONTAINS(route_plan.category_ids, '\"$category_id\"')", null, false);
														$this->db->where('route_head.id', $record['route_id']);
														// echo "<pre>";print_r($record['route_id']);die;

														$query = $this->db->get();
														$amt_fee_heads = $query->row();
														
														// $db_months = json_decode($db_months);
													  
														$selected_months = $fees_months ?? [];
														if (!is_array($selected_months)) {
															$selected_months = [$selected_months];
														}
														
														$routeDiscountsArr = [];
														if ($record['student_session_id'] != null) {
															$routeDiscountsArr    = $this->fee_discount_model->get_all_routes($record['student_session_id']);
														}
														$monthMap = [
															"Apr" => "month_apr",
															"May" => "month_may",
															"Jun" => "month_jun",
															"Jul" => "month_jul",
															"Aug" => "month_aug",
															"Sep" => "month_sep",
															"Oct" => "month_oct",
															"Nov" => "month_nov",
															"Dec" => "month_dec",
															"Jan" => "month_jan",
															"Feb" => "month_feb",
															"Mar" => "month_mar"
														];
														if(!empty($routeDiscountsArr)){
															foreach ($routeDiscountsArr as $paid) {

																if ($paid['fee_type_id'] == $amt_fee_heads->id) {

																	$months = json_decode($amt_fee_heads->months, true);

																	if (!is_array($months)) continue;

																	$amounts = [];

																	foreach ($months as $month) {

																		$column = $monthMap[$month];

																		$amounts[$month] = isset($paid[$column])
																			? floatval($paid[$column])
																			: floatval($amt_fee_heads->amount); // fallback
																	}

																	// Replace amount with month-wise array
																	$amt_fee_heads->amount = $amounts;
																}
															}
														}else{
															$months = json_decode($amt_fee_heads->months, true);
															if (!is_array($months)) continue;
															$amounts = [];
															foreach ($months as $month) {

																$column = $monthMap[$month];

																$amounts[$month] = floatval($amt_fee_heads->amount); // fallback
															}
															$amt_fee_heads->amount = $amounts;
														}
														$pay=0;
														foreach ($selected_months as $month) {
															// Check if this month is part of the allowed months in the fee plan
															if (!in_array($month, $db_months)) {
																continue; // Skip months not in the plan
															}

															// Fetch receipt for this student, fee heading, and month
															$this->db->where([
																'student_id' => $record["student_id"],
																'fee_head_name' => $fee_group_id,
																'fee_head_type' => 'route',
																'months' => $month
															]);
															$receipt = $this->db->get('receipts')->row();
//echo $this->db->last_query();
															// echo json_encode($receipt);
															 //echo '<pre>'; print_r($amt_fee_heads->amount[$month]); echo '</pre>';
															
															if (!empty($receipt)) {
																// $pay+= $amt_fee_heads->amount??0;
																
																$pay+= isset($amt_fee_heads->amount[$month]) ? (float)$amt_fee_heads->amount[$month] : 0;
																$routes_month[$month] = $month;
															} else {
																// $pay+=$receipt->fees_received;
																$pay+=0;
															}
														}

														}
													//}
													$finalRF += $routeFees = $pay;
												}
                                            ?>
                                            <tr>
                                                <td><?= $sno++ ?></td>
                                                <td ><?= date('d-m-Y',strtotime($record["date_time"])) ?></td>
                                                <td ><?= $record["receipt_no"] ?></td>
                                                <td ><?= $record["admission_no"] ?></td>
                                                <td ><?= $record["firstname"].' '.$record["middlename"].' '.$record["lastname"] ?></td>
                                                <td ><?= $record["father_name"] ?></td>
                                                <td ><?= $record["class"] ?></td>
                                                <td ><?= $record["section"] ?></td>
                                                <td ><?=  ($this->db->get_where('fee_groups', ['id' => $record['category_id']])->row()) ? $this->db->get_where('fee_groups', ['id' => $record['category_id']])->row()->name : 'N.A'; ?>  </td>
                                                <td>
                                                    <?php
                                                        if(!empty($record['fee_head'])){
															
                                                            echo implode(', ', $fees_months);
                                                        }else{
                                                            echo "Old Bal.";
                                                        }
                                                    ?>
                                            
                                                </td>
												<?php if(!empty($routes)) { ?>
                                                       <td style="text-align:right"><?= format_amount($routeFees);?></td>
                                                <?php } ?>
                                                <!--<td ><?=  ($this->db->get_where('route_head', ['id' => $record['route_id']])->row()) ? $this->db->get_where('route_head', ['id' => $record['route_id']])->row()->fees_heading : 'N.A'; ?>  </td>-->
												<?php
													
													$fees_month_amount = 0;
													foreach($fee_heads as $list){
														$head_wise_totals[$list['fees_heading']] += $cat_list_amount[$list['fees_heading']];
														$fees_month_amount += $cat_list_amount[$list['fees_heading']];
													?>
														<td style="text-align:right"><?=format_amount($cat_list_amount[$list['fees_heading']]); ?></td>
													<?php 
														}
													?>


                                              

                                            <td style="text-align: right;"><?= format_amount($record["net_fees"]) ?></td>
                                                <td style="text-align: right;"><?= format_amount($record["receipt_amt"]) ?></td>
                                                <td style="text-align: right;"><?= format_amount($record["discount_amt"]) ?></td>
                                                <td style="text-align: right;"><?= format_amount($record["previous_balance"]) ?></td>
                                                <td style="text-align: right;"><?= format_amount($record["balance_amt"]) ?></td>

                                                <td ><?= $record["mode"] ?></td>
                                                <td ><?= $record["create_by"] ?></td>
                                                <td ><?= $record["remarks"] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                         <tr>
                                           
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>Total</th>
                                            <?php if(!empty($routes)) { ?>
												<th><?= format_amount($finalRF);?></th>
											<?php } foreach($fee_heads as $list) { ?>
												<th style="text-align:right"><?=format_amount($head_wise_totals[$list['fees_heading']] ?? 0); ?></th>
											<?php } ?>
                                          
                                           <th style="text-align: right;"><?= format_amount($net_fees_sum) ?></th>
                                            <th style="text-align: right;"><?= format_amount($receipt_amt_sum) ?></th>
                                            <th style="text-align: right;"><?= format_amount($discount_amt_sum) ?></th>
                                            <th style="text-align: right;"><?= format_amount($previous_balance_sum) ?></th>
                                            <th style="text-align: right;"><?= format_amount($balance_amt_sum) ?></th>

                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        <?php else: ?>
                                            <tr><td colspan="17" class="text-center">No records found</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                    
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        <?= $pagination_links; ?>
                                    </div>
                                </div>



                                <div class="box-body table-responsive" hidden>
                                    <div class="download_label"><?php
                                    
                            $this->customlib->get_postmessage();
                            ?></div> 
                                    <a class="btn btn-default btn-xs pull-right" id="print" onclick="printDiv()" ><i class="fa fa-print"></i></a> <button class="btn btn-default btn-xs pull-right" id="btnExport" onclick="fnExcelReport();"> <i class="fa fa-file-excel-o"></i> </button>  
                                   <table border="1" cellpadding="8" cellspacing="0" class="table table-striped table-bordered table-hover example table-fixed-header" id="headerTable">
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
										  <th>Fee Cat.</th>
										  <th>Route</th>
										  <th>Months</th>
										  <th>Old Bal.</th>
										  <th>Late</th>
										  <th>Total Fee</th>
										  <th>Discount</th>
										  <th>Net Fee</th>
										  <th>Rec. Amt.</th>
										  <th>Bal. Amt.</th>
										  <th>Mode</th>
										  <th>User</th>
										  <th>Remark</th>
										</tr>
									  </thead>
									  <tbody>
										<tr>
										  <td>1</td>
										  <td>2025-05-11</td>
										  <td>1023</td>
										  <td>ADM123</td>
										  <td>John Doe</td>
										  <td>Michael Doe</td>
										  <td>10</td>
										  <td>A</td>
										  <td>General</td>
										  <td>Yes</td>
										  <td>Apr-May</td>
										  <td>500</td>
										  <td>50</td>
										  <td>2550</td>
										  <td>100</td>
										  <td>2450</td>
										  <td>2450</td>
										  <td>0</td>
										  <td>Cash</td>
										  <td>admin</td>
										  <td>Paid full</td>
										</tr>
									  </tbody>
									</table>
                                    </div>
                                    </div>                            
                                </div>                 
                            </div>

                       
                  





                </div>
            </div>
    </section>
</div>

<script type="text/javascript">
    function removeElement() {
        document.getElementById("imgbox1").style.display = "block";
    }
    function getSectionByClass(class_id, section_id) {
        if (class_id != "" && section_id != "") {
            $('#section_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (section_id == obj.section_id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                    });
                    $('#section_id').html(div_data);
                }
            });
        }
    }
    $(document).ready(function () {
        $(document).on('change', '#class_id', function (e) {
            $('#section_id').html("");
            var class_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                    });

                    $('#section_id').html(div_data);
                }
            });
        });
        $(document).on('change', '#section_id', function (e) {
            getStudentsByClassAndSection();
        });
        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id') ?>';
        getSectionByClass(class_id, section_id);
    });
    function getStudentsByClassAndSection() {
        $('#student_id').html("");
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "student/getByClassAndSection",
            data: {'class_id': class_id, 'section_id': section_id},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                    div_data += "<option value=" + obj.id + ">" + obj.firstname + " " + obj.lastname + "</option>";
                });
                $('#student_id').append(div_data);
            }
        });
    }

    $(document).ready(function () {
        $("ul.type_dropdown input[type=checkbox]").each(function () {
            $(this).change(function () {
                var line = "";
                $("ul.type_dropdown input[type=checkbox]").each(function () {
                    if ($(this).is(":checked")) {
                        line += $("+ span", this).text() + ";";
                    }
                });
                $("input.form-control").val(line);
            });
        });
    });
    $(document).ready(function () {
        $.extend($.fn.dataTable.defaults, {
            ordering: false,
            paging: false,
            bSort: false,
            info: false
        });
    });
</script>
<script>

    document.getElementById("print").style.display = "block";
    document.getElementById("btnExport").style.display = "block";

    function printDiv() {
        document.getElementById("print").style.display = "none";
        document.getElementById("btnExport").style.display = "none";
        var divElements = document.getElementById('transfee').innerHTML;
        var oldPage = document.body.innerHTML;
        document.body.innerHTML =
                "<html><head><title></title></head><body>" +
                divElements + "</body>";
        window.print();
        document.body.innerHTML = oldPage;

        location.reload(true);
    }

    function fnExcelReport()
    {
        var tab_text = "<table border='2px'><tr >";
        var textRange;
        var j = 0;
        tab = document.getElementById('headerTable'); // id of table

        for (j = 0; j < tab.rows.length; j++)
        {
            tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
            //tab_text=tab_text+"</tr>";
        }

        tab_text = tab_text + "</table>";
        tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
        tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
        tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");

        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
        {
            txtArea1.document.open("txt/html", "replace");
            txtArea1.document.write(tab_text);
            txtArea1.document.close();
            txtArea1.focus();
            sa = txtArea1.document.execCommand("SaveAs", true, "Say Thanks to Sumit.xls");
        } else                 //other browser not tested on IE 11
            sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

        return (sa);
    }
</script>


