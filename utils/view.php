<?php

function view(string $viewName, $context=[])
{
    extract($context);
    $filePath = str_replace('.', '/', $viewName);
    require "resources/views/{$filePath}.php";
}