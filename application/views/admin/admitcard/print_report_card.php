<?php

	$desc=$reportcard;
	$saved_json = json_decode($desc->exam_group_grade, true);			
	$saved_max_marks_json = json_decode($desc->exam_group_max_marks, true);	
	$saved_marks_obtained_json = json_decode($desc->exam_group_marks_obtained, true);	
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
   .subject-color {
	   color: var(--subject-color);
   }
   .scholastic-area-color {
	   color: var(--scholastic-area-color);
   }
   .main-subject-color {
	   color: var(--main-subject-color);
   }
	.remarks-line {
		width: 100%;
		border-bottom: 1px solid #000;
		margin-left: 5px;
	}
	.text-underline {
		border-bottom: 1px solid #000;
		margin-left: 5px;
	}
	.ml-5px {
		margin-left: 5px;
	}
	.top_left_width {
		width:25%
	}
	.top_right_width {
		width:27%
	}
	.allBold {
		font-size:15px !important;
		font-weight:bold;
	}	
  
</style>

	
  </head>
  <body>

<?php 
	ob_start();
	$grade_html = '';
	if($desc->marks_grade_table==1){
?>
	<div class="col-12 mt-2" style="padding-left:0px;padding-right:0px;padding-bottom:0px; border-top: 2px solid #000;">
		<div class="text-center mt-2"><h4 style="font-size: 18px;"><?php echo $desc->grade_table_title; ?></h4></div>
		<?php
			$grades = $this->db->order_by('mark_from', 'DESC')->where('session_id', $current_session['id'])->get('grades')->result();
			$half = ceil(count($grades) / 2);

			$left  = array_slice($grades, 0, $half);
			$right = array_slice($grades, $half);
		?>
		<table class="w-100 border-dark table-bordered">
			<tr>
				<th style="padding-left:8px;text-align: center;"><?php echo $this->lang->line('marks_range'); ?></th>
				<th style="padding-left:8px;text-align: center;"><?php echo $this->lang->line('grade'); ?></th>
				<th style="padding-left:8px;text-align: center;"><?php echo $this->lang->line('marks_range'); ?></th>
				<th style="padding-left:8px;text-align: center;"><?php echo $this->lang->line('grade'); ?></th>
			</tr>
			<?php for ($i = 0; $i < $half; $i++): ?>
				<tr>

					<!-- LEFT SIDE -->
					<?php if (isset($left[$i])): ?>
						<td style="padding-left:8px;text-align: center;"><?= rtrim(rtrim($left[$i]->mark_upto, '0'), '.') ?> - <?= rtrim(rtrim($left[$i]->mark_from, '0'), '.') ?></td>
						<td style="padding-left:8px;text-align: center;"><?= $left[$i]->name ?></td>
					<?php else: ?>
						<td></td><td></td>
					<?php endif; ?>

					<!-- RIGHT SIDE -->
					<?php if (isset($right[$i])): ?>
						<td style="padding-left:8px;text-align: center;"><?= rtrim(rtrim($right[$i]->mark_upto, '0'), '.') ?> - <?= rtrim(rtrim($right[$i]->mark_from, '0'), '.') ?></td>
						<td style="padding-left:8px;text-align: center;"><?= $right[$i]->name ?></td>
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



	foreach($marksheet as $i=>$stddata){
	// echo '<pre>';print_r($stddata);
			if(in_array($stddata->student_id, $exam_group_class_batch_exam_student_id)){
			$student_id=$stddata->student_id;
?>
<?php if ($index > 0): ?>
	<div class="pagebreak"></div>
<?php endif; ?>
<?php 
	if($desc->is_header==0){
?>
	<div class="" style="height:<?php echo $desc->header_height; ?>px;"></div>
<?php
	}
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
			<div class="col-12 text-center mt-3">
				<p class="h3"><strong><?php echo $desc->title; ?> (<?php echo $this->lang->line('session'); ?> : <?php echo $current_session['session']; ?>)</strong></p>
			</div>
			<?php } ?>
			<div class="col-12" style="border:1px solid">
				<div class="row pt-3" >
						<?php
						$is_photo_exists = false;
						if($desc->is_photo==1){	
							if($stddata->image != ''){
								$is_student_photo_file_path = FCPATH . $stddata->image;
								if (file_exists($is_student_photo_file_path)) {
									$is_photo_exists = true;
								}
							}
						}
						?>
					<div class="col-<?php echo $is_photo_exists ? 5 : 6; ?>" >
						<table class="table table-borderless allBold">
						<tbody>
							<?php if($desc->is_admission_no==1){ ?>
							<tr>
							  <th class="th top_left_width" scope="row"><?php echo $this->lang->line('admission_no'); ?></th>
							  <td>:</td>
							  <td><?=$stddata->admission_no?></td>
							</tr>
							<?php } if($desc->is_name==1){ ?>
							<tr>
							  <th class="th top_left_width" scope="row"><?php echo $this->lang->line('student_name'); ?></th>
							  <td>:  &nbsp;</td>
							  <td><?=$stddata->firstname.' '.$stddata->middlename.' '.$stddata->lastname ?></td>
							</tr>
							<?php } if($desc->is_father_name==1){ ?>
							<tr>
							  <th scope="row"  class="th top_left_width"><?php echo $this->lang->line('father_name'); ?></th>
							  <td>:</td>
							  <td><?=$stddata->father_name?></td>
							</tr>
							<?php } if($desc->is_mother_name==1){ ?>
							<tr>
							  <th scope="row"  class="th top_left_width"><?php echo $this->lang->line('mother_name'); ?></th>
							  <td>:</td>
							  <td><?=$stddata->mother_name?></td>
							</tr>
							<?php }  ?>
						  </tbody>
						</table>
					</div>
					<div class="col-<?php echo $is_photo_exists ? 5 : 6; ?>">
					
						<table class="table table-borderless allBold">
						  <tbody>
						  	<?php if($desc->is_roll_no==1){ ?>
							<tr>
							  <th  class="th top_right_width"><?php echo $this->lang->line('roll_no'); ?></th>
							  <td>:  &nbsp;</td>
							  <td><?=$stddata->roll_no?></td>
							</tr>
							<?php } if($desc->is_class==1 or $desc->is_section==1){ ?>
							<tr>
							  <th scope="row"  class="th top_right_width"><?php echo $this->lang->line('class_and_section'); ?></th>
							  <td>:</td>
							  <td><?=$stddata->class?>  <?=$stddata->section?>  </td>
							</tr>
							<?php } if($desc->is_dob==1){ ?>							
							<tr>
							  <th scope="row"  class="th top_right_width"><?php echo $this->lang->line('d_o_b'); ?></th>
							  <td>:</td>
							  <td><?=date('d-M-Y',strtotime($stddata->dob))?></td>
							</tr>
							<?php } if($desc->is_contactno==1){ ?>
							<tr>
							  <th  class="th top_right_width" scope="row"><?php echo $this->lang->line('contactno'); ?></th>
							  <td>:</td>
							  <td><?=$stddata->mobileno?></td>
							</tr>
							<?php } ?>
						  </tbody>
						</table>
					
					</div>
					<?php
					if($is_photo_exists){
					?>
					<div class="col-2">
						<table class="table table-borderless">
							<tbody>
								<tr>
									<td valign="top" width="25%" align="right">
										<img src="<?php echo base_url() . $stddata->image; ?>" height="85" style="border: 2px solid #fff;outline: 1px solid #000000; width: auto;">
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<?php } ?>
				</div>
			</div>
			
			
			
			<div class="col-12 mt-3" style="border:0px solid">
				<div class="row">
					<div class="col-12" style="padding-left:0px;padding-right:0px;padding-bottom:0px">
						<table class="w-100 table-bordered border-dark text-center" style="padding-bottom:0px">
							
							<thead>
								
								<tr>
									<th class="scholastic-area-color" style=" --scholastic-area-color: <?= htmlspecialchars($desc->scholastic_area_color, ENT_QUOTES, 'UTF-8') ?>;"><?php echo $this->lang->line('scholastic_area'); ?></th>
									<?php 
									// $allNames = [];
									foreach($post_exam_group_id as $rowDatagroup){
									$exam_type=$this->db->query("SELECT exam_group_class_batch_exams.* FROM exam_group_class_batch_exams INNER JOIN exam_group_class_batch_exam_students ON exam_group_class_batch_exam_students.exam_group_class_batch_exam_id=exam_group_class_batch_exams.id WHERE exam_group_id='".$rowDatagroup->id."' AND exam_group_class_batch_exam_students.student_id='".$stddata->student_id."'")->result();
									// $allNames[] = $rowDatagroup->name;
									$gradecount = 0;
									if(isset($saved_json[$rowDatagroup->id]) && $saved_json[$rowDatagroup->id] == 1){
										$gradecount++;
									}
									if(isset($saved_marks_obtained_json[$rowDatagroup->id]) && $saved_marks_obtained_json[$rowDatagroup->id] == 1){
										$gradecount++;
									}
									if(isset($saved_max_marks_json[$rowDatagroup->id]) && $saved_max_marks_json[$rowDatagroup->id] == 1){
										$gradecount++;
									}
										?>
									<th class="scholastic-area-color" style=" --scholastic-area-color: <?= htmlspecialchars($desc->scholastic_area_color, ENT_QUOTES, 'UTF-8') ?>;" colspan="<?=count($exam_type)+$gradecount?>" class=""><?=$rowDatagroup->name?></th>
									<?php }
										$overallgradecount = 0;
										if(isset($saved_json['overall']) && $saved_json['overall'] == 1){
											$overallgradecount++;
										}
										if(isset($saved_marks_obtained_json['overall']) && $saved_marks_obtained_json['overall'] == 1){
											$overallgradecount++;
										}
										if(isset($saved_max_marks_json['overall']) && $saved_max_marks_json['overall'] == 1){
											$overallgradecount++;
										}
									if($overallgradecount > 0){
									?>
									<!--<th colspan="<?php //echo $overallgradecount; ?>" class="text-danger"><?php //echo implode(' + ', $allNames); ?></th>-->
									<th class="scholastic-area-color" style=" --scholastic-area-color: <?= htmlspecialchars($desc->scholastic_area_color, ENT_QUOTES, 'UTF-8') ?>;" colspan="<?php echo $overallgradecount; ?>" class=""><?= $desc->overall_marks_title; ?></th>
									<?php } ?>
								</tr>


								
								<tr style="vertical-align: middle;">
									<th class="main-subject-color" style="width:100px; --main-subject-color: <?= htmlspecialchars($desc->main_subject_color, ENT_QUOTES, 'UTF-8') ?>;"><?php echo $this->lang->line('main'); ?> <?php echo $this->lang->line('subject'); ?></th>
									
									<?php  foreach($post_exam_group_id as $rowDatagroup){
									$exam_type=$this->db->query("SELECT exam_group_class_batch_exams.* FROM exam_group_class_batch_exams INNER JOIN exam_group_class_batch_exam_students ON exam_group_class_batch_exam_students.exam_group_class_batch_exam_id=exam_group_class_batch_exams.id WHERE exam_group_id='".$rowDatagroup->id."' AND exam_group_class_batch_exam_students.student_id='".$stddata->student_id."'")->result();
										if($desc->max_marks_shift_left==1){
											if(isset($saved_max_marks_json[$rowDatagroup->id]) && $saved_max_marks_json[$rowDatagroup->id] == 1){
											?>
											<th class="main-subject-color" style="width:100px; --main-subject-color: <?= htmlspecialchars($desc->main_subject_color, ENT_QUOTES, 'UTF-8') ?>;"><?php echo $this->lang->line('m_m'); ?></th>
											<?php
											}
										}
										foreach($exam_type as $type){
										?>
									
									
										<th class="main-subject-color" style="width:90px; --main-subject-color: <?= htmlspecialchars($desc->main_subject_color, ENT_QUOTES, 'UTF-8') ?>;"><?=$type->exam?>  </th>
										<?php } ?>
										
										<?php
										if(isset($saved_marks_obtained_json[$rowDatagroup->id]) && $saved_marks_obtained_json[$rowDatagroup->id] == 1){
										?>
										<th class="main-subject-color" style="width:100px; --main-subject-color: <?= htmlspecialchars($desc->main_subject_color, ENT_QUOTES, 'UTF-8') ?>;"><?php echo $this->lang->line('m_o'); ?></th>
										<?php
										}
										if($desc->max_marks_shift_left==0){
											if(isset($saved_max_marks_json[$rowDatagroup->id]) && $saved_max_marks_json[$rowDatagroup->id] == 1){
											?>
											<th class="main-subject-color" style="width:100px; --main-subject-color: <?= htmlspecialchars($desc->main_subject_color, ENT_QUOTES, 'UTF-8') ?>;"><?php echo $this->lang->line('m_m'); ?></th>
											<?php
											}
										}
										if(isset($saved_json[$rowDatagroup->id]) && $saved_json[$rowDatagroup->id] == 1){
										?>
										<th class="main-subject-color" style="width:100px; --main-subject-color: <?= htmlspecialchars($desc->main_subject_color, ENT_QUOTES, 'UTF-8') ?>;"><?php echo $this->lang->line('grade'); ?></th>
									<?php 
										}
									} 
									?>
									
									
									
									
									<?php
									if($desc->max_marks_shift_left==1){
										if(isset($saved_max_marks_json['overall']) && $saved_max_marks_json['overall'] == 1){
									?>
										<th class="main-subject-color" style="width:100px; --main-subject-color: <?= htmlspecialchars($desc->main_subject_color, ENT_QUOTES, 'UTF-8') ?>;"><?php echo $this->lang->line('m_m'); ?></th>
									<?php
										}
									}
									if(isset($saved_marks_obtained_json['overall']) && $saved_marks_obtained_json['overall'] == 1){
									?>
									<th class="main-subject-color" style="width:100px; --main-subject-color: <?= htmlspecialchars($desc->main_subject_color, ENT_QUOTES, 'UTF-8') ?>;"><?php echo $this->lang->line('m_o'); ?></th>
									<?php
									}
									if($desc->max_marks_shift_left==0){
										if(isset($saved_max_marks_json['overall']) && $saved_max_marks_json['overall'] == 1){
									?>
									<th class="main-subject-color" style="width:100px; --main-subject-color: <?= htmlspecialchars($desc->main_subject_color, ENT_QUOTES, 'UTF-8') ?>;"><?php echo $this->lang->line('m_m'); ?></th>
									<?php
										}
									}
									if(isset($saved_json['overall']) && $saved_json['overall'] == 1){
									?>
									<th class="main-subject-color" style="width:100px; --main-subject-color: <?= htmlspecialchars($desc->main_subject_color, ENT_QUOTES, 'UTF-8') ?>;"><?php echo $this->lang->line('grade'); ?></th>
									<?php } ?>
								</tr>
							</thead>
							
							<tbody>
								

								<?php 
								$array1=[];
								$aadi=0;
								$finalTotal=0;
								$maxMark=[];
								$minMark=[];
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
								$is_fail = 0;
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
											<td class="subject-color" style="text-align:left;padding:5px 8px 5px 8px;font-weight: bold; --subject-color: <?= htmlspecialchars($desc->subject_color, ENT_QUOTES, 'UTF-8') ?>;" ><?=$rowdata->name?></td>
											
											<?php

											$min_marks = 0;
											foreach($post_exam_group_id as $post_exam_group){
													
													
													$total=0;
													$exam_group_id=$post_exam_group->id;
			
												
												// $exam_type=$this->db->query("SELECT * FROM exam_group_class_batch_exams WHERE exam_group_id='".$exam_group_id."'")->result();
												$exam_type=$this->db->query("SELECT exam_group_class_batch_exams.* FROM exam_group_class_batch_exams INNER JOIN exam_group_class_batch_exam_students ON exam_group_class_batch_exam_students.exam_group_class_batch_exam_id=exam_group_class_batch_exams.id WHERE exam_group_id='".$exam_group_id."' AND exam_group_class_batch_exam_students.student_id='".$stddata->student_id."'")->result();
											


												$max_marks1 = 0;
												$term_html = '';
												$term_array = [];
												foreach($exam_type as $type){
													$maxMarks=$this->db->query("SELECT max_marks, min_marks FROM exam_group_class_batch_exam_subjects WHERE exam_group_class_batch_exams_id='".$type->id."' and subject_id='".$rowdata->id."'")->result()[0];
													array_push($maxMark,$maxMarks->max_marks);
													array_push($minMark,$maxMarks->min_marks);
								
								
		$resultData=$this->db->query("SELECT exam_group_exam_results.*,exam_group_class_batch_exam_subjects.max_marks FROM exam_group_exam_results left JOIN exam_group_class_batch_exam_subjects ON exam_group_class_batch_exam_subjects.id=exam_group_exam_results.exam_group_class_batch_exam_subject_id left JOIN exam_group_class_batch_exam_students ON exam_group_class_batch_exam_students.id=exam_group_exam_results.`exam_group_class_batch_exam_student_id` WHERE exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id='".$type->id."' and exam_group_class_batch_exam_students.exam_group_class_batch_exam_id='".$type->id."' and exam_group_class_batch_exam_subjects.subject_id='".$rowdata->id."' and exam_group_class_batch_exam_students.student_id='".$stddata->student_id."'")->result()[0];

													$min_marks+=round($maxMarks->min_marks);
													$max_marks+=round($maxMarks->max_marks);
													$max_marks1+=round($maxMarks->max_marks);
												
													$marks = !empty($resultData) ? ($resultData->attendence == 'absent' ? 'AB' : round($resultData->get_marks)) : "-";
													// echo $marks;

													$total_subject++; 
													// array_push($array, !empty($resultData) ? $resultData->get_marks : 0);
													array_push($term_array, !empty($resultData) ? $resultData->get_marks : 0);
												
													$term_html .= '<td>'.$marks.'</td>';
													
												 
													$total+=$resultData->get_marks; 
												}
												$total1+=$total; 
											
											if($desc->max_marks_shift_left==1){
												if(isset($saved_max_marks_json[$exam_group_id]) && $saved_max_marks_json[$exam_group_id] == 1){
													array_push($array,$max_marks1);
												?>
												<td style="width:100px"><strong><?php echo $max_marks1; ?></strong></td>
												<?php
												}
											}
											echo $term_html;
											$array = array_merge($array,$term_array);
											if(isset($saved_marks_obtained_json[$exam_group_id]) && $saved_marks_obtained_json[$exam_group_id] == 1){
												array_push($array,$total); 
											?>
											<td style="width:100px"><?php echo $total; ?></td>
											<?php
											}
											if($desc->max_marks_shift_left==0){
												if(isset($saved_max_marks_json[$exam_group_id]) && $saved_max_marks_json[$exam_group_id] == 1){
													array_push($array,$max_marks1);
												?>
												<td style="width:100px"><strong><?php echo $max_marks1; ?></strong></td>
												<?php
												}
											}
											if(isset($saved_json[$exam_group_id]) && $saved_json[$exam_group_id] == 1){
											?>
											<td style="width:100px">
											<?php
												$t_grade = ($max_marks1 > 0) ? ($total * 100 / $max_marks1) : 0;
												$t_grade = round($t_grade);
												$gd=$this->db->query("SELECT * FROM `grades` WHERE mark_from>='$t_grade' and 	mark_upto<='$t_grade' order by mark_upto asc")->result();
												echo ($gd[0]->name);
											?>
											</td>
											
											<?php
											}
											
											if(isset($saved_json[$exam_group_id]) && $saved_json[$exam_group_id] == 1){
												$grade_array = [];
												$grade_array = [ 'type'=>'grade', 'marks'=>$max_marks1 ];
												// array_push($array,$max_marks1);
												array_push($array,$grade_array);
											} 
											} 
											?>

											<?php
											if($desc->max_marks_shift_left==1){
												if(isset($saved_max_marks_json['overall']) && $saved_max_marks_json['overall'] == 1){
												?>
												<td><strong><?=$max_marks; ?></strong></td>
												<?php
												}
											}
											if(isset($saved_marks_obtained_json['overall']) && $saved_marks_obtained_json['overall'] == 1){
											?>
											<td><strong><?=$total1; ?></strong></td>
											<?php
											}
											if($desc->max_marks_shift_left==0){
												if(isset($saved_max_marks_json['overall']) && $saved_max_marks_json['overall'] == 1){
												?>
												<td><strong><?=$max_marks; ?></strong></td>
												<?php
												}
											}
											if(isset($saved_json['overall']) && $saved_json['overall'] == 1){
											?>
											<td><strong><?php 
											
											
											
												$grade = ($max_marks > 0) ? ($total1 * 100 / $max_marks) : 0;
											
											
										 
											
											
											
											$grade = round($grade);
											$gd=$this->db->query("SELECT * FROM `grades` WHERE mark_from>='$grade' and 	mark_upto<='$grade' order by mark_upto asc")->result(); 
											//echo ($gd[0]->name);
												echo ($gd[0]->name);
											
											?></strong></td>
											<?php } 
											if($min_marks > $total1){
												$is_fail = 1;
											}
											?>	
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
											<td class="subject-color" style="text-align:left;padding:5px 8px 5px 8px;font-weight: bold; --subject-color: <?= htmlspecialchars($desc->subject_color, ENT_QUOTES, 'UTF-8') ?>;" ><?=$rowdata->name?></td>
											
											<?php

												foreach($post_exam_group_id as $post_exam_group){
													
													
													$total_op=0;
													$exam_group_id_op=$post_exam_group->id;
			
												
												// $exam_type_op=$this->db->query("SELECT * FROM exam_group_class_batch_exams WHERE exam_group_id='".$exam_group_id_op."'")->result();
												$exam_type_op=$this->db->query("SELECT exam_group_class_batch_exams.* FROM exam_group_class_batch_exams INNER JOIN exam_group_class_batch_exam_students ON exam_group_class_batch_exam_students.exam_group_class_batch_exam_id=exam_group_class_batch_exams.id WHERE exam_group_id='".$exam_group_id_op."' AND exam_group_class_batch_exam_students.student_id='".$stddata->student_id."'")->result();
											

												$max_marks1_op = 0;
												$term_html_op = '';
												foreach($exam_type_op as $type_op){
													
													$maxMarks_op=$this->db->query("SELECT max_marks FROM exam_group_class_batch_exam_subjects WHERE exam_group_class_batch_exams_id='".$type_op->id."' and subject_id='".$rowdata->id."'")->result()[0];
													
													array_push($maxMark_op,$maxMarks_op->max_marks);
								
								
		$resultData_op=$this->db->query("SELECT exam_group_exam_results.*,exam_group_class_batch_exam_subjects.max_marks FROM exam_group_exam_results left JOIN exam_group_class_batch_exam_subjects ON exam_group_class_batch_exam_subjects.id=exam_group_exam_results.exam_group_class_batch_exam_subject_id left JOIN exam_group_class_batch_exam_students ON exam_group_class_batch_exam_students.id=exam_group_exam_results.`exam_group_class_batch_exam_student_id` WHERE exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id='".$type_op->id."' and exam_group_class_batch_exam_students.exam_group_class_batch_exam_id='".$type_op->id."' and exam_group_class_batch_exam_subjects.subject_id='".$rowdata->id."' and exam_group_class_batch_exam_students.student_id='".$stddata->student_id."'")->result()[0];		

													$max_marks_op+=round($maxMarks_op->max_marks);
													$max_marks1_op+=round($maxMarks_op->max_marks);
												?>
													
														<?php 
															$marks_op = !empty($resultData_op) ? ($resultData_op->attendence == 'absent' ? 'AB' : round($resultData_op->get_marks)) : "-";
															// echo $marks_op;

															$total_subject_op++; 
															array_push($array_op, !empty($resultData_op) ? $resultData_op->get_marks : 0);
												
													$term_html_op .= '<td>'.$marks_op.'</td>';
													
												
														$total_op+=$resultData_op->get_marks; 
													} 
													$total1_op+=$total_op; 
													
												?>
											
											<?php
											if($desc->max_marks_shift_left==1){
												if(isset($saved_max_marks_json[$exam_group_id_op]) && $saved_max_marks_json[$exam_group_id_op] == 1){
												?>
												<td style="width:100px"><strong><?php echo $max_marks1_op; ?></strong></td>
												<?php
												}
											}
											echo $term_html_op;
											if(isset($saved_marks_obtained_json[$exam_group_id_op]) && $saved_marks_obtained_json[$exam_group_id_op] == 1){
											?>
											<td style="width:100px"><?php echo $total_op; ?></td>
											<?php
											}
											if($desc->max_marks_shift_left==0){
												if(isset($saved_max_marks_json[$exam_group_id_op]) && $saved_max_marks_json[$exam_group_id_op] == 1){
												?>
												<td style="width:100px"><?php echo $max_marks1_op; ?></td>
												<?php
												}
											}
											if(isset($saved_json[$exam_group_id_op]) && $saved_json[$exam_group_id_op] == 1){
											?>
											<td style="width:100px">
											<?php
												$t_grade_op = ($max_marks1_op > 0) ? ($total_op * 100 / $max_marks1_op) : 0;
												$t_grade_op = round($t_grade_op);
												$gd_op=$this->db->query("SELECT * FROM `grades` WHERE mark_from>='$t_grade_op' and 	mark_upto<='$t_grade_op' order by mark_upto asc")->result();
												echo ($gd_op[0]->name);
											?>
											</td>
											
											<?php } array_push($array_op,$total_op); } ?>

											<?php
											if($desc->max_marks_shift_left==1){
												if(isset($saved_max_marks_json['overall']) && $saved_max_marks_json['overall'] == 1){
												?>
												<td><strong><?=$max_marks_op; ?></strong></td>
												<?php
												}
											}
											if(isset($saved_marks_obtained_json['overall']) && $saved_marks_obtained_json['overall'] == 1){
											?>
											<td><strong><?=$total1_op; ?></strong></td>
											<?php
											}
											if($desc->max_marks_shift_left==0){
												if(isset($saved_max_marks_json['overall']) && $saved_max_marks_json['overall'] == 1){
												?>
												<td><strong><?=$max_marks_op; ?></strong></td>
												<?php
												}
											}
											if(isset($saved_json['overall']) && $saved_json['overall'] == 1){
											?>
											<td><strong><?php 
											
											
											
												$grade_op = ($max_marks_op > 0) ? ($total1_op * 100 / $max_marks_op) : 0;
											
											
										 
											
											
											$grade_op = round($grade_op);
											$gd_op=$this->db->query("SELECT * FROM `grades` WHERE mark_from>='$grade_op' and 	mark_upto<='$grade_op' order by mark_upto asc")->result(); 
											
											//echo ($gd[0]->name);
												echo ($gd_op[0]->name);
											
											?></strong></td>
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
										$percentage = round($percentage);
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
										<th class="" style="text-align:left;padding:5px 8px 5px 8px;"><?php echo $this->lang->line('total'); ?></th>
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
										
										<?php
										if($desc->max_marks_shift_left==1){
											if(isset($saved_max_marks_json['overall']) && $saved_max_marks_json['overall'] == 1){
											?>
											<td><strong><?php echo array_sum($maxMark); ?></strong></td>
											<?php
											}
										}
										if(isset($saved_marks_obtained_json['overall']) && $saved_marks_obtained_json['overall'] == 1){
										?>
										<td><?php echo $finalTotal; ?></td>
										<?php
										}
										if($desc->max_marks_shift_left==0){
											if(isset($saved_max_marks_json['overall']) && $saved_max_marks_json['overall'] == 1){
											?>
											<td><strong><?php echo array_sum($maxMark); ?></strong></td>
											<?php
											}
										}
										if(isset($saved_json['overall']) && $saved_json['overall'] == 1){
										?>
										<td> 
										<?php
											
											// $grade=$finalTotal*100/array_sum($maxMark); 
											
											$totalMaxMarks = array_sum($maxMark);
											$grade = ($totalMaxMarks > 0) ? ($finalTotal * 100 / $totalMaxMarks) : 0;
									
									
									
									
									
									$grade = round($grade);
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
											<th style="padding: 5px 8px !important;"  colspan="<?=$final_column_count; ?>"><?php echo $this->lang->line('optional'); ?> <?php echo $this->lang->line('subject'); ?></th>
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
			
			
			
		
			
			
			
			
			
			
			
			<div class="col-8" style="padding: 0;">
				<strong>Note :</strong> 'AB' Indicates <strong>ABSENT</strong> in the Subject Exam.
			</div>	
			<!--<div class="col-8" style="padding: 0;">
				Note : <strong>'AB'</strong> Indicates <strong>ABSENT</strong> & <strong>'ML'</strong> Indicates <strong>Medical Leave</strong> in the Subject Exam.
			</div>-->
			<div class="col-4 text-end" style="padding: 0;"><strong style="font-size: 18px;">
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
				$list=$this->examgroup_model->getExamByExamGroup_reportCard_c($value->id,$student_id);
				if(count($list) > 0){
			?>
			<div class="col-6 mt-3" style="padding:0px">
				<table class="w-100 border-dark text-center table-bordered">
					<tr class="text-start">
						<th colspan="2" style="padding-left:8px; padding-top:7px;padding-bottom:7px;"><span class="" style="color:#000;"><?=$value->name ?>: <span style="color:#000;"><?=$value->description ?></span></span>
						</th>
					</tr>
					<tr>	
						<th style="text-align: left !important;padding:5px 8px 5px 8px;"><em style="">Activities</em></th>
						<?php /*$z=1; for ($i=0; $i < count($tearm_count); $i++) { 
							echo '<th>G'.$z++.'</th>';
						}*/ ?>
						<th style="padding-top:7px;padding-bottom:7px;"><?php echo $this->lang->line('grade'); ?></th>
						
						
					</tr>
					<?php					
					foreach($list as $res){ 
					?>
					<tr>
						<th class="" style="text-align: left !important;padding:5px 8px 5px 8px;">
							<?=$res->exam; ?>
						</th>
						<td style="padding:5px 8px 5px 8px;"><?=$res->get_marks; ?></td>
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

				<?php }
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
					<div class="col-12 mb-3 d-flex">
						<?php 
							$exam_pass_status = 1;
							if ($finalTotal < array_sum($minMark)) {
								$exam_pass_status = 0;
							}
						?>
						<strong>
						<?php echo $this->lang->line('result') ?> : 	
						</strong>			
						<?php 
						if($is_fail){
						?>
						<span class="text-underline" style="width:420px; text-align:center;">&nbsp;</span>
						<?php
						}else{
						?>
						<span class="text-underline" style="width:420px;">
						<?php
							echo $exam_pass_status ? $this->lang->line('pass') : $this->lang->line('fail'); ?> <?php echo $this->lang->line('with'); ?> <?php echo $exam_pass_status ? '('.get_division_by_percentage($totalNumber).' '.$this->lang->line('division').')' : ''; 
						?>
						</span>
						<?php
						}
						?>
					</div>			
					<div class="col-12 mb-3 d-flex">				
						<?php if($exam_pass_status){
							if($is_fail){
						?>		
								<strong><?php echo $this->lang->line('promoted_to_class'); ?> :</strong> <span class="text-underline" style="width:330px; text-align:center;">&nbsp;</span>
						<?php		
							}else{
						?>		
								<strong><?php echo $this->lang->line('promoted_to'); ?> :</strong> <span class="text-underline" style="width:370px;"><?php echo $this->lang->line('next_class'); ?></span>
						<?php		
							}
						}else{
						?>
						<strong><?php echo $this->lang->line('promoted_to_class'); ?> :</strong> <span class="text-underline" style="width:330px; text-align:center;">&nbsp;</span>
						<?php } ?>
					</div>
					<div class="col-12 mb-3 d-flex">
						<strong><?php echo $this->lang->line('remarks'); ?></strong>
						<strong class="ml-5px">:</strong> 
						<span class="text-underline" style="width:400px;">
							<?php echo !empty($gd[0]->description) ? $gd[0]->description : '&nbsp;'; ?>
						</span>
					</div>
					<?php
					if($desc->school_reopen==1){
					?>
					<div class="col-12 mb-3 d-flex">
						<strong><?php echo $this->lang->line('school_will_reopen_on'); ?></strong>
						<strong class="ml-5px">:</strong>
						<span class="text-underline" style="width:150px; text-align:center;">
							<?php echo $desc->school_reopen_date != '' ? $desc->school_reopen_date : '&nbsp;'; ?>
						</span>
						<span class="ml-5px"><?php echo $this->lang->line('at'); ?></span>
						<span class="text-underline" style="width:124px; text-align:center;">
							<?php echo $desc->school_reopen_time != '' ? $desc->school_reopen_time : '&nbsp;'; ?>
						</span>
					</div>
					<?php
					}					
					if($desc->place==1){
					?>
					<div class="col-12 mb-3 d-flex">
						<strong><?php echo $this->lang->line('place'); ?> :</strong> <span class="text-underline" style="width:300px; text-align:center;">&nbsp;</span>
					</div>
					<?php
					}
					if($desc->is_show_date==1){
					?>
					<div class="col-12 d-flex">
						<strong><?php echo $this->lang->line('date'); ?> :</strong> <span class="text-underline" style="width:300px; text-align:center;">&nbsp;</span>
					</div>
					<?php
					}
					?>
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
				<div class="row text-center" style="background-color: #000000">
					<div class="col-4">
						<?php
						if($desc->is_class_teacher==1){
							if($desc->left_sign!='' || $desc->left_sign!=null){
							$is_left_sign_file_path = FCPATH . 'uploads/reportcard/' . $desc->left_sign;
								if (file_exists($is_left_sign_file_path)) {						
							?>
							<img src="<?php echo base_url('uploads/reportcard/'.$desc->left_sign) ?>" style="height:90px;width:auto;margin-top: 5px;">
							<?php
								}else{
									echo '<div style="height:90px;width:auto;margin-top: 5px;"></div>';
								}
							}else{
								echo '<div style="height:90px;width:auto;margin-top: 5px;"></div>';
							}
							echo '<h6 class="mt-1">'.$desc->left_sign_title.'</h6>';
						} 
						?>						
					</div>
					<div class="col-4">
						<?php
						if($desc->is_examination_ic==1){
							if($desc->middle_sign!='' || $desc->middle_sign!=null){
							$is_middle_sign_file_path = FCPATH . 'uploads/reportcard/' . $desc->middle_sign;
								if (file_exists($is_middle_sign_file_path)) {						
							?>
							<img src="<?php echo base_url('uploads/reportcard/'.$desc->middle_sign) ?>" style="height:90px;width:auto;margin-top: 5px;">
							<?php
								}else{
									echo '<div style="height:90px;width:auto;margin-top: 5px;"></div>';
								}
							}else{
								echo '<div style="height:90px;width:auto;margin-top: 5px;"></div>';
							}
							echo '<h6 class="mt-1">'.$desc->middle_sign_title.'</h6>';
						}
						?>
					</div>
					<div class="col-4">
						<?php
						if($desc->is_principal==1){
							if($desc->right_sign!='' || $desc->right_sign!=null){
							$is_right_sign_file_path = FCPATH . 'uploads/reportcard/' . $desc->right_sign;
								if (file_exists($is_right_sign_file_path)) {						
							?>
							<img src="<?php echo base_url('uploads/reportcard/'.$desc->right_sign) ?>" style="height:90px;width:auto;margin-top: 5px;">
							<?php
								}else{
									echo '<div style="height:90px;width:auto;margin-top: 5px;"></div>';
								}
							}else{
								echo '<div style="height:90px;width:auto;margin-top: 5px;"></div>';
							}
							echo '<h6 class="mt-1">'.$desc->right_sign_title.'</h6>';
						}
						?>						
					</div>
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



	<?php 
	if($desc->is_header==0){
	?>
		<div class="" style="height:<?php echo $desc->footer_height; ?>px;"></div>
	<?php
		}
	?>	
			<?php }
			} ?>

  </body>
</html>