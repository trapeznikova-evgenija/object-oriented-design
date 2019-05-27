<?php

namespace tests;

use WithState\interfaces\GumBallMachineContextInterface;
use WithState\states\HasQuarterState;
use WithState\states\NoQuarterState;
use WithState\states\SoldOutState;
use WithState\states\SoldState;
use WithState\classes\QuarterRegulator;

class GumBallMachineContextMock implements GumBallMachineContextInterface
{
    /* int */
    private $ballsCount;
    /* QuarterRegulator */
    private $quarterRegulator;
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
        $this->quarterRegulator = new QuarterRegulator();
        $this->soldState = new SoldState($this);
        $this->soldOutState = new SoldOutState($this);
        $this->noQuarterState = new NoQuarterState($this);
        $this->hasQuarterState = new HasQuarterState($this);
        $this->state = $this->soldOutState;
        $this->ballsCount = $numBalls;

        if ($this->ballsCount > 0)
        {
            $this->state = $this->noQuarterState;
        }
    }

    public function toString(): string
    {
        $strTemplate = "Mighty Gumball, Inc.\nPHP-enabled Standing Gumball Model #2019 (with state)\nInventory: %d gumball%s\nMachine is %s";

        return sprintf($strTemplate, $this->ballsCount, ($this->ballsCount !== 1 ? "s" : ""), $this->state->toString());
    }

    public function ejectQuarter()
    {
        echo "Eject Quarter" . PHP_EOL;
    }

    public function insertQuarter()
    {
        echo "Insert Quarter" . PHP_EOL;
    }

    public function turnCrank()
    {
       echo "Turn Crank" . PHP_EOL;
    }

    public function releaseBall()
    {
        if ($this->ballsCount !== 0)
        {
            echo "A gumball comes rolling out the slot...\n";
            --$this->ballsCount;
        }
    }

    public function getBallCount() : int
    {
        return $this->ballsCount;
    }

    public function setSoldState()
    {
        echo "Set Sold State" . PHP_EOL;
    }

    public function setHasQuarterState()
    {
        echo "Set Has Quarter State" . PHP_EOL;
    }

    public function setNoQuarterState()
    {
        echo "Set NoQuarter State" . PHP_EOL;
    }

    public function setSoldOutState()
    {
        echo "Set Sold Out State" . PHP_EOL;
    }

    public function getQuarterRegulator() : QuarterRegulator
    {
        return $this->quarterRegulator;
    }

    public function setNumBalls(int $num) : void
    {
        $this->ballsCount = $num + $this->ballsCount;
    }
    public function fillMachine(int $num)
    {
        $this->state->fillMachine($num);
    }
}