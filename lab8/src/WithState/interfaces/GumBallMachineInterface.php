<?php

namespace WithState;

interface GumBallMachineInterface
{
    public function releaseBall();
    public function getBallCount();

    public function setSoldOutState(); //все шарики распроданы
    public function setNoQuarterState(); //состояние нет монетки
    public function setSoldState(); //выдача шарика
    public function setHasQuarterState(); //состояние есть монетка

}