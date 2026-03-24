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
                            <h3 class="box-title"><?php echo $this->lang->line('add'); ?> Tc</h3>
                        </div><!-- /.box-header -->

                        <form id="form1" enctype="multipart/form-data" action="<?php echo site_url('admin/designtc/create') ?>"  id="certificateform" name="certificateform" method="post" accept-charset="utf-8">
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
                                    <span class="text-primary">[name] [dob] [present_address] [guardian] [created_at] [admission_no] [roll_no] [class] [section] [gender] [admission_date] [category] [cast] [father_name] [mother_name] [religion] [email] [phone] [CASTE CATEGORY] [PAN Card] 
                                    </span>
                                    <span class="text-danger"><?php echo form_error('certificate_text'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Tc Title</label><small class="req"> *</small>
                                    <input autofocus="" id="certificate_name" name="certificate_name" placeholder="" type="text" class="form-control" />
                                    <span class="text-danger"><?php echo form_error('certificate_name'); ?></span>
                                </div>
								
								<div class="form-group">
                                    <label>Book No.</label><small class="req"> *</small>
                                    <input autofocus="" id="book_no" name="book_no" placeholder="Book No" type="text" class="form-control" />
                                    <span class="text-danger"><?php echo form_error('book_no'); ?></span>
                                </div>
								
								<div class="form-group">
                                    <label>Serial No Prefix.</label><small class="req"> *</small>
                                    <input autofocus="" id="serial_no_prefix" name="serial_no_prefix" placeholder="Prefix" type="text" class="form-control" />
                                    <span class="text-danger"><?php echo form_error('serial_no_prefix'); ?></span>
                                </div>
								
								<div class="form-group">
                                    <label>Serial No Suffix.</label><small class="req"> *</small>
                                    <input autofocus="" id="serial_no_suffix" name="serial_no_suffix" placeholder="Suffix" type="text" class="form-control" onkeypress="return /\d/.test(String.fromCharCode(event.keyCode || event.which))"/>
                                    <span class="text-danger"><?php echo form_error('serial_no_suffix'); ?></span>
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
									<div class="row field-row">
										<div class="col-md-5">
											<div class="form-group">
												<input type="text" name="field_title[]" placeholder="Field Title" class="form-control" />
											</div>
										</div>

										<div class="col-md-5">
											<div class="form-group">
												<input type="text" name="field_value[]" placeholder="Field Value" class="form-control" />
											</div>
										</div>
									</div>
								</div>
								<div class="row">
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
												<input id="is_signature" name="is_signature" type="checkbox" class="chk" value="1" onclick="valueSignChanged()">
												<label for="is_signature" class="label-success"></label>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 img_div_modal">
										<div class="form-group enableSignDiv" hidden>
											<input id="documents" name="signature" placeholder="" type="file" class="filestyle form-control" data-height="40"  name="signature">
											<span class="text-danger"><?php echo form_error('signature'); ?></span>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 img_div_modal">
										<div class="form-group enableSignDiv" hidden>
											<input autofocus="" id="signature_title" name="signature_title" placeholder="<?php echo $this->lang->line('sign'); ?> <?php echo $this->lang->line('title'); ?>" type="text" class="form-control" />
											<span class="text-danger"><?php echo form_error('signature_title'); ?></span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 col-sm-12">
										<div class="form-group">
											<label><?php echo $this->lang->line('background_image'); ?></label>
											<input id="documents" name="background_image" placeholder="" type="file" class="filestyle form-control" data-height="40"  name="background_image">
											<span class="text-danger"><?php echo form_error('background_image'); ?></span>
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group switch-inline">
											<label><?php echo $this->lang->line('show'); ?> <?php echo $this->lang->line('date'); ?></label>
											<div class="material-switch switchcheck">
												<input id="is_show_date" name="is_show_date" type="checkbox" class="chk" value="1" onclick="valueDateChanged()">
												<label for="is_show_date" class="label-success"></label>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 img_div_modal enableDateDiv" hidden>
										<div class="form-group">
											<input id="show_date" name="show_date" placeholder="<?php echo $this->lang->line('date'); ?>" type="text" class="form-control" />
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
    function valueDateChanged()
    {
        if ($('#is_show_date').is(":checked"))
            $(".enableDateDiv").show();
        else
            $(".enableDateDiv").hide();
    }
</script>