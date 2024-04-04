<?php

namespace App\Helpers;

class Helper {
    public static function formatVnd($number) {
        $trieu = floor($number / 1000000);
        $ngan = floor(($number % 1000000) / 1000);

        $result = '';
        if ($trieu > 0) {
            $result .= $trieu . 'Triệu';
        }
        if ($ngan > 0) {
            $result .= $ngan . 'k';
        }

        return $result ?: '0';
    }
}
