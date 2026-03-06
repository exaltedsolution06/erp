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
            if ($this->rbac->hasPrivilege('reminder_letter', 'can_edit')) {
                ?>
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('fees_reminder'); ?></h3>
                        </div><!-- /.box-header -->

                        <form id="form1" enctype="multipart/form-data" action="<?php echo site_url('admin/reminder_letter/edit/' . $editcertificate[0]->id) ?>"  id="certificateform" name="certificateform" method="post" accept-charset="utf-8">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>
                                
								
								<div class="form-group">
                                    <label><?php echo $this->lang->line('paymentdue_header_image'); ?></label>
                                    <input id="documents" placeholder="" type="file" class="filestyle form-control" data-height="40"  name="header_image">
                                </div>
								
								<div class="form-group">
                                    <label><?php echo $this->lang->line('template'); ?> <?php echo $this->lang->line('name'); ?></label><small class="req"> *</small>
                                    <input id="template_name" name="template_name" placeholder="Template name" type="text" class="form-control" value="<?php echo isset($editcertificate[0]->template_name) ? $editcertificate[0]->template_name : ''?>">
									<span class="text-danger"><?php echo form_error('template_name'); ?></span>
                                </div>
								<input type="hidden" name="id" value="<?php echo set_value('id', $editcertificate[0]->id); ?>" >

                                <div class="mediarow">
                                    <div class="row">
                                        
										<div class="col-md-7 col-sm-7">
                                            <div class="form-group switch-inline">
                                                <label><?php echo $this->lang->line('uid_no'); ?></label>
                                                <div class="material-switch switchcheck">
                                                    <input id="enable_uid_no" name="is_active_uid_no" type="checkbox" class="chk" value="1" <?php echo isset($editcertificate[0]->uid_no) &&  $editcertificate[0]->uid_no == 1 ? 'checked': ''?>>
                                                    <label for="enable_uid_no" class="label-success"></label>
                                                </div>
                                            </div>
                                        </div>
										
										<div class="col-md-7 col-sm-7">
                                            <div class="form-group switch-inline">
                                                <label><?php echo $this->lang->line('student_name'); ?></label>
                                                <div class="material-switch switchcheck">
                                                    <input id="enable_student_name" name="is_active_student_name" type="checkbox" class="chk"  value="1" <?php echo isset($editcertificate[0]->student_name) && $editcertificate[0]->student_name == 1 ? 'checked': ''?>>
                                                    <label for="enable_student_name" class="label-success"></label>
                                                </div>
                                            </div>
                                        </div>
										
										<div class="col-md-7 col-sm-7">
                                            <div class="form-group switch-inline">
                                                <label><?php echo $this->lang->line('father_name'); ?></label>
                                                <div class="material-switch switchcheck">
                                                    <input id="enable_father_name" name="is_active_father_name" type="checkbox" class="chk"  value="1" <?php echo isset($editcertificate[0]->father_name) && $editcertificate[0]->father_name == 1 ? 'checked': ''?>>
                                                    <label for="enable_father_name" class="label-success"></label>
                                                </div>
                                            </div>
                                        </div>
										
										<div class="col-md-7 col-sm-7">
                                            <div class="form-group switch-inline">
                                                <label><?php echo $this->lang->line('class_and_section'); ?></label>
                                                <div class="material-switch switchcheck">
                                                    <input id="enable_class_and_section" name="is_active_class_section" type="checkbox" class="chk"  value="1" <?php echo isset($editcertificate[0]->class_section) && $editcertificate[0]->class_section== 1 ? 'checked': ''?>>
                                                    <label for="enable_class_and_section" class="label-success"></label>
                                                </div>
                                            </div>
                                        </div>
                                        
										<div class="col-md-7 col-sm-7">
                                            <div class="form-group switch-inline">
                                                <label><?php echo $this->lang->line('phone'); ?></label>
                                                <div class="material-switch switchcheck">
                                                    <input id="enable_phone" name="is_active_phone" type="checkbox" class="chk"  value="1" <?php echo isset($editcertificate[0]->phone) && $editcertificate[0]->phone == 1 ? 'checked': ''?>>
                                                    <label for="enable_phone" class="label-success"></label>
                                                </div>
                                            </div>
                                        </div>
										
										<div class="col-md-7 col-sm-7">
                                            <div class="form-group switch-inline">
                                                <label><?php echo $this->lang->line('date'); ?></label>
                                                <div class="material-switch switchcheck">
                                                    <input id="enable_date" name="is_active_date" type="checkbox" class="chk"  value="1"  <?php echo isset($editcertificate[0]->date) && $editcertificate[0]->date == 1 ? 'checked': ''?>>
                                                    <label for="enable_date" class="label-success"></label>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!--./row-->
									
									<div class="row">
										<div class="form-group">
											<label><?php echo $this->lang->line('body_text'); ?></label><small class="req"> *</small>
											<textarea class="form-control" id="description" name="description" placeholder="" rows="3" placeholder=""><?php echo isset($editcertificate[0]->description) ? $editcertificate[0]->description : ''?></textarea>
											<span class="text-primary">[old_balance] [amount]
											</span>
											<span class="text-danger"><?php echo form_error('description'); ?></span>
										</div>
									</div>
                                </div><!--./mediarow-->



                                <!--<div class="form-group">
                                    <label><?php echo $this->lang->line('background_image'); ?></label>
                                    <input id="documents" placeholder="" type="file" class="filestyle form-control" data-height="40"  name="background_image">
                                </div>-->


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
            if ($this->rbac->hasPrivilege('reminder_letter', 'can_edit')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary" id="hroom">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('fees_reminder'); ?> <?php echo $this->lang->line('list'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('certificate'); ?> <?php echo $this->lang->line('list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('template'); ?> <?php echo $this->lang->line('name'); ?></th>

                                        <th><?php echo $this->lang->line('paymentdue_header_image'); ?></th>
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
                                                    <a style="cursor: pointer;" class="view_data" id="<?php echo $certificate->id ?>" data-toggle="popover" class="detail_popover" ><?php echo $certificate->template_name; ?></a>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php if ($certificate->header_image != '' && !is_null($certificate->header_image)) { ?>
                                                        <img src="<?php echo base_url('uploads/remind_letter/') ?><?php echo $certificate->header_image ?>" width="40">
                                                    <?php } else { ?>
                                                        <i class="fa fa-picture-o fa-3x" aria-hidden="true"></i>
                                                    <?php } ?>

                                                </td>
                                                <td class="mailbox-date text-right no-print">
												<?php
                                                    if ($this->rbac->hasPrivilege('reminder_letter', 'can_view')) {
														?>
                                                    <a data-placement="left" id="<?php echo $certificate->id ?>" class="btn btn-default btn-xs view_data" title="<?php echo $this->lang->line('view'); ?>">
                                                        <i class="fa fa-reorder"></i>
                                                    </a>
                                                    <?php
													}
                                                    if ($this->rbac->hasPrivilege('reminder_letter', 'can_edit')) {
                                                        ?>
                                                        <a data-placement="left" href="<?php echo base_url(); ?>admin/Reminder_letter/edit/<?php echo $certificate->id ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <?php
                                                    }
                                                    if ($this->rbac->hasPrivilege('reminder_letter', 'can_delete')) {
                                                        ?>
                                                        <a data-placement="left" href="<?php echo base_url(); ?>admin/Reminder_letter/delete/<?php echo $certificate->id ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
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
                <h4 class="modal-title"><?php echo $this->lang->line('view'); ?> <?php echo $this->lang->line('certificate'); ?></h4>
            </div>
            <div class="modal-body" id="certificate_detail">

            </div>
        </div>
    </div>
</div>

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
                url: "<?php echo base_url('admin/certificate/view') ?>",
                method: "post",
                data: {certificateid: certificateid},
                success: function (data) {
                    $('#certificate_detail').html(data);
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