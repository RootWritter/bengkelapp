<?php

use App\Models\Config;

if (!function_exists('get_config')) {
    function get_config($name)
    {
        $data = Config::where('name', $name)->first();
        return empty($data) ? "" : $data->value;
    }
}
