<?php

use Carbon\Carbon;

function customTanggal($date, $format = 'd F Y')
{
    return date($format, strtotime($date));
}

function diffForHumans($date)
{
    // dd(now());
        $newDate = Carbon::createFromFormat('Y/m/d H:i:s', $date);
        $result = Carbon::createFromFormat('Y/m/d H:i:s', now())->diffForHumans($newDate);

        return $result;
}
