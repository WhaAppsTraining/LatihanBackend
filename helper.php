<?php
function generate_key()
{
    return implode('-', str_split(substr(strtolower(md5(microtime() . rand(1000, 9999))), 0, 30), 6));
}

function print_json($array)
{
    header('Content-Type: application/json');
    echo json_encode($array);
}
