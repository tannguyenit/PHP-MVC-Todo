<?php

function dd($obj)
{
    echo '<pre>';
    die(var_dump($obj));
    echo '</pre>';
}