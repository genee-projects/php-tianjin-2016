<?php
header("Content-Type: text/html; charset=UTF-8");

$db = new PDO('mysql:host=localhost;port=3306;dbname=blog', 'root', '');
$db->exec('SET CHARACTER SET urf8');
$result = $db->query("insert into user (first,last,`user`) values ('Mark', 'Otto', '@mdo')");

unset($db);