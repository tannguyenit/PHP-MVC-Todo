<?php

use Infrastructure\DotEnv\DotEnv;

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function env(string $key, $default = null) {
        static $variable;

        if ($variable === null) {
            $variable = (new DotEnv())->load();
        }

        return $variable->get($key) ?? $default;
    };
}

if (! function_exists('config')) {
    function config(string $key)
    {
        if (strpos($key, '.')) {
            $filePath = explode('.', $key);
            $data = require_once "config/{$filePath[0]}.php";

            return $data[$filePath[1]];
        } else {
            return require_once "config/{$key}.php";
        }
    }
}