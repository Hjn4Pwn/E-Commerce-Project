<?php

if (!function_exists('format_to_k')) {
    /**
     * Format số thành dạng K với một chữ số thập phân
     *
     * @param int $number
     * @return string
     */
    function format_to_k(int $number): string
    {
        if ($number >= 1000) {
            $formattedNumber = number_format($number / 1000, 1) . 'K';
        } else {
            $formattedNumber = (string) $number;
        }
        return $formattedNumber;
    }
}
