
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <?php
            echo $this->lang->line('system_settings');
		$activeTab = $this->session->flashdata('type');
		$activeTab = $activeTab ?: 'student_receipt';
            // print_r(validation_errors());
            //die; 
			//print_r($_POST['type']);die; 
			//echo $this->session->flashdata('type');die;
            ?> </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="nav-tabs-custom box box-primary theme-shadow">

                    <ul class="nav nav-tabs pull-right">
                        <li class="<?php echo ($activeTab == 'staff_payslip') ? 'active' : ''?>"><a href="#tab_4" data-toggle="tab"><?php echo $this->lang->line('payslip') ?></a></li>
						
                        <li class="<?php echo ($activeTab == 'student_receipt') ? 'active' : ''?>"><a href="#tab_3" data-toggle="tab"><?php echo $this->lang->line('fees_receipt'); ?></a></li>
						<li class="<?php echo ($activeTab == 'admission_form') ? 'active' : ''?>"><a href="#tab_2" data-toggle="tab"><?php echo $this->lang->line('admission_form_header_footer') ?></a></li>

                        <li class="pull-left header"> <?php echo $this->lang->line('print_headerfooter'); ?></li>
                    </ul>
                    <div class="tab-content">
                        <?php
                        if ($this->session->flashdata('msg') != '') {
                            $msg = $this->session->flashdata('msg');
                            ?>

                            <?php echo $msg ?>
                        <?php } ?>    
                        <?php echo $this->customlib->getCSRF(); ?>
						
						<!-- .tab panel -->
						<div class="tab-pane <?php echo ($activeTab == 'admission_form') ? 'active' : ''?>" id="tab_2">
                            <form role="form"  enctype="multipart/form-data" action="<?php echo site_url('admin/print_headerfooter/edit') ?>" class="" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line('header') . " " . $this->lang->line('image') . " (2230px X 300px)"; ?></label>
                                            <input id="documents" data-default-file="<?php echo base_url() ?>./uploads/print_headerfooter/admission_form/<?php echo $result_admission['header_image'] ?>" placeholder="" type="file" class="filestyle form-control" data-height="180"  name="header_image">
                                            <input  placeholder="" type="hidden" class="form-control" value="admission_form" name="type">
                                            <span class="text-danger"><?php echo form_error('header_image'); ?></span>
											<input type="hidden" name="remove_image" class="remove_image">
                                        </div>
                                        <div class="form-group"><label><?php echo $this->lang->line('footer') . " " . $this->lang->line('content'); ?><small class="req"> *</small></label>
                                            <textarea id="admission_textarea" name="message2" class="form-control" style="height: 250px">
                                                <?php echo set_value('message2', $result_admission['footer_content']); ?>
                                            </textarea>
                                            <span class="text-danger"><?php echo form_error('message2'); ?></span>
                                        </div>
                                    </div>



                                    <div class="col-lg-12">         
                                        <div class="pull-right">

                                            <button type="submit" class="btn btn-primary " data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo $this->lang->line('save'); ?>"><?php echo $this->lang->line('save'); ?></button>

                                        </div>
                                    </div>  
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
						
                        <!-- /.tab-pane -->
                        <div class="tab-pane <?php echo ($activeTab == 'student_receipt') ? 'active' : ''?>" id="tab_3">
                            <form role="form"  enctype="multipart/form-data" action="<?php echo site_url('admin/print_headerfooter/edit') ?>" class="" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line('header') . " " . $this->lang->line('image') . " (2230px X 300px)"; ?></label>
                                            <input id="documents" data-default-file="<?php echo base_url() ?>./uploads/print_headerfooter/student_receipt/<?php echo $result_receipt['header_image'] ?>" placeholder="" type="file" class="filestyle form-control" data-height="180"  name="header_image">
                                            <input  placeholder="" type="hidden" class="form-control" value="student_receipt" name="type">
                                            <span class="text-danger"><?php echo form_error('header_image'); ?></span>
											<input type="hidden" name="remove_image" class="remove_image">
                                        </div>
                                        <div class="form-group"><label><?php echo $this->lang->line('footer') . " " . $this->lang->line('content'); ?><small class="req"> *</small></label>
                                            <textarea id="student_textarea" name="message1" class="form-control" style="height: 250px">
                                                <?php echo set_value('message1', $result_receipt['footer_content']); ?>
                                            </textarea>
                                            <span class="text-danger"><?php echo form_error('message1'); ?></span>
                                        </div>
                                    </div>



                                    <div class="col-lg-12">         
                                        <div class="pull-right">

                                            <button type="submit" class="btn btn-primary " data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo $this->lang->line('save'); ?>"><?php echo $this->lang->line('save'); ?></button>

                                        </div>
                                    </div>  
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane <?php echo ($activeTab == 'staff_payslip') ? 'active' : ''?>" id="tab_4">
                            <form role="form" action="<?php echo site_url('admin/print_headerfooter/edit') ?>" class="" enctype="multipart/form-data" method="post">
                                <div class="row">
                                    <div class="col-md-12">     
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line('header') . " " . $this->lang->line('image') . " (2230px X 300px)"; ?></label>
                                            <input id="documents" data-default-file="<?php echo base_url() ?>./uploads/print_headerfooter/staff_payslip/<?php echo $result_payslip['header_image'] ?>" placeholder="" type="file" class="filestyle form-control" data-height="180"  name="header_image">
                                            <input  placeholder="" type="hidden" class="form-control" value="staff_payslip" name="type">
                                            <span class="text-danger"><?php echo form_error('header_image'); ?></span>
											<input type="hidden" name="remove_image" class="remove_image">
                                        </div>
                                        <div class="form-group"><label><?php echo $this->lang->line('footer') . " " . $this->lang->line('content'); ?><small class="req"> *</small></label>
                                            <textarea id="staff_textarea" name="message" class="form-control" style="height: 250px">
                                                <?php echo set_value('message', $result_payslip['footer_content']); ?>
                                            </textarea>
                                            <span class="text-danger"><?php echo form_error('message'); ?></span>
                                        </div>

                                    </div>
                                    <div class="col-lg-12">
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-primary" data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo $this->lang->line('save'); ?>"><?php echo $this->lang->line('save'); ?></button>
                                        </div>
                                    </div>   
                                </div>  
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
            </div>

        </div>  
    </section>
</div>


<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
    $(function () {
        $("#admission_textarea").wysihtml5();
        $("#staff_textarea").wysihtml5();
        $("#student_textarea").wysihtml5();

    });
	$(document).ready(function (e) {
		$("body").on('click', '.dropify-clear', function () {
			$(this).closest('.form-group').find('.remove_image').val(1);
		});
	});
</script>


