<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Certificate</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
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
.cert-title {
    font-size: 22px;
    font-weight: 700;
    text-align: center;
    letter-spacing: 1px;
    text-decoration: underline;
    text-underline-offset: 4px;
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
$certificate = $certificate[0];
foreach ($students as $student) {
	$student_name = '';
    if (isset($student->firstname))  $student_name  = $student->firstname;
    if (isset($student->middlename)) $student_name .= ' ' . $student->middlename;
    if (isset($student->lastname))   $student_name .= ' ' . $student->lastname;

    $replaceArr = [
        '[roll_no]'          => $student->roll_no,
        '[name]'             => trim($student_name),
        '[class]'            => $student->class,
        '[section]'          => $student->section,
        '[Student Pen No]'   => $student->pan_no,
        '[Student Adhar No]' => $student->aadhan_no,
        '[father_name]'      => $student->father_name,
        '[Father PAN No]'    => $student->father_pan_no,
        '[Father Adhar No]'  => $student->father_aadhar_no,
        '[mother_name]'      => $student->mother_name,
        '[Mother PAN No]'    => $student->mother_pan_no,
        '[Mother Adhar No]'  => $student->mother_aadhar_no,
        '[dob]'              => date('d/m/Y', strtotime($student->dob)),
        '[admission_date]'   => date('d/m/Y', strtotime($student->admission_date)),
        '[gender]'           => $student->gender,
        '[category]'         => $student->category,
        '[phone]'            => $student->mobileno,
        '[CASTE CATEGORY]'   => $student->cast_category,
        '[present_address]'  => $student->current_address,
        '[guardian]'         => $student->guardian_name,
        '[created_at]'       => date('d/m/Y', strtotime($student->created_at)),
        '[admission_no]'     => $student->admission_no,
        '[cast]'             => $student->cast,
        '[religion]'         => $student->religion,
        '[email]'            => $student->email,
        '[PAN Card]'         => $student->cast,
    ];
	
	$check_student_id = $this->Generatecertificate_model->check_student_id($student->id);
	if($check_student_id)
	{
		$data = [
			'session_id' => $certificate->session_id,
			'student_id' => $student->id,
			'template_id' => $certificate->id,
			'created_date' => date('Y-m-d h:i:s')
		];
		$i_id = $this->Generatecertificate_model->addCertificateGenerate($data);
	}
	
	?>
	<?php 
	if ($certificate->is_active_header_img == 0){
	if($certificate->header_height!=0){
	?>
		<div class="" style="height:<?php echo $certificate->header_height; ?>px;"></div>
	<?php
		}
		}
	?>
	<div class="mark-container mb-5">
		<?php
			if ($certificate->background_image != "") {
		?>
			<img src="<?php echo base_url('uploads/certificate/' . $certificate->background_image); ?>" class="tcmybg" width="100%" height="100%" />
		<?php
			}
		?>
		<div class="row maincontent">
			<div class="col-sm-12 print-block">
				<div class="slip">
					<!-- HEADER IMAGE -->
					<div class="header">
						<?php
						if ($certificate->is_active_header_img == 1 && !empty($header_image)){
							$is_header_file_path = FCPATH . 'uploads/print_headerfooter/common_header/' . $header_image;
						if (file_exists($is_header_file_path)){
						?>
						<img src="<?php echo base_url(); ?>/uploads/print_headerfooter/common_header/<?php echo $header_image; ?>" style="height:auto;width:100%">
						<?php } } ?>
					</div>
					
					<div class="content">
						<div class="row mt-3">
							<div class="col-3" >
								<?php if ($certificate->left_header != '') { ?>
									<strong><?php echo $certificate->left_header; ?></strong>
								<?php } ?>
							</div>
							<div class="col-6 text-center" >
								<?php if ($certificate->center_header != '') { ?>
									<h4 class="cert-title"><?php echo $certificate->center_header; ?></h4>
								<?php } ?>
							</div>
							<div class="col-3" >
								<?php if ($certificate->right_header != '') { ?>
									<strong><?php echo $certificate->right_header; ?></strong>
								<?php } ?>
							</div>
						</div>
						<div class="row">
							<div class="col-12 text-end" >
								<?php if ($certificate->enable_student_image == 1) { ?>
									<img src="<?php echo base_url().$student->image; ?>" width="auto" height="<?php echo $certificate->enable_image_height ?>">
								<?php } ?>
							</div>
						</div>
						<div class="row mt-5">
							<div class="col-12" >
								<?php
								$fields = $certificate->certificate_text;
								$value = str_replace(
									array_keys($replaceArr),
									array_values($replaceArr),
									$fields
								);
								echo $value; ?>
							</div>
						</div>
						<div class="row">
							<div class="col-12 mt-3" style="padding-left:0px;padding-right:0px;padding-bottom:0px;">
								<div class="row text-center" style="background-color: transparent">
									<div class="col-4">
										<?php
										if($certificate->is_left_footer==1){
											if($certificate->left_sign!='' || $certificate->left_sign!=null){
											$is_left_sign_file_path = FCPATH . 'uploads/certificate/' . $certificate->left_sign;
												if (file_exists($is_left_sign_file_path)) {						
											?>
											<img src="<?php echo base_url('uploads/certificate/'.$certificate->left_sign) ?>" style="height:90px;width:auto;margin-top: 5px;">
											<?php
												}else{
													echo '<div style="height:90px;width:auto;margin-top: 5px;"></div>';
												}
											}else{
												echo '<div style="height:90px;width:auto;margin-top: 5px;"></div>';
											}
											echo '<h6 class="mt-1">'.$certificate->left_footer.'</h6>';
										} 
										?>						
									</div>
									<div class="col-4">
										<?php
										if($certificate->is_center_footer==1){
											if($certificate->middle_sign!='' || $certificate->middle_sign!=null){
											$is_middle_sign_file_path = FCPATH . 'uploads/certificate/' . $certificate->middle_sign;
												if (file_exists($is_middle_sign_file_path)) {						
											?>
											<img src="<?php echo base_url('uploads/certificate/'.$certificate->middle_sign) ?>" style="height:90px;width:auto;margin-top: 5px;">
											<?php
												}else{
													echo '<div style="height:90px;width:auto;margin-top: 5px;"></div>';
												}
											}else{
												echo '<div style="height:90px;width:auto;margin-top: 5px;"></div>';
											}
											echo '<h6 class="mt-1">'.$certificate->center_footer.'</h6>';
										}
										?>
									</div>
									<div class="col-4">
										<?php
										if($certificate->is_right_footer==1){
											if($certificate->right_sign!='' || $certificate->right_sign!=null){
											$is_right_sign_file_path = FCPATH . 'uploads/certificate/' . $certificate->right_sign;
												if (file_exists($is_right_sign_file_path)) {						
											?>
											<img src="<?php echo base_url('uploads/certificate/'.$certificate->right_sign) ?>" style="height:90px;width:auto;margin-top: 5px;">
											<?php
												}else{
													echo '<div style="height:90px;width:auto;margin-top: 5px;"></div>';
												}
											}else{
												echo '<div style="height:90px;width:auto;margin-top: 5px;"></div>';
											}
											echo '<h6 class="mt-1">'.$certificate->right_footer.'</h6>';
										}
										?>						
									</div>
								</div>
								
							</div>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
</body>
</html>