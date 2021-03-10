<?php

if (!function_exists('sql_date_to_format')) {
    function sql_date_to_format($date, $format) {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format($format);
    }
}
