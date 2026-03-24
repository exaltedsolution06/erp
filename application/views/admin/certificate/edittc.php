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
            if ($this->rbac->hasPrivilege('design_tc', 'can_add')) {
                ?>
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('edit'); ?> Tc</h3>
                        </div><!-- /.box-header -->

                        <form id="form1" enctype="multipart/form-data" action="<?php echo site_url('admin/designtc/edit/' . $editcertificate[0]->id) ?>"  id="certificateform" name="certificateform" method="post" accept-charset="utf-8" class="haveDropify">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
								$certificate_val = $editcertificate[0];
                                ?>
								<div class="form-group">
                                    <span class="text-primary">[name] 
                                    </span>
                                    <span class="text-danger"><?php echo form_error('certificate_text'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Tc Title</label><small class="req"> *</small>
                                    <input autofocus="" id="certificate_name" name="certificate_name" value="<?= $certificate_val->certificate_name ?? '' ?>" placeholder="" type="text" class="form-control" />
                                    <span class="text-danger"><?php echo form_error('certificate_name'); ?></span>
                                </div>
                                <div id="dynamic-fields">
									<div class="row field-row">
										<div class="col-md-5">
											<div class="form-group1">
												<label>Field Title</label>
											</div>
										</div>

										<div class="col-md-5">
											<div class="form-group1">
												<label>Field Value</label>
											</div>
										</div>
									</div>
									<?php
									$fields = json_decode($certificate_val->fields_json, true);
									if(!empty($fields)){
										foreach($fields as $field){
									?>
											<div class="row field-row">
												<div class="col-md-5">
													<div class="form-group">
														<input type="text" name="field_title[]" value="<?= $field['title'] ?? '' ?>" class="form-control" placeholder="Field Title">
													</div>
												</div>

												<div class="col-md-5">
													<div class="form-group">
														<input type="text" name="field_value[]" value="<?= $field['value'] ?? '' ?>" class="form-control" placeholder="Field Value">
													</div>
												</div>

												<div class="col-md-2">
													<button type="button" class="btn btn-danger btn-sm remove-row">X</button>
												</div>
											</div>
										<?php } ?>
									<?php } else { ?>
										<div class="row field-row">
											<div class="col-md-5">
												<input type="text" name="field_title[]" class="form-control" placeholder="Field Title">
											</div>

											<div class="col-md-5">
												<input type="text" name="field_value[]" class="form-control" placeholder="Field Value">
											</div>
										</div>
									<?php } ?>
								</div>
								<div class="row mt-2">
									<div class="col-md-12">
										<button type="button" id="add-more" class="btn btn-primary">Add More</button>
									</div>
								</div>
								<div class="clearfix"></div>
								<br>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group switch-inline">
											<label><?php echo $this->lang->line('sign'); ?></label>
											<div class="material-switch switchcheck">
												<input id="is_signature" name="is_signature" type="checkbox" class="chk" value="1" onclick="valueSignChanged()" <?php echo set_checkbox('is_signature', '1', (set_value('is_signature', $editcertificate[0]->is_signature) == 1) ? TRUE : FALSE); ?>>
												<label for="is_signature" class="label-success"></label>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 img_div_modal">
										<div class="form-group enableSignDiv" hidden>
											<input id="documents" data-default-file="<?php echo base_url() ?>./uploads/transfer_certificate/<?php echo $editcertificate[0]->signature; ?>" name="signature" placeholder="" type="file" class="filestyle form-control" data-height="40">
											<span class="text-danger"><?php echo form_error('signature'); ?></span>
											<input type="hidden" name="remove_signature" class="remove_image">
										</div>
									</div>
									<div class="col-md-12 col-sm-12 img_div_modal">
										<div class="form-group enableSignDiv" hidden>
											<input autofocus="" id="signature_title" name="signature_title" placeholder=" <?php echo $this->lang->line('sign'); ?> <?php echo $this->lang->line('title'); ?>" type="text" class="form-control" value="<?php echo set_value('signature_title', $editcertificate[0]->signature_title); ?>"/>
											<span class="text-danger"><?php echo form_error('signature_title'); ?></span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 col-sm-12">
										<div class="form-group">
											<label><?php echo $this->lang->line('background_image'); ?></label>
											<input id="documents" data-default-file="<?php echo base_url() ?>./uploads/transfer_certificate/<?php echo $editcertificate[0]->background_image; ?>" name="background_image" placeholder="" type="file" class="filestyle form-control" data-height="40">
											<span class="text-danger"><?php echo form_error('background_image'); ?></span>
											<input type="hidden" name="remove_background_image" class="remove_image">
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group switch-inline">
											<label><?php echo $this->lang->line('show'); ?> <?php echo $this->lang->line('date'); ?></label>
											<div class="material-switch switchcheck">
												<input id="is_show_date" name="is_show_date" type="checkbox" class="chk" value="1" <?php echo set_checkbox('is_show_date', '1', (set_value('is_show_date', $editcertificate[0]->is_show_date) == 1) ? TRUE : FALSE); ?> onclick="valueDateChanged()">
												<label for="is_show_date" class="label-success"></label>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 img_div_modal enableDateDiv" hidden>
										<div class="form-group">
											<input id="show_date" name="show_date" placeholder="<?php echo $this->lang->line('date'); ?>" type="text" class="form-control" value="<?php echo set_value('show_date', $editcertificate[0]->show_date); ?>" />
										</div>
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
            if ($this->rbac->hasPrivilege('design_tc', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary" id="hroom">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Tc <?php echo $this->lang->line('list'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('certificate'); ?> <?php echo $this->lang->line('list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>Tc Title</th>

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
                                                    <a style="cursor: pointer;" class="view_data" id="<?php echo $certificate->id ?>" data-toggle="popover" class="detail_popover" ><?php echo $certificate->certificate_name; ?></a>
                                                </td>
                                                <td class="mailbox-date text-right no-print">
                                                    <?php
                                                    if ($this->rbac->hasPrivilege('design_tc', 'can_edit')) {
                                                        ?>
                                                        <a data-placement="left" href="<?php echo base_url(); ?>admin/designtc/edit/<?php echo $certificate->id ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <?php
                                                    }
                                                    if ($this->rbac->hasPrivilege('design_tc', 'can_delete')) {
                                                        ?>
                                                        <a data-placement="left" href="<?php echo base_url(); ?>admin/designtc/delete/<?php echo $certificate->id ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
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

<script>
	function valueSignChanged()
	{
		if ($('#is_signature').is(":checked"))
			$(".enableSignDiv").show();
		else
			$(".enableSignDiv").hide();
	}
    function valueDateChanged()
    {
        if ($('#is_show_date').is(":checked"))
            $(".enableDateDiv").show();
        else
            $(".enableDateDiv").hide();
    }
    $(document).ready(function () {
		if ($('#is_signature').is(":checked")) {
            $(".enableSignDiv").show();
        } else {
            $(".enableSignDiv").hide();
        }
		if ($('#is_show_date').is(":checked")){
            $(".enableDateDiv").show();
        }else{
            $(".enableDateDiv").hide();
		}
		
		$("body").on('click', '.dropify-clear', function () {
			$(this).closest('.form-group').find('.remove_image').val(1);
		});
		
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
<script>
$(document).ready(function(){

    // Add More
    $('#add-more').click(function(){

        let html = `
        <div class="row field-row mt-2">
            <div class="col-md-5">
                <div class="form-group">
                    <input type="text" name="field_title[]" class="form-control" placeholder="Field Title"/>
                </div>
            </div>

            <div class="col-md-5">
                <div class="form-group">
                    <input type="text" name="field_value[]" class="form-control" placeholder="Field Value"/>
                </div>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
            </div>
        </div>
        `;

        $('#dynamic-fields').append(html);
    });

    // Remove Row
    $(document).on('click','.remove-row',function(){
        $(this).closest('.field-row').remove();
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