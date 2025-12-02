<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>
<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>     
<div class="content-wrapper">

    <section class="content-header">
        <h1><i class="fa fa-newspaper-o"></i> <?php echo $this->lang->line('certificate'); ?></h1>
    </section>

    <section class="content">
        <div class="row">


            <?php
            if ($this->rbac->hasPrivilege('design_report_card', 'can_edit')) {
                ?>
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('report_card'); ?></h3>
                        </div><!-- /.box-header -->

                        <form  enctype="multipart/form-data" action="<?php echo site_url('admin/reportcard/edit/' . $reportcard->id) ?>"  id="editform" name="editform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php echo validation_errors(); ?>
                                <input type="hidden" name="id" value="<?php echo $reportcard->id; ?>">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>                           
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('template'); ?></label><small class="req"> *</small>
                                    <input autofocus="" id="template" name="template" placeholder="" type="text" class="form-control" value="<?php echo set_value('template', $reportcard->template); ?>"/>
                                    <span class="text-danger"><?php echo form_error('template'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('session').' '.$this->lang->line('title'); ?></label>
                                    <input autofocus="" id="title" name="title" placeholder="" type="text" class="form-control" value="<?php echo set_value('title', $reportcard->title); ?>"/>
                                    <span class="text-danger"><?php echo form_error('title'); ?></span>
                                </div>
								
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('header').' '.$this->lang->line('image'); ?></label>
                                    <input id="documents" name="header_img" placeholder="" type="file" class="filestyle form-control" data-height="40"  name="background_image">
                                </div>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('left') . " " . $this->lang->line('sign'); ?></label>
                                    <input id="documents" name="left_sign" placeholder="" type="file" class="filestyle form-control" data-height="40"  name="left_sign">
                                    <span class="text-danger"><?php echo form_error('left_sign'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('middle') . " " . $this->lang->line('sign'); ?></label>
                                    <input id="documents" name="middle_sign" placeholder="" type="file" class="filestyle form-control" data-height="40"  name="middle_sign">
                                    <span class="text-danger"><?php echo form_error('middle_sign'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('right') . " " . $this->lang->line('sign'); ?></label>
                                    <input id="documents" name="right_sign" placeholder="" type="file" class="filestyle form-control" data-height="40"  name="right_sign">
                                    <span class="text-danger"><?php echo form_error('right_sign'); ?></span>
                                </div>
								
                                <div class="form-group switch-inline">
                                    <label><?php echo $this->lang->line('name'); ?></label>
                                    <div class="material-switch switchcheck">
                                        <input id="is_name" name="is_name" type="checkbox" class="chk" value="1" <?php echo set_checkbox('is_name', '1', (set_value('is_name', $reportcard->is_name) == 1) ? TRUE : FALSE); ?>>
                                        <label for="is_name" class="label-success"></label>
                                    </div>
                                </div>
                                <div class="form-group switch-inline">
                                    <label><?php echo $this->lang->line('father') . " " . $this->lang->line('name'); ?></label>
                                    <div class="material-switch switchcheck">
                                        <input id="is_father_name" name="is_father_name" type="checkbox" class="chk" value="1" <?php echo set_checkbox('is_father_name', '1', (set_value('is_father_name', $reportcard->is_father_name) == 1) ? TRUE : FALSE); ?>>
                                        <label for="is_father_name" class="label-success"></label>
                                    </div>
                                </div>
                                <div class="form-group switch-inline">
                                    <label><?php echo $this->lang->line('mother') . " " . $this->lang->line('name'); ?></label>
                                    <div class="material-switch switchcheck">
                                        <input id="is_mother_name" name="is_mother_name" type="checkbox" class="chk" value="1" <?php echo set_checkbox('is_mother_name', '1', (set_value('is_mother_name', $reportcard->is_mother_name) == 1) ? TRUE : FALSE); ?>>
                                        <label for="is_mother_name" class="label-success"></label>
                                    </div>
                                </div>
                                <div class="form-group switch-inline">
                                    <label><?php echo $this->lang->line('date_of_birth'); ?></label>
                                    <div class="material-switch switchcheck">
                                        <input id="is_dob" name="is_dob" type="checkbox" class="chk" value="1" <?php echo set_checkbox('is_dob', '1', (set_value('is_dob', $reportcard->is_dob) == 1) ? TRUE : FALSE); ?>>
                                        <label for="is_dob" class="label-success"></label>
                                    </div>
                                </div>
                                <div class="form-group switch-inline">
                                    <label><?php echo $this->lang->line('admission') . " " . $this->lang->line('no'); ?></label>
                                    <div class="material-switch switchcheck">
                                        <input id="is_admission_no" name="is_admission_no" type="checkbox" class="chk" value="1" <?php echo set_checkbox('is_admission_no', '1', (set_value('is_admission_no', $reportcard->is_admission_no) == 1) ? TRUE : FALSE); ?>>
                                        <label for="is_admission_no" class="label-success"></label>
                                    </div>
                                </div>
                                <div class="form-group switch-inline">
                                    <label><?php echo $this->lang->line('roll') . " " . $this->lang->line('no') ?></label>
                                    <div class="material-switch switchcheck">
                                        <input id="is_roll_no" name="is_roll_no" type="checkbox" class="chk" value="1" <?php echo set_checkbox('is_roll_no', '1', (set_value('is_roll_no', $reportcard->is_roll_no) == 1) ? TRUE : FALSE); ?>>
                                        <label for="is_roll_no" class="label-success"></label>
                                    </div>
                                </div>
                                <div class="form-group switch-inline">
                                    <label><?php echo $this->lang->line('class'); ?></label>
                                    <div class="material-switch switchcheck">
                                        <input id="is_class" name="is_class" type="checkbox" class="chk" value="1" <?php echo set_checkbox('is_class', '1', (set_value('is_class', $reportcard->is_class) == 1) ? TRUE : FALSE); ?>>
                                        <label for="is_class" class="label-success"></label>
                                    </div>
                                </div>
                                <div class="form-group switch-inline">
                                    <label><?php echo $this->lang->line('section'); ?></label>
                                    <div class="material-switch switchcheck">
                                        <input id="is_section" name="is_section" type="checkbox" class="chk" value="1" <?php echo set_checkbox('is_section', '1', (set_value('is_section', $reportcard->is_section) == 1) ? TRUE : FALSE); ?>>
                                        <label for="is_section" class="label-success"></label>
                                    </div>
                                </div>
                                <div class="form-group switch-inline">
                                    <label><?php echo $this->lang->line('contactno'); ?></label>
                                    <div class="material-switch switchcheck">
                                        <input id="is_contactno" name="is_contactno" type="checkbox" class="chk" value="1" <?php echo set_checkbox('is_contactno', '1', (set_value('is_contactno', $reportcard->is_contactno) == 1) ? TRUE : FALSE); ?>>
                                        <label for="is_contactno" class="label-success"></label>
                                    </div>
                                </div>

                                <div class="form-group switch-inline">
                                    <label><?php echo $this->lang->line('header'); ?></label>
                                    <div class="material-switch switchcheck">
                                        <input id="is_header" name="is_header" type="checkbox" class="chk" value="1" <?php echo set_checkbox('is_header', '1', (set_value('is_header', $reportcard->is_section) == 1) ? TRUE : FALSE); ?>>
                                        <label for="is_header" class="label-success"></label>
                                    </div>
                                </div>
								
								<?php foreach($exam_groups as $exam_groups_val){
									$saved_json = json_decode($reportcard->exam_group_grade, true);								
								?>
									<div class="form-group switch-inline">
										<label><?php echo $this->lang->line('show'); ?> <?php echo $this->lang->line('grade'); ?> <?= $exam_groups_val->name; ?></label>

										<div class="material-switch switchcheck">
											<input id="exam_group_<?= $exam_groups_val->id ?>"
												   name="exam_group[<?= $exam_groups_val->id ?>]"
												   type="checkbox"
												   class="chk"
												   value="1"
												   <?= isset($saved_json[$exam_groups_val->id]) && $saved_json[$exam_groups_val->id] == 1 ? 'checked' : '' ?>
											>
											<label for="exam_group_<?= $exam_groups_val->id ?>" class="label-success"></label>
										</div>
									</div>
								<?php } ?>
								<div class="form-group switch-inline">
									<label><?php echo $this->lang->line('show'); ?> <?php echo $this->lang->line('overall'); ?> <?php echo $this->lang->line('grade'); ?></label>

									<div class="material-switch switchcheck">
										<input id="exam_group_overall"
											   name="exam_group[overall]"
											   type="checkbox"
											   class="chk"
											   value="1"
											   <?= isset($saved_json['overall']) && $saved_json['overall'] == 1 ? 'checked' : '' ?>
										>
										<label for="exam_group_overall" class="label-success"></label>
									</div>
								</div>
								

                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>

                </div><!--/.col (right) -->
                <!-- left column -->
            <?php } ?>
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('design_report_card', 'can_edit')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary" id="hroom">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('report_card'); ?> <?php echo $this->lang->line('list'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('certificate'); ?> <?php echo $this->lang->line('list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('certificate'); ?> <?php echo $this->lang->line('name'); ?></th>

                                        <th><?php echo $this->lang->line('background_image'); ?></th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($certificateList)) {
                                        ?>

                                        <?php
                                    } else {
                                        $count = 1;
                                        foreach ($certificateList as $certificate) {
                                            ?>
                                            <tr>
                                                <td class="mailbox-name">
                                                    <a style="cursor: pointer;" class="view_data" id="<?php echo $certificate->id ?>" data-toggle="popover" class="detail_popover" ><?php echo $certificate->template; ?></a>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php if ($certificate->header_img != '' && !is_null($certificate->header_img)) { ?>
                                                        <img src="<?php echo base_url('uploads/reportcard/') ?><?php echo $certificate->header_img ?>" width="40">
                                                    <?php } else { ?>
                                                        <i class="fa fa-picture-o fa-3x" aria-hidden="true"></i>
                                                    <?php } ?>

                                                </td>
                                                <td class="mailbox-date text-right no-print">
                                                    <a data-placement="left" id="<?php echo $certificate->id ?>" class="btn btn-default btn-xs view_data" title="<?php echo $this->lang->line('view'); ?>">
                                                        <i class="fa fa-reorder"></i>
                                                    </a>
                                                    <?php
                                                    if ($this->rbac->hasPrivilege('design_report_card', 'can_edit')) {
                                                        ?>
                                                        <a data-placement="left" href="<?php echo site_url('admin/reportcard/edit/' . $certificate->id); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <?php
                                                    }
                                                    if ($this->rbac->hasPrivilege('design_report_card', 'can_delete')) {
                                                        ?>
                                                        <a data-placement="left" href="<?php echo base_url(); ?>admin/reportcard/delete/<?php echo $certificate->id ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                                            <i class="fa fa-remove"></i>
                                                        </a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        $count++;
                                    }
                                    ?>
                                </tbody>
                            </table><!-- /.table -->
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
            <!-- right column -->
        </div>
        <div class="row">
            <div class="col-md-12">
            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" style="width: 100%;" >
    <div class="modal-dialog modal-lg" style="width: 90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('view'); ?> <?php echo $this->lang->line('report_card'); ?></h4>
            </div>
            <div class="modal-body" id="certificate_detail">

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });
    });
</script>
<script type="text/javascript">
    var base_url = '<?php echo base_url() ?>';
    function printDiv(elem) {
        Popup(jQuery(elem).html());
    }

    function Popup(data)
    {

        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({"position": "absolute", "top": "-1000000px"});
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title></title>');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');


        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
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
<script>
    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.view_data').click(function () {
            var certificateid = $(this).attr("id");
            $.ajax({
                url: "<?php echo base_url('admin/reportcard/view') ?>",
                method: "post",
                data: {certificateid: certificateid},
                dataType: 'JSON',
                success: function (data) {
                    $('#certificate_detail').html(data.page);
                    $('#myModal').modal("show");
                }
            });
        });
    });
</script>
<script type="text/javascript">
    function valueChanged()
    {
        if ($('#enable_student_img').is(":checked"))
            $("#enableImageDiv").show();
        else
            $("#enableImageDiv").hide();
    }
</script>