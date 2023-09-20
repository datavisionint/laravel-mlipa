<?php

if (!function_exists('cleanPhone')) {
    function cleanPhone($phone): string
    {
        $phone = substr($phone, -9);

        return '255' . str()->of($phone)->replace(' ', '');
    }
}


if (!function_exists("generateReference")) {
    function generateReference(): int
    {
        return round(microtime(true) * 1000) - 1695100000000;
    }
}
