<?php

namespace WithState\classes;
use WithState\interfaces\GumBallMachineInterface;
use WithState\states\HasQuarterState;
use WithState\states\NoQuarterState;
use WithState\states\SoldOutState;
use WithState\states\SoldState;

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
        $this->soldState = new SoldState($this);
        $this->soldOutState = new SoldOutState($this);
        $this->noQuarterState = new NoQuarterState($this);
        $this->hasQuarterState = new HasQuarterState($this);
        $this->state = $this->soldOutState;
        $this->count = $numBalls;

        if ($this->count > 0)
        {
            $this->state = $this->noQuarterState;
        }
    }

    public function toString(): string
    {
        $strTemplate = "Mighty Gumball, Inc.\nPHP-enabled Standing Gumball Model #2019 (with state)\nInventory: %d gumball%s\nMachine is %s";

        return sprintf($strTemplate, $this->count, ($this->count !== 1 ? "s" : ""), $this->state->toString());
    }

    public function ejectQuarter()
    {
        $this->state->ejectQuarter();
    }

    public function insertQuarter()
    {
        $this->state->insertQuarter();
    }

    public function turnCrank()
    {
        $this->state->turnCrank();
        $this->state->dispense();
    }

    public function releaseBall()
    {
        if ($this->count !== 0)
        {
            echo "A gumball comes rolling out the slot...\n";
            --$this->count;
        }
    }

    public function getBallCount()
    {
        return $this->count;
    }

    public function setSoldState()
    {
        $this->state = $this->soldState;
    }

    public function setHasQuarterState()
    {
       $this->state = $this->hasQuarterState;
    }

    public function setNoQuarterState()
    {
        $this->state = $this->noQuarterState;
    }

    public function setSoldOutState()
    {
       $this->state = $this->soldOutState;
    }
}