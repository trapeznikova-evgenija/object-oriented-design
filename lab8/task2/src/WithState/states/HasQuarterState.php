<?php

namespace WithState\states;
use WithState\interfaces\StateInterface;
use WithState\interfaces\GumBallMachineContextInterface;

class HasQuarterState implements StateInterface
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
        $this->quarterRegulator->incrementQuarterCounter();
    }

    public function ejectQuarter()
    {
        $this->quarterRegulator->returnQuarter();
        $this->gumBallMachine->setNoQuarterState();
    }

    public function turnCrank()
    {
        echo "You turned...\n";
        $this->quarterRegulator->decrementQuarterCounter();
        $this->gumBallMachine->setSoldState();

    }

    public function dispense()
    {
        echo "No gumball dispensed\n";
    }

    public function toString() : string
    {
        return "waiting for turn of crank";
    }
}