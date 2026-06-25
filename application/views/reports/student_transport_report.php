<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<style type="text/css">
    /*REQUIRED*/
    .carousel-row {
        margin-bottom: 10px;
    }
    .slide-row {
        padding: 0;
        background-color: #ffffff;
        min-height: 150px;
        border: 1px solid #e7e7e7;
        overflow: hidden;
        height: auto;
        position: relative;
    }
    .slide-carousel {
        width: 20%;
        float: left;
        display: inline-block;
    }
    .slide-carousel .carousel-indicators {
        margin-bottom: 0;
        bottom: 0;
        background: rgba(0, 0, 0, .5);
    }
    .slide-carousel .carousel-indicators li {
        border-radius: 0;
        width: 20px;
        height: 6px;
    }
    .slide-carousel .carousel-indicators .active {
        margin: 1px;
    }
    .slide-content {
        position: absolute;
        top: 0;
        left: 20%;
        display: block;
        float: left;
        width: 80%;
        max-height: 76%;
        padding: 1.5% 2% 2% 2%;
        overflow-y: auto;
    }
    .slide-content h4 {
        margin-bottom: 3px;
        margin-top: 0;
    }
    .slide-footer {
        position: absolute;
        bottom: 0;
        left: 20%;
        width: 78%;
        height: 20%;
        margin: 1%;
    }
    /* Scrollbars */
    .slide-content::-webkit-scrollbar {
        width: 5px;
    }
    .slide-content::-webkit-scrollbar-thumb:vertical {
        margin: 5px;
        background-color: #999;
        -webkit-border-radius: 5px;
    }
    .slide-content::-webkit-scrollbar-button:start:decrement,
    .slide-content::-webkit-scrollbar-button:end:increment {
        height: 5px;
        display: block;
    }
    .filter-box {
      border: 1px solid #ccc;
      padding: 10px;
      border-radius: 5px;
      max-height: 125px;
      overflow-y: auto;
    }
    .box-header-ptbnull{
        padding-top:2rem;
    }
    .form-check-label{
        padding-left:1rem;
    }
</style>
<?php



?>
<div class="content-wrapper" style="min-height: 946px;">

    <section class="content-header">
        <h1>
            <i class="fa fa-bus"></i> <?php echo $this->lang->line('transport'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php $this->load->view('reports/_finance'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box removeboxmius">
                    <div class="box-header ptbnull"></div>
                   


                    <div class="box-header ptbnull"></div>
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><i class="fa fa-money"></i>  Student Transport Report</h3>
                    </div>
                    <div class="box-body" style="padding-top:0;">
                        <div class="container-fluid">
                            <div class="card p-3">
                                <form action="" method="POST">
                                    <div class="box-header-ptbnull"></div>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-3 col-md-12">
											<div class="form-group">
												<label><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
												<select autofocus="" id="class_id" name="class_id" class="form-control" >
													<option value=""><?php echo $this->lang->line('select'); ?></option>
													<option value="all" <?php
														if (set_value('class_id') == 'all') {
															echo "selected=selected";
														}
														?>><?php echo $this->lang->line('all'); ?></option>
													<?php
													foreach ($classlist as $class) {
														?>
														<option value="<?php echo $class['id'] ?>" <?php
														if (set_value('class_id') == $class['id']) {
															echo "selected=selected";
														}
														?>><?php echo $class['class'] ?></option>
																<?php
															}
															?>
												</select>
												<span class="text-danger"><?php echo form_error('class_id'); ?></span>
												
												
												<label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
												<select  id="section_id" name="section_id" class="form-control" >
													<option value=""><?php echo $this->lang->line('select'); ?></option>
												</select>
												<span class="text-danger"><?php echo form_error('section_id'); ?></span>
											</div>
										</div>
										<?php
										$selectedRoutes = $_POST['routes'] ?? [];
										$onlyWithoutRoute = true;

										if (!empty($selectedRoutes)) {
											if (count($selectedRoutes) == 1 && in_array(0, $selectedRoutes)) {
												$onlyWithoutRoute = false;
											}
										}
										?>
										<!--<div class="col-md-2 mb-3">
											<div class="form-check">
												<input type="checkbox" class="form-check-input" name="routes[]" value="0" <?php echo in_array(0, $selectedRoutes) ? 'checked' : '';?> id="selectWithoutRoute">
												<label class="form-check-label" for="selectWithoutRoute">Without Route.</label>
											</div>
										</div>-->
										<div class="col-sm-6 col-lg-3 col-md-12">
											<div class="form-check">												
												<input type="checkbox" class="form-check-input master-check" data-target="route-check" id="selectAllRoute">
												<label class="form-check-label" for="selectAllRoute">Select Route.</label>
												
												<input type="checkbox" class="form-check-input" name="routes[]" value="0" <?php echo in_array(0, $selectedRoutes) ? 'checked' : '';?> id="selectWithoutRoute">
												<label class="form-check-label text-danger" for="selectWithoutRoute">Without Route.</label>
											</div>
											<div class="filter-box">
												<?php
												foreach ($routes as $row) {
												$checked = in_array($row['id'], $selectedRoutes) ? 'checked' : '';
												echo "<div class='form-check'>
														<input type='checkbox' class='form-check-input route-check' name='routes[]' value='{$row['id']}' id='fee1{$row['id']}' $checked>
														<label class='form-check-label' for='fee1{$row['id']}'>{$row['fees_heading']}</label>
														</div>";
												}
												?>
											</div>
										</div>
										<div class="col-md-1 mb-3">
											<div class="form-group">
												<button type="submit" name="filter_button"class="btn btn-primary btn-block">OK</button>
											</div>
										</div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
					<div class="box-body">
						<div class="table-responsive table-header-sticky">
							<div class="download_label">Student Transport Report</div>
							<table class="table table-striped table-bordered table-hover example table-fixed-header sticky-col-4" cellspacing="0" width="100%">
								<thead>
									<tr>
							
										<th><?php echo $this->lang->line('sl_no'); ?></th>
										<th><?php echo $this->lang->line('admission_no'); ?></th>
										<th><?php echo $this->lang->line('class'); ?></th>
										<th><?php echo $this->lang->line('student_name'); ?></th>
										<th><?php echo $this->lang->line('father_name'); ?></th>
										<th><?php echo $this->lang->line('mother_name'); ?></th>
										<th><?php echo $this->lang->line('date_of_birth'); ?></th>
										<th><?php echo $this->lang->line('gender'); ?></th>
										<th><?php echo $this->lang->line('mobile_no'); ?></th>
										<th><?php echo $this->lang->line('fee_category'); ?></th>
										<?php if ($onlyWithoutRoute) { ?>
										<th><?php echo $this->lang->line('route'); ?></th>
										<?php } ?>
									</tr>
								</thead>
								<tbody>
									<?php
									if (empty($resultlist)) {
										 ?>
														 
										<?php
									} else {
										$count = 1;
										foreach ($resultlist as $student) {
											?>
											<tr>
											
												<td><?php echo $count; ?></td>
												<td><?php echo $student['admission_no']; ?></td>
										
												<td><?php echo $student['class'] . "(" . $student['section'] . ")" ?></td>
												<td> 
													
													<a href="<?php echo base_url(); ?>student/view/<?php echo $student['id']; ?>"><?php echo $this->customlib->getFullName($student['firstname'],$student['middlename'],$student['lastname'],$sch_setting->middlename,$sch_setting->lastname); ?>
													</a>
												</td>
												<td><?php echo $student['father_name']; ?></td>
												<td><?php echo $student['mother_name']; ?></td>
												<td><?php
													if ($student["dob"] != null && $student["dob"]!='0000-00-00') {
														echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob']));
													}
													?></td>
												<td><?php echo $student['gender']; ?></td>
												<td><?php echo $student['mobileno']; ?></td>
												<td><?php echo $student['category']; ?></td>
												<?php if ($onlyWithoutRoute) { ?>
												<td><?php echo $student['route_title']; ?></td>
												<?php } ?>
											</tr>
											<?php
											$count++;
										}
									}
									?>
								</tbody>
							</table>
						</div> 
					</div> 
				</div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$('.select2').select2();
        $.extend($.fn.dataTable.defaults, {
            ordering: false,
            // paging: false,
            bSort: false,
            // info: false
        });
	});
	var class_id = '<?php echo set_value('class_id') ?>';
	var section_id = '<?php echo set_value('section_id') ?>';
	getSectionByClass(class_id, section_id);

	$(document).on('change', '#class_id', function (e) {
		$('#section_id').html("");
		var class_id = $(this).val();
		getSectionByClass(class_id, 0);
	});

	function getSectionByClass(class_id, section_id) {

		if (class_id !== "") {
			$('#section_id').html("");
			var base_url = '<?php echo base_url() ?>';
			var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
			var sel1 = "";
			if (section_id === 'all') {
				sel1 = "selected";
			}
			div_data += '<option value="all"'+sel1+'><?php echo $this->lang->line('all'); ?></option>';

			$.ajax({
				type: "GET",
				url: base_url + "sections/getByClass",
				data: {'class_id': class_id},
				dataType: "json",
				beforeSend: function () {
					$('#section_id').addClass('dropdownloading');
				},
				success: function (data) {
					$.each(data, function (i, obj)
					{
						var sel = "";
						if (section_id === obj.section_id) {
							sel = "selected";
						}
						div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
					});
					$('#section_id').append(div_data);
				},
				complete: function () {
					$('#section_id').removeClass('dropdownloading');
				}
			});
		}
	}
</script>
<script>
  document.querySelectorAll('.master-check').forEach(master => {
    master.addEventListener('change', function () {
      const targetClass = this.dataset.target;
      document.querySelectorAll('.' + targetClass).forEach(cb => {
        cb.checked = this.checked;
      });
    });
  });
</script>