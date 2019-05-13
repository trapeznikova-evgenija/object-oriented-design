<?php
    require_once 'vendor/autoload.php';

    $gbm = new \WithState\classes\GumBallMachine(2);
    $gbm->insertQuarter();
    $gbm->insertQuarter();
    $gbm->insertQuarter();
    $gbm->turnCrank();
    $gbm->turnCrank();
    $gbm->turnCrank();
    $gbm->ejectQuarter();