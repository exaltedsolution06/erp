<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<style type="text/css">
    /*REQUIRED*/
    .carousel-row {
        margin-bottom: 10px;
    }
    .slide-row {
        padding: 0;
        background-color: #ffffff;
        min-height: 150px;
        border: 1px solid #e7e7e7;
        overflow: hidden;
        height: auto;
        position: relative;
    }
    .slide-carousel {
        width: 20%;
        float: left;
        display: inline-block;
    }
    .slide-carousel .carousel-indicators {
        margin-bottom: 0;
        bottom: 0;
        background: rgba(0, 0, 0, .5);
    }
    .slide-carousel .carousel-indicators li {
        border-radius: 0;
        width: 20px;
        height: 6px;
    }
    .slide-carousel .carousel-indicators .active {
        margin: 1px;
    }
    .slide-content {
        position: absolute;
        top: 0;
        left: 20%;
        display: block;
        float: left;
        width: 80%;
        max-height: 76%;
        padding: 1.5% 2% 2% 2%;
        overflow-y: auto;
    }
    .slide-content h4 {
        margin-bottom: 3px;
        margin-top: 0;
    }
    .slide-footer {
        position: absolute;
        bottom: 0;
        left: 20%;
        width: 78%;
        height: 20%;
        margin: 1%;
    }
    /* Scrollbars */
    .slide-content::-webkit-scrollbar {
        width: 5px;
    }
    .slide-content::-webkit-scrollbar-thumb:vertical {
        margin: 5px;
        background-color: #999;
        -webkit-border-radius: 5px;
    }
    .slide-content::-webkit-scrollbar-button:start:decrement,
    .slide-content::-webkit-scrollbar-button:end:increment {
        height: 5px;
        display: block;
    }
    .filter-box {
      border: 1px solid #ccc;
      padding: 10px;
      border-radius: 5px;
      max-height: 125px;
      overflow-y: auto;
    }
    .box-header-ptbnull{
        padding-top:2rem;
    }
    .form-check-label{
        padding-left:1rem;
    }
</style>
<?php



?>
<div class="content-wrapper" style="min-height: 946px;">

    <section class="content-header">
        <h1>
            <i class="fa fa-bus"></i> <?php echo $this->lang->line('transport'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php $this->load->view('reports/_finance'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box removeboxmius">
                    <div class="box-header ptbnull"></div>
                   


                    <div class="box-header ptbnull"></div>
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><i class="fa fa-money"></i>  Overall collection report</h3>
                    </div>




                    <div class="box-body" style="padding-top:0;">
						   



                        <div class="container-fluid">
                            <div class="card p-3">
                                <form action="" method="POST">
                                    <div class="box-header-ptbnull"></div>
                                    <div class="row">

                                        <!-- Filters -->
                                        <div class="col-md-2 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input master-check" data-target="filter-check" id="selectAllFilters">
                                            <label class="form-check-label" for="selectAllFilters">Select All Filters</label>
                                        </div>
                                        <div class="filter-box">
                                            <?php
                                            //  "Show Total & Recd."
                                            $filters = $_POST['filters'] ?? [];
                                            $filterOptions = ["Fees Head Wise", "Include Route", "Consider Old Bal" ];
                                            foreach ($filterOptions as $index => $value) {
                                            $checked = in_array($value, $filters) ? 'checked' : '';
                                            echo "<div class='form-check'>
                                                    <input type='checkbox' class='form-check-input filter-check' name='filters[]' value='$value' id='filter$index' $checked>
                                                    <label class='form-check-label' for='filter$index'>$value</label>
                                                    </div>";
                                            }
                                            ?>
                                        </div>
                                        </div>

                                        <!-- Classes -->
                                        
                                        <div class="col-md-2 mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input master-check" data-target="class-check" id="selectAllClass">
                                                <label class="form-check-label" for="selectAllClass">Select Class</label>
                                            </div>
                                            <div class="filter-box">
                                                <?php
                                                
                                                $selectedClasses = $_POST['class'] ?? [];

                                                foreach ($class as $row) {
                                                    foreach ($row->vehicles as $section) {
                                                        $class_id = $row->id;
                                                        $section_id = $section->section_id;
                                                        $value = $class_id . '-' . $section_id;
                                                        $checked = in_array($value, $selectedClasses) ? 'checked' : '';

                                                        $count = $this->db->select('COUNT(*) as total')
                                                            ->from('student_session')
                                                            ->where('class_id', $class_id)
                                                            ->where('section_id', $section_id)
                                                            ->get()
                                                            ->row()
                                                            ->total;

                                                        echo "<div class='form-check'>
                                                                <input type='checkbox' class='form-check-input class-check' name='class[]' value='$value' id='class{$value}' $checked>
                                                                <label class='form-check-label' for='class{$value}'>{$row->class} - {$section->section} ($count)</label>
                                                            </div>";
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>





                                        <!-- Months -->
                                        <div class="col-md-2 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input master-check" data-target="month-check" id="selectAllMonths">
                                            <label class="form-check-label" for="selectAllMonths">Select Month(s)</label>
                                        </div>
                                        <div class="filter-box">
                                            <?php
                                            $selectedMonths = $_POST['months'] ?? [];
                                            $months = ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "Mar"];
                                            foreach ($months as $month) {
                                            $checked = in_array($month, $selectedMonths) ? 'checked' : '';
                                            echo "<div class='form-check'>
                                                    <input type='checkbox' class='form-check-input month-check' name='months[]' value='$month' id='month$month' $checked>
                                                    <label class='form-check-label' for='month$month'>$month</label>
                                                    </div>";
                                            }
                                            ?>
                                        </div>
                                        </div>

                                        <!-- Fee Category -->
                                        <div class="col-md-2 mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input master-check" data-target="fee-check" id="selectAllFee">
                                                <label class="form-check-label" for="selectAllFee"> Fee Cat. Filter</label>
                                            </div>
                                            <div class="filter-box">
                                                <?php
                                                $selectedFeeCat = $_POST['fee_cat'] ?? [];
                                                foreach ($category as $row) {
                                                $checked = in_array($row['id'], $selectedFeeCat) ? 'checked' : '';
                                                echo "<div class='form-check'>
                                                        <input type='checkbox' class='form-check-input fee-check' name='fee_cat[]' value='{$row['id']}' id='fee1{$row['id']}' $checked>
                                                        <label class='form-check-label' for='fee1{$row['id']}'>{$row['name']}</label>
                                                        </div>";
                                                }
                                                ?>
                                            </div>
                                        </div>
										<!-- From Date -->
                                    <div class="form-group col-md-2">
                                        <label for="fromDate">From</label>
                                        <input type="date" class="form-control" id="fromDate" name="from_date" value="<?= $this->input->get('from_date') ?? date('Y-m-d') ?>">
										
										<label for="toDate">To</label>
                                        <input type="date" class="form-control" id="toDate" name="to_date" value="<?= $this->input->get('to_date') ?? date('Y-m-d') ?>">
                                    </div>

                                    <!-- To Date -->
                                    <div class="form-group col-md-2">
                                        
                                    </div>
                                        <!--<div class="col-md-2 mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input master-check" data-target="route-check" id="selectAllRoute">
                                                <label class="form-check-label" for="selectAllRoute">Select Route.</label>
                                            </div>
                                            <div class="filter-box">
                                                <?php
                                                $selectedFeeCat = $_POST['routes'] ?? [];
                                                foreach ($routes as $row) {
                                                $checked = in_array($row['id'], $selectedFeeCat) ? 'checked' : '';
                                                echo "<div class='form-check'>
                                                        <input type='checkbox' class='form-check-input route-check' name='routes[]' value='{$row['id']}' id='fee1{$row['id']}' $checked>
                                                        <label class='form-check-label' for='fee1{$row['id']}'>{$row['fees_heading']}</label>
                                                        </div>";
                                                }
                                                ?>
                                            </div>
                                        </div>-->

                                        <!-- Balance & Submit -->
                                        <div class="col-md-1 mb-3">
                                        <!-- <label><strong>Balance</strong></label>
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="min_balance" placeholder="Min Balance" value="<?= $_POST['min_balance'] ?? '' ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="max_balance" placeholder="Max Balance" value="<?= $_POST['max_balance'] ?? '' ?>">
                                        </div> -->
                                        <button type="submit" name="filter_button"class="btn btn-primary btn-block">OK</button>
                                        </div>

                                    </div>
                                    </form>
                            </div>
                        </div>
                        <div class="table-responsive table-header-sticky">
                            <div class="download_label"> <?php
                                // echo $this->lang->line('fees_statement') . "<br>";
                                $this->customlib->get_postmessage();
                                ?></div>

                            <?php if((!empty($filters) and !empty($selectedMonths)) or ($filters[0]=='Consider Old Bal') ){ ?>
                                    <table  cellpadding="8" cellspacing="0" class="table table-striped table-bordered table-hover example table-fixed-header sticky-col-3" style="width:1800px !important">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Adm. No</th>
                                        <th>Student</th>
                                        <th>Father</th>
                                        <th>Class</th>
                                        <th>Sec.</th>
                                        <th>Fee Cat.</th>
                                        <th>Route</th>
                                        <?php 

                                            $filters = $_POST['filters'];
                                                if(in_array('Consider Old Bal', $filters)){
                                                ?>
                                                        <th style="text-align:right">Old Bal.</th>
                                                    <!-- <th>Net Amt.</th> -->
                                                <?php
                                            }
                                            if(in_array('Include Route', $filters)){
                                                
                                                ?><th style="text-align:right">Route Amount</th><?php
                                            }
											if(in_array('Fees Head Wise', $filters)){
												foreach($fee_heads as $list) { 
											?>
                                                <th style="text-align:right"><?=$list['fees_heading']?></th>
                                            <?php  
												} 
											?>
											<th  style="text-align: right;">Fee Head Total</th>
											<?php } ?>
                                        <th style="text-align:right">Total Fee</th>
                                        <!--<th style="text-align:right">Received Amount</th>
                                        <th style="text-align:right">Balance Amount</th>-->
                                    </tr>
                                </thead>
                                
                                
                            
                            <tbody>
                                    
                                    <?php 
                                    $total_fees_discount = 0;
                                    $head_wise_totals = []; // index by fee head
                                    $total_route = 0;
                                    $grand_total = 0;
                                    $grand_total_1 = 0;
                                    $grand_total_2 = 0;
                                    if (!empty($receipt_data)): ?>
                                        <?php $sno = 1; foreach ($receipt_data as $record): ?>
                                    <?php  $record=(array)$record;   $final=0;?>
                                    <?php
                                             $final_rec=0;
                                            $filters = $_POST['filters'];


                                            $final_rec1=0;
                                            if(in_array('Consider Old Bal', $filters)){
                                                // if($_POST['months'][0]=='Apr'){

                                                // $final+=0;
                                                // $final_rec1=0;

                                                // }else{
                                                     $final_rec1+=$record["total_receipt_amt"];
                                                $final+=$record["total_receipt_amt"];
                                                
                                                // }
                                                 $final_rec+=$final_rec1;
                                            }
											$headFees=0;
                                             if(in_array('Fees Head Wise', $filters)){
                                                $cat_list_amount=[];
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
													$selected_months = $_POST['months'] ?? [];
													if (!is_array($selected_months)) {
														$selected_months = [$selected_months];
													}
													
													$pay=0;
													//echo 'student_session_id--'.$record['student_session_id'];die;
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
															//echo $amt_fee_heads->amount.'<br/>';
														}
														
														if (!empty($receipt)) {
															// $pay+= $amt_fee_heads->amount??0;
															
															$pay+= isset($amt_fee_heads->amount[$month]) ? (float)$amt_fee_heads->amount[$month] : 0;
															//echo $amt_fee_heads->amount[$month];
															$fees_month[$month] = $month;
														} else {
															// $pay+=$receipt->fees_received;
															$pay+=0;
														}
													}
													// array_push($cat_list_amount,$pay);
													$cat_list_amount[$list['fees_heading']] = $pay;
													//$final += $pay;
													$final += $headFees = $pay;
													//echo '<pre>'; print_r($cat_list_amount);
													
                                                    
                                               
                                                }
                                            }
											
											$routeFees=0;
											$routes_month = [];
											if(in_array('Include Route', $filters)){
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
												  
													$selected_months = $_POST['months'] ?? [];
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


                                    <?php 
									$f_total = 0;
									// Fees Head Wise
									if(in_array('Consider Old Bal', $filters)){
										$f_total += $record["total_receipt_amt"];
									}

									// Include Route
									if(in_array('Fees Head Wise', $filters)){
										$f_total += $headFees;
									}

									// Consider Old Balance
									if(in_array('Include Route', $filters)){
										$f_total += $routeFees;
									}
									if($f_total>0){
                                        ?>
                                        <tr>
                                            <td><?= $sno++ ?></td>
                                            <td><?= $record["admission_no"] ?><?php //json_encode($record)?></td>
                                            <td><?= $record["firstname"].' '.$record["middlename"].' '.$record["lastname"] ?></td>
                                            <td><?= $record["father_name"] ?></td>
                                            <td><?= $record["class"] ?></td>
                                            <td><?= $record["section"] ?></td>
                                            <td ><?=  ($this->db->get_where('fee_groups', ['id' => $record['category_id']])->row()) ? $this->db->get_where('fee_groups', ['id' => $record['category_id']])->row()->name : 'N.A'; ?>  </td>
                                        
                                            <td ><?=  ($this->db->get_where('route_head', ['id' => $record['route_id']])->row()) ? $this->db->get_where('route_head', ['id' => $record['route_id']])->row()->fees_heading : 'N.A'; ?>  </td>
                                            
                                            <?php

                                               $oldBal = 0;

                                                if (in_array('Consider Old Bal', $filters)) {
                                                    $oldBal = $record["total_receipt_amt"] ?? 0;
                                                     ?><td style="text-align:right"><?= format_amount($oldBal) ?></td><?php
                                                    
                                                }
                                                if(in_array('Include Route', $filters)){

                                                    ?>
                                                        <td style="text-align:right"><?= format_amount($routeFees);?></td>
                                                    <?php
                                                
                                                }
												if(in_array('Fees Head Wise', $filters)){
													$fee_heads_total_amount = 0;
													foreach($fee_heads as $list){
															$head_wise_totals[$list['fees_heading']] += $cat_list_amount[$list['fees_heading']];
															
															$fee_heads_total_amount += $cat_list_amount[$list['fees_heading']];
												?>
															<td style="text-align:right"><?=format_amount($cat_list_amount[$list['fees_heading']]); ?></td>
												<?php 
														}
												?>		
													<td style="text-align:right" >
														<?= format_amount($fee_heads_total_amount) ?>
													</td>
												<?php		
													//array_push($head_wise_totals,array_sum($cat_list_amount));
												}

                                                // $final_rec=0;
                                            ?>
                                            <td style="text-align:right"><?=format_amount(($final + $routeFees))?></td>
                                            <!--<td style="text-align:right"><?=number_format(($final_rec-$oldBal),2)?></td>
                                            <td style="text-align:right"><?=number_format(($final-$final_rec+$oldBal),2)?></td>-->
                                        </tr>
                                        <?php
										if (in_array('Consider Old Bal', $filters)){
											$total_fees_discount += $record["total_receipt_amt"];
										}
                                        $total_route += $routeFees;
                                        $total_head_fees += $fee_heads_total_amount;
                                        $grand_total += $final;
                                        //$grand_total_1 += $final_rec-$oldBal;
                                        //$grand_total_2 += $final-$final_rec+$oldBal;
                                    } ?>

                                    


                                <?php endforeach; ?>
                                    <tr style="font-weight: bold;">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="" style="text-align:right;">Total</td>

                                        <?php if (in_array('Consider Old Bal', $filters)): ?>
                                            <td style="text-align:right"><?= format_amount($total_fees_discount) ?></td>
                                        <?php endif; ?>

                                      

                                        <?php if (in_array('Include Route', $filters)): ?>
                                            <td style="text-align:right"><?= format_amount($finalRF) ?></td>
                                        <?php endif; ?>
										
										<?php 
											if (in_array('Fees Head Wise', $filters)) {
												foreach($fee_heads as $list) 
												{ 
										?>
												<th style="text-align:right"><?=format_amount($head_wise_totals[$list['fees_heading']] ?? 0); ?></th>
										<?php
												} 
										?>
												<th style="text-align: right;"><?= format_amount($total_head_fees) ?></th>
										<?php } ?>
                                         

                                        <td style="text-align:right"><?= format_amount(($total_fees_discount + $total_head_fees + $finalRF)) ?></td>
                                        <!--<td style="text-align:right"><?= number_format($grand_total_1, 2) ?></td>
                                        <td style="text-align:right"><?= number_format($grand_total_2, 2) ?></td>-->
                                      
                                    </tr>
                                <?php else: ?>
                                    <tr><td colspan="21" class="text-center">No records found</td></tr>
                                <?php endif; ?>
                            </tbody>
                            
                            </table>
                            <div class="d-flex justify-content-center">
                                <?//= $pagination_links; ?>
                            </div>
                            <?php }else{
                                if(isset($_POST['filter_button'])){
                                    if(empty($selectedMonths) or empty($filters) ){
                                        ?>
                                            <h3 class="text-center text-danger py-2">
                                                Kindly select at least one filter and one month to proceed.
                                            </h3>
                                        <?php
                                    }
                                }
                            } ?>

                        </div> 






                    </div>
                </div>
            </div>
        </div> 
    </section>
</div>

<script>
<?php
if ($search_type == 'period') {
    ?>

        $(document).ready(function () {
            showdate('period');
        });

    <?php
}
?>

</script>
<script>
  document.querySelectorAll('.master-check').forEach(master => {
    master.addEventListener('change', function () {
      const targetClass = this.dataset.target;
      document.querySelectorAll('.' + targetClass).forEach(cb => {
        cb.checked = this.checked;
      });
    });
  });
</script>



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





    $(document).ready(function() {
        var table = $('.example').DataTable();

        table.on('draw', function() {
            updateTotals(table);
        });

        updateTotals(table); // Initial total on load
    });


    function updateTotals(table) {
        let fees_received_sum = 0;
        let late_fees_sum = 0;
        let ledger_amt_sum = 0;
        let total_fees_sum = 0;
        let discount_amt_sum = 0;
        let net_fees_sum = 0;
        let receipt_amt_sum = 0;
        let balance_amt_sum = 0;

        table.rows({ filter: 'applied' }).every(function() {
            const row = $(this.node());

            fees_received_sum += parseFloat(row.find('td:eq(11)').text()) || 0;
            late_fees_sum     += parseFloat(row.find('td:eq(12)').text()) || 0;
            ledger_amt_sum    += parseFloat(row.find('td:eq(13)').text()) || 0;
            total_fees_sum    += parseFloat(row.find('td:eq(14)').text()) || 0;
            discount_amt_sum  += parseFloat(row.find('td:eq(15)').text()) || 0;
            net_fees_sum      += parseFloat(row.find('td:eq(16)').text()) || 0;
            receipt_amt_sum   += parseFloat(row.find('td:eq(17)').text()) || 0;
            balance_amt_sum   += parseFloat(row.find('td:eq(18)').text()) || 0;
        });

        // Set values in the <th> total row
        const totalRow = $('table tbody tr:last-child');
        totalRow.find('th:eq(11)').text(fees_received_sum.toFixed(2));
        totalRow.find('th:eq(12)').text(late_fees_sum.toFixed(2));
        totalRow.find('th:eq(13)').text(ledger_amt_sum.toFixed(2));
        totalRow.find('th:eq(14)').text(total_fees_sum.toFixed(2));
        totalRow.find('th:eq(15)').text(discount_amt_sum.toFixed(2));
        totalRow.find('th:eq(16)').text(net_fees_sum.toFixed(2));
        totalRow.find('th:eq(17)').text(receipt_amt_sum.toFixed(2));
        totalRow.find('th:eq(18)').text(balance_amt_sum.toFixed(2));
    }











</script>
