<?php 
//echo "<pre>";print_r($data);die;
//echo $data['student']['firstname'];die;
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<title>Admission</title>
		<style>
			.table-details td {
				border: 1px solid #333;
				padding: 2px 4px;
				vertical-align: top;
				font-size: 12px;
			}
			.table-details th {
				border: 1px solid #333;
				padding: 2px 4px;
				font-size: 13px;
				font-weight: 600;
			}
			.borderOnly {
				border-bottom: 1px dotted #000;
				font-size: 12px;
				font-weight: 600;
				padding-left:0;
			}
			.labelOnly {
				font-size: 12px;
			}	
			.text-right {
				text-align: right;
			}
			.heading {
				font-size: 16px;
				font-weight: 600;
				border-bottom: 1px dashed #212529;
				text-align:left;
				margin-top: 10px;
				margin-bottom: 10px;
				color: #212529;
			}
			.text-small {
				font-size: 10px;
			}
		</style>
	</head>
  <body>
    <div class="container-fluid">
        <div class="row" style="border:2px solid #000;">
            <div class="col-12" style="border-bottom: 2px solid #000;padding: 5px;">
				<?php
				if(!empty($data['header_image'])){
				?>
				<img src="<?php echo base_url(); ?>/uploads/print_headerfooter/student_receipt/<?php echo $data['header_image']; ?>" style="height:100px;width:100%">
				<?php } ?>
            </div>
            <div class="col-12 heading">Basic Information</div>
            <div class="col-12">
				<div class="row" style="margin-right:0px">
					<div class="col-10">
						<div class="row d-flex">
							<div class="col-3 labelOnly">Admission No</div>
							<div class="col-3 borderOnly"><?php echo $data['student']['admission_no']; ?></div>
							<div class="col-3 labelOnly text-right">Admission Date</div>
							<div class="col-3 borderOnly"><?php echo date('d/m/Y', strtotime($data['student']['admission_date'])); ?></div>
						</div>
						<div class="row mt-2 d-flex">
							<div class="col-3 labelOnly">Student Name</div>
							<div class="col-9 borderOnly">
							<?= implode(' ', array_filter([
								$data['student']['firstname'] ?? '',
								$data['student']['middlename'] ?? '',
								$data['student']['lastname'] ?? ''
							])); ?>
							</div>
						</div>
						<div class="row mt-2 d-flex">
							<div class="col-3 labelOnly">Caste Category </div>
							<div class="col-2 borderOnly"><?php echo $data['student']['cast_category']; ?></div>
							<div class="col-2 labelOnly text-right">Religion</div>
							<div class="col-2 borderOnly"><?php echo $data['student']['religion']; ?></div>
							<div class="col-1 labelOnly text-right">Caste </div>
							<div class="col-2 borderOnly"><?php echo $data['student']['cast']; ?></div>
						</div>
						<div class="row mt-2 d-flex">
							<div class="col-2 labelOnly">Class</div>
							<div class="col-2 borderOnly"><?php echo $data['student']['class']; ?></div>
							<div class="col-2 labelOnly">Section</div>
							<div class="col-2 borderOnly"><?php echo $data['student']['section']; ?></div>
							<div class="col-2 labelOnly">Roll No</div>
							<div class="col-2 borderOnly"><?php echo $data['student']['roll_no']; ?></div>
						</div>
						<div class="row mt-2 d-flex">
							<div class="col-2 labelOnly">Gender</div>
							<div class="col-2 borderOnly"><?php echo $data['student']['gender']; ?></div>
							<div class="col-2 labelOnly">DOB</div>
							<div class="col-2 borderOnly"><?php echo date('d/m/Y', strtotime($data['student']['dob'])); ?></div>
							<div class="col-2 labelOnly">Blood Group</div>
							<div class="col-2 borderOnly"><?php echo $data['student']['blood_group']; ?></div>
						</div>
					</div>
					<div class="col-2">
						<table class="table table-borderless mb-0">
							<tbody>
								<tr>
									<td valign="top" width="100%" align="right">
										<img src="<?php echo base_url() . $data['student']['image']; ?>" width="70" height="90" style="border: 2px solid #fff;outline: 1px solid #000000;">
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-12">
						<div class="row mt-2 d-flex">
							<div class="col-2 labelOnly">PEN No</div>
							<div class="col-2 borderOnly"><?php echo $data['student']['pan_no']; ?></div>
							<div class="col-2 labelOnly text-right">Adhar No</div>
							<div class="col-2 borderOnly"><?php echo $data['student']['adhar_no']; ?></div>
							<div class="col-2 labelOnly text-right">Other No</div>
							<div class="col-2 borderOnly"><?php echo $data['student']['other_no']; ?></div>
						</div>
						<div class="row mt-2 d-flex">
							<div class="col-2 labelOnly">Student Mob. No</div>
							<div class="col-2 borderOnly"><?php echo $data['student']['mobileno']; ?></div>
							<div class="col-2 labelOnly text-right">Email ID </div>
							<div class="col-2 borderOnly"><?php echo $data['student']['email']; ?></div>
							<div class="col-2 labelOnly text-right">Student House</div>
							<div class="col-2 borderOnly">123</div>
						</div>
					</div>
				</div>
            </div>

			<div class="col-12 heading">Parents and Guardian Details</div>
			<div class="col-12">
				<div class="row" style="margin-right:0px">
					<div class="col-<?php echo $data['student']['father_pic']!='' ? 10 : 12; ?>">
						<div class="row d-flex">
							<div class="col-3 labelOnly">Father Name</div>
							<div class="col-9 borderOnly"><?php echo $data['student']['father_name']; ?></div>
						</div>
						<div class="row mt-2 d-flex">
							<div class="col-3 labelOnly">Contact No</div>
							<div class="col-3 borderOnly"><?php echo $data['student']['father_phone']; ?></div>
							<div class="col-3 labelOnly text-right">Occupation</div>
							<div class="col-3 borderOnly"><?php echo $data['student']['father_occupation']; ?></div>
						</div>
						<div class="row mt-2 d-flex">
							<div class="col-3 labelOnly">PEN No</div>
							<div class="col-3 borderOnly"><?php echo $data['student']['father_pan_no']; ?></div>
							<div class="col-3 labelOnly text-right">Adhar No</div>
							<div class="col-3 borderOnly"><?php echo $data['student']['father_aadhar_no']; ?></div>
						</div>
						<div class="row mt-2 d-flex">
							<div class="col-3 labelOnly">Other No</div>
							<div class="col-3 borderOnly"><?php echo $data['student']['father_other_no']; ?></div>
						</div>
					</div>
					<?php if(!empty($data['student']['father_pic'])) { ?>
					<div class="col-2">
						<table class="table table-borderless mb-0">
							<tbody>
								<tr>
									<td valign="top" width="100%" align="right">
										<img src="<?php echo base_url() . $data['student']['father_pic']; ?>" width="70" height="90" style="border: 2px solid #fff;outline: 1px solid #000000;">
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<?php } ?>
				</div>
            </div>
			<div class="col-12">
				<div class="row mt-2" style="margin-right:0px">
					<div class="col-<?php echo $data['student']['mother_pic']!='' ? 10 : 12; ?>">
						<div class="row d-flex">
							<div class="col-3 labelOnly">Mother Name</div>
							<div class="col-9 borderOnly"><?php echo $data['student']['mother_name']; ?></div>
						</div>
						<div class="row mt-2 d-flex">
							<div class="col-3 labelOnly">Contact No</div>
							<div class="col-3 borderOnly"><?php echo $data['student']['mother_phone']; ?></div>
							<div class="col-3 labelOnly text-right">Occupation</div>
							<div class="col-3 borderOnly"><?php echo $data['student']['mother_occupation']; ?></div>
						</div>
						<div class="row mt-2 d-flex">
							<div class="col-3 labelOnly">PEN No</div>
							<div class="col-3 borderOnly"><?php echo $data['student']['mother_pan_no']; ?></div>

							<div class="col-3 labelOnly text-right">Adhar No</div>
							<div class="col-3 borderOnly"><?php echo $data['student']['mother_aadhar_no']; ?></div>
						</div>
						<div class="row mt-2 d-flex">
							<div class="col-3 labelOnly">Other No</div>
							<div class="col-3 borderOnly"><?php echo $data['student']['mother_other_no']; ?></div>
						</div>
					</div>
					<?php if(!empty($data['student']['mother_pic'])) { ?>
					<div class="col-2">
						<table class="table table-borderless mb-0">
							<tbody>
								<tr>
									<td valign="top" width="100%" align="right">
										<img src="<?php echo base_url() . $data['student']['mother_pic']; ?>" width="70" height="90" style="border: 2px solid #fff;outline: 1px solid #000000;">
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<?php } ?>
				</div>
            </div>
			<div class="col-12">
				<div class="row mt-2" style="margin-right:0px">
					<div class="col-<?php echo $data['student']['guardian_pic']!='' ? 10 : 12; ?>">
						<div class="row d-flex">
							<div class="col-3 labelOnly">Current Address</div>
							<div class="col-9 borderOnly"><?php echo $data['student']['current_address']; ?></div>
						</div>
						<div class="row mt-2 d-flex">
							<div class="col-3 labelOnly">Permanent Address</div>
							<div class="col-9 borderOnly"><?php echo $data['student']['permanent_address']; ?></div>
							<!--<div class="col-3 labelOnly text-right">Occupation</div>
							<div class="col-3 borderOnly"><?php echo $data['student']['guardian_occupation']; ?></div>-->
						</div>
						<!--<div class="row mt-2 d-flex">
							<div class="col-3 labelOnly">PEN No</div>
							<div class="col-3 borderOnly"><?php echo $data['student']['guardian_is'] == 'father' ? $data['student']['father_pan_no'] : ($data['student']['guardian_is'] == 'mother' ? $data['student']['mother_pan_no'] : ''); ?></div>
							<div class="col-3 labelOnly text-right">Adhar No</div>
							<div class="col-3 borderOnly"><?php echo $data['student']['guardian_is'] == 'father' ? $data['student']['father_aadhar_no'] : ($data['student']['guardian_is'] == 'mother' ? $data['student']['mother_aadhar_no'] : ''); ?></div>
						</div>-->
						<!--<div class="row mt-2 d-flex">
							<div class="col-3 labelOnly">Other No</div>
							<div class="col-3 borderOnly"><?php echo $data['student']['guardian_is'] == 'father' ? $data['student']['father_other_no'] : ($data['student']['guardian_is'] == 'mother' ? $data['student']['mother_other_no'] : ''); ?></div>
						</div>-->
					</div>
					<?php if(!empty($data['student']['guardian_pic'])) { ?>
					<div class="col-2">
						<table class="table table-borderless mb-0" >
							<tbody>
								<tr>
									<td valign="top" width="100%" align="right">
										<img src="<?php echo base_url() . $data['student']['guardian_pic']; ?>" width="70" height="90" style="border: 2px solid #fff;outline: 1px solid #000000;">
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<?php } ?>
				</div>
            </div>
			
			<div class="col-12 heading">Fee Details</div>
			<div class="col-12">
				<div class="row d-flex">
					<div class="col-12">
						<table width="100%" cellspacing="0" cellpadding="0" class="table-details">
							<thead>
								<tr>
									<th>Fee Category</th>
									<th>Route Name</th>
									<th>Driver Name</th>
									<th>Vehicle No</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $data['student']['category']; ?></td>
									<td><?php echo $data['route_details']['route_title']; ?></td>
									<?php
									$driverNames = array_column($data['vehicle_details'], 'driver_name'); 
									$driverNames = implode(', ', $driverNames);
									?>
									<td><?php echo $driverNames; ?></td>
									<?php
									$vehicleNos = array_column($data['vehicle_details'], 'vehicle_no'); 
									$vehicleNos = implode(', ', $vehicleNos);
									?>
									<td><?php echo $vehicleNos; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!--<div class="row mt-2" style="margin-right:0px">
					<div class="col-3 labelOnly">Current Address</div>
					<div class="col-9 borderOnly"><?php echo $data['student']['current_address']; ?></div>
				</div>
				<div class="row mt-1" style="margin-right:0px">
					<div class="col-3 labelOnly">Permanent Address</div>
					<div class="col-9 borderOnly"><?php echo $data['student']['permanent_address']; ?></div>
				</div>-->
			</div>
			
			<div class="col-12 heading">Miscellaneous Details</div>
			<div class="col-12">
				<table width="100%" cellspacing="0" cellpadding="0" class="table-details">
					<thead>
						<tr>
							<th>Last School Name</th>
							<th>Bank Account Detail</th>
							<th>Bank Name</th>
							<th>IFSC Code</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $data['student']['previous_school']; ?></td>
							<td><?php echo $data['student']['bank_account_no']; ?></td>
							<td><?php echo $data['student']['bank_name']; ?></td>
							<td><?php echo $data['student']['ifsc_code']; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
			
            <div class="col-sm-12 mb-1 mt-1">
              <div class="row">
                <div class="col-12 text-small">
                  <?php
					if (!empty($data['footer_text'])) {
						echo $data['footer_text'];
					} else {
						echo '<strong>Note</strong> : <span style="font-size:13px !important">This is a System Generated Slip Not Required Stamp.</span>';
					}
				  ?>
                </div>
              </div>
            </div>

        </div>
    </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>





<script>
window.onload = function () {
   window.print();
        window.onafterprint = back;
}
 function back() {
    // window.history.back();
	window.close();
 }
</script>