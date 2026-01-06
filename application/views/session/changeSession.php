data-placement="left"<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-gears"></i> <?php echo $this->lang->line('system_settings'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
			<div class="col-md-7">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Move Students From this Class to this Class</h3>
					</div>
					<form id="form1" action="" method="post" accept-charset="utf-8">
					<input type="hidden" name="batch_id" value="<?php echo $batch_id; ?>">
						<div class="box-body">
							<div class="col-sm-5">
								<div class="form-group">
									<label>Class in Current Session (<?php echo $this->setting_model->getCurrentSessionName(); ?>)</label><small class="req"> *</small>
									<select autofocus="" id="current_class_id" name="current_class_id" class="form-control" data-id="current">
										<option value=""><?php echo $this->lang->line('select'); ?></option>
										<?php
											foreach ($classlist as $class) {
										?>
											<option value="<?php echo $class['id'] ?>"><?php echo $class['class'] ?></option>
										<?php
											}
										?>
									</select>
									<span class="text-danger" id="current_class_id_error"></span>
								</div>
							</div>
							<!--<div class="col-sm-6">
								<div class="form-group">
									<label>Section in Current Session</label>
									<select autofocus="" id="current_section_id" name="current_section_id" class="form-control" >
										<option value=""><?php echo $this->lang->line('select'); ?></option>
									</select>
									<span class="text-danger" id="current_section_id_error"></span>
								</div>
							</div>-->
							<div class="col-md-3">
								<div class="form-group">
									<label for="exampleInputEmail1">Next session </label><small class="req"> *</small>
									<select  id="next_session_id" name="next_session_id" class="form-control" >
										<option value=""><?php echo $this->lang->line('select'); ?></option>
										<?php
										foreach ($sessionlist as $session) {
											?>
											<option value="<?php echo $session['id'] ?>" ><?php echo $session['session'] ?></option>
											<?php
											$count++;
										}
										?>
									</select>
									<span class="text-danger" id="next_session_id_error"></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="exampleInputEmail1">Shift to this next Class</label><small class="req"> *</small>
									<select  id="next_class_id" name="next_class_id" class="form-control" data-id="next">
										<option value=""><?php echo $this->lang->line('select'); ?></option>
										<?php
											foreach ($classlist as $class) {
										?>
											<option value="<?php echo $class['id'] ?>"><?php echo $class['class'] ?></option>
										<?php
											}
										?>
									</select>
									<span class="text-danger" id="next_class_id_error"></span>
								</div>
							</div>
							<!--<div class="col-md-4">
								<div class="form-group">
									<label for="exampleInputEmail1">Shift to this next Section</label>
									<select  id="next_section_id" name="next_section_id" class="form-control" >
										<option value=""><?php echo $this->lang->line('select'); ?></option>
									</select>
									<span class="text-danger" id="next_section_id_error"></span>
								</div>
							</div>-->
						</div>
						<div class="box-footer">
							<button type="button" class="btn btn-info pull-right add_list">Add to list</button>
						</div>
					</form>
				</div>  
			</div>
            <div class="col-md-5">                
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Change Category</h3>
                    </div>
					<form id="form2" action="" method="post" accept-charset="utf-8">
					<input type="hidden" name="batch_id" value="<?php echo $batch_id; ?>">
						<div class="box-body">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Current Session Category</label><small class="req"> *</small>
									<select autofocus="" id="current_category_id" name="current_category_id" class="form-control" >
										<option value=""><?php echo $this->lang->line('select'); ?></option>
										<?php
										foreach ($feegroupList as $feegroupListVal) {
										?>
											<option value="<?php echo $feegroupListVal['id'] ?>"><?php echo $feegroupListVal['name'] ?></option>
										<?php
										}
										?>
									</select>
									<span class="text-danger" id="current_category_error"></span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Next Session Category</label><small class="req"> *</small>
									<select autofocus="" id="next_category_id" name="next_category_id" class="form-control" >
										<option value=""><?php echo $this->lang->line('select'); ?></option>
										<?php
										foreach ($feegroupList as $feegroupListVal) {
										?>
											<option value="<?php echo $feegroupListVal['id'] ?>"><?php echo $feegroupListVal['name'] ?></option>
										<?php
										}
										?>
									</select>
									<span class="text-danger" id="next_category_id_error"></span>
								</div>
							</div>
						</div>
						<div class="box-footer">
							<button type="button" class="btn btn-info pull-right add_list_category">Add to list</button>
						</div>
					</form>	
                </div>
            </div>

        </div> 
		<div class="row">
			<div class="col-md-7">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Added List</h3>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Batch Id</th>
										<th>Current Class</th>
										<th>Next Class</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if (!empty($addedListData)) {
										foreach ($addedListData as $list_val) {
											?>
											<tr>
												<td><?php echo $list_val['batch_id']; ?></td>
												<td><?php echo $this->class_model->getClassNameById($list_val['current_class_id']); ?></td>
												<td><?php echo $this->class_model->getClassNameById($list_val['next_class_id']); ?></td>
											</tr>
									<?php
										}
									}
									?>
								</tbody>
							</table>
						</div>
					</div> 
				</div> 
			</div> 
			<div class="col-md-5">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Added Category List</h3>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Batch Id</th>
										<th>Current Category</th>
										<th>Next Category</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if (!empty($addedListCatData)) {
										foreach ($addedListCatData as $list_cat_val) {
											?>
											<tr>
												<td><?php echo $list_cat_val['batch_id']; ?></td>
												<td><?php echo $this->feegroup_model->getgroupNameById($list_cat_val['current_category_id']); ?></td>
												<td><?php echo $this->feegroup_model->getgroupNameById($list_cat_val['next_category_id']); ?></td>
											</tr>
									<?php
										}
									}
									?>
								</tbody>
							</table>
						</div>
					</div> 
				</div> 
			</div> 
			<div class="col-md-12">
				<button type="button" class="btn btn-success pull-right transfer_batch">Ok, Transfer these students to next session</button> 
			</div> 
        </div> 
    </section>
</div>
<script type="text/javascript">
	$(document).on('change', '#current_class_id, #next_class_id', function (e) {
		var data_id = $(this).data('id');
        $('#'+data_id+'_section_id').html("");
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
                $('#'+data_id+'_section_id').append(div_data);
            }
        });
    });
	$(document).ready(function () {
		$('#form1').on('click', '.add_list', function (e) {
			var datastring = $("#form1").serialize();
			$.ajax({
                type: "POST",

                url: '<?php echo site_url("changesessions/add_list") ?>',
                data: datastring,
                beforeSend: function () {
					$(this).prop('disabled', true);
                },
                success: function (data) {
                    var data = (JSON.parse(data));
                    if (data.status == "fail") {
                        $.each(data.msg, function (index, value) {
                            var errorDiv = '#' + index + '_error';

                            $(errorDiv).addClass('required');
                            $(errorDiv).empty().append(value);
                        });
						$(this).prop('disabled', false);
                    }else if(data.status == "added_in_list"){
						errorMsg(data.msg);
						$(this).prop('disabled', false);
					} else {
                        successMsg(data.msg);
						setTimeout(function () {
							location.reload(true);
						}, 5000);                        
                    }
                },
            });
		});
	});	
	$(document).ready(function () {
		$('#form2').on('click', '.add_list_category', function (e) {
			var datastring = $("#form2").serialize();
			$.ajax({
                type: "POST",

                url: '<?php echo site_url("changesessions/add_list_category") ?>',
                data: datastring,
                beforeSend: function () {
					$(this).prop('disabled', true);
                },
                success: function (data) {
                    var data = (JSON.parse(data));
                    if (data.status == "fail") {
                        $.each(data.msg, function (index, value) {
                            var errorDiv = '#' + index + '_error';

                            $(errorDiv).addClass('required');
                            $(errorDiv).empty().append(value);
                        });
						$(this).prop('disabled', false);
                    }else if(data.status == "added_in_list"){
						errorMsg(data.msg);
						$(this).prop('disabled', false);
					} else {
                        successMsg(data.msg);
                        setTimeout(function () {
							location.reload(true);
						}, 5000);
                    }
                },
            });
		});
		$(document).on('click', '.transfer_batch', function (e) {
			$.ajax({
                type: "POST",

                url: '<?php echo site_url("changesessions/transfer_batch") ?>',
                beforeSend: function () {
					$(this).prop('disabled', true);
                },
                success: function (data) {
                    var data = (JSON.parse(data));
                    if(data.status == "no_added_list"){
						errorMsg(data.msg);
						$(this).prop('disabled', false);
					} else {
                        successMsg(data.msg);
                        setTimeout(function () {
							location.reload(true);
						}, 5000);
                    }
                },
                error: function (xhr) { 
					// if error occured
                },
                complete: function () {
                    //
                },
            });
		});
	});	
</script>