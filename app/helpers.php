<?php

use App\Models\Config;

if (!function_exists('get_config')) {
    function get_config($name)
    {
        $data = Config::where('name', $name)->first();
        return empty($data) ? "" : $data->value;
    }
}
if (!function_exists('rupiah')) {
    function rupiah($angka)
    {
        $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
        return $hasil_rupiah;
    }
}
