<?php

if (!function_exists('format_currency')) {
    /**
     * Format the given number as currency.
     *
     * @param  int  $amount
     * @return string
     */
    function format_currency($amount)
    {
        return number_format($amount, 0, ',', '.') . '₫';
    }
}
