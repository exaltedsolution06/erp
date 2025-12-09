<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<title>Admission</title>
		<style>
			.table-details td {
				padding: 6px 4px;
				vertical-align: top;
				font-size: 14px;
			}
			.table-details td, .table-details th {
				border: 1px solid #333;
				padding: 6px 8px;
			}

			.label {
				width: 45%;
			}
			.value {
				border-bottom: 1px dotted #000;
				width: 55%;
			}
			.label_name {
				width: 20%;
			}
			.value_name {
				border-bottom: 1px dotted #000;
				width: 80%;
			}
		</style>
	</head>
  <body>
    <div class="container-fluid">
        <div class="row" style="border:2px solid #000;">
            <div class="col-12" style="border-bottom: 2px solid #000;padding: 5px;">
				<?php
				if(!empty($header_image)){
				?>
				<img src="<?php echo base_url(); ?>/uploads/print_headerfooter/student_receipt/<?php echo $header_image; ?>" style="height:100px;width:100%">
				<?php } ?>
            </div>
            <div class="col-12 mb-3 mt-3 text-center" style="border-bottom: 2px dashed #000;">
                <h4>Basic Information</h4>
            </div>
            <div class="col-12">
				<div class="row">
					<div class="col-10">
						<div class="row">
							<div class="col-6">
								<div class="d-flex">
									<div class="label">Admission No</div>
									<div class="value"><strong><?php echo $student['admission_no']; ?></strong></div>
								</div>
							</div>
							<div class="col-6">
								<div class="d-flex">
									<div class="label">Admission Date</div>
									<div class="value"><strong><?php echo $student['admission_date']; ?></strong></div>
								</div>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-4">
								<div class="d-flex">
									<div class="label">Class</div>
									<div class="value"><strong>Play</strong></div>
								</div>
							</div>
							<div class="col-4">
								<div class="d-flex">
									<div class="label">Section</div>
									<div class="value"><strong>A</strong></div>
								</div>
							</div>
							<div class="col-4">
								<div class="d-flex">
									<div class="label">Roll No</div>
									<div class="value"><strong>AG101</strong></div>
								</div>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-12">
								<div class="d-flex">
									<div class="label_name">Student Full Name</div>
									<div class="value_name"><strong>Vihan Roy</strong></div>
								</div>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-6">
								<div class="d-flex">
									<div class="label">Gender</div>
									<div class="value"><strong>Male</strong></div>
								</div>
							</div>
							<div class="col-6">
								<div class="d-flex">
									<div class="label">DOB</div>
									<div class="value"><strong>20-04-2024</strong></div>
								</div>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-6">
								<div class="d-flex">
									<div class="label">PEN No</div>
									<div class="value"><strong>ETZPM4041M</strong></div>
								</div>
							</div>
							<div class="col-6">
								<div class="d-flex">
									<div class="label">Adhar No</div>
									<div class="value"><strong>1111 2222 3333</strong></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-2">
						<table class="table table-borderless">
							<tbody>
								<tr>
									<td valign="top" width="25%" align="right">
										<img src="<?php echo base_url() . $student['image']; ?>" width="100" height="130" style="border: 2px solid #fff;outline: 1px solid #000000;">
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-12">
						<div class="row mt-2">
							<div class="col-6">
								<div class="d-flex">
									<div class="label">Other No</div>
									<div class="value"><strong>1258964586</strong></div>
								</div>
							</div>
							<div class="col-6">
								<div class="d-flex">
									<div class="label">Caste Category </div>
									<div class="value"><strong>ABC</strong></div>
								</div>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-6">
								<div class="d-flex">
									<div class="label">Religion</div>
									<div class="value"><strong>Hindu</strong></div>
								</div>
							</div>
							<div class="col-6">
								<div class="d-flex">
									<div class="label">Caste </div>
									<div class="value"><strong>General</strong></div>
								</div>
							</div>
						</div>
						<div class="row mt-2">	
							<div class="col-6">
								<div class="d-flex">
									<div class="label">Student Mob. No</div>
									<div class="value"><strong>9732479865</strong></div>
								</div>
							</div>
							<div class="col-6">
								<div class="d-flex">
									<div class="label">Email ID </div>
									<div class="value"><strong>student@gmail.com</strong></div>
								</div>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-6">
								<div class="d-flex">
									<div class="label">Blood Group</div>
									<div class="value"><strong>A+</strong></div>
								</div>
							</div>
							<div class="col-6">
								<div class="d-flex">
									<div class="label">Student House</div>
									<div class="value"><strong>ABC street, Kolkata</strong></div>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>

			<div class="col-12 mb-3 mt-5 text-center" style="border-bottom: 2px dashed #000;">
                <h4>Parents and Guardian Details</h4>
            </div>
			<div class="col-12">
				<div class="row">
					<div class="col-10">
						<div class="row">
							<div class="col-12">
								<div class="d-flex">
									<div class="label_name">Father Name</div>
									<div class="value_name"><strong>Vinay Roy</strong></div>
								</div>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-6">
								<div class="d-flex">
									<div class="label">Contact No</div>
									<div class="value"><strong>8965236589</strong></div>
								</div>
							</div>
							<div class="col-6">
								<div class="d-flex">
									<div class="label">Occupation</div>
									<div class="value"><strong>PVT employee</strong></div>
								</div>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-6">
								<div class="d-flex">
									<div class="label">PEN No</div>
									<div class="value"><strong>ETZPM4041M</strong></div>
								</div>
							</div>
							<div class="col-6">
								<div class="d-flex">
									<div class="label">Adhar No</div>
									<div class="value"><strong>1111 2222 3333</strong></div>
								</div>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-6">
								<div class="d-flex">
									<div class="label">Other No</div>
									<div class="value"><strong>1111 2222 3333</strong></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-2">
						<table class="table table-borderless">
							<tbody>
								<tr>
									<td valign="top" width="25%" align="right">
										<img src="<?php echo base_url() . $student['image']; ?>" width="100" height="130" style="border: 2px solid #fff;outline: 1px solid #000000;">
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
            </div>
			<div class="col-12">
				<div class="row">
					<div class="col-10">
						<div class="row">
							<div class="col-12">
								<div class="d-flex">
									<div class="label_name">Mother Name</div>
									<div class="value_name"><strong>Vinay Roy</strong></div>
								</div>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-6">
								<div class="d-flex">
									<div class="label">Contact No</div>
									<div class="value"><strong>8965236589</strong></div>
								</div>
							</div>
							<div class="col-6">
								<div class="d-flex">
									<div class="label">Occupation</div>
									<div class="value"><strong>PVT employee</strong></div>
								</div>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-6">
								<div class="d-flex">
									<div class="label">PEN No</div>
									<div class="value"><strong>ETZPM4041M</strong></div>
								</div>
							</div>
							<div class="col-6">
								<div class="d-flex">
									<div class="label">Adhar No</div>
									<div class="value"><strong>1111 2222 3333</strong></div>
								</div>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-6">
								<div class="d-flex">
									<div class="label">Other No</div>
									<div class="value"><strong>1111 2222 3333</strong></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-2">
						<table class="table table-borderless">
							<tbody>
								<tr>
									<td valign="top" width="25%" align="right">
										<img src="<?php echo base_url() . $student['image']; ?>" width="100" height="130" style="border: 2px solid #fff;outline: 1px solid #000000;">
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
            </div>
			<div class="col-12">
				<div class="row">
					<div class="col-10">
						<div class="row">
							<div class="col-12">
								<div class="d-flex">
									<div class="label_name">Guardian Name</div>
									<div class="value_name"><strong>Vinay Roy</strong></div>
								</div>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-6">
								<div class="d-flex">
									<div class="label">Contact No</div>
									<div class="value"><strong>8965236589</strong></div>
								</div>
							</div>
							<div class="col-6">
								<div class="d-flex">
									<div class="label">Occupation</div>
									<div class="value"><strong>PVT employee</strong></div>
								</div>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-6">
								<div class="d-flex">
									<div class="label">PEN No</div>
									<div class="value"><strong>ETZPM4041M</strong></div>
								</div>
							</div>
							<div class="col-6">
								<div class="d-flex">
									<div class="label">Adhar No</div>
									<div class="value"><strong>1111 2222 3333</strong></div>
								</div>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-6">
								<div class="d-flex">
									<div class="label">Other No</div>
									<div class="value"><strong>1111 2222 3333</strong></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-2">
						<table class="table table-borderless">
							<tbody>
								<tr>
									<td valign="top" width="25%" align="right">
										<img src="<?php echo base_url() . $student['image']; ?>" width="100" height="130" style="border: 2px solid #fff;outline: 1px solid #000000;">
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
            </div>
			
			<div class="col-12 mb-3 mt-5 text-center" style="border-bottom: 2px dashed #000;">
                <h4>Fee Details</h4>
            </div>
			<div class="col-12">
				<table width="100%" cellspacing="0" cellpadding="0" class="table-details">
					<thead>
						<tr>
							<th>Fee Category</th>
							<th>Route Name</th>
							<th>Driver Name</th>
							<th>Vehicle No</th>
							<th>Current Address</th>
							<th>Permanent Address</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
			
			<div class="col-12 mb-3 mt-5 text-center" style="border-bottom: 2px dashed #000;">
                <h4>Miscellaneous Details</h4>
            </div>
			<div class="col-12">
				<table width="100%" cellspacing="0" cellpadding="0" class="table-details">
					<thead>
						<tr>
							<th>Last School Name</th>
							<th>Bank Account Detail</th>
							<th>Bank Name</th>
							<th> IFSC Code</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
			
            <div class="col-sm-12 mb-5 mt-5">
              <div class="row">
                <div class="col-12 ">
				<b>Note</b> : <span style="font-size:13px !important">
                  <?php
					if (!empty($footer_text)) {
						echo $footer_text;
					} else {
						echo 'This is a System Generated Slip Not Required Stamp.';
					}
				  ?>
                </span>
                </div>
              </div>
            </div>

        </div>
    </div>














   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>





<script>
/*window.onload = function () {
   window.print();
        window.onafterprint = back;
}
 function back() {
    // window.history.back();
	window.close();
 }*/
</script>