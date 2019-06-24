<?php
    require_once 'vendor/autoload.php';
    define('ROOT_DIR', __DIR__);

    use application\Application;

    $app = new Application();
    $app->run();