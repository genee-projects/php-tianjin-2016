<?php
/**
 *  Boolean 布尔类型
 *
 */

$foo = TRUE;
if ($foo) {
	echo 'this is true';
}
else {
	echo 'this is false';
}

/**
 * Integer 整型
 */

$a = 1234; // 十进制数
$a = -123; // 负数
$a = 0123; // 八进制数 (等于十进制 83)
$a = 0x1A; // 十六进制数 (等于十进制 26)
//32位 2^31-1 2147483647
//64位 2^63-1 9223372036854775807

// 浮点数
$a = 1.234;

/*
 * 字符串
 * 一个字符串 string 就是由一系列的字符组成，其中每个字符等同于一个字节。
 */

echo 'this is a simple string';


/*
 * Array 数组
 * PHP 中的数组实际上是一个有序映射。

	可以用 array() 语言结构来新建一个数组。它接受任意数量用逗号分隔的 键（key） => 值（value）对。

	array(  key =>  value
	     , ...
	     )
	键（key）可是是一个整数 integer 或字符串 string
	值（value）可以是任意类型的值
 */

$array = array(
    "foo" => "bar",
    "bar" => "foo",
);

// 自 PHP 5.4 起
$array = [
    "foo" => "bar",
    "bar" => "foo",
];


?>