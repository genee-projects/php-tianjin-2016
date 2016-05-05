<?php

function testTryCatch($success) {
    echo '$success = '. json_encode($success)."\n";
    try {
        if (!$success) {
            throw new Exception("我不正常啊!");
        }
        echo "我是正常的!!!\n";
    } catch (Exception $e) {
        printf("捕获了异常: %s\n", $e->getMessage());
    }
    echo "\n";
}

testTryCatch(true);
testTryCatch(false);