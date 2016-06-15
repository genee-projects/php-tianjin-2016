<?php

// If we're running under `php -S` with PHP 5.4.0+

$_SERVER['SYS_PATH'] = __DIR__;

include __DIR__ . '/index.php';