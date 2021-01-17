<?php

function config(string $key)
{
    if (strpos($key, '.')) {
        $filePath = explode('.', $key);
        $data = require "config/{$filePath[0]}.php";

        return $data[$filePath[1]];
    } else {
        return require "config/{$key}.php";
    }
}