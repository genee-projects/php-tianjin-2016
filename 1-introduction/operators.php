<?php
/*
 * 运算符
 */

/*
算术运算符
-$a 		取反 	$a 的负值。
$a + $b 	加法 	$a 和 $b 的和。
$a - $b 	减法 	$a 和 $b 的差。
$a * $b 	乘法 	$a 和 $b 的积。
$a / $b 	除法 	$a 除以 $b 的商。
$a % $b 	取余数 	$a 除以 $b 的余数。
*/

// 赋值运算符

$a = 3;
$a += 5; // sets $a to 8, as if we had said: $a = $a + 5;
$b = "Hello ";
$b .= "There!"; // sets $b to "Hello There!", just like $b = $b . "There!";


/**
 * 比较运算符
 * $a == $b 	等于 	TRUE，如果类型转换后 $a 等于 $b。
 * $a === $b 	全等 	TRUE，如果 $a 等于 $b，并且它们的类型也相同。
 * $a != $b 	不等 	TRUE，如果类型转换后 $a 不等于 $b。
 * $a <> $b 	不等 	TRUE，如果类型转换后 $a 不等于 $b。
 * $a !== $b 	不全等 	TRUE，如果 $a 不等于 $b，或者它们的类型不同。
 * $a < $b 	小与 	TRUE，如果 $a 严格小于 $b。
 * $a > $b 	大于 	TRUE，如果 $a 严格大于 $b。
 * $a <= $b 	小于等于 	TRUE，如果 $a 小于或者等于 $b。
 * $a >= $b 	大于等于 	TRUE，如果 $a 大于或者等于 $b。
 */

/*
 * 递增／递减运算符
 * ++$a 	前加 	$a 的值加一，然后返回 $a。
 * $a++ 	后加 	返回 $a，然后将 $a 的值加一。
 * --$a 	前减 	$a 的值减一， 然后返回 $a。
 * $a-- 	后减 	返回 $a，然后将 $a 的值减一。
 */

echo "<h3>Postincrement</h3>";
$a = 5;
echo "Should be 5: " . $a++ . "<br />\n";
echo "Should be 6: " . $a . "<br />\n";

echo "<h3>Preincrement</h3>";
$a = 5;
echo "Should be 6: " . ++$a . "<br />\n";
echo "Should be 6: " . $a . "<br />\n";

echo "<h3>Postdecrement</h3>";
$a = 5;
echo "Should be 5: " . $a-- . "<br />\n";
echo "Should be 4: " . $a . "<br />\n";

echo "<h3>Predecrement</h3>";
$a = 5;
echo "Should be 4: " . --$a . "<br />\n";
echo "Should be 4: " . $a . "<br />\n";



/*
 * 逻辑运算符
 * $a and $b 	And（逻辑与） 	TRUE，如果 $a 和 $b 都为 TRUE。
 * $a or $b 	Or（逻辑或） 	TRUE，如果 $a 或 $b 任一为 TRUE。
 * $a xor $b 	Xor（逻辑异或） 	TRUE，如果 $a 或 $b 任一为 TRUE，但不同时是。
 * ! $a 	Not（逻辑非） 	TRUE，如果 $a 不为 TRUE。
 * $a && $b 	And（逻辑与） 	TRUE，如果 $a 和 $b 都为 TRUE。
 * $a || $b 	Or（逻辑或） 	TRUE，如果 $a 或 $b 任一为 TRUE。
 */