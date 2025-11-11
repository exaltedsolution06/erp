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


<div class="content-wrapper" style="min-height: 946px;">

    <section class="content-header">
        <h1>
            <i class="fa fa-bus"></i> <?php echo $this->lang->line('transport'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php //$this->load->view('reports/_finance'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box removeboxmius">
                    <div class="box-header ptbnull">
						<h4>Defaulter List</h4>
					</div>
                   


                    <div class="">
                        <!-- <div class="box-header ptbnull"></div> -->
                        <!--<div class="box-header ptbnull">
                            <h5 class="mb-3">DEFAULTERS LIST</h5>
                             <h3 class="box-title titlefix"><i class="fa fa-money"></i> <?php echo $this->lang->line('income') . " " . $this->lang->line('group') . " " . $this->lang->line('report'); ?></h3> 
                        </div>-->
						<div class="box-body" style="padding-top:0;">
						   



                            <div class="container-fluid">
                                <div class="card p-3">
                                    <form action="" method="POST">
                                        <div class="box-header-ptbnull"></div>
                                        <div class="row">

                                            <!-- Filters -->
                                            <div class="col-md-3 mb-3">
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

                                                    // var_dump($class);
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
                                                    <label class="form-check-label" for="selectAllFee">Select Fee Cat.</label>
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
                                            <div class="col-md-2 mb-3">
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
                                            </div>

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







                                






                                <div class="table-responsive">
                                    <div class="download_label"> <?php
                                        // echo $this->lang->line('fees_statement') . "<br>";
                                        $this->customlib->get_postmessage();
                                        ?></div>

                                    <?php if(!empty($filters) and !empty($selectedMonths)){ ?>
                                    <table  cellpadding="8" cellspacing="0" class="table table-striped table-bordered table-hover example table-fixed-header">
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

                                                    
                                                    if(in_array('Fees Head Wise', $filters)){
                                                        foreach($fee_heads as $list){ ?>
                                                            <th style="text-align:right"><?=$list['fees_heading']?></th>
                                                        <?php }
                                                    }
                                                    
                                                    if(in_array('Show Total & Recd.', $filters)){

                                                        ?>
                                                            <th style="text-align:right">Fees Total.</th>
                                                            <th style="text-align:right">Rec. Amount</th>
                                                        <?php

                                                    }
                                                    
                                                    if(in_array('Include Route', $filters)){
                                                        
                                                        ?><th style="text-align:right"> Route Amount</th><?php
                                                    }
                                                    
                                                   

                                                
                                                ?>



                                                <th style="text-align:right">Total Fee</th>
                                            </tr>
                                        </thead>
                                       
                                       
                                    
                                    <tbody>
                                            
                                            <?php 
                                            
                                            $total_fees_discount = 0;
                                            $head_wise_totals = []; // index by fee head
                                            $total_route = 0;
                                            $grand_total = 0;
                                            if (!empty($receipt_data)): ?>
                                                <?php $sno = 1; foreach ($receipt_data as $record): ?>
                                            <?php  $record=(array)$record;   $final=0;?>
                                            <?php

                                                    $filters = $_POST['filters'];



                                                    if(in_array('Consider Old Bal', $filters)){
                                                        $final+=$record["fees_discount"];
                                                    }








                                                     
                                                    if(in_array('Fees Head Wise', $filters)){
                                                        $cat_list_amount=[];
                                                        foreach($fee_heads as $list){ 
                                                           
                                                        ?>
                                                            <?php 
                                                                $class_id = $record['class_id'];
                                                                $category_id = $record['category_id'];
                                                                $fee_group_id = $list['fees_heading'];

                                                                // Fetch the matching fee plan
                                                                $this->db->from('fees_plan');
                                                                $this->db->where('fee_group_id', $list['id']);
                                                                $this->db->where("JSON_CONTAINS(fees_plan.class_ids, '\"$class_id\"')", null, false);
                                                                $this->db->where("JSON_CONTAINS(fees_plan.category_ids, '\"$category_id\"')", null, false);
                                                                $query = $this->db->get();
                                                                $amt_fee_heads = $query->row();

                                                                $db_months = json_decode($list['months'] ?? '[]');

                                                                $selected_months = $_POST['months'] ?? [];
                                                                if (!is_array($selected_months)) {
                                                                    $selected_months = [$selected_months];
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
                                                                        'months' => $month
                                                                    ]);
                                                                    $receipt = $this->db->get('receipts')->row();

                                                                    // echo json_encode($receipt);
                                                                    // echo $amt_fee_heads->amount;
                                                                    
                                                                    if (empty($receipt)) {
                                                                        $pay+= $amt_fee_heads->amount??0;
                                                                    } else {
                                                                        // $pay+=$receipt->fees_received;
                                                                        $pay+=0;
                                                                    }
                                                                }

                                                                // echo $pay;
                                                                array_push($cat_list_amount,$pay);
                                                                $final += $pay;
                                                            
                                                            ?>

                                                            <?php  
                                                        }
                                                    }
                                                    
                                                   
                                                    $routeFees=0;


                                                    if(in_array('Include Route', $filters)){

                                                       
                                                        ?>
                                                        
                                                            <?php 
                                                             foreach($routes as $list){ 
                                                                $class_id = $record['class_id'];
                                                                $category_id = $record['category_id'];
                                                                $fee_group_id = $list['fees_heading'];

                                                                
                                                                $route = $this->db->get_where('route_head', ['id' => $record['vehroute_id']])->row();

                                                                $db_months = [];
                                                                if ($route && !empty($route->months)) {
                                                                    $decoded = json_decode($route->months, true);
                                                                    $db_months = is_array($decoded) ? $decoded : [];
                                                                }

                                                                // var_dump($db_months);

                                                                $this->db->from('route_plan');
                                                                $this->db->where('fee_group_id', $record['vehroute_id']);
                                                                $this->db->where("JSON_CONTAINS(route_plan.class_ids, '\"$class_id\"')", null, false);
                                                                $this->db->where("JSON_CONTAINS(route_plan.category_ids, '\"$category_id\"')", null, false);
                                                               

                                                                $query = $this->db->get();
                                                                $amt_fee_heads = $query->row();
                                                                
                                                                // $db_months = json_decode($db_months);
                                                              
                                                                $selected_months = $_POST['months'] ?? [];
                                                                if (!is_array($selected_months)) {
                                                                    $selected_months = [$selected_months];
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
                                                                        'months' => $month
                                                                    ]);
                                                                    $receipt = $this->db->get('receipts')->row();

                                                                    // echo json_encode($receipt);
                                                                    // echo $amt_fee_heads->amount;
                                                                    
                                                                    if (empty($receipt)) {
                                                                        $pay+= $amt_fee_heads->amount??0;
                                                                    } else {
                                                                        // $pay+=$receipt->fees_received;
                                                                        $pay+=0;
                                                                    }
                                                                }

                                                            }
                                                               
                                                                $final += $routeFees= $pay;
                                                            
                                                            ?>  
                                                       
                                                        <?php






                                                    }
                                                    
                                                    

                                                
                                                ?>


                                            <?php if($final>0){
                                                ?>
                                                <tr>
                                                    <td><?= $sno++ ?></td>
                                                    <td><?= $record["admission_no"] ?><?php //json_encode($record)?></td>
                                                    <td><?= $record["firstname"].' '.$record["middlename"].' '.$record["lastname"] ?></td>
                                                    <td><?= $record["father_name"] ?></td>
                                                    <td><?= $record["class"] ?></td>
                                                    <td><?= $record["section"] ?></td>
                                                    <td ><?=  ($this->db->get_where('fee_groups', ['id' => $record['category_id']])->row()) ? $this->db->get_where('fee_groups', ['id' => $record['category_id']])->row()->name : 'N.A'; ?>  </td>
                                                
                                                    <td ><?=  ($this->db->get_where('route_head', ['id' => $record['vehroute_id']])->row()) ? $this->db->get_where('route_head', ['id' => $record['vehroute_id']])->row()->fees_heading : 'N.A'; ?>  </td>
                                                    
                                                    <?php
                                                        if(in_array('Consider Old Bal', $filters)){
                                                            ?><td style="text-align:right"><?= number_format($record["fees_discount"], 2) ?></td> <?php
                                                        }



                                                        if(in_array('Fees Head Wise', $filters)){
                                                            foreach($cat_list_amount as $key=>$value){ 
                                                                $head_wise_totals[$key] += $value; 
                                                            ?>
                                                                <td style="text-align:right">
                                                                    <?php 
                                                                        echo number_format($value,2);
                                                                    ?>  
                                                                </td>
                                                            <?php  
                                                            }
                                                        }





                                                        if(in_array('Include Route', $filters)){

                                                            ?>
                                                                <td style="text-align:right"><?= number_format($routeFees,2);?></td>
                                                            <?php
                                                       
                                                        }

                                                    ?>
                                                    <td style="text-align:right"><?=number_format($final,2)?></td>
                                                    
                                                </tr>
                                                <?php

                                                $total_fees_discount += $record["fees_discount"];
                                                $total_route += $routeFees;
                                                $grand_total += $final;
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
                                                    <td style="text-align:right"><?= number_format($total_fees_discount, 2) ?></td>
                                                <?php endif; ?>

                                                <?php 
                                                if (in_array('Fees Head Wise', $filters)) {
                                                    foreach($cat_list_amount as $key => $value): ?>
                                                        <td style="text-align:right"><?= number_format($head_wise_totals[$key] ?? 0, 2) ?></td>
                                                <?php endforeach; } ?>

                                                <?php if (in_array('Include Route', $filters)): ?>
                                                    <td style="text-align:right"><?= number_format($total_route, 2) ?></td>
                                                <?php endif; ?>

                                                <td style="text-align:right"><?= number_format($grand_total, 2) ?></td>
                                            </tr>
                                        <?php else: ?>
                                            <tr><td colspan="21" class="text-center">No records found</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                    
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        <?= $pagination_links; ?>
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
  // Handle each section's master checkbox
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
