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
</style>

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
                  


                    <div class="">
                        <div class="box-header ptbnull"></div>
                        <div class="box-header ptbnull">
                            <h3 class="box-title titlefix"> Route Wise Collection Report</h3>
                        </div>
						<div class="box-body" style="padding-top:0;">
						
                        



                           
                                
                             <form method="get"  action="">
                                 <div class="row">
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

                                    <!-- Fees Head -->
                                   

                                    <!-- Route -->
                                    <div class="form-group col-md-2">
                                        <label for="routeHead">Route</label>
                                        <select class="form-control form-control-sm" id="routeHead" name="routeHead">
                                            <option value="">N/A</option>
                                            <?php foreach ($route_head as $row): ?>
                                                <option value="<?= $row->fees_heading ?>" <?= ($this->input->get('routeHead') == $row->fees_heading) ? 'selected' : '' ?>><?= $row->fees_heading ?></option>
                                            <?php endforeach; ?>
                                            <option value="All" <?= ($this->input->get('routeHead') == 'All') ? 'selected' : '' ?>>All Routes</option>
                                        </select>
                                    </div>
                                     <!-- <div class="form-group col-md-2">
                                        <label for="feesHead">Fees Head</label>
                                        <select class="form-control form-control-sm" id="feesHead" name="feesHead">
                                            <option value="">N/A</option>
                                            <?php foreach ($head_data as $row): ?>
                                                <option value="<?= $row->fees_heading ?>" <?= ($this->input->get('feesHead') == $row->fees_heading) ? 'selected' : '' ?>><?= $row->fees_heading ?></option>
                                            <?php endforeach; ?>
                                            <option value="All" <?= ($this->input->get('feesHead') == 'All') ? 'selected' : '' ?>>All Heads</option>
                                        </select>
                                    </div> -->
                                    <!-- Category -->
                                    

                                    <!-- Class -->
                                    <div class="form-group col-md-2">
                                        <label for="classSelect">Class</label>
                                        <select class="form-control form-control-sm" id="classSelect" name="class_id">
                                            <option value="">N/A</option>
                                            <?php foreach ($classes_data as $row): ?>
                                                <option value="<?= $row->id ?>" <?= ($this->input->get('class_id') == $row->id) ? 'selected' : '' ?>><?= $row->class ?></option>
                                            <?php endforeach; ?>
                                            <option value="All" <?= ($this->input->get('class_id') == 'All') ? 'selected' : '' ?>>All Classes</option>
                                        </select>
                                    </div>
                                     <div class="form-group col-md-2">
                                        <label for="categoryHead">Fees Category</label>
                                        <select class="form-control form-control-sm" id="categoryHead" name="categoryHead">
                                            <option value="">N/A</option>
                                            <?php foreach ($category_head as $row): ?>
                                                <option value="<?= $row['id'] ?>" <?= ($this->input->get('categoryHead') == $row['id']) ? 'selected' : '' ?>><?= $row['name'] ?></option>
                                            <?php endforeach; ?>
                                            <option value="All" <?= ($this->input->get('categoryHead') == 'All') ? 'selected' : '' ?>>All Categories</option>
                                        </select>
                                    </div>
                                                   </div>

                                     <div class="row">
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
                                       </div>

                                </form>
                                    



























                                <div class="table-responsive">
                                    <div class="download_label"> <?php
                                        // echo $this->lang->line('fees_statement') . "<br>";
                                        $this->customlib->get_postmessage();
                                        ?></div>

                                    <table  cellpadding="8" cellspacing="0" class="table table-striped table-bordered table-hover example table-fixed-header">
                                        <thead>
                                            <tr>
                                                <th>Route Name</th>
                                                <th>Adm. No</th>
                                                <th>Student</th>
                                                <th>Father</th>
                                                <th>Class</th>
                                                <th>Sec.</th>
                                                <th style="text-align:right">Total Fee</th>
                                                <th style="text-align:right">Discount</th>
                                                <th style="text-align:right">Net Fee</th>
                                                <th style="text-align:right">Rec. Amt.</th>
                                                <th style="text-align:right">Bal. Amt.</th>
                                            </tr>
                                        </thead>
                                       
                                       
                                    
                                    <tbody>
                                        <?php
$total_fees_sum = 0;
$discount_amt_sum = 0;
$net_fees_sum = 0;
$receipt_amt_sum = 0;
$balance_amt_sum = 0;
?>
                                            <?php if (!empty($receipt_data)): ?>
                                                <?php $sno = 1; foreach ($receipt_data as $record): ?>
                                            <?php  $record=(array)$record; ?>
                                              <?php
            $total_fees_sum += $record["rec_amount"];
            $discount_amt_sum += $record["discount_amt"];
            $net_fees_sum += $record["rec_amount"]-$record["discount_amt"];
            $receipt_amt_sum += $record["rec_amount"]-$record["discount_amt"];
            $balance_amt_sum += 0;

        ?>

                                            <tr>
                                                
                                                <td><?= $record["fee_head_name"] ?></td>
                                                <td><?= $record["admission_no"] ?></td>
                                                <td><?= $record["firstname"].' '.$record["middlename"].' '.$record["lastname"] ?></td>
                                                <td><?= $record["father_name"] ?></td>
                                                <td><?= $record["class"] ?></td>
                                                <td><?= $record["section"] ?></td>
                                               <td style="text-align:right"><?= number_format($record["rec_amount"], 2) ?></td>
												<td style="text-align:right"><?= number_format($record["discount_amt"], 2) ?></td>
												<td style="text-align:right"><?= number_format(($record["rec_amount"]-$record["discount_amt"]), 2) ?></td>
												<td style="text-align:right"><?= number_format($record["rec_amount"]-$record["discount_amt"], 2) ?></td>
												<td style="text-align:right"><?= number_format(0, 2) ?></td>

                                            </tr>
                                        <?php endforeach; ?>
                                          <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
        <td colspan="" style="text-align: right;"><strong>Grand Total</strong></td>
        <td style="text-align:right"><strong><?= number_format($total_fees_sum, 2) ?></strong></td>
        <td style="text-align:right"><strong><?= number_format($discount_amt_sum, 2) ?></strong></td>
        <td style="text-align:right"><strong><?= number_format($net_fees_sum, 2) ?></strong></td>
        <td style="text-align:right"><strong><?= number_format($receipt_amt_sum, 2) ?></strong></td>
        <td style="text-align:right"><strong><?= number_format($balance_amt_sum, 2) ?></strong></td>
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
























                        <div class="box-body table-responsive" hidden >
                            <div class="download_label"><?php
                                echo $this->lang->line('payroll') . " " . $this->lang->line('report');
                                $this->customlib->get_postmessage();
                                ;
                                ?></div>
                            <table border="1" cellpadding="8" cellspacing="0" class="table table-striped table-bordered table-hover example">
							  <thead style="background-color: #00bcd4; color: white;">
								<tr>
								  <th>Route Name</th>
								  <th>Adm. No</th>
								  <th>Student</th>
								  <th>Father</th>
								  <th>Class</th>
								  <th>Sec.</th>
								  <th>Total Fee</th>
								  <th>Discount</th>
								  <th>Net Fee</th>
								  <th>Rec. Amt.</th>
								  <th>Bal. Amt.</th>
								</tr>
							  </thead>
							  <tbody>
								<tr>
								  <td>Route A</td>
								  <td>ADM002</td>
								  <td>Jane Smith</td>
								  <td>Mr. Smith</td>
								  <td>9</td>
								  <td>B</td>
								  <td>5000</td>
								  <td>500</td>
								  <td>4500</td>
								  <td>3000</td>
								  <td>1500</td>
								</tr>
							  </tbody>
							</table>


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
