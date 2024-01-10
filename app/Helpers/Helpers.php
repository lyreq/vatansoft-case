<?php

if (!function_exists('format_phone')) {
    function format_phone($value)
    {
        $value = str_replace(" ", "", $value);
        $value = str_replace("+", "", $value);
        $value = str_replace("(", "", $value);
        $value = str_replace(")", "", $value);
        $value = str_replace("-", "", $value);
        $value = str_replace(".", "", $value);

        return $value;
    }
}
