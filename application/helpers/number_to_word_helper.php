<?php
function number_to_words($number) {
    if (!class_exists('NumberFormatter')) {
        return 'Intl extension not enabled.';
    }

    $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
    return ucwords($f->format($number));
}

function numberToWords($number)
{
    $no = floor($number);
    $point = round($number - $no, 2) * 100;

    $words = array(
        0 => '', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four',
        5 => 'Five', 6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen',
        14 => 'Fourteen', 15 => 'Fifteen', 16 => 'Sixteen',
        17 => 'Seventeen', 18 => 'Eighteen', 19 => 'Nineteen',
        20 => 'Twenty', 30 => 'Thirty', 40 => 'Forty',
        50 => 'Fifty', 60 => 'Sixty', 70 => 'Seventy',
        80 => 'Eighty', 90 => 'Ninety'
    );

    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
    $str = array();

    $i = 0;
    while ($no > 0) {
        $divider = ($i == 2) ? 10 : 100;
        $number_part = $no % $divider;
        $no = floor($no / $divider);
        $i += ($divider == 10) ? 1 : 2;

        if ($number_part) {
            $plural = (($counter = count($str)) && $number_part > 9) ? '' : '';
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : '';

            if ($number_part < 21) {
                $str [] = $words[$number_part] . " " . $digits[$counter] . $plural . " " . $hundred;
            } else {
                $str [] = $words[floor($number_part / 10) * 10]
                        . " " . $words[$number_part % 10] . " "
                        . $digits[$counter] . $plural . " " . $hundred;
            }
        } else {
            $str[] = null;
        }
    }

    $str = array_reverse($str);
    $result = implode('', $str);

    $points = ($point) ? "and " . $words[$point / 10] . " " . $words[$point % 10] . " Paise" : '';

    return $result . "Rupees " . $points;
}
 