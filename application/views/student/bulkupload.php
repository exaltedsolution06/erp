<div class="content-wrapper" style="min-height: 946px;">

    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php //echo $this->lang->line('student_information'); ?> <small><?php //echo $this->lang->line('student1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('bulk_upload'); ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">  
                            <?php if ($this->session->flashdata('msg')) { ?> <div class="alert alert-success">  <?php echo $this->session->flashdata('msg') ?> </div> <?php } ?>
                            <form role="form" action="<?php echo site_url('student/bulkupload') ?>" method="post" class="">
                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('student'); ?></label> 
                                         
                                        <button type="button" class="btn btn-primary d-block mt-2 bulk-upload student" data-name="student"><span class="btn-text">Upload</span>
										<span class="btn-loader" style="display:none;">
											<i class="fa fa-spinner fa-spin"></i> Processing...
										</span></button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('father'); ?></label>
                                         <button type="button" class="btn btn-primary d-block mt-2 bulk-upload father" data-name="father">Upload</button>
                                    </div>
                                </div>
								<div class="col-md-12">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('mother'); ?></label>
                                         <button type="button" class="btn btn-primary d-block mt-2 bulk-upload mother" data-name="mother">Upload</button>
                                    </div>
                                </div>
								<div class="col-md-12">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('guardian'); ?></label>
                                         <button type="button" class="btn btn-primary d-block mt-2 bulk-upload guardian" data-name="guardian">Upload</button>
                                    </div>
                                </div>

                            </form>



                        </div>  
                    </div>

                </div>
            </div>
    </section>
</div>
<script type="text/javascript">
   $(document).on('click', '.bulk-upload', function(){
	   let name = $(this).data('name');
	   
	   let btn  = $(this);
	    btn.find('.btn-loader').show();
		//btn.prop('disabled', true);
        btn.find('.btn-text').hide();
        btn.find('.btn-loader').show();
	   
	   if(name == 'student')
	   {
		   $('.father').prop('disabled', true);
		   $('.mother').prop('disabled', true);
		   $('.guardian').prop('disabled', true);
	   }
	   
	   if(name == 'father')
	   {
		   $('.mother').prop('disabled', true);
		   $('.guardian').prop('disabled', true);
		   $('.student').prop('disabled', true);
	   }
	   
	   if(name == 'mother')
	   {
		   $('.father').prop('disabled', true);
		   $('.guardian').prop('disabled', true);
		   $('.student').prop('disabled', true);
	   }
	   
	   if(name == 'guardian')
	   {
		   $('.mother').prop('disabled', true);
		   $('.father').prop('disabled', true);
		   $('.student').prop('disabled', true);
	   }
	   
	   
	   //alert(name);
	   $.ajax({
			type: "POST",
			url: base_url + "student/bulkuploadprocess",
			data: {'name': name},
			dataType: "json",
			success: function (data) {
				if(data.status){
					successMsg('Files uploaded successfully');
				}else{
					errorMsg(data.msg);
				}
			},

			error: function () {
				alert('Something went wrong');
			},

			complete: function () {
				// 🔹 hide loader (always run)
				//btn.prop('disabled', false);
				btn.find('.btn-text').show();
				btn.find('.btn-loader').hide();
				
				 if(name == 'student')
				   {
					   $('.father').prop('disabled', false);
					   $('.mother').prop('disabled', false);
					   $('.guardian').prop('disabled', false);
				   }
				   
				   if(name == 'father')
				   {
					   $('.mother').prop('disabled', false);
					   $('.guardian').prop('disabled', false);
					   $('.student').prop('disabled', false);
				   }
				   
				   if(name == 'mother')
				   {
					   $('.father').prop('disabled', false);
					   $('.guardian').prop('disabled', false);
					   $('.student').prop('disabled', false);
				   }
				   
				   if(name == 'guardian')
				   {
					   $('.mother').prop('disabled', false);
					   $('.father').prop('disabled', false);
					   $('.student').prop('disabled', false);
				   }
				
				
			}
		});
	})
</script>