<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Balance Due</title>

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
	margin-bottom: 30px;
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

.content{
    padding:15px;
}

.title-row{
    width:100%;
    margin-bottom:10px;
}

.title-row td{
    font-weight:bold;
}

.info-table{
    width:100%;
    margin-top:10px;
}

.info-table td{
    padding:4px;
	font-size: 12px;
}

.message{
    margin-top:15px;
    line-height:1.6;
}

.footer{
    width:100%;
}

.footer td{
    vertical-align:bottom;
}

.signature{
    text-align:right;
}


</style>

</head>

<body>
	<div class="mark-container mb-5">
		<div class="row maincontent">
		<?php 
		foreach($result as $val)
		{
		$replace = [
			'[old_balance]' => '<strong><u>Old Bal.</u></strong>',
			'[amount]'      => '<strong><u>'.$val['amount'].'</u></strong>'
		];
		?>
			<div class="col-sm-6 print-block">
				<div class="slip">
					<!-- HEADER IMAGE -->
					<div class="header">
						<?php
						if(!empty($val['header_image'])){
						?>
						<img src="<?php echo base_url(); ?>/uploads/print_headerfooter/common_header/<?php echo $val['header_image']; ?>" style="height:100px;width:100%">
						<?php } ?>
					</div>

					<div class="content">
						<table class="title-row">
							<tr>
								<td style="text-align:center;"><?php echo $val['heading_title'] ?? ''; ?></td>
								<?php if($val['isdate'] == 1){ ?>
								<td style="text-align:right;">
									DATED: <strong>
									<?php echo !empty($val['date']) ? date('d-M-y', strtotime($val['date'])) : ''; ?>
									</strong>
								</td>
								<?php } ?>
							</tr>
						</table>
						<div class="row">
							<div class="col-md-6">
								<table class="info-table">
								<?php if($val['isuid'] == 1){ ?>
									<tr>
										<td >Admission No</td>
										<td ><strong><?php echo $val['uid_no'] ?></strong></td>
									</tr>
								<?php } ?>
								<?php if($val['isstudent'] == 1){ ?>
									<tr>
										<td>Student's Name</td>
										<td><strong><?php echo $val['student_name'] ?></strong></td>
									</tr>
								<?php } ?>
								<?php if($val['isfather'] == 1){ ?>
									<tr>
										<td>Father's Name</td>
										<td><strong><?php echo $val['father_name'] ?></strong></td>
									</tr>
								<?php } ?>
								</table>
							</div>
							<div class="col-md-6">
								<table class="info-table">
								<?php if($val['isclass'] == 1){ ?>
									<tr>
										<td>Class:</td>
										<td><strong><?php echo $val['class'] ?></strong></td>
									</tr>
								<?php } ?>
								<?php if($val['isroute'] == 1){ ?>
									<tr>
										<td>Route:</td>
										<td><strong><?php echo $val['route'] ?></strong></td>
									</tr>
								<?php } ?>
								<?php if($val['isuphone'] == 1){ ?>
									<tr>
										<td>Ph. No:</td>
										<td><strong><?php echo $val['phone'] ?></strong></td>
									</tr>
								<?php } ?>
								</table>
							</div>
						</div>
						<div class="message">
							<p>
							Dear Parents / Guardians,
							</p>
							<?php echo strtr($val['description'], $replace); ?>
						</div>

						<table class="footer">
							<tr>
								<td>Thank You,</td>
								<td class="signature">
									<?php if($val['is_signature'] == 1){
											$is_signature_path = FCPATH . 'uploads/remind_letter/' . $val['signature'];
											if (file_exists($is_signature_path)) {
											?>
										<img src="<?php echo base_url('uploads/remind_letter/'.$val['signature']) ?>" style="height:60px;width:auto">
									<?php }else{
										echo '<div style="height:60px;width:auto;"></div>';
									} ?>
									<br>
									<?php echo $val['signature_title'] ?>
									<?php } ?>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>
</body>
</html>