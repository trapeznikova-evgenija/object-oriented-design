<?php

namespace WithState\interfaces;
use WithState\classes\QuarterRegulator;

interface GumBallMachineInterface
{
    public function releaseBall();
    public function getBallCount() : int;
    public function getQuarterRegulator() : QuarterRegulator;
    public function toString() : string;

    public function setSoldOutState(); //все шарики распроданы
    public function setNoQuarterState(); //состояние нет монетки
    public function setSoldState(); //выдача шарика
    public function setHasQuarterState(); //состояние есть монетка
}