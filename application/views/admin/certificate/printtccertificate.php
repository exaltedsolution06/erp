<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Receipt</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: 0;
    background: #fff;
}

.pagebreak {
    page-break-before: always;
}

/* Outer page wrapper — full A4-like width */
.mark-container {
    width: 100%;
    max-width: 1000px;
    margin: 0 auto;
    position: relative;
}

/* Prevent page breaks inside a slip */
.print-block {
    page-break-inside: avoid;
    break-inside: avoid;
}

/* The certificate slip */
.slip {
    padding: 20px 30px 30px 30px;
    page-break-inside: avoid;
    break-inside: avoid;
    position: relative; /* stacking context for watermark */
    min-height: 600px;
}

/* ─── HEADER ─────────────────────────────────── */
.header {
    width: 100%;
    border-bottom: 2.5px solid #000;
    overflow: hidden;
    line-height: 0; /* remove inline-block gap */
}

.header img {
    display: block;
    width: 100%;          /* stretch to full container width */
    height: auto;        /* fixed header height — adjust as needed */
    object-fit: cover;    /* crop gracefully if image aspect differs */
    object-position: center top;
}

/* ─── WATERMARK ──────────────────────────────── */
/*
  Positioned INSIDE .slip so it sits below the header.
  Uses opacity for the watermark effect.
  pointer-events: none so it doesn't block text selection.
*/
.watermark {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 55%;          /* control how large the watermark appears */
    max-width: 420px;
    /*z-index: 0;*/
    pointer-events: none;
    display: flex;
    align-items: center;
    justify-content: center;
}

.watermark img {
    width: 100%;
    height: auto;
    /*opacity: 0.10;*/       /* 10% opacity = classic watermark look */
    /*filter: grayscale(100%);*/ /* desaturate for subtlety */
}

/* ─── CONTENT (always above watermark) ───────── */
.content {
    position: relative;
    z-index: 1;          /* sits on top of the watermark */
}

/* Certificate title */
.cert-title {
    font-size: 22px;
    font-weight: 700;
    text-align: center;
    margin: 18px 0 8px;
    letter-spacing: 1px;
    text-decoration: underline;
    text-underline-offset: 4px;
}

/* Meta row — Book No / SR No / Admission No */
.meta-row {
    display: flex;
    justify-content: space-between;
    margin: 16px 0 20px;
    font-size: 14px;
}

.meta-item {
    flex: 1;
    /*text-align: center;*/
    font-weight: 500;
}
.meta-item:first-child {
    text-align: left;
}

.meta-item:nth-child(2) {
    text-align: center;
}

.meta-item:last-child {
    text-align: right;
}

/* Field rows */
.field-row {
    display: flex;
    align-items: flex-end;
    margin-bottom: 12px;
    gap: 6px;
}

.field-label {
    white-space: nowrap;
    font-weight: bold;
    font-size: 17px;
    min-width: fit-content;
}

.field-value {
    flex: 1;
    border-bottom: 1px solid #555;
    font-size: 15px;
    font-weight: bold;
    padding: 0 4px 2px;
    min-height: 20px;
	text-align: center;
}

/* Signature section */
.signature-section {
    margin-top: 40px;
    display: flex;
    justify-content: space-between;
    text-align: center;
}

.sign-block {
    flex: 1;
    padding: 0 10px;
}

.sign-block img {
    height: 70px;
    width: auto;
    display: block;
    margin: 0 auto 6px;
}

.sign-block .sign-placeholder {
    height: 70px;
    display: block;
}

.sign-block h6 {
    font-size: 12px;
    font-weight: 600;
    border-top: 1.5px solid #000;
    padding-top: 6px;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* ─── PRINT STYLES ──────────────────────────── */
@media print {
    body { margin: 0; }
    .watermark img { /*opacity: 0.08;*/ -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    .header img { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
}

/* ─── LABEL TEXT helper ──────────────────────── */
.label-text { white-space: nowrap; }
</style>

</head>
<body>
<?php
foreach ($students as $s => $student) {

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

    $check_student_id = $this->designtc_model->check_student_id($student->id);
    if ($check_student_id) {
        $max_serial_no = $this->designtc_model->get_max_serial_no();
        $sl_no = ($max_serial_no > 0) ? $max_serial_no + 1 : $result->serial_no_suffix;
        $data = [
            'session_id'   => $certificate->session_id,
            'serial_no'    => $sl_no,
            'student_id'   => $student->id,
            'template_id'  => $certificate->id,
            'created_date' => date('Y-m-d h:i:s'),
        ];
        $i_id = $this->designtc_model->addCertificateGenerate($data);
    } else {
        $check_certificate = $this->designtc_model->get_certificate($student->id);
        $sl_no = $check_certificate['serial_no'];
    }
?>

    <?php if ($s > 0): ?>
        <div class="pagebreak"></div>
    <?php endif; ?>

    <?php if ($certificate->is_common_header == 0): ?>
        <div style="height:<?php echo (int)$certificate->header_height; ?>px;"></div>
    <?php endif; ?>

    <div class="mark-container mb-5">
        <div class="row">
            <div class="col-sm-12 print-block">

                <!-- ═══ HEADER (full width, 100%) ═══ -->
                <?php if ($certificate->is_common_header == 1 && !empty($header_image)):
                    $is_header_file_path = FCPATH . 'uploads/print_headerfooter/common_header/' . $header_image;
                    if (file_exists($is_header_file_path)): ?>
                        <div class="header">
                            <img src="<?php echo base_url(); ?>/uploads/print_headerfooter/common_header/<?php echo $header_image; ?>"
                                 alt="School Header">
                        </div>
                <?php endif; endif; ?>

                <!-- ═══ SLIP (contains watermark + content) ═══ -->
                <div class="slip">

                    <!-- ── WATERMARK (centered, behind content) ── -->
                    <?php if ($certificate->background_image != ''): ?>
                        <div class="watermark">
                            <img src="<?php echo base_url('uploads/transfer_certificate/' . $certificate->background_image); ?>"
                                 alt="">
                        </div>
                    <?php endif; ?>

                    <!-- ── CONTENT (z-index above watermark) ── -->
                    <div class="content">

                        <!-- Certificate Title -->
                        <?php if ($certificate->certificate_name != ''): ?>
                            <h4 class="cert-title">
                                <?php echo htmlspecialchars($certificate->certificate_name); ?>
                            </h4>
                        <?php endif; ?>

                        <!-- Meta info row -->
                        <div class="meta-row">
							<div class="meta-item">
								Book No : <strong><?php echo htmlspecialchars($result->book_no); ?></strong>
							</div>
							<div class="meta-item">
								SR No : <strong><?php echo htmlspecialchars($result->serial_no_prefix . $sl_no); ?></strong>
							</div>
							<div class="meta-item">
								Admission No : <strong><?php echo htmlspecialchars($student->admission_no); ?></strong>
							</div>
						</div>

                        <!-- Dynamic fields -->
                        <?php
                        $fields_json = json_decode($certificate->fields_json);
                        $i = 0;
                        foreach ($fields_json as $val):
                            $value = str_replace(
                                array_keys($replaceArr),
                                array_values($replaceArr),
                                $val->value
                            );
                            $i++;
                        ?>
                            <div class="field-row">
                                <span class="field-label"><?php echo $i; ?>. <?php echo htmlspecialchars($val->title); ?> :</span>
                                <span class="field-value"><?php echo htmlspecialchars($value); ?></span>
                            </div>
                        <?php endforeach; ?>

                        <!-- Signature section -->
                        <?php
                        $sign_count = 0;
                        if ($certificate->is_class_teacher == 1)  $sign_count++;
                        if ($certificate->is_examination_ic == 1) $sign_count++;
                        if ($certificate->is_principal == 1)      $sign_count++;
                        if ($sign_count > 0):
                        ?>
                        <div class="signature-section">

                            <!-- Left signature -->
                            <div class="sign-block">
                                <?php if ($certificate->is_class_teacher == 1): ?>
                                    <?php
                                    $left_path = FCPATH . 'uploads/transfer_certificate/' . $certificate->left_sign;
                                    if (!empty($certificate->left_sign) && file_exists($left_path)): ?>
                                        <img src="<?php echo base_url('uploads/transfer_certificate/' . $certificate->left_sign); ?>" alt="Signature">
                                    <?php else: ?>
                                        <span class="sign-placeholder"></span>
                                    <?php endif; ?>
                                    <h6><?php echo htmlspecialchars($certificate->left_sign_title); ?></h6>
                                <?php endif; ?>
                            </div>

                            <!-- Middle signature -->
                            <div class="sign-block">
                                <?php if ($certificate->is_examination_ic == 1): ?>
                                    <?php
                                    $mid_path = FCPATH . 'uploads/transfer_certificate/' . $certificate->middle_sign;
                                    if (!empty($certificate->middle_sign) && file_exists($mid_path)): ?>
                                        <img src="<?php echo base_url('uploads/transfer_certificate/' . $certificate->middle_sign); ?>" alt="Signature">
                                    <?php else: ?>
                                        <span class="sign-placeholder"></span>
                                    <?php endif; ?>
                                    <h6><?php echo htmlspecialchars($certificate->middle_sign_title); ?></h6>
                                <?php endif; ?>
                            </div>

                            <!-- Right signature -->
                            <div class="sign-block">
                                <?php if ($certificate->is_principal == 1): ?>
                                    <?php
                                    $right_path = FCPATH . 'uploads/transfer_certificate/' . $certificate->right_sign;
                                    if (!empty($certificate->right_sign) && file_exists($right_path)): ?>
                                        <img src="<?php echo base_url('uploads/transfer_certificate/' . $certificate->right_sign); ?>" alt="Signature">
                                    <?php else: ?>
                                        <span class="sign-placeholder"></span>
                                    <?php endif; ?>
                                    <h6><?php echo htmlspecialchars($certificate->right_sign_title); ?></h6>
                                <?php endif; ?>
                            </div>

                        </div>
                        <?php endif; ?>

                    </div><!-- /.content -->
                </div><!-- /.slip -->

            </div>
        </div>
    </div>

    <?php if ($certificate->is_common_header == 0): ?>
        <div style="height:<?php echo (int)$certificate->footer_height; ?>px;"></div>
    <?php endif; ?>

<?php } ?>
</body>
</html>
