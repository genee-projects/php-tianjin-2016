<?php

$data = file_get_contents('./data.json');
echo $data;

$json = json_decode($data, true);
echo '<pre>' . print_r($json, true) . '</pre>';
