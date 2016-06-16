<?php
header("Content-Type: text/html; charset=UTF-8");

$data = file_get_contents('./data.json');
$json = json_decode($data, true);
echo print_r($json, true);
