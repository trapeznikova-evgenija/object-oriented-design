<?php
    require_once 'vendor/autoload.php';

    $gbm = new \WithState\classes\GumBallMachine(3);
$gbm->insertQuarter();
$gbm->turnCrank();
$gbm->turnCrank();