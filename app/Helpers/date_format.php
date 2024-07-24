<?php

use Carbon\Carbon;

if (!function_exists('format_date_to_ho_chi_minh_timezone')) {
    /**
     * Format date to Asia/Ho_Chi_Minh timezone and format it
     *
     * @param string $date
     * @return string
     */
    function format_date_to_ho_chi_minh_timezone($date)
    {
        return Carbon::parse($date)->setTimezone('Asia/Ho_Chi_Minh')->format('H:i:s d/m/Y');
    }
}
