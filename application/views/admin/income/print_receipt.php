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
}

.table td {
	padding: 0 !important;
}
.table div {
	padding: 15px;
}

</style>

</head>

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
								<th><strong>Rec. No.:</strong> 2025-2026/10</th>
								<th class="text-end"><strong>Date:</strong> <?=date('d-m-Y',strtotime('2026-02-27'))?></th>
							</tr>
						</tbody>
					</table>
					
					<table class="table">
						<tbody>
							<tr>
								<td>
									<div style="margin-bottom: 50px;">
										<span style="width:90px; display:inline-block;">Party :</span> <strong>132 - Aaryan Khatiyan</strong>
									</div>
									<div style="margin-bottom: 5px;">Please find enclosed herewith a sum of</div>
									<div style="font-size: 13px;"><strong>Rupees Five Thousand Only</strong></div>
									<div style="border-bottom: 1px solid #000;"><strong>As per details given below</strong></div>
									<div style="border-bottom: 1px solid #000;font-style: italic;"><strong>Testing Only</strong></div>
									<div style="display: flex;">
										<div style="width: 50%; padding:0; display: flex; align-items: center;">
											<strong style="font-size: 13px;">5000</strong>
										</div>
										<div style="width: 50%; text-align: right; padding:0;">
											<div style="font-weight: bold; font-size: 13px; margin-bottom: 15px;">For GURUKUL INTERNATIONAL SCHOOL</div>
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