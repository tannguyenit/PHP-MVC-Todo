<?php

function json_response(int $code = 200, array $data = null)
{
    http_response_code($code);
    echo json_encode($data);

    exit();
}
