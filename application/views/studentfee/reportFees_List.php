
<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-money"></i> <?php echo $this->lang->line('fees_collection'); ?> <small><?php echo $this->lang->line('student1'); ?></small>  </h1>
    </section>



    <!-- Main content -->
    <section class="content">
        
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box removeboxmius">
                    <div class="box-header ptbnull">
						<h4>Collect Fee List</h4>
					</div>
                    
                        <div class="">
                            <!--<div class="box-header ptbnull"></div>    
                            <div class="box-header">
                                <h3 class="box-title">

                                    <i class="fa fa-file-text-o"></i> 
                                </h3>
                            </div>-->
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

                                    <!-- Submit Button -->
                                    <div class="form-group col-md-2 d-flex align-items-end">
                                        <br>
                                        <button type="submit" class="btn btn-primary btn-sm">OK</button>
                                    </div>
                                </form>

                                    
                            </div>










                                        
                                    </div>
                                    
                                </div>   
                                 <div class="table-responsive-" style="overflow: auto;">
                                    <div class="download_label"> </div>

                                    <table  cellpadding="8" cellspacing="0" class="table example table-striped table-bordered table-hover example table-fixed-header" style="width:2500px !important">
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
                                                <th style="text-align: right;">Late Fees</th>
                                                <th style="text-align: right;">Total Fees</th>
                                                <th style="text-align: right;">Discount Amt</th>
                                                <th style="text-align: right;">Net Fees</th>
                                                <th style="text-align: right;">Receipt. Amt.</th>
                                                <th style="text-align: right;">Balance Amt</th>



                                                <th >Mode</th>
                                                <th >User</th>
                                                <!-- <th >Remark</th> -->
                                                <th>Action</th>
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
                                                <td ><?= $record["admission_no"] ?></td>
                                                <td ><?= $record["firstname"].' '.$record["middlename"].' '.$record["lastname"] ?></td>
                                                <td ><?= $record["father_name"] ?></td>
                                                <td ><?= $record["class"] ?></td>
                                                <td ><?= $record["section"] ?></td>
                                                <td ><?=  ($this->db->get_where('fee_groups', ['id' => $record['category_id']])->row()) ? $this->db->get_where('fee_groups', ['id' => $record['category_id']])->row()->name : 'N.A'; ?>  </td>
                                                <td ><?=  ($this->db->get_where('route_head', ['id' => $record['vehroute_id']])->row()) ? $this->db->get_where('route_head', ['id' => $record['vehroute_id']])->row()->fees_heading : 'N.A'; ?>  </td>
                                                
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



                                                <td ><?= $record["mode"] ?></td>
                                                <td ><?= $record["create_by"] ?></td>
                                                <td>

                                                    <a href="<?php echo base_url(); ?>studentfee/edit/<?= base64_encode($record["receipt_no"]); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="Edit">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="<?php echo base_url(); ?>studentfee/studentfeelist?receipt_no=<?=$record["receipt_no"]?>&type=delete" class="btn btn-default btn-xs"  data-toggle="tooltip" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
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
                                            <th>-</th>
                                            <!-- <th>-</th> -->

                                        </tr>
                                        <?php else: ?>
                                            <tr><td colspan="21" class="text-center">No records found</td></tr>
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
        <!-- /.row -->
    </section>

    <!-- /.content -->
    <div class="clearfix"></div>
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
