<?php

class Vars {

    public static function weakTyping() {
        echo "弱类型\n----------------\n";
        $a = '1';
        $b = 2;

        printf("运算一下: %s + %d = %d\n", $a, $b, $a + $b);
        echo "\n";
    }

    public static function singleOrDouble() {
        echo "变量单双引号都支持\n----------------\n";

        $single = 'Hello';
        $double = "world";

        printf("'%s', \"%s\"\n", $single, $double);
        
        echo "\n";
    }

    public static function stringExpression() {
        echo "我们可以这样操作字符串\n----------------\n";

        $a = 'Hello';
        $b = "world";

        echo '$a . $b ' . "will be '$a" . ', ' . $b . "'\n";
        
        echo "\n";
    }

    public static function variousTypes() {
        
        echo "多种变量类型:\n----------------\n";

        $a = true;
        echo '$a = ' . json_encode($a, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)."\n";
        echo "\n";

        $b = [ 1, 2, 'Hello'];

        echo '$b = ' . json_encode($b, JSON_UNESCAPED_UNICODE);
        echo "\n";

        echo '$b[0] = ' . $b[0] . "\n";
        echo '$b[2] = ' . $b[2] . "\n";
        echo "\n";

        $c = [
            'apple' => '苹果',
            'orange' => '橘子',
        ];
        
        echo '$c = ' . json_encode($c, JSON_UNESCAPED_UNICODE)."\n";
        echo '$c[\'apple\'] = ' . $c['apple'] . "\n";
        echo '$c[\'orange\'] = ' . $c['orange'] . "\n";
        echo "\n";

        $d = (object) $c;
        
        echo '$d = (object) $c'."\n";
        echo '$d->apple = ' . $d->apple . "\n";
        echo '$d->orange = ' . $d->orange . "\n";
        echo "\n";
    }

}

Vars::weakTyping();
Vars::singleOrDouble();
Vars::stringExpression();
Vars::variousTypes();
