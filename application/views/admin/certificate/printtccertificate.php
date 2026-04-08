<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Receipt</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.pagebreak { page-break-before: always; } 
.mark-container{
    width:1000px;
    position:relative;
    z-index:2;
    margin:0 auto;
    /*padding:10px 30px;*/
}

.maincontent{
    position:relative;
    z-index:2;
}

/* Prevent breaking between pages */
.print-block{
    page-break-inside: avoid;
    break-inside: avoid;
}

.slip{
    /*border:1px solid #000;*/
	padding: 15px;
    page-break-inside: avoid;
    break-inside: avoid;
}

.header{
    border-bottom:2px solid #000;
}

.tcmybg {
   background:top center;
	background-size: 100% 100%;
	position: absolute;
	top: 0;
	left: 0;
	bottom: 0;
	z-index: 1;
}
.text-underline {
	border-bottom: 1px solid #000;
	margin-left: 5px;
	width: 100%;
	font-style: italic;
}
.label-text {
	white-space: nowrap
}

</style>

</head>
<body>
<?php
//$this->load->model('designtc_model');
//echo "<pre>";print_r($certificate);die;
foreach ($students as $s=>$student) {
	$student_name = '';
	if(isset($student->firstname))
	{
		$student_name = $student->firstname;
	}
	
	if(isset($student->middlename))
	{
		$student_name .= $student->middlename;
	}
	if(isset($student->lastname))
	{
		$student_name .= $student->lastname;
	}
	
	$replaceArr = [
        '[roll_no]'  => $student->roll_no,
        '[name]' => $student_name,
        '[class]'  => $student->class,
        '[section]'  => $student->section,
        '[Student Pen No]'  => $student->pan_no,
        '[Student Adhar No]'  => $student->aadhan_no,
        '[father_name]'  => $student->father_name,
        '[Father PAN No]'  => $student->father_pan_no,
        '[Father Adhar No]'  => $student->father_aadhar_no,
        '[mother_name]'  => $student->mother_name,
        '[Mother PAN No]'  => $student->mother_pan_no,
        '[Mother Adhar No]'  => $student->mother_aadhar_no,
        '[dob]' => date('d/m/Y' , strtotime($student->dob)),
		'[admission_date]'  => date('d/m/Y' , strtotime($student->admission_date)),
        '[gender]'  => $student->gender,
        '[category]'  => $student->category,
        '[phone]'  => $student->mobileno,
        '[CASTE CATEGORY]'  => $student->cast_category,
		'[present_address]' => $student->current_address,
		'[guardian]' => $student->guardian_name,
		'[created_at]' => date('d/m/Y' , strtotime($student->created_at)),
        '[admission_no]'  => $student->admission_no,
        '[cast]'  => $student->cast,
        '[religion]'  => $student->religion,
        '[email]'  => $student->email,
        '[PAN Card]'  => $student->cast
    ];
	
	$check_student_id = $this->designtc_model->check_student_id($student->id);
	if($check_student_id)
	{
		$max_serial_no = $this->designtc_model->get_max_serial_no();
		if($max_serial_no > 0){
			$sl_no = $max_serial_no+1;
		}else{
			$sl_no = $result->serial_no_suffix;
		}
		$data = [
			'session_id' => $certificate->session_id,
			'serial_no'  => $sl_no,
			'student_id' => $student->id,
			'template_id' => $certificate->id,
			'created_date' => date('Y-m-d h:i:s')
		];
		$i_id = $this->designtc_model->addCertificateGenerate($data);
	}else{
		$check_certificate = $this->designtc_model->get_certificate($student->id);
		$sl_no = $check_certificate['serial_no'];
	}
	
	?>
	<?php if ($s > 0): ?>
		<div class="pagebreak"></div>
	<?php endif; ?>
	<?php 
	if($certificate->is_common_header==0){
	?>
		<div class="" style="height:<?php echo $certificate->header_height; ?>px;"></div>
	<?php
		}
	?>
	<div class="mark-container mb-5">
		<?php
			if ($certificate->background_image != "") {
		?>
			<img src="<?php echo base_url('uploads/transfer_certificate/' . $certificate->background_image); ?>" class="tcmybg" width="100%" height="100%" />
		<?php
			}
		?>
		<div class="row maincontent">
			<div class="col-sm-12 print-block">
				<div class="slip">
					<!-- HEADER IMAGE -->
					<?php 
					if($certificate->is_common_header==1){
					if(!empty($header_image)){
					$is_header_file_path = FCPATH . 'uploads/print_headerfooter/common_header/' . $header_image;
					if (file_exists($is_header_file_path)) {
					?>
					<div class="header">
						<img src="<?php echo base_url(); ?>/uploads/print_headerfooter/common_header/<?php echo $header_image; ?>" style="height:100px;width:100%">
					</div>
					<?php } } } ?>
					
					<div class="content">
						
						<?php
							if ($certificate->certificate_name != "") {
								$fields_json = json_decode($certificate->fields_json);
								//echo "<pre>";print_r($fields_json);
						?>
							<h4 class="text-center mt-3" style="font-size: 20px;">
								<strong><?php echo $certificate->certificate_name; ?></strong> <?php //echo $fields_json[0]->title; ?>
							</h4>
						<?php
							}
						?>
						<div class="row mt-5">
						<div class="col-4 mb-3 d-flex mt-2">	
							<strong class="label-text">Book No :</strong>
							<span class="text-underline" style="text-align:center;"><?php echo $result->book_no; ?></span>
						</div>
						<div class="col-4 mb-3 d-flex mt-2">	
							<strong class="label-text">SR No :</strong>
							<span class="text-underline" style="text-align:center;"><?php echo $result->serial_no_prefix.$sl_no; ?></span>
						</div>
						<div class="col-4 mb-3 d-flex mt-2">	
							<strong class="label-text">Admission No :</strong>
							<span class="text-underline" style="text-align:center;"><?php echo $student->admission_no; ?></span>
						</div>
						<?php 
						$i=0;
						foreach($fields_json as $val)
						{
							$value = str_replace(
								array_keys($replaceArr),
								array_values($replaceArr),
								$val->value
							);
							$i++;
						?>
							<div class="col-12 mb-3 d-flex mt-2">	
								<strong class="label-text"><?php echo $i ?>. <?php echo $val->title ?> :</strong>
								<span class="text-underline" style="text-align:center;"><?php echo $value; ?></span>
							</div>
						<?php 
						}
						?>
						</div>
						<?php
						$sign_count = 0;
						if($certificate->is_class_teacher==1){ $sign_count++; }
						if($certificate->is_examination_ic==1){ $sign_count++; }
						if($certificate->is_principal==1){ $sign_count++; }
						if($sign_count > 0){
						?>
						<div class="col-12 mt-3" style="padding-left:0px;padding-right:0px;padding-bottom:0px;">
							<div class="row text-center" style="background-color: transparent">
								<div class="col-4">
									<?php
									if($certificate->is_class_teacher==1){
										if($certificate->left_sign!='' || $certificate->left_sign!=null){
										$is_left_sign_file_path = FCPATH . 'uploads/transfer_certificate/' . $certificate->left_sign;
											if (file_exists($is_left_sign_file_path)) {						
										?>
										<img src="<?php echo base_url('uploads/transfer_certificate/'.$certificate->left_sign) ?>" style="height:90px;width:auto;margin-top: 5px;">
										<?php
											}else{
												echo '<div style="height:90px;width:auto;margin-top: 5px;"></div>';
											}
										}else{
											echo '<div style="height:90px;width:auto;margin-top: 5px;"></div>';
										}
										echo '<h6 class="mt-1">'.$certificate->left_sign_title.'</h6>';
									} 
									?>						
								</div>
								<div class="col-4">
									<?php
									if($certificate->is_examination_ic==1){
										if($certificate->middle_sign!='' || $certificate->middle_sign!=null){
										$is_middle_sign_file_path = FCPATH . 'uploads/transfer_certificate/' . $certificate->middle_sign;
											if (file_exists($is_middle_sign_file_path)) {						
										?>
										<img src="<?php echo base_url('uploads/transfer_certificate/'.$certificate->middle_sign) ?>" style="height:90px;width:auto;margin-top: 5px;">
										<?php
											}else{
												echo '<div style="height:90px;width:auto;margin-top: 5px;"></div>';
											}
										}else{
											echo '<div style="height:90px;width:auto;margin-top: 5px;"></div>';
										}
										echo '<h6 class="mt-1">'.$certificate->middle_sign_title.'</h6>';
									}
									?>
								</div>
								<div class="col-4">
									<?php
									if($certificate->is_principal==1){
										if($certificate->right_sign!='' || $certificate->right_sign!=null){
										$is_right_sign_file_path = FCPATH . 'uploads/transfer_certificate/' . $certificate->right_sign;
											if (file_exists($is_right_sign_file_path)) {						
										?>
										<img src="<?php echo base_url('uploads/transfer_certificate/'.$certificate->right_sign) ?>" style="height:90px;width:auto;margin-top: 5px;">
										<?php
											}else{
												echo '<div style="height:90px;width:auto;margin-top: 5px;"></div>';
											}
										}else{
											echo '<div style="height:90px;width:auto;margin-top: 5px;"></div>';
										}
										echo '<h6 class="mt-1">'.$certificate->right_sign_title.'</h6>';
									}
									?>						
								</div>
							</div>
							
						</div>
						<?php
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php 
	if($certificate->is_common_header==0){
	?>
		<div class="" style="height:<?php echo $certificate->footer_height; ?>px;"></div>
	<?php
		}
	?>
<?php } ?>
</body>
</html>