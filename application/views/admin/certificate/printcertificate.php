<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Certificate</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Times New Roman', Times, serif;
    background: #fff;
}

/* ── PAGE WRAPPER ─────────────────────────────────────────────── */
.page-wrapper {
    display: flex;
    flex-wrap: wrap;
    align-content: flex-start;
    width: 100%;
}

/*
   Each .page-slot is one certificate.
   break-inside: avoid = never torn across pages.
   Two short certs can share one printed page naturally;
   if the second one doesn't fit it is pushed to the next page.
*/
.page-slot {
    width: 100%;
    page-break-inside: avoid;
    break-inside: avoid;
    position: relative;
}

/* ── MARK CONTAINER ───────────────────────────────────────────── */
.mark-container {
    width: 100%;
    max-width: 1000px;
    margin: 0 auto;
    position: relative;
}

/* ── HEADER (full width, auto height) ────────────────────────── */
.header {
    width: 100%;
    border-bottom: 2.5px solid #000;
    line-height: 0;
    overflow: hidden;
}

.header img {
    display: block;
    width: 100%;
    height: auto;         /* natural aspect ratio — no cropping    */
    object-fit: contain;
    object-position: center top;
}

/* ── SLIP (content area, sits below header) ───────────────────── */
.slip {
    padding: 20px 30px 30px 30px;
    position: relative;   /* stacking context for the bg image    */
    min-height: 400px;
}

/* ── BACKGROUND IMAGE ─────────────────────────────────────────── */
/*
   Placed inside .slip so it NEVER overlaps the header.
   Absolutely centred. Full colour (no opacity change).
   z-index 0 keeps it behind all text (z-index 1).
*/
.bg-image {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 55%;           /* tune this percentage to taste         */
    max-width: 480px;
    z-index: 0;
    pointer-events: none;
}

.bg-image img {
    display: block;
    width: 100%;
    height: auto;
}

/* ── CONTENT (always above bg image) ─────────────────────────── */
.content {
    position: relative;
    z-index: 1;
}

/* ── CERTIFICATE TITLE ────────────────────────────────────────── */
.cert-title {
    font-size: 22px;
    font-weight: 700;
    text-align: center;
    letter-spacing: 1px;
    text-decoration: underline;
    text-underline-offset: 4px;
    margin: 0;
}

/* ── SUB-HEADER ROW (left | centre | right) ───────────────────── */
.sub-header-row {
    display: flex;
    align-items: flex-start;
    margin-top: 12px;
    margin-bottom: 8px;
}
.sub-header-left   { flex: 1; text-align: left;   }
.sub-header-center { flex: 2; text-align: center;  }
.sub-header-right  { flex: 1; text-align: right;  }

/* ── STUDENT PHOTO ────────────────────────────────────────────── */
.student-photo-row {
    text-align: right;
    margin-bottom: 8px;
}

/* ── CERTIFICATE TEXT BLOCK ───────────────────────────────────── */
.cert-text-block {
    margin-top: 24px;
    font-size: 14px;
    line-height: 1.9;
    text-align: justify;
}

/* ── SIGNATURE SECTION ────────────────────────────────────────── */
.signature-section {
    display: flex;
    justify-content: space-between;
    text-align: center;
    margin-top: 40px;
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

.sign-placeholder {
    height: 70px;
    display: block;
}

.sign-block h6 {
    font-size: 12px;
    font-weight: 700;
    border-top: 1.5px solid #000;
    padding-top: 6px;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* ── PRINT ────────────────────────────────────────────────────── */
@media print {
    .header img,
    .bg-image img {
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
}
</style>

</head>
<body>

<div class="page-wrapper">
<?php
$certificate = $certificate[0];

foreach ($students as $s_idx => $student) {

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
    if ($check_student_id) {
        $data = [
            'session_id'   => $certificate->session_id,
            'student_id'   => $student->id,
            'template_id'  => $certificate->id,
            'created_date' => date('Y-m-d h:i:s'),
        ];
        $this->Generatecertificate_model->addCertificateGenerate($data);
    }
?>

    <div class="page-slot">

        <?php if ($certificate->is_active_header_img == 0 && $certificate->header_height != 0): ?>
            <div style="height:<?php echo (int)$certificate->header_height; ?>px;"></div>
        <?php endif; ?>

        <div class="mark-container mb-3">
            <div class="row">
                <div class="col-sm-12">

                    <!-- HEADER: full 100% width, auto height -->
                    <div class="header">
                        <?php
                        if ($certificate->is_active_header_img == 1 && !empty($header_image)):
                            $header_path = FCPATH . 'uploads/print_headerfooter/common_header/' . $header_image;
                            if (file_exists($header_path)):
                        ?>
                            <img src="<?php echo base_url(); ?>/uploads/print_headerfooter/common_header/<?php echo $header_image; ?>"
                                 alt="School Header">
                        <?php endif; endif; ?>
                    </div>

                    <!-- SLIP: bg image lives here — never overlaps header -->
                    <div class="slip">

                        <!-- Background image: centred inside slip, full colour, behind text -->
                        <?php if ($certificate->background_image != ''): ?>
                            <div class="bg-image">
                                <img src="<?php echo base_url('uploads/certificate/' . $certificate->background_image); ?>"
                                     alt="">
                            </div>
                        <?php endif; ?>

                        <div class="content">

                            <!-- Left | Centre title | Right -->
                            <div class="sub-header-row">
                                <div class="sub-header-left">
                                    <?php if ($certificate->left_header != ''): ?>
                                        <strong><?php echo $certificate->left_header; ?></strong>
                                    <?php endif; ?>
                                </div>
                                <div class="sub-header-center">
                                    <?php if ($certificate->center_header != ''): ?>
                                        <h4 class="cert-title"><?php echo $certificate->center_header; ?></h4>
                                    <?php endif; ?>
                                </div>
                                <div class="sub-header-right">
                                    <?php if ($certificate->right_header != ''): ?>
                                        <strong><?php echo $certificate->right_header; ?></strong>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Student photo -->
                            <?php if ($certificate->enable_student_image == 1): ?>
                                <div class="student-photo-row">
                                    <img src="<?php echo base_url() . $student->image; ?>"
                                         width="auto"
                                         height="<?php echo (int)$certificate->enable_image_height; ?>">
                                </div>
                            <?php endif; ?>

                            <!-- Certificate body text -->
                            <div class="cert-text-block">
                                <?php
                                $value = str_replace(
                                    array_keys($replaceArr),
                                    array_values($replaceArr),
                                    $certificate->certificate_text
                                );
                                echo $value;
                                ?>
                            </div>

                            <!-- Signatures -->
                            <?php
                            $sign_count = 0;
                            if ($certificate->is_left_footer   == 1) $sign_count++;
                            if ($certificate->is_center_footer == 1) $sign_count++;
                            if ($certificate->is_right_footer  == 1) $sign_count++;
                            if ($sign_count > 0):
                            ?>
                            <div class="signature-section">

                                <div class="sign-block">
                                    <?php if ($certificate->is_left_footer == 1): ?>
                                        <?php $lp = FCPATH . 'uploads/certificate/' . $certificate->left_sign;
                                        if (!empty($certificate->left_sign) && file_exists($lp)): ?>
                                            <img src="<?php echo base_url('uploads/certificate/' . $certificate->left_sign); ?>" alt="">
                                        <?php else: ?>
                                            <span class="sign-placeholder"></span>
                                        <?php endif; ?>
                                        <h6><?php echo $certificate->left_footer; ?></h6>
                                    <?php endif; ?>
                                </div>

                                <div class="sign-block">
                                    <?php if ($certificate->is_center_footer == 1): ?>
                                        <?php $mp = FCPATH . 'uploads/certificate/' . $certificate->middle_sign;
                                        if (!empty($certificate->middle_sign) && file_exists($mp)): ?>
                                            <img src="<?php echo base_url('uploads/certificate/' . $certificate->middle_sign); ?>" alt="">
                                        <?php else: ?>
                                            <span class="sign-placeholder"></span>
                                        <?php endif; ?>
                                        <h6><?php echo $certificate->center_footer; ?></h6>
                                    <?php endif; ?>
                                </div>

                                <div class="sign-block">
                                    <?php if ($certificate->is_right_footer == 1): ?>
                                        <?php $rp = FCPATH . 'uploads/certificate/' . $certificate->right_sign;
                                        if (!empty($certificate->right_sign) && file_exists($rp)): ?>
                                            <img src="<?php echo base_url('uploads/certificate/' . $certificate->right_sign); ?>" alt="">
                                        <?php else: ?>
                                            <span class="sign-placeholder"></span>
                                        <?php endif; ?>
                                        <h6><?php echo $certificate->right_footer; ?></h6>
                                    <?php endif; ?>
                                </div>

                            </div>
                            <?php endif; ?>

                        </div><!-- /.content -->
                    </div><!-- /.slip -->

                </div>
            </div>
        </div><!-- /.mark-container -->

        <?php if ($certificate->is_active_header_img == 0 && !empty($certificate->footer_height) && $certificate->footer_height != 0): ?>
            <div style="height:<?php echo (int)$certificate->footer_height; ?>px;"></div>
        <?php endif; ?>

    </div><!-- /.page-slot -->

<?php } ?>
</div><!-- /.page-wrapper -->

</body>
</html>
