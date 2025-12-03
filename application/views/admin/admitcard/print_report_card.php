<?php

	$desc=$reportcard;
	$saved_json = json_decode($desc->exam_group_grade, true);			
	$saved_max_marks_json = json_decode($desc->exam_group_max_marks, true);	
	// var_dump($marksheet['students'][0]['exam_result']);
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<style>
		
		.table>:not(caption)>*>* {
			padding:0px 0px !important;
		}
		
	</style>
	
	<style type="text/css">
   @media print {
	   .container{
	   -webkit-print-color-adjust: exact; 
	   }
   .pagebreak { page-break-before: always; } 
   
    @page {
        margin-top: 5px;
        margin-bottom: 0;
      }
	  
	  .h3{
		  font-size:20px !important;
	  }
	  span{
		  font-size:15px !important;
		  font-weight:bold;
	  }
	  
	  th{
		font-size:15px !important;
		font-weight:bold;
	  }
	  .th{
		 font-size:15px !important;
		font-weight:bold;
	  }
   }
   .mark-container{
        width: 1000px;position: relative;z-index: 2; margin: 0 auto; padding: 10px 30px;}
   .tcmybg {
	   background:top center;
        background-size: 100% 100%;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        z-index: 1;
   }
   .maincontent{position: relative;z-index: 2}
  
</style>

	
  </head>
  <body>

<?php 
	ob_start();
	$grade_html = '';
	if($desc->marks_grade_table==1){
?>
	<div class="col-12 mt-3" style="padding-left:0px;padding-right:0px;padding-bottom:0px">
		<div class="text-danger text-center"><h4><?php echo $this->lang->line('grade_system'); ?></h4></div>
		<?php
			$grades = $this->db->order_by('mark_from', 'DESC')->get('grades')->result();
			$half = ceil(count($grades) / 2);

			$left  = array_slice($grades, 0, $half);
			$right = array_slice($grades, $half);
		?>
		<table class="w-100 border-dark table-bordered">
			<tr>
				<th style="padding-left:8px;"><?php echo $this->lang->line('marks_range'); ?></th>
				<th style="padding-left:8px;"><?php echo $this->lang->line('grade'); ?></th>
				<th style="padding-left:8px;"><?php echo $this->lang->line('marks_range'); ?></th>
				<th style="padding-left:8px;"><?php echo $this->lang->line('grade'); ?></th>
			</tr>
			<?php for ($i = 0; $i < $half; $i++): ?>
				<tr>

					<!-- LEFT SIDE -->
					<?php if (isset($left[$i])): ?>
						<td style="padding-left:8px;"><?= $left[$i]->mark_upto ?> - <?= $left[$i]->mark_from ?></td>
						<td style="padding-left:8px;"><?= $left[$i]->name ?></td>
					<?php else: ?>
						<td></td><td></td>
					<?php endif; ?>

					<!-- RIGHT SIDE -->
					<?php if (isset($right[$i])): ?>
						<td style="padding-left:8px;"><?= $right[$i]->mark_upto ?> - <?= $right[$i]->mark_from ?></td>
						<td style="padding-left:8px;"><?= $right[$i]->name ?></td>
					<?php else: ?>
						<td></td><td></td>
					<?php endif; ?>

				</tr>
			<?php endfor; ?>
		</table>

	</div>
<?php
	}
	$grade_html .= ob_get_clean();	

	$exam_group_class_batch_exam_student_id=$_POST['exam_group_class_batch_exam_student_id'];



	foreach($marksheet as $stddata){
	
			if(in_array($stddata->student_id, $exam_group_class_batch_exam_student_id)){
			$student_id=$stddata->student_id;
?>

	<div class="mark-container mb-5">
	<?php
		if ($desc->background_image != "") {
	?>
		<img src="<?php echo base_url('uploads/reportcard/' . $desc->background_image); ?>" class="tcmybg" width="100%" height="100%" />
	<?php
		}
	?>
		<div class="row maincontent">
			<div class="col-12 bg-danger"style="height:0px"></div>
			<?php 
			if($desc->is_header==1){
			if($desc->header_img!='' || $desc->header_img!=null){
			$is_header_file_path = FCPATH . 'uploads/reportcard/' . $desc->header_img;
			if (file_exists($is_header_file_path)) {
			?>
			<div class="col-12" style="padding:0;">
				<img src="<?php echo base_url('uploads/reportcard/'.$desc->header_img) ?>" style="height:150px;width:100%">
			</div>
			<?php } } } ?>
			<?php if(!empty($desc->title)){ ?>
			<div class="col-12 text-center">
				<p class="text-danger h3"><?php echo $desc->title; ?> (<?php echo $this->lang->line('session'); ?> : <?php echo $current_session['session']; ?>)</p>
			</div>
			<?php } ?>
			<div class="col-12" style="border:1px solid">
				<div class="row pt-3" >
					<div class="col-6" >
						<table class="table table-borderless">
						<tbody>
							<?php if($desc->is_name==1){ ?>
							<tr>
							  <th class="th" scope="row"><?php echo $this->lang->line('student_name'); ?></th>
							  <td>:  &nbsp;</td>
							  <td><?=$stddata->firstname.' '.$stddata->middlename.' '.$stddata->lastname ?></td>
							</tr>
						<?php } ?> 
						
						
						<?php if($desc->is_father_name==1){ ?>
							<tr>
							  <th scope="row"  class="th"><?php echo $this->lang->line('father_name'); ?></th>
							  <td>:</td>
							  <td><?=$stddata->father_name?></td>
							</tr>
							<?php } ?>
						
						
						<?php if($desc->is_mother_name==1){ ?>
							<tr>
							  <th scope="row"  class="th"><?php echo $this->lang->line('mother_name'); ?></th>
							  <td>:</td>
							  <td><?=$stddata->mother_name?></td>
							</tr>
							<?php }  ?>
							
						<?php if($desc->is_dob==1){ ?>
							
							<tr>
							  <th scope="row"  class="th"><?php echo $this->lang->line('d_o_b'); ?></th>
							  <td>:</td>
							  <td><?=date('d-M-Y',strtotime($stddata->dob))?></td>
							</tr>
							<?php } ?>
						  </tbody>
						</table>
					</div>
					<div class="col-6">
					
						<table class="table table-borderless">
						  <tbody>
						  	<?php  if($desc->is_class==1 or $desc->is_section==1){ ?>
							<tr>
							  <th scope="row"  class="th"><?php echo $this->lang->line('class_and_section'); ?></th>
							  <td>:</td>
							  <td><?=$stddata->class?>  <?=$stddata->section?>  </td>
							</tr>
							<?php } if($desc->is_roll_no==1){ ?>
							<tr>
							  <th  class="th"><?php echo $this->lang->line('roll_no'); ?></th>
							  <td>:  &nbsp;</td>
							  <td><?=$stddata->roll_no?></td>
							</tr>
							<?php } if($desc->is_admission_no==1){ ?>
							<tr>
							  <th  class="th" scope="row"><?php echo $this->lang->line('admission_no'); ?></th>
							  <td>:</td>
							  <td><?=$stddata->admission_no?></td>
							</tr>
							<?php } if($desc->is_contactno==1){ ?>
							<tr>
							  <th  class="th" scope="row"><?php echo $this->lang->line('contactno'); ?></th>
							  <td>:</td>
							  <td><?=$stddata->mobileno?></td>
							</tr>
							<?php } ?>
						  </tbody>
						</table>
					
					</div>
				</div>
			</div>
			
			
			
			<div class="col-12 mt-1" style="border:0px solid">
				<div class="row">
					<div class="col-12" style="padding-left:0px;padding-right:0px;padding-bottom:0px">
						<table class="w-100 table-bordered border-dark text-center" style="padding-bottom:0px">
							
							<thead>
								
								<tr>
									<th class="text-success"><?php echo $this->lang->line('scholastic_area'); ?></th>
									<?php 
									$allNames = [];
									foreach($post_exam_group_id as $rowDatagroup){
									$exam_type=$this->db->query("SELECT exam_group_class_batch_exams.* FROM exam_group_class_batch_exams INNER JOIN exam_group_class_batch_exam_students ON exam_group_class_batch_exam_students.exam_group_class_batch_exam_id=exam_group_class_batch_exams.id WHERE exam_group_id='".$rowDatagroup->id."' AND exam_group_class_batch_exam_students.student_id='".$stddata->student_id."'")->result();
									$allNames[] = $rowDatagroup->name;
									$gradecount = 1;
									if(isset($saved_json[$rowDatagroup->id]) && $saved_json[$rowDatagroup->id] == 1){
										$gradecount++;
									}
									if(isset($saved_max_marks_json[$rowDatagroup->id]) && $saved_max_marks_json[$rowDatagroup->id] == 1){
										$gradecount++;
									}
										?>
									<th colspan="<?=count($exam_type)+$gradecount?>" class="text-danger"><?=$rowDatagroup->name?></th>
									<?php }
										$overallgradecount = 1;
										if(isset($saved_json['overall']) && $saved_json['overall'] == 1){
											$overallgradecount++;
										}
										if(isset($saved_max_marks_json['overall']) && $saved_max_marks_json['overall'] == 1){
											$overallgradecount++;
										}
									?>
									
									<th colspan="<?php echo $overallgradecount; ?>" class="text-danger"><?= implode(' + ', $allNames); ?></th>
								</tr>


								
								<tr style="vertical-align: middle;">
									<th style="width:100px"><?php echo $this->lang->line('main'); ?> <?php echo $this->lang->line('subject'); ?></th>
									
									<?php  foreach($post_exam_group_id as $rowDatagroup){
									$exam_type=$this->db->query("SELECT exam_group_class_batch_exams.* FROM exam_group_class_batch_exams INNER JOIN exam_group_class_batch_exam_students ON exam_group_class_batch_exam_students.exam_group_class_batch_exam_id=exam_group_class_batch_exams.id WHERE exam_group_id='".$rowDatagroup->id."' AND exam_group_class_batch_exam_students.student_id='".$stddata->student_id."'")->result();
										
										foreach($exam_type as $type){
										?>
									
									
									<th class="text-success" style="width:90px"><?=$type->exam?>  </th>
										<?php } ?>
										
										<th class="text-success" style="width:100px"><?php echo $this->lang->line('m_o'); ?></th>
										<?php
										if(isset($saved_max_marks_json[$rowDatagroup->id]) && $saved_max_marks_json[$rowDatagroup->id] == 1){
										?>
										<th class="text-success" style="width:100px"><?php echo $this->lang->line('m_m'); ?></th>
										<?php
										}
										if(isset($saved_json[$rowDatagroup->id]) && $saved_json[$rowDatagroup->id] == 1){
										?>
										<th class="text-success" style="width:100px"><?php echo $this->lang->line('grade'); ?></th>
									<?php 
										}
									} 
									?>
									
									
									
									
									<th class="text-success" style="width:100px"><?php echo $this->lang->line('grand_total'); ?></th>
									<?php
										if(isset($saved_max_marks_json['overall']) && $saved_max_marks_json['overall'] == 1){
									?>
									<th class="text-success" style="width:100px"><?php echo $this->lang->line('m_m'); ?></th>
									<?php
										}
										if(isset($saved_json['overall']) && $saved_json['overall'] == 1){
									?>
									<th class="text-success" style="width:100px"><?php echo $this->lang->line('overall'); ?> <?php echo $this->lang->line('grade'); ?></th>
									<?php } ?>
								</tr>
							</thead>
							
							<tbody>
								

								<?php 
								$array1=[];
								$aadi=0;
								$finalTotal=0;
								$maxMark=[];
								$maxMark_op=[];
								
								/*$sql="SELECT exam_group_class_batch_exam_subjects.subject_id FROM exam_group_class_batch_exam_subjects INNER JOIN exam_group_class_batch_exams ON exam_group_class_batch_exams.id=exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id  INNER JOIN exam_groups ON exam_groups.id=exam_group_class_batch_exams.exam_group_id INNER JOIN exam_group_class_batch_exam_students ON exam_group_class_batch_exam_students.exam_group_class_batch_exam_id=exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id WHERE exam_group_class_batch_exam_students.student_id='". $stddata->student_id ."' and exam_groups.id  IN ('".implode("','",$postExamGroupId)."') ";
								 
								
								
								$query = $this->db->query($sql);
								$subject= $query->result();
								

								$abc=[];
								foreach($subject as $rowdata){ 
									array_push($abc,$rowdata->subject_id);
								}
								
								$subject_id_data=array_unique($abc);*/
								
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
								
								$max_marks = $max_marks_op = 0;
								$total_subject = $total_subject_op=0;
								for($i=0;$i<count($subject_id_data);$i++){
								
									$sql1="SELECT * FROM subjects WHERE id='".$subject_id_data[$i]."' ";
									$query1 = $this->db->query($sql1);
									$rowdata = $query1->result()[0];
									$max_marks1 = $max_marks1_op = 0;
									$total1 = $total1_op = 0;
									$array = $array_op = [];
									if($rowdata->type_one != 'optional'){
								?>
								
										<tr>
											<td class="text-success" style="text-align:left;padding-left:8px" ><?=$rowdata->name?></td>
											
											<?php

											foreach($post_exam_group_id as $post_exam_group){
													
													
													$total=0;
													$exam_group_id=$post_exam_group->id;
			
												
												// $exam_type=$this->db->query("SELECT * FROM exam_group_class_batch_exams WHERE exam_group_id='".$exam_group_id."'")->result();
												$exam_type=$this->db->query("SELECT exam_group_class_batch_exams.* FROM exam_group_class_batch_exams INNER JOIN exam_group_class_batch_exam_students ON exam_group_class_batch_exam_students.exam_group_class_batch_exam_id=exam_group_class_batch_exams.id WHERE exam_group_id='".$exam_group_id."' AND exam_group_class_batch_exam_students.student_id='".$stddata->student_id."'")->result();
											


												$max_marks1 = 0;
												foreach($exam_type as $type){
													$maxMarks=$this->db->query("SELECT max_marks FROM exam_group_class_batch_exam_subjects WHERE exam_group_class_batch_exams_id='".$type->id."' and subject_id='".$rowdata->id."'")->result()[0];
													array_push($maxMark,$maxMarks->max_marks);
								
								
		$resultData=$this->db->query("SELECT exam_group_exam_results.*,exam_group_class_batch_exam_subjects.max_marks FROM exam_group_exam_results left JOIN exam_group_class_batch_exam_subjects ON exam_group_class_batch_exam_subjects.id=exam_group_exam_results.exam_group_class_batch_exam_subject_id left JOIN exam_group_class_batch_exam_students ON exam_group_class_batch_exam_students.id=exam_group_exam_results.`exam_group_class_batch_exam_student_id` WHERE exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id='".$type->id."' and exam_group_class_batch_exam_students.exam_group_class_batch_exam_id='".$type->id."' and exam_group_class_batch_exam_subjects.subject_id='".$rowdata->id."' and exam_group_class_batch_exam_students.student_id='".$stddata->student_id."'")->result()[0];

													$max_marks+=round($maxMarks->max_marks);
													$max_marks1+=round($maxMarks->max_marks);
												?>
													<td>
														<?php 
															$marks = !empty($resultData) ? ($resultData->attendence == 'absent' ? 'AB' : round($resultData->get_marks)) : "-";
															echo $marks;

															$total_subject++; 
															array_push($array, !empty($resultData) ? $resultData->get_marks : 0);
														?>
													</td>
													
												<?php 
														$total+=$resultData->get_marks; 
													} 
													$total1+=$total; 
													
												?>
											
											<td style="width:100px"><?php echo $total; ?></td>
											<?php
											if(isset($saved_max_marks_json[$exam_group_id]) && $saved_max_marks_json[$exam_group_id] == 1){
											?>
											<td style="width:100px"><?php echo $max_marks1; ?></td>
											<?php
											}
											if(isset($saved_json[$exam_group_id]) && $saved_json[$exam_group_id] == 1){
											?>
											<td style="width:100px">
											<?php
												$t_grade = ($max_marks1 > 0) ? ($total * 100 / $max_marks1) : 0;
												$gd=$this->db->query("SELECT * FROM `grades` WHERE mark_from>='$t_grade' and 	mark_upto<='$t_grade' order by mark_upto asc")->result();
												echo ($gd[0]->name);
											?>
											</td>
											
											<?php
											}
											array_push($array,$total); 
											if(isset($saved_max_marks_json[$exam_group_id]) && $saved_max_marks_json[$exam_group_id] == 1){
												array_push($array,$max_marks1);
											}
											
											if(isset($saved_json[$exam_group_id]) && $saved_json[$exam_group_id] == 1){
												$grade_array = [];
												$grade_array = [ 'type'=>'grade', 'marks'=>$max_marks1 ];
												// array_push($array,$max_marks1);
												array_push($array,$grade_array);
											} 
											} 
											?>

											<td><?=$total1; ?> <?php //echo $max_marks; ?> </td>
											<?php
											if(isset($saved_max_marks_json['overall']) && $saved_max_marks_json['overall'] == 1){
											?>
											<td><?=$max_marks; ?> <?php //echo $max_marks; ?> </td>
											<?php
											}
											if(isset($saved_json['overall']) && $saved_json['overall'] == 1){
											?>
											<td><?php 
											
											
											
												$grade = ($max_marks > 0) ? ($total1 * 100 / $max_marks) : 0;
											
											
										 
											
											
											
											$gd=$this->db->query("SELECT * FROM `grades` WHERE mark_from>='$grade' and 	mark_upto<='$grade' order by mark_upto asc")->result(); 
											
											//echo ($gd[0]->name);
												echo ($gd[0]->name);
											
											?></td>
											<?php } ?>	
										</tr>
									
									<?php
										$max_marks=0;
										$finalTotal+=$total1;
										array_push($array1,$array);	
									}else{
										ob_start();
										$optional_html = '';
									?>
										<tr class="optional">
											<td class="text-success" style="text-align:left;padding-left:8px" ><?=$rowdata->name?></td>
											
											<?php

												foreach($post_exam_group_id as $post_exam_group){
													
													
													$total_op=0;
													$exam_group_id_op=$post_exam_group->id;
			
												
												// $exam_type_op=$this->db->query("SELECT * FROM exam_group_class_batch_exams WHERE exam_group_id='".$exam_group_id_op."'")->result();
												$exam_type_op=$this->db->query("SELECT exam_group_class_batch_exams.* FROM exam_group_class_batch_exams INNER JOIN exam_group_class_batch_exam_students ON exam_group_class_batch_exam_students.exam_group_class_batch_exam_id=exam_group_class_batch_exams.id WHERE exam_group_id='".$exam_group_id_op."' AND exam_group_class_batch_exam_students.student_id='".$stddata->student_id."'")->result();
											

												$max_marks1_op = 0;
												foreach($exam_type_op as $type_op){
													
													$maxMarks_op=$this->db->query("SELECT max_marks FROM exam_group_class_batch_exam_subjects WHERE exam_group_class_batch_exams_id='".$type_op->id."' and subject_id='".$rowdata->id."'")->result()[0];
													
													array_push($maxMark_op,$maxMarks_op->max_marks);
								
								
		$resultData_op=$this->db->query("SELECT exam_group_exam_results.*,exam_group_class_batch_exam_subjects.max_marks FROM exam_group_exam_results left JOIN exam_group_class_batch_exam_subjects ON exam_group_class_batch_exam_subjects.id=exam_group_exam_results.exam_group_class_batch_exam_subject_id left JOIN exam_group_class_batch_exam_students ON exam_group_class_batch_exam_students.id=exam_group_exam_results.`exam_group_class_batch_exam_student_id` WHERE exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id='".$type_op->id."' and exam_group_class_batch_exam_students.exam_group_class_batch_exam_id='".$type_op->id."' and exam_group_class_batch_exam_subjects.subject_id='".$rowdata->id."' and exam_group_class_batch_exam_students.student_id='".$stddata->student_id."'")->result()[0];		

													$max_marks_op+=round($maxMarks_op->max_marks);
													$max_marks1_op+=round($maxMarks_op->max_marks);
												?>
													<td>
														<?php 
															$marks_op = !empty($resultData_op) ? ($resultData_op->attendence == 'absent' ? 'AB' : round($resultData_op->get_marks)) : "-";
															echo $marks_op;

															$total_subject_op++; 
															array_push($array_op, !empty($resultData_op) ? $resultData_op->get_marks : 0);
														?>
													</td>
													
												<?php 
														$total_op+=$resultData_op->get_marks; 
													} 
													$total1_op+=$total_op; 
													
												?>
											
											<td style="width:100px"><?php echo $total_op; ?></td>
											<?php
											if(isset($saved_max_marks_json[$exam_group_id]) && $saved_max_marks_json[$exam_group_id] == 1){
											?>
											<td style="width:100px"><?php echo $max_marks1_op; ?></td>
											<?php
											}
											if(isset($saved_json[$exam_group_id_op]) && $saved_json[$exam_group_id_op] == 1){
											?>
											<td style="width:100px">
											<?php
												$t_grade_op = ($max_marks1_op > 0) ? ($total_op * 100 / $max_marks1_op) : 0;
												$gd_op=$this->db->query("SELECT * FROM `grades` WHERE mark_from>='$t_grade_op' and 	mark_upto<='$t_grade_op' order by mark_upto asc")->result();
												echo ($gd_op[0]->name);
											?>
											</td>
											
											<?php } array_push($array_op,$total_op); } ?>

											<td><?=$total1_op; ?> <?php //echo $max_marks; ?> </td>
											<?php
											if(isset($saved_max_marks_json['overall']) && $saved_max_marks_json['overall'] == 1){
											?>
											<td><?=$max_marks_op; ?> <?php //echo $max_marks; ?> </td>
											<?php
											}
											if(isset($saved_json['overall']) && $saved_json['overall'] == 1){
											?>
											<td><?php 
											
											
											
												$grade_op = ($max_marks_op > 0) ? ($total1_op * 100 / $max_marks_op) : 0;
											
											
										 
											
											
											
											$gd_op=$this->db->query("SELECT * FROM `grades` WHERE mark_from>='$grade_op' and 	mark_upto<='$grade_op' order by mark_upto asc")->result(); 
											
											//echo ($gd[0]->name);
												echo ($gd_op[0]->name);
											
											?></td>
											<?php } ?>	
										</tr>
									<?php
									$optional_html .= ob_get_clean();
									}
								}

								?>
								
								
							</tbody>
							
							<?php
							
								/*$final = array();
								array_walk_recursive($array1, function($item, $key) use (&$final){
									$final[$key] = isset($final[$key]) ?  $item + $final[$key] : $item;
								});*/
								$colTotals = [];
								$gradeLimits = [];

								// Step 1: SUM numeric columns + store grade marks
								foreach ($array1 as $row) {
									foreach ($row as $index => $value) {

										// numeric marks
										if (is_numeric($value)) {
											if (!isset($colTotals[$index])) $colTotals[$index] = 0;
											$colTotals[$index] += $value;
										}

										// grade block
										elseif (is_array($value) && isset($value['marks'])) {
											if (!isset($gradeLimits[$index])) $gradeLimits[$index] = 0;
											$gradeLimits[$index] += $value['marks'];
										}
									}
								}


								// Step 2: Build final array
								$final = [];

								foreach ($array1[0] as $index => $colExample) {

									// numeric column → push total
									if (is_numeric($colExample)) {
										$final[] = $colTotals[$index];
									}

									// grade column → calculate grade
									elseif (is_array($colExample) && isset($colExample['marks'])) {

										$maxMarks = $gradeLimits[$index];

										// total marks before this grade column
										$prevColIndex = $index - 1;
										$totalMarks = $colTotals[$prevColIndex] ?? 0;

										// percentage
										$percentage = ($maxMarks > 0)
											? ($totalMarks * 100 / $maxMarks)
											: 0;

										// DB grade fetch
										$gd = $this->db->query("
											SELECT name FROM grades
											WHERE mark_from <= '$percentage'
											  AND mark_upto >= '$percentage'
											LIMIT 1
										")->row();
										$gd=$this->db->query("SELECT * FROM `grades` WHERE mark_from>='$percentage' and 	mark_upto<='$percentage' order by mark_upto asc")->result();

										// $gradeName = $gd ? $gd->name : "-";

										// push grade
										$final[] = $gd[0]->name;
									}
								}


							?>
							
							<tfoot>
									<tr style="font-weight:bold">
										<th class="text-success" style="text-align:left;padding-left:8px"><?php echo $this->lang->line('total'); ?> : </th>
										<?php
										$i=count($final);
										foreach($final as $row){
											/*if($i==1){
												echo '<td>'.$row.'/'.array_sum($maxMark).'</td>';
											}else{
												echo '<td>'.$row.'</td>';
											}
											$i--;*/	
											echo '<td>'.$row.'</td>';	
										} ?>
										
										<td><?php echo $finalTotal; ?></td>
										<?php
										if(isset($saved_max_marks_json['overall']) && $saved_max_marks_json['overall'] == 1){
										?>
										<td><?php echo array_sum($maxMark); ?></td>
										<?php
										}
										if(isset($saved_json['overall']) && $saved_json['overall'] == 1){
										?>
										<td> 
										<?php
											
											// $grade=$finalTotal*100/array_sum($maxMark); 
											
											$totalMaxMarks = array_sum($maxMark);
											$grade = ($totalMaxMarks > 0) ? ($finalTotal * 100 / $totalMaxMarks) : 0;
									
									
									
									
									
									
									$gd=$this->db->query("SELECT * FROM `grades` WHERE mark_from>='$grade' and 	mark_upto<='$grade' order by mark_upto asc")->result(); 
									echo ($gd[0]->name);
									
									
										
										?>
										
										</td>
										<?php } ?>
									</tr>
									<?php
									if($optional_html != ''){
										$final_column_count = sizeof($final)+3+$overallgradecount;
									?>
										<tr style="text-align: left !important;">
											<th style="padding-left: 8px !important;"  colspan="<?=$final_column_count; ?>"><?php echo $this->lang->line('optional'); ?> <?php echo $this->lang->line('subject'); ?></th>
										</tr>
									<?php
										echo $optional_html;
									}
									?>
							</tfoot>
							
						</table>
						

					</div>
					
					
				</div>
			</div>
			
			
			
		
			
			
			
			
			
			
			
			
			<div class="col-6" style="padding: 0;" >
				Note : 'AB' Indicates <strong>ABSENT</strong> in the Subject Exam.
			</div>
			<div class="col-6 text-end" style="padding: 0;"><strong>
				<?php echo $this->lang->line('overall'); ?> <?php echo $this->lang->line('percentage'); ?>(%) : <?php 
											$totalMaxMarks = array_sum($maxMark);

											$totalNumber = ($totalMaxMarks > 0) 
												? round(($finalTotal * 100 / $totalMaxMarks), 2) 
												: 0;

											echo $totalNumber;
											?>%</strong>
			</div>
			
			<?php 
			$tearm_count=($_POST['exam_group_id']);
			$examgroup_result = $this->examgroup_model->get_c_by_exam_group($tearm_count);
			
			foreach ($examgroup_result as $key => $value) {							
			?>
			<div class="col-6 mt-3" style="padding:0px">
				<table class="w-100 border-dark text-center table-bordered">
					<tr class="text-center">
						<th colspan="2"><h5 class="text-danger"><?=$value->name ?></h5>
							<h6>(3 Point Grading Scale A,B,C)</h6>
						</th>
					</tr>
					<tr>	
						<th style="text-align: left !important;padding-left: 15px !important;"><em style="color:#C00;">Activities</em></th>
						<?php /*$z=1; for ($i=0; $i < count($tearm_count); $i++) { 
							echo '<th>G'.$z++.'</th>';
						}*/ ?>
						<th><?php echo $this->lang->line('grade'); ?></th>
						
						
					</tr>
					<?php  
					$list=$this->examgroup_model->getExamByExamGroup_reportCard_c($value->id,$student_id);
					
					foreach($list as $res){ 
					?>
					<tr>
						<th style="text-align: left !important;padding-left: 15px !important;">
							<?=$res->exam; ?>
						</th>
						<td><?=$res->get_marks; ?></td>
						<?php 
						/*$z=1; for ($i=0; $i < count($tearm_count); $i++) {
							$term_id=$tearm_count[$i];

							// echo $res->id.','.$term_id.','.$student_id;		

							$grade=$this->batchsubject_model->getExamSubjectsPrintReport($res->id,$term_id,$student_id);
							

							echo '<td>'.$grade[0]->grade.'</td>';
							// echo '<td>6</td>';

						}*/
						?>
					</tr>					
				<?php } ?>
				</table>
			</div>

				<?php
			} ?>
			
			<!--<div class="col-12 mt-3" style="padding-left:0px;padding-right:0px;padding-bottom:0px">
				<table class="w-100 table-bordered border-dark " style="padding-bottom:0px">
					<tr>
						<th style="padding-left: 8px !important;width:200px;background:#fff"><?php echo $this->lang->line('result'); ?></th>
						<th style="width:800px"></th>
					</tr>
				</table>
			</div>-->
			<div class="col-12 mt-3" style="padding-left:0px;padding-right:0px;padding-bottom:0px;">
				<div class="row">
					<div class="col-12 mt-3 mb-3">
						<strong><?php echo $this->lang->line('remarks'); ?> :</strong> <span>___________________________________________________________________</span>
					</div>
					<div class="col-6">
						<strong><?php echo $this->lang->line('promoted_to_class'); ?> :</strong> <span>___________________________________</span>
					</div>
					<div class="col-6 text-end">
						<strong><?php echo $this->lang->line('date'); ?> :</strong> <span>________________________________</span>
					</div>
				</div>
			</div>
			<?php
				$sign_count = 0;
				if($desc->is_class_teacher==1){ $sign_count++; }
				if($desc->is_examination_ic==1){ $sign_count++; }
				if($desc->is_principal==1){ $sign_count++; }
				if($sign_count > 0){
			?>
			<div class="col-12 mt-3" style="padding-left:0px;padding-right:0px;padding-bottom:0px;">
				<div class="row text-center">
					<?php
					if($desc->is_class_teacher==1){
					?>
					<div class="col-<?php echo 12/$sign_count; ?>">
						<?php
						if($desc->left_sign!='' || $desc->left_sign!=null){
						$is_left_sign_file_path = FCPATH . 'uploads/reportcard/' . $desc->left_sign;
							if (file_exists($is_left_sign_file_path)) {						
						?>
						<img src="<?php echo base_url('uploads/reportcard/'.$desc->left_sign) ?>" style="height:65px;width:auto;margin-top: 5px;">
						<?php
							}else{
								echo '<div style="height:65px;width:auto;margin-top: 5px;"></div>';
							}
						}else{
							echo '<div style="height:65px;width:auto;margin-top: 5px;"></div>';
						}
						?>
						<h6 class="mt-1"><?php echo $this->lang->line('class_teacher'); ?> <?php echo $this->lang->line('sign'); ?> </h6>
					</div>                   
					<?php } if($desc->is_examination_ic==1){ ?>
					<div class="col-<?php echo 12/$sign_count; ?>">
						<?php
						if($desc->middle_sign!='' || $desc->middle_sign!=null){
						$is_middle_sign_file_path = FCPATH . 'uploads/reportcard/' . $desc->middle_sign;
							if (file_exists($is_middle_sign_file_path)) {						
						?>
						<img src="<?php echo base_url('uploads/reportcard/'.$desc->middle_sign) ?>" style="height:65px;width:auto;margin-top: 5px;">
						<?php
							}else{
								echo '<div style="height:65px;width:auto;margin-top: 5px;"></div>';
							}
						}else{
							echo '<div style="height:65px;width:auto;margin-top: 5px;"></div>';
						}
						?>
						<h6 class="mt-1"><?php echo $this->lang->line('examination_ic'); ?> <?php echo $this->lang->line('sign'); ?> </h6>
					</div>
					<?php } if($desc->is_principal==1){ ?>
					<div class="col-<?php echo 12/$sign_count; ?>">
						<?php
						if($desc->right_sign!='' || $desc->right_sign!=null){
						$is_right_sign_file_path = FCPATH . 'uploads/reportcard/' . $desc->right_sign;
							if (file_exists($is_right_sign_file_path)) {						
						?>
						<img src="<?php echo base_url('uploads/reportcard/'.$desc->right_sign) ?>" style="height:65px;width:auto;margin-top: 5px;">
						<?php
							}else{
								echo '<div style="height:65px;width:auto;margin-top: 5px;"></div>';
							}
						}else{
							echo '<div style="height:65px;width:auto;margin-top: 5px;"></div>';
						}
						?>
						<h6 class="mt-1"><?php echo $this->lang->line('principal'); ?> <?php echo $this->lang->line('sign'); ?></h6>
					</div>
					<?php } ?>
				</div>
				
			</div>
			<?php
				}
			if($grade_html != ''){
				echo $grade_html;
			}
			?>
		</div>
	</div>


<div class="pagebreak"></div>


			<?php }
			} ?>

  </body>
</html>