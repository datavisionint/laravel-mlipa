<?php


if (!function_exists("cleanPhone")) {
    function cleanPhone($phone): string
    {
        $phone = substr($phone, -9);
        return "255" . str()->of($phone)->replace(" ", "");
    }
}
