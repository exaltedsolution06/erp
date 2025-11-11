<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>

<div class="content-wrapper">
    <section class="content-header"></section>

    <!-- Main content -->
    <section class="content">
        <?php $this->load->view('reports/_finance'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="box removeboxmius">
                    <div class="box-header ptbnull">
                        <h4>Receipt Book</h4>
                    </div>

                    <div class="box-body" style="padding-top:0;">
                        <div class="row">
                            <div class="col-md-12">
                                <div style="background: #dadada; height: 1px; width: 100%; margin-bottom: 10px;"></div>
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

                        <div class="table-responsive" style="overflow: auto;">
                            <div class="download_label"></div>
                            <table class="table table-striped table-bordered table-hover example table-fixed-header" style="width:100% !important" cellpadding="8" cellspacing="0">
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
                                        <th style="text-align: right;">Rec. Amt.</th>
                                        <th>Mode</th>
                                        <th>User</th>
                                        <th>Remark</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $total_amount = 0;
                                    if (!empty($receipt_data)):
                                        $sno = 1;
                                        foreach ($receipt_data as $record):
                                            $record = (array) $record;
                                            $total_amount += floatval($record["receipt_amt"]);
                                    ?>
                                        <tr>
                                            <td><?= $sno++ ?></td>
                                            <td><?= date('d-m-Y', strtotime($record["date_time"])) ?></td>
                                            <td><?= $record["receipt_no"] ?></td>
                                            <td><?= $record["admission_no"] ?></td>
                                            <td><?= $record["firstname"] . ' ' . $record["middlename"] . ' ' . $record["lastname"] ?></td>
                                            <td><?= $record["father_name"] ?></td>
                                            <td><?= $record["class"] ?></td>
                                            <td><?= $record["section"] ?></td>
                                            <td style="text-align: right;"><?= sprintf('%.2f', $record["receipt_amt"]) ?></td>
                                            <td><?= $record["mode"] ?></td>
                                            <td><?= $record["create_by"] ?></td>
                                            <td><?= $record["remarks"] ?></td>
                                            <!-- <td>
                                                <a data-placement="left" class="btn btn-default btn-xs"  data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a data-placement="left" class="btn btn-default btn-xs"  data-toggle="tooltip" title="Delete" >
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                            </td> -->
                                        </tr>
                                    <?php endforeach; ?>
                                            <tr>
                                                <td class="text-end"><strong>Total</strong></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <th style="text-align: right;"><?= sprintf('%.2f', $total_amount) ?></th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <!-- <td></td> -->
                                            </tr>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="12" class="text-center">No records found</td>
                                        </tr>
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
    </section>
</div>

<!-- Scripts -->
<script>
function removeElement() {
    document.getElementById("imgbox1").style.display = "block";
}

function getSectionByClass(class_id, section_id) {
    if (class_id !== "" && section_id !== "") {
        $('#section_id').html("");
        var base_url = '<?= base_url() ?>';
        var div_data = '<option value=""><?= $this->lang->line('select') ?></option>';

        $.ajax({
            type: "GET",
            url: base_url + "sections/getByClass",
            data: { class_id: class_id },
            dataType: "json",
            success: function(data) {
                $.each(data, function(i, obj) {
                    var sel = (section_id == obj.section_id) ? "selected" : "";
                    div_data += `<option value="${obj.section_id}" ${sel}>${obj.section}</option>`;
                });
                $('#section_id').html(div_data);
            }
        });
    }
}

$(document).ready(function () {
    $('#class_id').change(function () {
        $('#section_id').html("");
        var class_id = $(this).val();
        var base_url = '<?= base_url() ?>';
        var div_data = '<option value=""><?= $this->lang->line('select') ?></option>';

        $.ajax({
            type: "GET",
            url: base_url + "sections/getByClass",
            data: { class_id: class_id },
            dataType: "json",
            success: function(data) {
                $.each(data, function(i, obj) {
                    div_data += `<option value="${obj.section_id}">${obj.section}</option>`;
                });
                $('#section_id').html(div_data);
            }
        });
    });

    $('#section_id').change(function () {
        getStudentsByClassAndSection();
    });

    var class_id = $('#class_id').val();
    var section_id = '<?= set_value('section_id') ?>';
    getSectionByClass(class_id, section_id);
});

function getStudentsByClassAndSection() {
    $('#student_id').html("");
    var class_id = $('#class_id').val();
    var section_id = $('#section_id').val();
    var base_url = '<?= base_url() ?>';
    var div_data = '<option value=""><?= $this->lang->line('select') ?></option>';

    $.ajax({
        type: "GET",
        url: base_url + "student/getByClassAndSection",
        data: { class_id: class_id, section_id: section_id },
        dataType: "json",
        success: function(data) {
            $.each(data, function(i, obj) {
                div_data += `<option value="${obj.id}">${obj.firstname} ${obj.lastname}</option>`;
            });
            $('#student_id').append(div_data);
        }
    });
}

$(document).ready(function () {
    $("ul.type_dropdown input[type=checkbox]").change(function () {
        var line = "";
        $("ul.type_dropdown input[type=checkbox]:checked").each(function () {
            line += $("+ span", this).text() + ";";
        });
        $("input.form-control").val(line);
    });

    $.extend($.fn.dataTable.defaults, {
        ordering: false,
        paging: false,
        bSort: false,
        info: false
    });
});

document.getElementById("print").style.display = "block";
document.getElementById("btnExport").style.display = "block";

function printDiv() {
    document.getElementById("print").style.display = "none";
    document.getElementById("btnExport").style.display = "none";
    var divElements = document.getElementById('transfee').innerHTML;
    var oldPage = document.body.innerHTML;
    document.body.innerHTML = `<html><head><title></title></head><body>${divElements}</body>`;
    window.print();
    document.body.innerHTML = oldPage;
    location.reload(true);
}

function fnExcelReport() {
    var tab = document.getElementById('headerTable');
    var tab_text = "<table border='2px'><tr>";

    for (var j = 0; j < tab.rows.length; j++) {
        tab_text += tab.rows[j].innerHTML + "</tr>";
    }

    tab_text += "</table>";
    tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, "")
                       .replace(/<img[^>]*>/gi, "")
                       .replace(/<input[^>]*>|<\/input>/gi, "");

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
        txtArea1.document.open("txt/html", "replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus();
        txtArea1.document.execCommand("SaveAs", true, "Receipt_Report.xls");
    } else {
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
    }

    return true;
}
</script>
