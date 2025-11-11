<?php
function number_to_words($number) {
    if (!class_exists('NumberFormatter')) {
        return 'Intl extension not enabled.';
    }

    $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
    return ucwords($f->format($number));
}
 