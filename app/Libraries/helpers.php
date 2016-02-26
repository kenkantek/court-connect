<?php

function format_time(DateTime $timestamp, $format = 'j M Y H:i')
{
    $first = Carbon::create(0000, 0, 0, 00, 00, 00);
    if ($timestamp->lte($first)) {
        return '';
    }

    return $timestamp->format($format);
}

function date_from_database($time, $format = 'Y-m-d')
{
    return format_time(Carbon::parse($time), $format);
}
