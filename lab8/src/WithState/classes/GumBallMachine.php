<?php

namespace WithState;

class GumBallMachine implements GumBallMachineInterface
{
    /* int */
    private $count;
    /* SoldState */
    private $soldState;
    /* SoldOutState */
    private $soldOutState;
    /* NoQuarterState */
    private $noQuarterState;
    /* HasQuarterState */
    private $hasQuarterState;
    /* StateInterface */
    private $state;

    public function __construct($numBalls)
    {
        $this->soldState = $this;
        $this->soldOutState = $this;
        $this->noQuarterState = $this;
        $this->hasQuarterState = $this;
        $this->state = $this->soldOutState;
        $this->count = $numBalls;

        if ($this->count > 0)
        {
            $this->state = $this->noQuarterState;
        }
    }
}