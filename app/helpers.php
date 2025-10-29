<?php

if (!function_exists('hour_format')) {
    function hour_format(int $minutes, $format = 'G:i'): string
    {
        $date = \Carbon\Carbon::today()->setMinutes($minutes);

        return $date->format($format);
    }
}
