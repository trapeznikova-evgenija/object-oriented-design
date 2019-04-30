<?php
    require_once 'vendor/autoload.php';

    $gm = new \WithState\GumBallMachine(12);
    $state = new \WithState\HasQuarterState($gm);

    echo $state->toString();