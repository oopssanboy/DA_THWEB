<?php

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/views/client/auth/getclient_google.php';
spl_autoload_register(function ($class) {
    $path = __DIR__. '/model/' . $class . '.class.php';
    if (file_exists($path)) {
        require_once $path;
    }
});
?>