<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper">
    <section class="content-header">
    </section>

    <!-- Main content -->
    <section class="content">
        <?php //$this->load->view('reports/_finance'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box removeboxmius">
                    <div class="box-header ptbnull">
						<h4>Fee Card</h4>
					</div>

                    <div class="">
                        <!--<div class="box-header ptbnull"></div>-->
                        <div class="box-header ptbnull row">
                            <!--<h3 class="box-title titlefix col-md-4">
                                <i class="fa fa-money"></i> 
                                <?php echo $this->lang->line('online') . " " . $this->lang->line('fees') . " " . $this->lang->line('report'); ?>
                            </h3>-->
                            <div class="form-group col-md-8" style="position: relative;">
                                <label>Student Search</label>
                                <input type="text" id="searchInput" name="search_text" class="form-control" placeholder="Search By Student Name, Roll Number, Enroll Number, National Id, Local Id Etc.">
                                <ul id="suggestionsList" class="list-group" style="position: absolute; z-index: 1000; width: 100%; display: none;"></ul>
                            </div>
                        </div>
                        
                        <div class="box-body" style="padding-top: 20px;">
                            <div class="row mb-2 mt-5">
                                <?php //var_dump($student_data); ?>
                               

                                <!-- Student Information Section -->
                                <div class="col-md-8">
                                    <div  style="border: 2px solid #f2f2f2; padding: 0rem;">
                                        <table class="table table-bordered table-striped">
                                            <!--<thead>-->
                                            <!--    <tr>-->
                                            <!--        <th colspan="5" class="text-left">Student Details</th>-->
                                            <!--    </tr>-->
                                            <!--</thead>-->
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
                                                    <!-- <td colspan="3" class="text-right" id="admissionNo"></td> -->
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

                                <!-- Radio Button & Actions Section -->
                                <div class="col-md-4 mt-3 mt-md-0">
                                    <form method="POST" action="">
                                        <div class="row" style="border: 2px solid #f2f2f2; padding: 2rem;">
                                            <?php $selected = $this->input->post('feesCard'); ?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="feesCard" id="feeStructure" value="structure"
                                                    <?php if ($selected === 'structure' || $selected === null) echo 'checked'; ?>>
                                                <label class="form-check-label" for="feeStructure">Show Fee Structure</label>
                                            </div>
                                            
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="feesCard" id="receivedCard" value="received"
                                                    <?php if ($selected === 'received') echo 'checked'; ?>>
                                                <label class="form-check-label" for="receivedCard">Show Received Fees Card</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="feesCard" id="dueCard" value="due"
                                                    <?php if ($selected === 'due') echo 'checked'; ?>>
                                                <label class="form-check-label" for="dueCard">Show Due Fees Card</label>
                                            </div>

                                            <div class="text-right mt-3">
                                                <button class="btn btn-sm btn-primary">OK</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>





                            </div>

















                            <div class="row mt-5 mb-5">
                                <div class="col-sm-12">


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
                                                        $amount = 0;
                                                        if ($fees_card == 'received') {
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
                                                                echo $row->amount;
                                                                $total += $row->amount;
                                                                $column_totals[$key] += $row->amount;
                                                            } else {
                                                                echo 0;
                                                            }

                                                        } elseif ($fees_card == 'due') {
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
                                                                echo $row->amount;
                                                                $total += $row->amount;
                                                                $column_totals[$key] += $row->amount;
                                                            } else {
                                                                echo 0;
                                                            }
                                                        } else {
                                                            if (in_array($value, $db_months)) {
                                                                echo $row->amount;
                                                                $total += $row->amount;
                                                                $column_totals[$key] += $row->amount;
                                                            } else {
                                                                echo 0;
                                                            }
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
                                                        $amount = 0;
                                                        if ($fees_card == 'received') {
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
                                                                echo $row->amount;
                                                                $total += $row->amount;
                                                                $column_totals[$key] += $row->amount;
                                                            } else {
                                                                echo 0;
                                                            }
                                                        } elseif ($fees_card == 'due') {
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
                                                                echo $row->amount;
                                                                $total += $row->amount;
                                                                $column_totals[$key] += $row->amount;
                                                            } else {
                                                                echo 0;
                                                            }
                                                        } else {
                                                            if (in_array($value, $db_months)) {
                                                                echo $row->amount;
                                                                $total += $row->amount;
                                                                $column_totals[$key] += $row->amount;
                                                            } else {
                                                                echo 0;
                                                            }
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




                                </div>
                            </div>







                            <div class="table-responsive-"style="overflow-x: auto;">
                                <div class="download_label"><?php $this->customlib->get_postmessage(); ?></div>

                                <table cellpadding="8" cellspacing="0" class="table table-striped table-bordered table-hover example table-fixed-header"  style="width:1700px !important;">
                                    <thead>
                                        <tr>
                                           <th style="width:50px !imortant">S.No</th>
                                            <th style="width:70px !imortant">Date</th>
                                            <th style="width:70px !imortant">Slip No</th>
                                            <th>Months</th>
                                            <th style="text-align: right;">Fees</th>

                                            <th style="text-align: right;">Ledger Amt</th>
                                            <th style="text-align: right;">Late F.</th>
                                            <th style="text-align: right;">Total Fees</th>
                                            <th style="text-align: right;">Discount Amt</th>
                                            <th style="text-align: right;">Net Fees</th>
                                            <th style="text-align: right;">Receipt Amt</th>
                                            <th style="text-align: right;">Bal.Amt</th>
                                            <th style="text-align: right;">Mode</th>
                                            <th style="text-align: right;">User</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        
                                            <?php if (!empty($receipt_data)): ?>
                                                <?php $sno = 1; foreach ($receipt_data as $record): ?>
                                             <?php  
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
                                                
                                                <td >
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



                                                <td style="text-align: right;"><?= $record["mode"] ?></td>
                                                <td ><?= $record["create_by"] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                         <tr>
                                           
                                            <th>Total - </th>
                                            
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
                                        <?php else: ?>
                                            <tr><td colspan="14" class="text-center">No records found</td></tr>
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


document.getElementById('searchInput').addEventListener('input', function () {
    const query = this.value;
    const suggestionsList = document.getElementById('suggestionsList');

    if (query.length < 2) {
        suggestionsList.style.display = 'none';
        return;
    }

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
                        
                        const currentUrl = "<?=base_url()?>/report/fee_card";
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
