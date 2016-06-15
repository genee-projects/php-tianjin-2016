<?php
header("Content-Type: text/html; charset=UTF-8");

$db = new PDO('mysql:host=localhost;port=3306;dbname=blog', 'root', '');
$db->exec('SET CHARACTER SET urf8');
$result = $db->query('SELECT * FROM `user`');

$row = $result->fetch();

while (!empty($row)) {
	echo "名字: " . $row['first'] . "<br>";
	$row = $result->fetch();
}

unset($db);
