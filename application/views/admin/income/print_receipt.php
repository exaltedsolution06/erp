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
    border:1px solid #000;
    page-break-inside: avoid;
    break-inside: avoid;
}

.header{
    border-bottom:1px solid #000;
}

.header img{
    width:100%;
    display:block;
}
.table {
	margin-bottom: 0;
	border: 0;
}

.table td {
	padding: 0 !important;
}
.table div {
	padding: 15px;
}

</style>

</head>
<?php 
$this->load->helper('number_to_word_helper');
//echo "<pre>"; print_r($resultLists); die;
?>
<body>
	<div class="mark-container mb-5">
		<div class="row maincontent">
			<div class="col-sm-12 print-block">
				<div class="slip">
					<!-- HEADER IMAGE -->
					<div class="header">
					<?php
					if(!empty($header_image)){
					?>
						<img src="<?php echo base_url(); ?>/uploads/print_headerfooter/student_receipt/<?php echo $header_image; ?>" style="height:100px;width:100%">
					<?php } ?>
					</div>

					<table class="table">
						<tbody>
							<tr style="border-bottom: 1px solid #000;">
								<th style="border: 0;"><strong>Rec. No.:</strong> <?php echo isset($resultLists['receipt_no']) ? $resultLists['receipt_no'] : 'N/A'; ?></th>
								<th style="border: 0;" class="text-end"><strong>Date:</strong> <?=date('d-m-Y',strtotime($resultLists['date']))?></th>
							</tr>
						</tbody>
					</table>
					
					<table class="table">
						<tbody>
							<tr>
								<td style="border: 0;">
								<?php 
								if(isset($resultLists['student_id']) && $resultLists['student_id'] != '')
								{
									$this->load->model('Student_model');
									$student_data = $this->Student_model->getRecentRecord($resultLists['student_id']);
									//echo "<pre>";print_r($student_data);die;
									$student_name = '';
									if(isset($student_data['firstname']))
									{
										$student_name .= $student_data['firstname'];
									}
									
									if(isset($student_data['middlename']))
									{
										$student_name .= ' '.$student_data['middlename'];
									}
									
									if(isset($student_data['lastname']))
									{
										$student_name .= ' '.$student_data['lastname'];
									}
									
								?>
									<div style="margin-bottom: 50px;">
										<span style="width:90px; display:inline-block;">Party :</span> <strong><?php echo isset($student_data['admission_no']) ? $student_data['admission_no'] : '' ;?> - <?php echo $student_name ;?></strong>
									</div>
								<?php 
								}
								
								if(isset($resultLists['staff_id']) && $resultLists['staff_id'] !='')
								{
									
									$this->load->model('staff_model');
									$staff_data = $this->staff_model->get($resultLists['staff_id']);
									//echo "<pre>";print_r($staff_data);die;
								?>
									<div style="margin-bottom: 50px;">
										<span style="width:90px; display:inline-block;">Party :</span> <strong><?php echo $staff_data['name'] ;?></strong>
									</div>
								<?php 
								}
								?>
									<div style="margin-bottom: 5px;">Please find enclosed herewith a sum of</div>
									<div style="font-size: 13px;"><strong><?php echo numberToWords($resultLists['amount']); ?></strong></div>
									<div style="border-bottom: 1px solid #000;">As per details given below</div>
									<div style="border-bottom: 1px solid #000;font-style: italic;"><strong><?php echo isset($resultLists['description']) ? $resultLists['description'] : 'N/A'; ?></strong></div>
									<div style="display: flex;">
										<div style="width: 50%; padding:0; display: flex; align-items: center;">
											<strong style="font-size: 13px;"> Rs. <?php echo isset($resultLists['amount']) ? format_amount($resultLists['amount']) : 'N/A'; ?></strong>
										</div>
										<div style="width: 50%; text-align: right; padding:0;">
											<div style="font-weight: bold; font-size: 13px; margin-bottom: 15px;">For <?php echo $this->setting_model->getCurrentSchoolName(); ?></div>
											<div>Auth. Signatory</div>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>