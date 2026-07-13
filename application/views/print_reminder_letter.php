<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Balance Due</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    background: #fff;
    font-size: 9px;
}

/* A4 */
@page {
    size: A4 portrait;
    margin: 6mm;
}

@media print {
    body { margin: 0; }
}

/* GRID: 2 columns */
.page-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 6px;
    width: 100%;
}

/* Each slip = 1/3 height */
.slip-wrap {
    height: calc(100vh / 3 - 10px);
    break-inside: avoid;
    page-break-inside: avoid;
}

/* CARD */
.slip {
    border: 1px solid #333;
    height: 100%;
    display: flex;
    flex-direction: column;
}

/* HEADER */
.slip-header img {
    width: 100%;
    height: auto;
}

/* CONTENT */
.slip-content {
    padding: 5px;
    flex: 1;
}

/* TITLE */
.title-row {
    display: flex;
    justify-content: space-between;
    font-weight: bold;
    border-bottom: 1px solid #ccc;
    margin-bottom: 4px;
}

/* INFO */
.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 5px;
}

.info-table td {
    font-size: 8px;
    padding: 1px;
}

/* MESSAGE */
.message {
    font-size: 8px;
    margin-top: 4px;
    border-top: 1px dashed #ccc;
    padding-top: 3px;
}

/* FOOTER */
.slip-footer {
    display: flex;
    justify-content: space-between;
    border-top: 1px solid #ccc;
    font-size: 8px;
    padding-top: 3px;
}

.signature-block img {
    height: 25px;
}
</style>
</head>

<body>

<div class="page-grid">

<?php
$count = 0;

foreach ($result as $val) {
    $count++;

    $old_balance = $net_balance = 0;
    $selected_months = '';

    if ($val['old_balc'] > 0) {
        $old_balance = (int)$val['old_balc'];
    }
    if ($val['fees_month_amount'] > 0 || $val['routes_month_amount'] > 0) {
        $net_balance = (int)($val['fees_month_amount'] ?? 0) + (int)($val['routes_month_amount'] ?? 0);
    }
    $arr1 = explode(',', $val['fees_month']);
	$arr2 = explode(',', $val['routes_month']);
	$common = array_intersect($arr1, $arr2);
	$selected_months = implode(',', $common);

    $replaceArr = [
        '[Old Balance]'   => $old_balance,
        '[Net Balance]'   => $net_balance,
        '[Total Balance]' => $net_balance+$old_balance,
        '[Selected Months]'  => $selected_months,
        '[Last Receipt Date]'  => $val['last_receipt_date'],
    ];

    $body = str_replace(array_keys($replaceArr), array_values($replaceArr), $val['description']);
?>

    <div class="slip-wrap">
        <div class="slip">

            <!-- HEADER -->
            <div class="slip-header">
                <?php if (!empty($val['header_image'])): ?>
                    <img src="<?php echo base_url('uploads/print_headerfooter/common_header/'.$val['header_image']); ?>">
                <?php endif; ?>
            </div>

            <div class="slip-content">

                <!-- TITLE -->
                <div class="title-row">
                    <span><?php echo $val['heading_title']; ?></span>
                    <?php if ($val['isdate']): ?>
                        <span><?php echo date('d-M-y', strtotime($val['date'])); ?></span>
                    <?php endif; ?>
                </div>

                <!-- INFO -->
                <div class="info-grid">
                    <table class="info-table">
                        <?php if ($val['isuid']): ?>
                        <tr><td>Adm:</td><td><strong><?php echo $val['uid_no']; ?></strong></td></tr>
                        <?php endif; ?>
                        <?php if ($val['isstudent']): ?>
                        <tr><td>Name:</td><td><strong><?php echo $val['student_name']; ?></strong></td></tr>
                        <?php endif; ?>
                        <?php if ($val['isfather']): ?>
                        <tr><td>Father:</td><td><strong><?php echo $val['father_name']; ?></strong></td></tr>
                        <?php endif; ?>
                    </table>

                    <table class="info-table">
                        <?php if ($val['isclass']): ?>
                        <tr><td>Class:</td><td><strong><?php echo $val['class']; ?></strong></td></tr>
                        <?php endif; ?>
                        <?php if ($val['isroute']): ?>
                        <tr><td>Route:</td><td><strong><?php echo $val['route']; ?></strong></td></tr>
                        <?php endif; ?>
                        <?php if ($val['isuphone']): ?>
                        <tr><td>Phone:</td><td><strong><?php echo $val['phone']; ?></strong></td></tr>
                        <?php endif; ?>
                    </table>
                </div>

                <!-- MESSAGE -->
                <div class="message">
                    <strong>Dear Parents,</strong><br>
                    <?php echo $body; ?>
                </div>

                <!-- FOOTER -->
                <div class="slip-footer">
                    <span>Thank You</span>

                    <?php if ($val['is_signature']): ?>
                    <div class="signature-block">
                        <?php
                        $sig = 'uploads/remind_letter/'.$val['signature'];
                        if (file_exists(FCPATH.$sig)):
                        ?>
                            <img src="<?php echo base_url($sig); ?>">
                        <?php endif; ?>
                        <div><?php echo $val['signature_title']; ?></div>
                    </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>

<?php
// ✅ PAGE BREAK AFTER 6
if ($count % 6 == 0) {
    echo '</div><div class="page-grid" style="page-break-after: always;">';
}
}
?>

</div>

</body>
</html>