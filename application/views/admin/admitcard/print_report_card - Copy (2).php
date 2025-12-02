<?php

	$desc=$reportcard;
	// echo '<pre>'; print_r($desc);exit;
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
  
</style>

	
  </head>
  <body>

<?php 





	$exam_group_class_batch_exam_student_id=$_POST['exam_group_class_batch_exam_student_id'];




	foreach($marksheet as $stddata){
	
			if(in_array($stddata->student_id, $exam_group_class_batch_exam_student_id)){
			$student_id=$stddata->student_id;
?>

	<div class="container mb-5">
		<div class="row">
			<div class="col-12 bg-danger"style="height:0px"></div>
			<?php if($desc->is_header==1){ ?>
			<div class="col-12">
				<img src="<?php echo base_url('uploads/reportcard/'.$desc->header_img) ?>" style="height:150px;width:100%">
			</div>
			<?php } ?>
			<?php if(!empty($desc->title)){ ?>
			<div class="col-12 text-center">
				<p class="text-danger h3"><?php echo $desc->title; ?></p>
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
							
							<thead style="background:#fff">
								
								<tr>
									<th class="text-success">Scholastic Area</th>
									<?php 
									$allNames = [];
									
									foreach($post_exam_group_id as $rowDatagroup){
									$exam_type=$this->db->query("SELECT * FROM exam_group_class_batch_exams WHERE exam_group_id='".$rowDatagroup->id."'")->result();
									$allNames[] = $rowDatagroup->name;
										?>
									<th colspan="<?=count($exam_type)+1?>" class="text-danger"><?=$rowDatagroup->name?></th>
									<?php } ?>
									
									<th colspan="2" class="text-danger"><?= implode(' + ', $allNames); ?></th>
								</tr>


								
								<tr style="vertical-align: middle;">
									<th style="width:100px">Subject</th>
									
									<?php  foreach($post_exam_group_id as $rowDatagroup){
									$exam_type=$this->db->query("SELECT * FROM exam_group_class_batch_exams WHERE exam_group_id='".$rowDatagroup->id."'")->result();
										foreach($exam_type as $type){
										?>
									
									
									<th style="width:90px"><?=$type->exam?> </th>
										<?php } ?>
										
										<th style="width:100px">Mark Obt</th>
									
									
									
									<?php } ?>
									
									
									
									
									<th style="width:100px">G. Total</th>
									<th style="width:100px">Overall Grade</th>
								</tr>
							</thead>
							
							<tbody>
								

								<?php 
								$array1=[];
								$aadi=0;
								$finalTotal=0;
								$maxMark=[];
								
								 $sql="SELECT exam_group_class_batch_exam_subjects.subject_id FROM exam_group_class_batch_exam_subjects INNER JOIN exam_group_class_batch_exams ON exam_group_class_batch_exams.id=exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id  INNER JOIN exam_groups ON exam_groups.id=exam_group_class_batch_exams.exam_group_id INNER JOIN exam_group_class_batch_exam_students ON exam_group_class_batch_exam_students.exam_group_class_batch_exam_id=exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id WHERE exam_group_class_batch_exam_students.student_id='". $stddata->student_id ."' and exam_groups.id  IN ('".implode("','",$postExamGroupId)."') ";
								
								
								
								$query = $this->db->query($sql);
								$subject= $query->result();
								

								$abc=[];
								foreach($subject as $rowdata){ 
									array_push($abc,$rowdata->subject_id);
								}
								
								$subject_id_data=array_unique($abc);
								
								$max_marks=0;
								$total_subject=0;
								
								for($i=0;$i<count($subject_id_data);$i++){
								
									$sql1="SELECT * FROM subjects WHERE id='".$subject_id_data[$i]."' ";
									$query1 = $this->db->query($sql1);
									$rowdata= $query1->result()[0];
									$max_marks1=0;
									$total1=0;
									$array=[];
								?>
							
								<tr>
									<td style="text-align:left;padding-left:8px" ><?=$rowdata->name?></td>
									
									<?php

										foreach($post_exam_group_id as $post_exam_group){
											
											
											$total=0;
											$exam_group_id=$post_exam_group->id;
	
										
										$exam_type=$this->db->query("SELECT * FROM exam_group_class_batch_exams WHERE exam_group_id='".$exam_group_id."'")->result();
									


										foreach($exam_type as $type){
											
											$maxMarks=$this->db->query("SELECT max_marks FROM exam_group_class_batch_exam_subjects WHERE exam_group_class_batch_exams_id='".$type->id."' and subject_id='".$rowdata->id."'")->result()[0];
											
												array_push($maxMark,$maxMarks->max_marks);
						
						
$resultData=$this->db->query("SELECT exam_group_exam_results.*,exam_group_class_batch_exam_subjects.max_marks FROM exam_group_exam_results left JOIN exam_group_class_batch_exam_subjects ON exam_group_class_batch_exam_subjects.id=exam_group_exam_results.exam_group_class_batch_exam_subject_id left JOIN exam_group_class_batch_exam_students ON exam_group_class_batch_exam_students.id=exam_group_exam_results.`exam_group_class_batch_exam_student_id` WHERE exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id='".$type->id."' and exam_group_class_batch_exam_students.exam_group_class_batch_exam_id='".$type->id."' and exam_group_class_batch_exam_subjects.subject_id='".$rowdata->id."' and exam_group_class_batch_exam_students.student_id='".$stddata->student_id."'")->result()[0];		

											 $max_marks+=round($maxMarks->max_marks);
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
									
									<?php array_push($array,$total); } ?>

									<td><?=$total1.'/<b>'.$max_marks.'</b>'?> <?php //echo $max_marks; ?> </td>
									<td><?php 
									
									
									
										$grade = ($max_marks > 0) ? ($total1 * 100 / $max_marks) : 0;
									
									
								 
									
									
									
									$gd=$this->db->query("SELECT * FROM `grades` WHERE mark_from>='$grade' and 	mark_upto<='$grade' order by mark_upto asc")->result(); 
									
									//echo ($gd[0]->name);
										echo ($gd[0]->name);
									
									?></td>
										
								</tr>
								
								<?php
									$max_marks=0;
									$finalTotal+=$total1;
									array_push($array1,$array);	
								}

								?>
								
								
							</tbody>
							
							<?php
							
								$final = array();
								array_walk_recursive($array1, function($item, $key) use (&$final){
									$final[$key] = isset($final[$key]) ?  $item + $final[$key] : $item;
								});
								
							?>
							
							<tfoot>
									<tr style="font-weight:bold">
										<th style="text-align:left;padding-left:8px">Total : </th>
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
										
										<td><?php echo $finalTotal.'/'.array_sum($maxMark); ?></td>
										
										<td> 
										<?php
											
											$grade=$finalTotal*100/array_sum($maxMark); 
									
									
									
									
									
									
									$gd=$this->db->query("SELECT * FROM `grades` WHERE mark_from>='$grade' and 	mark_upto<='$grade' order by mark_upto asc")->result(); 
									echo ($gd[0]->name);
									
									
										
										?>
										
										</td>
										
									</tr>
									
									<tr style="text-align: left !important;">
										<th style="padding-left: 15px !important;"  colspan="<?=sizeof($final)+3?>">Overall Percentage(%) :  <?php echo $totalNumber=round($finalTotal*100/array_sum($maxMark),2); ?>% </th>
									</tr>
									
							</tfoot>
							
						</table>
						

					</div>
					
					
				</div>
			</div>
			
			
			
		
			
			
			
			
			
			
			
			
			<div class="col-12" >
				Note : 'AB' Indicates <strong>ABSENT</strong> in the Subject Exam.

				<?php


						$tearm_count=($_POST['exam_group_id']); 

				?>
			</div>
			
			<?php $examgroup_result = $this->examgroup_model->get_c(); foreach ($examgroup_result as $key => $value) {	
							
				?>

			<div class="col-<?=12/count($examgroup_result)?>" style="padding:0px">
				<table class="w-100 border-dark text-center table-bordered">
					<tr class="text-center">
						<th colspan="3"><h5 class="text-danger"><?=$value->name ?></h5>
							<h6>(3 Point Grading Scale A,B,C)</h6>
						</th>
					</tr>
					<tr style="background:#fff"	>	
						<th style="text-align: left !important;padding-left: 15px !important;"><em style="color:#C00;">Activities</em></th>
						<?php $z=1; for ($i=0; $i < count($tearm_count); $i++) { 
							echo '<th>G'.$z++.'</th>';
						} ?>
						
						
					</tr>
					<?php  
					
					
					
					//var_dump($student_id);
					
					$list=$this->examgroup_model->getExamByExamGroup_reportCard($value->id,$student_id); 




					foreach($list as $res){ 


						?>

					<tr>
						<th style="text-align: left !important;padding-left: 15px !important;">
							<?=$res->exam; ?>
						</th>
							<?php 
								$z=1; for ($i=0; $i < count($tearm_count); $i++) {
									 $term_id=$tearm_count[$i];

								// echo $res->id.','.$term_id.','.$student_id;		

							$grade=$this->batchsubject_model->getExamSubjectsPrintReport($res->id,$term_id,$student_id);
							

							echo '<td>'.$grade[0]->grade.'</td>';
							// echo '<td>6</td>';

						} ?>
					</tr>
					
				<?php } ?>
				</table>
			</div>

				<?php
			} ?>



			
			
			
			<div class="col-12 mt-3" style="padding-left:0px;padding-right:0px;padding-bottom:0px">
				<table class="w-100 table-bordered border-dark " style="padding-bottom:0px">
					<tr>
						<th style="width:200px;background:#fff">Result</th>
						<!--<th style="width:200px"></th>-->
						<th style="width:800px"></th>
					</tr>
				</table>
			</div>
			
			
			<div class="col-12 mt-3" style="padding-left:0px;padding-right:0px;padding-bottom:0px;border:1px solid">
				<div class="row text-center">
					<div class="col-4">
						
						<h6 class="mt-5">CLASS TEACHER </h6>
						
					</div>                   
					
					<div class="col-4">
						
						<h6 class="mt-5">EXAMINATION I/C </h6>
						
					</div>
					
					<div class="col-4">
						
						<h6 class="mt-5">PRINCIPAL</h6>
						
					</div>
				</div>
				
			</div>
		</div>
	</div>


<div class="pagebreak"></div>


			<?php }
			} ?>

  </body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
	
	$( document ).ready(function() {
   
	// window.print();
   
});

</script>