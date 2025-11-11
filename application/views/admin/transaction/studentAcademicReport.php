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

                                    <table  cellpadding="8" cellspacing="0" class="table table-striped table-bordered table-hover example table-fixed-header" style="width:2000px !important">
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


                                                <!-- <th >Fee</th>
                                                <th >Late Fees</th>
                                                <th >Ledger Amt</th>
                                                <th >Total Fees</th>
                                                <th >Discount Amt</th> -->
                                                <th  style="text-align: right;">Net Fees</th>
                                                <th  style="text-align: right;">Receipt. Amt.</th>
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


                                              

                                            <td style="text-align: right;"><?= sprintf('%.2f', $record["net_fees"]) ?></td>
                                                <td style="text-align: right;"><?= sprintf('%.2f', $record["receipt_amt"]) ?></td>
                                                <td style="text-align: right;"><?= sprintf('%.2f', $record["balance_amt"]) ?></td>

                                                <td ><?= $record["mode"] ?></td>
                                                <td ><?= $record["create_by"] ?></td>
                                                <td ><?= $record["remarks"] ?></td>
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
                                          
                                           <th style="text-align: right;"><?= sprintf('%.2f', $net_fees_sum) ?></th>
                                            <th style="text-align: right;"><?= sprintf('%.2f', $receipt_amt_sum) ?></th>
                                            <th style="text-align: right;"><?= sprintf('%.2f', $balance_amt_sum) ?></th>

                                            <th>-</th>
                                            <th>-</th>
                                            <th>-</th>
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


