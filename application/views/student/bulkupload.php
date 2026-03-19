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
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('student'); ?></label> 
                                         
                                        <button type="button" class="btn btn-primary d-block mt-2 bulk-upload" data-name="student">Upload</button>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('father'); ?></label>
                                         <button type="button" class="btn btn-primary d-block mt-2 bulk-upload" data-name="father">Upload</button>
                                    </div>
                                </div>
								<div class="col-sm-2">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('mother'); ?></label>
                                         <button type="button" class="btn btn-primary d-block mt-2 bulk-upload" data-name="mother">Upload</button>
                                    </div>
                                </div>
								<div class="col-sm-2">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('guardian'); ?></label>
                                         <button type="button" class="btn btn-primary d-block mt-2 bulk-upload" data-name="guardian">Upload</button>
                                    </div>
                                </div>

                                <!--<div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                    </div>
                                </div>-->
                            </form>



                        </div>  
                    </div>

                </div>
            </div>
    </section>
</div>
<script type="text/javascript">


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
                    $('#section_id').append(div_data);
                }
            });
        }
    }
    $(document).ready(function () {
        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id') ?>';
        getSectionByClass(class_id, section_id);
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
                    $('#section_id').append(div_data);
                }
            });
        });
    });
</script>
<script type="text/javascript">
   $(document).on('click', '.bulk-upload', function(){
	   let name = $(this).data('name');
	   //alert(name);
	   $.ajax({
			type: "POST",
			url: base_url + "student/bulkupload",
			data: {'name': name},
			dataType: "json",
			success: function (data) {
				
			}
		});
	   
   })
</script>