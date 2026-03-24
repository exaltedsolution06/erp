<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Receipt</title>

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
foreach ($students as $student) {
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
        '[name]' => $student_name,
        '[dob]' => date('d/m/Y' , strtotime($student->dob)),
		'[present_address]' => $student->current_address,
		'[guardian]' => $student->guardian_name,
		'[created_at]' => date('d/m/Y' , strtotime($student->created_at)),
        '[admission_no]'  => $student->admission_no,
        '[roll_no]'  => $student->roll_no,
        '[class]'  => $student->class,
        '[section]'  => $student->section,
        '[gender]'  => $student->gender,
        '[gender]'  => $student->gender,
		'[admission_date]'  => date('d/m/Y' , strtotime($student->admission_date)),
        '[category]'  => $student->cast,
        '[cast]'  => $student->cast,
        '[father_name]'  => $student->father_name,
        '[mother_name]'  => $student->mother_name,
        '[religion]'  => $student->religion,
        '[email]'  => $student->email,
        '[phone]'  => $student->guardian_phone,
        '[CASTE CATEGORY]'  => $student->cast,
        '[PAN Card]'  => $student->cast
    ];
	
	$check_student_id = $this->designtc_model->check_student_id($student->id);
	if($check_student_id)
	{
		$data = [
			'session_id' => $certificate->session_id,
			'serial_no'  => $certificate->serial_no_prefix.' '.$certificate->serial_no_suffix,
			'student_id' => $student->id,
			'created_date' => date('Y-m-d h:i:s')
		];
		$this->designtc_model->addCertificateGenerate($data);
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
					<div class="header">
						<?php
						if(!empty($header_image)){
						?>
						<img src="<?php echo base_url(); ?>/uploads/print_headerfooter/common_header/<?php echo $header_image; ?>" style="height:100px;width:100%">
						<?php } ?>
					</div>
					
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
						<?php 
						foreach($fields_json as $val)
						{
							$value = str_replace(
								array_keys($replaceArr),
								array_values($replaceArr),
								$val->value
							);
						?>
							<div class="col-12 mb-3 d-flex mt-2">	
								<strong class="label-text">1. <?php echo $val->title ?> :</strong>
								<span class="text-underline" style="text-align:center;"><?php echo $value; ?></span>
							</div>
						<?php 
						}
						?>
							<!--<div class="col-12 mb-3 d-flex mt-2">	
								<strong class="label-text">2. Father's Name :</strong>
								<span class="text-underline" style="text-align:center;">SHASHIKANT BHARADWAJ</span>
							</div>
							<div class="col-12 mb-3 d-flex mt-2">	
								<strong class="label-text">3. Father's Name :</strong>
								<span class="text-underline" style="text-align:center;">SHASHIKANT BHARADWAJ</span>
							</div>
							<div class="col-12 mb-3 d-flex mt-2">	
								<strong class="label-text">4. Father's Name :</strong>
								<span class="text-underline" style="text-align:center;">SHASHIKANT BHARADWAJ</span>
							</div>
							<div class="col-12 mb-3 d-flex mt-2">	
								<strong class="label-text">5. Father's Name :</strong>
								<span class="text-underline" style="text-align:center;">SHASHIKANT BHARADWAJ</span>
							</div>
							<div class="col-12 mb-3 d-flex mt-2">	
								<strong class="label-text">6. Father's Name Father's Name :</strong>
								<span class="text-underline" style="text-align:center;">SHASHIKANT BHARADWAJ</span>
							</div>
							<div class="col-12 mb-3 d-flex mt-2">	
								<strong class="label-text">7. Father's Name :</strong>
								<span class="text-underline" style="text-align:center;">SHASHIKANT BHARADWAJ</span>
							</div>
							<div class="col-12 mb-3 d-flex mt-2">	
								<strong class="label-text">8. Father's Name :</strong>
								<span class="text-underline" style="text-align:center;">SHASHIKANT BHARADWAJ</span>
							</div>
							<div class="col-12 mb-3 d-flex mt-2">	
								<strong class="label-text">9. Father's Name :</strong>
								<span class="text-underline" style="text-align:center;">SHASHIKANT BHARADWAJ</span>
							</div>
							<div class="col-12 mb-3 d-flex mt-2">	
								<strong class="label-text">10. Father's Name :</strong>
								<span class="text-underline" style="text-align:center;">SHASHIKANT BHARADWAJ</span>
							</div>
							<div class="col-12 mb-3 d-flex mt-2">	
								<strong class="label-text">11. Father's Name :</strong>
								<span class="text-underline" style="text-align:center;">SHASHIKANT BHARADWAJ</span>
							</div>
							<div class="col-12 mb-3 d-flex mt-2">	
								<strong class="label-text">12. Father's Name :</strong>
								<span class="text-underline" style="text-align:center;">SHASHIKANT BHARADWAJ</span>
							</div>
							<div class="col-12 mb-3 d-flex mt-2">	
								<strong class="label-text">13. Father's Name :</strong>
								<span class="text-underline" style="text-align:center;">SHASHIKANT BHARADWAJ</span>
							</div>
							<div class="col-12 mb-3 d-flex mt-2">	
								<strong class="label-text">14. Father's Name :</strong>
								<span class="text-underline" style="text-align:center;">SHASHIKANT BHARADWAJ</span>
							</div>-->
						</div>
						<div style="display: flex;justify-content: space-between;" class="mt-5">
							<div style="width: 50%; padding:0; display: flex; align-items: center;">
							<?php if($certificate->is_show_date == 1){ ?>
								<strong>Date:</strong> <span class="text-underline" style="width:200px;text-align:center;"><?php echo $certificate->show_date; ?></span>
							<?php } ?>	
							</div>
							<div class="text-center" style="width: 20%; text-align: right; padding:0;">
								<span>
									<?php if($certificate->is_signature == 1){
											$is_signature_path = FCPATH . 'uploads/transfer_certificate/' . $certificate->signature;
											if (file_exists($is_signature_path)) {
											?>
										<img src="<?php echo base_url('uploads/transfer_certificate/'.$certificate->signature) ?>" style="height:60px;width:auto">
									<?php }else{
										echo '<div style="height:60px;width:auto;"></div>';
									} ?>
									<br>
									<strong style="font-style:italic;"><?php echo $certificate->signature_title ?></strong>
									<?php } ?>
								</span>
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