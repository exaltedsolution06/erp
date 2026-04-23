<style>
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
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-map-o"></i> <?php echo $this->lang->line('examinations'); ?> <small><?php echo $this->lang->line('student_fee1'); ?></small>  </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php $this->load->view('reports/_examinations'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box removeboxmius">
                    <div class="box-header ptbnull"></div>
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <div class="box-body">

                        <form role="form" action="<?php echo site_url('admin/examresult/percentreport') ?>" method="post">

                            <?php echo $this->customlib->getCSRF(); ?>

                            <div class="row">
                                <div class="col-sm-6 col-lg-3 col-md-12">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                        <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
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
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-3 col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                                        <select  id="section_id" name="section_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                    </div>
                                </div>
								<div class="col-sm-6 col-lg-3 col-md-12">
									<div class="form-check">
										<input type="checkbox" class="form-check-input master-check" data-target="exam-group-check" id="selectAllExamGroup">
										<label class="form-check-label" for="selectAllExamGroup"> <?php echo $this->lang->line('exam') . " " . $this->lang->line('group'); ?></label><small class="req text-danger"> *</small>
									</div>
									<div class="filter-box">
										<?php
										$selectedExamGroup = $_POST['exam_group_id'] ?? [];
										foreach ($examgrouplist as $ex_group_key => $ex_group_value) {
										$checked = in_array($ex_group_value->id, $selectedExamGroup) ? 'checked' : '';
										echo "<div class='form-check'>
												<input type='checkbox' class='form-check-input exam-group-check' name='exam_group_id[]' value='{$ex_group_value->id}' id='exam-group{$ex_group_value->id}' $checked>
												<label class='form-check-label' for='exam-group{$ex_group_value->id}'>{$ex_group_value->name}</label>
												</div>";
										}
										?>
									</div>
                                    <span class="text-danger"><?php echo form_error('exam_group_id[]'); ?></span>
								</div>
								<div class="col-sm-6 col-lg-3 col-md-12">
									<div class="form-check">
										<input type="checkbox" class="form-check-input master-check" data-target="exam-group-check" id="selectAllExamGroup">
										<label class="form-check-label" for="selectAllExamGroup"> <?php echo $this->lang->line('exam'); ?></label><small class="req"> *</small>
									</div>
									<div class="filter-box">
										<div id="exam-list-container">
											<?php 
											if(!empty($exam_list)){
												foreach ($exam_list as $exam_list_exam){
											?>
												<div class='form-check'>
													<input type='checkbox' class='form-check-input exam-check' 
														name='exam_id[]' value='<?php echo $exam_list_exam->id; ?>' id='exam<?php echo $exam_list_exam->id; ?>'>
													<label class='form-check-label' for='exam<?php echo $exam_list_exam->id; ?>'>
														<?php echo $exam_list_exam->exam; ?>
													</label>
												</div>
											<?php 	
												}
											}
											?>
										</div>
									</div>
                                    <span class="text-danger"><?php echo form_error('exam_id[]'); ?></span>
								</div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" name="search" value="search_filter" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                    </div>
                                </div>
                            </div>  
                        </form>

                    </div>

                    <?php
                    if (isset($stdResult)) {
                        ?>
                        <div class="box-header ptbnull"></div>  
                        <div class="box-header ptbnull">
                            <h3 class="box-title titlefix"><i class="fa fa-users"></i> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('list'); ?></h3>

                        </div>
                        <div class="box-body">
                            <div class="table-responsive no-padding">
                                <div class="download_label"><?php ?> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('list') . "<br>";
                        ?></div>

                                <?php
                                if (empty($stdResult)) {
									
                                } else {
									// echo '<pre>';print_r($stdResult);exit;
									$student_list_array = array();
									foreach($stdResult as $i=>$stddata){
										$student_array = array();
                                        $student_array['admission_no'] = $stddata->admission_no;
                                        $student_array['exam_roll_no'] = ($stddata->exam_roll_no != 0) ? $stddata->exam_roll_no : "-";
                                        $student_array['student_id'] = $stddata->student_id;
                                        $student_array['name'] = $this->customlib->getFullName($stddata->firstname,$stddata->middlename,$stddata->lastname,$sch_setting->middlename,$sch_setting->lastname);
												
										$array1=[];								
										$finalTotal=0;
										$maxMark=[];
										$minMark=[];
										
										$student_id=$stddata->student_id;
										$student_result = $this->studentsession_model->getStudentClass($stddata->student_id);
										$subject_group_by_classsection = $this->subjectgroup_model->getGroupByClassandSection($student_result['class_id'], $student_result['section_id']);
										$subject_id_data = [];
										foreach ($subject_group_by_classsection as $sgc_val) {
											$subject_list_by_groupid = $this->subjectgroup_model->getByID($sgc_val['subject_group_id']);

											foreach ($subject_list_by_groupid as $slg_val) {
												foreach ($slg_val->group_subject as $subject) {
													$subject_id_data[] = $subject->subject_id;
												}
											}
										}
										
										$max_marks = 0;
									
										for($i=0;$i<count($subject_id_data);$i++){
											$sql1="SELECT * FROM subjects WHERE id='".$subject_id_data[$i]."' ";
											$query1 = $this->db->query($sql1);
											$rowdata = $query1->result()[0];
											$max_marks1 = 0;
											$total1 = 0;
											$array = [];
											if($rowdata->type_one != 'optional'){
												$min_marks = 0;
												foreach($post_exam_group_id as $post_exam_group){
													$total=0;
													$exam_group_id=$post_exam_group;
													
													$exam_type=$this->db->query("SELECT exam_group_class_batch_exams.* FROM exam_group_class_batch_exams INNER JOIN exam_group_class_batch_exam_students ON exam_group_class_batch_exam_students.exam_group_class_batch_exam_id=exam_group_class_batch_exams.id WHERE exam_group_id='".$exam_group_id."' AND exam_group_class_batch_exam_students.student_id='".$stddata->student_id."'")->result();
											// echo '<pre>';print_r($exam_ids);exit;
													
													$max_marks1 = 0;
													$term_array = [];
													foreach($exam_type as $type){
														if(in_array($type->id, $exam_ids)){
															$maxMarks=$this->db->query("SELECT max_marks, min_marks FROM exam_group_class_batch_exam_subjects WHERE exam_group_class_batch_exams_id='".$type->id."' and subject_id='".$rowdata->id."'")->result()[0];
															array_push($maxMark,$maxMarks->max_marks);
															array_push($minMark,$maxMarks->min_marks);
															
										// echo '<pre>';print_r($maxMarks->max_marks);exit;				
															$resultData=$this->db->query("SELECT exam_group_exam_results.*,exam_group_class_batch_exam_subjects.max_marks FROM exam_group_exam_results left JOIN exam_group_class_batch_exam_subjects ON exam_group_class_batch_exam_subjects.id=exam_group_exam_results.exam_group_class_batch_exam_subject_id left JOIN exam_group_class_batch_exam_students ON exam_group_class_batch_exam_students.id=exam_group_exam_results.`exam_group_class_batch_exam_student_id` WHERE exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id='".$type->id."' and exam_group_class_batch_exam_students.exam_group_class_batch_exam_id='".$type->id."' and exam_group_class_batch_exam_subjects.subject_id='".$rowdata->id."' and exam_group_class_batch_exam_students.student_id='".$stddata->student_id."'")->result()[0];

															$min_marks+=$maxMarks->min_marks;
															$max_marks+=$maxMarks->max_marks;
															$max_marks1+=$maxMarks->max_marks;
														
															// $marks = !empty($resultData) ? ($resultData->attendence == 'absent' ? 'AB' : $resultData->get_marks) : "-";
															array_push($term_array, !empty($resultData) ? $resultData->get_marks : 0);
															
															$total+=$resultData->get_marks;
														}
													}
													$total1+=$total;
													array_push($array,$max_marks1);
													$array = array_merge($array,$term_array);
													array_push($array,$total);

													$grade_array = [ 'type'=>'grade', 'marks'=>$max_marks1 ];
													// array_push($array,$max_marks1);
													array_push($array,$grade_array);
													
													// echo '<pre>';print_r($array1);exit;
												}
													$max_marks=0;
													$finalTotal+=$total1;
													array_push($array1,$array);
											}
										}
										$student_array['max_marks'] = array_sum($maxMark);
										$student_array['finalTotal'] = $finalTotal;
										$student_list_array[] = $student_array;
										// echo '<pre>';print_r($array1);exit;
									}
									echo '<pre>';print_r($student_list_array);exit;
                                }
                                ?>

                                <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th><?php echo $this->lang->line('rank'); ?></th>
                                            <th><?php echo $this->lang->line('admission_no'); ?></th>

                                            <th><?php echo $this->lang->line('roll_no'); ?></th>
                                            <th><?php echo $this->lang->line('student_name'); ?></th>
                                            <th>M.M</th>
                                            <th>M.O</th>
                                            <th>Percentage</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($student_list_array)) {
                                            $rank_count = 1;
                                            foreach ($student_list_array as $student_list_value) {
                                               
                                                ?>
                                                <tr>
                                                    <td><?php echo $rank_count; ?></td>
                                                    <td><?php echo $student_list_value['admission_no']; ?></td>

                                                    <td><?php echo ($student_list_value['exam_roll_no'] != 0) ? $student_list_value['exam_roll_no'] : "-"; ?> </td>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>student/view/<?php echo $student_list_value['student_id']; ?>"><?php echo $student_list_value['name'];
 
                                                         ?>
                                                        </a>
                                                    </td>
													<td>M.M</td>
													<td>M.O</td>
													<td>Percentage</td>  
                                                </tr>
                                        <?php
                                            $rank_count++;
                                            }
                                        }
                                        ?>

                                     </tbody>
                                </table>
                             </div>
                        </div>
                </div>
				<?php
					}
				?>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$('.select2').select2();
	});
	$(document).ready(function () {
		$.extend($.fn.dataTable.defaults, {
			searching: true,
			ordering: true,
			paging: false,
			retrieve: true,
			destroy: true,
			info: false
		});
	});
	var class_id = '<?php echo set_value('class_id') ?>';
	var section_id = '<?php echo set_value('section_id') ?>';
	var session_id = '<?php echo set_value('session_id') ?>';
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
  $(document).on('change', '.master-check', function () {
		const targetClass = $(this).data('target');

		$('.' + targetClass).prop('checked', this.checked);

		loadExamList();
	});
  $(document).on('change', '.exam-group-check', function () {
		loadExamList();
	});
	function loadExamList() {
		let selected = [];

		$('.exam-group-check:checked').each(function () {
			selected.push($(this).val());
		});

		$.ajax({
			url: base_url + "admin/examgroup/getExamByExamgroupArray",
			type: "POST",
			data: { exam_group_id: selected },
			success: function (res) {
				$('#exam-list-container').html(res);
			}
		});
	}
</script>