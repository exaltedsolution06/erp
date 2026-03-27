
<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
	
    </section>



    <!-- Main content -->
    <section class="content">
        <?php $this->load->view('admin/reports/_report_tab'); ?>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box removeboxmius">
                    <div class="box-header ptbnull"></div>
                    
                        <div class="">
                            <div class="box-header ptbnull"></div>    
                            <div class="box-header">
                                <h3 class="box-title">

                                    <i class="fa fa-file-text-o"></i> 
                                </h3>
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
                                    <div class="download_label"><?php echo $this->lang->line('fee_register');?></div>

                                    <table  cellpadding="8" cellspacing="0" class="table example table-striped table-bordered table-hover example table-fixed-header" style="">
                                        <thead>
                                            <tr>
                                                <th style="">Book No</th>
                                                <th style="">Sr No</th>
                                                <th style="">Date</th>
												<th style="width:70px !imortant">Adm. No</th>
                                                <th >Student</th>
                                                <th >Father</th>
                                                <th >Class</th>
                                                <th >Sec.</th>
                                                <th >Fee Cat.</th>
                                                <th >Route</th>
                                                <th >Action</th>
                                            </tr>
                                        </thead>
                                       
                                       
                                    
                                    <tbody>
                                        
                                            <?php if (!empty($certificate_data)): ?>
                                                <?php foreach ($certificate_data as $record): ?>
												<?php $record=(array)$record;  ?>
												<?php $setting_result=(array)$setting_result;  ?>
                                            <tr>
                                                <td style=""><?= $setting_result['book_no'] ?></td>
                                                <td style=""><?= $setting_result['serial_no_prefix'].$record['serial_no'] ?></td>
                                                <td style=""><?= date('d-m-Y',strtotime($record["created_date"])) ?></td>
                                                <td ><?= $record["admission_no"] ?></td>
                                                <td ><?= $record["firstname"].' '.$record["middlename"].' '.$record["lastname"] ?></td>
                                                <td ><?= $record["father_name"] ?></td>
                                                <td ><?= $record["class"] ?></td>
                                                <td ><?= $record["section"] ?></td>
                                                <td ><?=  ($this->db->get_where('fee_groups', ['id' => $record['category_id']])->row()) ? $this->db->get_where('fee_groups', ['id' => $record['category_id']])->row()->name : 'N.A'; ?>  </td>
                                                <td ><?=  ($this->db->get_where('route_head', ['id' => $record['route_id']])->row()) ? $this->db->get_where('route_head', ['id' => $record['route_id']])->row()->fees_heading : 'N.A'; ?>  </td>
                                                
                                                <td >
													<a href="javascript:void(0)" class="btn btn-default btn-xs reprint" data-toggle="tooltip" title="" data-original-title="Reprint" data-id="<?= $record["id"] ?>" data-cid="<?= $record["template_id"] ?>">
                                                        <i class="fa fa-print"></i>
                                                    </a>
													<a href="<?php echo base_url(); ?>admin/printtc/delete/<?php echo $record["certificate_id"] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Delete" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
												</td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr><td colspan="3" class="text-center">No records found</td></tr>
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
    $(document).ready(function () {
        $(document).on('click', '.reprint', function () {
            var array_to_print = [];
            var classId = '';
            var certificateId = $(this).data('cid');
            var studentId = $(this).data('id');
			item = {}
			item ["student_id"] = studentId;
			array_to_print.push(item);
            if (array_to_print.length == 0) {
                alert("<?php echo $this->lang->line('no_record_selected'); ?>");
            } else {
                $.ajax({
                    url: '<?php echo site_url("admin/printtc/generatemultiple") ?>',
                    type: 'post',
                    dataType: "html",
                    data: {'data': JSON.stringify(array_to_print), 'class_id': classId, 'certificate_id': certificateId, },
                    success: function (response) {                       
                        Popup(response);
						// $('.abc').html(response);
                    }
                });
            }
        });
    });
</script>

<script type="text/javascript">

    var base_url = '<?php echo base_url() ?>';
    function Popup(data)
    {

        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";

        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
//Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title></title>');
// frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/idcard.css">');

        frameDoc.document.write('</head>');
        frameDoc.document.write('<body>');
        frameDoc.document.write(data);
        frameDoc.document.write('</body>');
        frameDoc.document.write('</html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);


        return true;
    }
</script>