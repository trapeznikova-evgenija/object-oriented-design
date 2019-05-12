<?php

namespace WithState\interfaces;

interface GumBallMachineInterface
{
    public function releaseBall();
    public function getBallCount();
    public function toString() : string;

    public function setSoldOutState(); //все шарики распроданы
    public function setNoQuarterState(); //состояние нет монетки
    public function setSoldState(); //выдача шарика
    public function setHasQuarterState(); //состояние есть монетка
}