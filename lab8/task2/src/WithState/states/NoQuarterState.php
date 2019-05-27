<?php

namespace WithState\states;
use WithState\interfaces\StateInterface;
use WithState\interfaces\GumBallMachineContextInterface;

class NoQuarterState implements StateInterface
{
    private $gumBallMachine;
    private $quarterRegulator;

    public function __construct(GumBallMachineContextInterface $gumBallMachine)
    {
        $this->gumBallMachine = $gumBallMachine;
        $this->quarterRegulator = $this->gumBallMachine->getQuarterRegulator();
    }

    public function insertQuarter()
    {
        echo "You inserted a quarter\n";
        $this->quarterRegulator->incrementQuarterCounter();
        $this->gumBallMachine->setHasQuarterState();
    }

    public function ejectQuarter()
    {
        echo "You haven't inserted a quarter\n";
    }

    public function turnCrank()
    {
        echo "You turned but there's no quarter\n";
    }

    public function dispense()
    {
        echo "You need to pay first\n";
    }

    public function toString() : string
    {
        return "waiting for quarter";
    }
}