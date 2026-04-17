<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
 <style>
 .table-header-sticky {
	max-height: 400px; 
	overflow-y: auto;
}
.table-header-sticky table thead th {
  position: sticky;
  top: 0;
} 
/* Sticky 5th column */
.example thead th:nth-child(5),
.example tbody td:nth-child(5) {
    position: sticky;
    left: 0;
    background: #fff;
    z-index: 2;
}

/* Header priority */
.example thead th:nth-child(5) {
    z-index: 3;
}
.filter-box {
      border: 1px solid #ccc;
      padding: 10px;
      border-radius: 5px;
      max-height: 125px;
      overflow-y: auto;
    }
 </style>
<div class="content-wrapper">

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
                   


                    <div class="">
                        <div class="box-header ptbnull"></div>
                        <div class="box-header ptbnull">
                            <h3 class="box-title titlefix">FEES HEAD WISE COLLECTION</h3>
                        </div>
						<div class="box-body" style="padding-top:0;">
						    
                                <form method="POST"  action="">
                                    <div class="row">
                                    <!-- Per Page Dropdown -->
                                    <div class="form-group col-md-2">
                                        <label for="per_page">Records per page:</label>
                                        <select name="per_page" id="per_page" onchange="this.form.submit()" class="form-control">
                                            <option value="10" <?= ($this->input->post('per_page') == 10) ? 'selected' : '' ?>>10</option>
                                            <option value="25" <?= ($this->input->post('per_page') == 25) ? 'selected' : '' ?>>25</option>
                                            <option value="50" <?= ($this->input->post('per_page') == 50) ? 'selected' : '' ?>>50</option>
                                            <option value="100" <?= ($this->input->post('per_page') == 100) ? 'selected' : '' ?>>100</option>
                                            <option value="all" <?= ($this->input->post('per_page') == 'all') ? 'selected' : '' ?>>All</option>
                                        </select>
                                    </div>

                                    

                                    <!-- Route -->
                                    <!--<div class="form-group col-md-2">
                                        <label for="routeHead">Route</label>
                                        <select class="form-control form-control-sm" id="routeHead" name="routeHead">
                                            <option value="">N/A</option>
                                            <?php foreach ($route_head as $row): ?>
                                                <option value="<?= $row->fees_heading ?>" <?= ($this->input->post('routeHead') == $row->fees_heading) ? 'selected' : '' ?>><?= $row->fees_heading ?></option>
                                            <?php endforeach; ?>
                                            <option value="All" <?= ($this->input->post('routeHead') == 'All') ? 'selected' : '' ?>>All Routes</option>
                                        </select>
                                    </div>-->

                                    <!-- Category -->
                                    <div class="form-group col-md-2">
                                        <label for="categoryHead">Fees Category</label>
                                        <select class="form-control form-control-sm" id="categoryHead" name="categoryHead">
                                            <option value="">N/A</option>
                                            <?php foreach ($category_head as $row): ?>
                                                <option value="<?= $row['id'] ?>" <?= ($this->input->post('categoryHead') == $row['id']) ? 'selected' : '' ?>><?= $row['name'] ?></option>
                                            <?php endforeach; ?>
                                            <option value="All" <?= ($this->input->post('categoryHead') == 'All') ? 'selected' : '' ?>>All Categories</option>
                                        </select>
                                    </div>

                                    <!-- Class -->
                                    <div class="form-group col-md-2">
                                        <label for="classSelect">Class</label>
                                        <select class="form-control form-control-sm" id="classSelect" name="class_id">
                                            <option value="">N/A</option>
                                            <?php foreach ($classes_data as $row): ?>
                                                <option value="<?= $row->id ?>" <?= ($this->input->post('class_id') == $row->id) ? 'selected' : '' ?>><?= $row->class ?></option>
                                            <?php endforeach; ?>
                                            <option value="All" <?= ($this->input->post('class_id') == 'All') ? 'selected' : '' ?>>All Classes</option>
                                        </select>
                                    </div>


                                    <!-- From Date -->
                                    <div class="form-group col-md-2">
                                        <label for="fromDate">From</label>
                                        <input type="date" class="form-control" id="fromDate" name="from_date" value="<?= $this->input->post('from_date') ?? date('Y-m-d') ?>" required>
                                    </div>

                                    <!-- To Date -->
                                    <div class="form-group col-md-2">
                                        <label for="toDate">To</label>
                                        <input type="date" class="form-control" id="toDate" name="to_date" value="<?= $this->input->post('to_date') ?? date('Y-m-d') ?>" required>
                                    </div>
									
                                   </div>
                                   <div class="row">
									<!-- Fees Head -->
                                    <div class="col-md-2">
                                        <!--<select class="form-control form-control-sm" id="feesHead" name="feesHead">
                                            <option value="">N/A</option>
                                            <?php foreach ($head_data as $row): ?>
                                                <option value="<?= $row->fees_heading ?>" <?= ($this->input->post('feesHead') == $row->fees_heading) ? 'selected' : '' ?>><?= $row->fees_heading ?></option>
                                            <?php endforeach; ?>
                                            <option value="All" <?= ($this->input->post('feesHead') == 'All') ? 'selected' : '' ?>>All Heads</option>
                                        </select>-->
										<div class="form-check">
											<input type="checkbox" class="form-check-input master-check" data-target="fee-check" id="selectAllFeeHead">
											<label class="form-check-label" for="selectAllFeeHead">Select Fees Head.</label>
										</div>
										<div class="filter-box">
											<?php
											$selectedFeeHead = isset($_POST['feesHead']) ? (array)$_POST['feesHead'] : [];
											foreach ($fee_heads as $row) {
											$checked = in_array($row['id'], $selectedFeeHead) ? 'checked' : '';
											echo "<div class='form-check'>
													<input type='checkbox' class='form-check-input fee-check' name='feesHead[]' value='{$row['id']}' id='fee{$row['id']}' $checked>
													<label class='form-check-label' for='fee{$row['id']}'>{$row['fees_heading']}</label>
												</div>";
											}
											?>
										</div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="form-group col-md-2 d-flex align-items-end">
                                        <br>
                                        <button type="submit" class="btn btn-primary btn-sm">OK</button>
                                    </div>
                                    </div>
                                </form>


                                <div class="table-responsive table-header-sticky">
                                    <div class="download_label"><?php echo $this->lang->line('head_wise_collection');?></div>
                                    <table  cellpadding="8" cellspacing="0" class="table table-striped table-bordered table-hover example table-fixed-header" style="width:1800px !important">
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
                                                <?php foreach($fee_heads as $list)
													{ 
														if(in_array($list['id'], $selectedFeeHead))
														{
												?>
                                                <th style="text-align:right"><?=$list['fees_heading']?></th>
                                                <?php 	} 
													} 
													if(!empty($selectedFeeHead)) {
												?>
												<th  style="text-align: right;">Fee Head Total</th>
												<?php } ?>
                                                <!--<th  style="text-align: right;">Net Fees</th>
                                                <th  style="text-align: right;">Receipt. Amt.</th>
												<th style="text-align: right;">Discount Amt</th>
                                                <th style="text-align: right;">Balance Amt</th>-->
											</tr>
                                        </thead>
                                       
                                       
                                        <tbody>
                                            <?php $total_rec_amount = 0; ?>
                                        
                                            <?php if (!empty($receipt_data)): ?>
                                                <?php $sno = 1; foreach ($receipt_data as $record): ?>
                                            <?php  
												$record=(array)$record;
												//echo '<pre>'; print_r($record); echo '<pre>';
												//$total_rec_amount += $record['rec_amount']; 
												/*$fees_received_sum       += (float)$record["fees_received"];
                                                $late_fees_sum    += (float)$record["late_fees"];
                                                $ledger_amt_sum   += (float)$record["ledger_amt"];
                                                $total_fees_sum     += (float)$record["total_fees"];
                                                $discount_amt_sum     += (float)$record["discount_amt"];
                                                $net_fees_sum  += (float)$record["net_fees"];
                                                $receipt_amt_sum  += (float)$record["receipt_amt"];
                                                $balance_amt_sum  += (float)$record["balance_amt"];*/
												
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
												foreach($fee_heads as $list) {
														
													if(in_array($list['id'], $selectedFeeHead))
													{
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
													$final += $pay;
													
													//echo '<pre>'; print_r($cat_list_amount);
													}
												}
											?>
                                            <tr>

                                                <td><?= $sno++ ?></td>
                                                <!--<td><?= $record["fee_head_name"] ?></td>-->
                                                <td><?= date('d-m-Y',strtotime($record["date_time"])) ?></td>
                                                <td><?= $record["receipt_no"] ?></td>
                                                <td><?= $record["admission_no"] ?></td>
                                                <td><?= $record["firstname"].' '.$record["middlename"].' '.$record["lastname"] ?></td>
                                                <td><?= $record["father_name"] ?></td>
                                                <td><?= $record["class"] ?></td>
                                                <td><?= $record["section"] ?></td>
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
												<?php
													$fee_heads_total_amount = 0;
													foreach($fee_heads as $list){
														if(in_array($list['id'], $selectedFeeHead))
														{
															$head_wise_totals[$list['fees_heading']] += $cat_list_amount[$list['fees_heading']];
															
															$fee_heads_total_amount += $cat_list_amount[$list['fees_heading']];
												?>
															<td style="text-align:right"><?=number_format($cat_list_amount[$list['fees_heading']],2); ?></td>
												<?php 
														}
													}
													if(!empty($selectedFeeHead)) {
												?>
													<td style="text-align: right;"><?= sprintf('%.2f', $fee_heads_total_amount) ?></td>
												<?php } ?>
												<!--<td style="text-align: right;"><?= sprintf('%.2f', $record["net_fees"]) ?></td>
                                                <td style="text-align: right;"><?= sprintf('%.2f', $record["receipt_amt"]) ?></td>
                                                <td style="text-align: right;"><?= sprintf('%.2f', $record["discount_amt"]) ?></td>
                                                <td style="text-align: right;"><?= sprintf('%.2f', $record["balance_amt"]) ?></td>-->
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
  											<?php foreach($fee_heads as $list) 
												{ 
												if(in_array($list['id'], $selectedFeeHead))
														{
											?>
												<th style="text-align:right"><?=number_format($head_wise_totals[$list['fees_heading']] ?? 0, 2); ?></th>
											<?php } } if(!empty($selectedFeeHead)) { ?>
												<th style="text-align: right;"><?= sprintf('%.2f', $final) ?></th>
											<?php } ?>
                                           <!--<th style="text-align: right;"><?= sprintf('%.2f', $net_fees_sum) ?></th>
                                            <th style="text-align: right;"><?= sprintf('%.2f', $receipt_amt_sum) ?></th>
                                            <th style="text-align: right;"><?= sprintf('%.2f', $discount_amt_sum) ?></th>
                                            <th style="text-align: right;"><?= sprintf('%.2f', $balance_amt_sum) ?></th>-->
                                        </tr>
                                        <?php else: ?>
                                            <tr><td colspan="12" class="text-center">No records found</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                    
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        <?= $pagination_links; ?>
                                    </div>
                                </div> 














                      
                    </div>
                </div>
            </div>
        </div>   
</div>  
</section>
</div>





<script>
  // Get today's date in yyyy-mm-dd format
//   const today = new Date().toISOString().split('T')[0];
//   document.getElementById('fromDate').value = today;
//   document.getElementById('toDate').value = today;
</script>



<script type="text/javascript">
// Handle each section's master checkbox
document.addEventListener('DOMContentLoaded', function () {

  document.querySelectorAll('.master-check').forEach(master => {
    master.addEventListener('change', function () {
      const targetClass = this.dataset.target;

      document.querySelectorAll('.' + targetClass).forEach(cb => {
        cb.checked = this.checked;
      });
    });
  });

});

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
