<?php

namespace WithState\classes;

class GumBallMachine
{
    /* GumBallMachineContext */
    private $context;

    public function __construct($numBalls)
    {
        $this->context = new GumBallMachineContext($numBalls);
    }

    public function toString(): string
    {
        return $this->context->toString();
    }

    public function ejectQuarter()
    {
        $this->context->ejectQuarter();
    }

    public function insertQuarter()
    {
        $this->context->insertQuarter();
    }

    public function turnCrank()
    {
        $this->context->turnCrank();
    }

    public function releaseBall()
    {
        $this->context->releaseBall();
    }

    public function getBallCount() : int
    {
        return $this->context->getBallCount();
    }

    public function fillMachine(int $num) : void
    {
        $this->context->fillMachine($num);
    }
}