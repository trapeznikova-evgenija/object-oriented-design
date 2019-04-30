<?php

namespace WithState\states;
use WithState\interfaces\StateInterface;
use WithState\interfaces\GumBallMachineInterface;

class HasQuarterState implements StateInterface
{
    private $gumBallMachine;

    public function __construct(GumBallMachineInterface $gumBallMachine)
    {
        $this->gumBallMachine = $gumBallMachine;
    }

    public function insertQuarter()
    {
        echo "You can't insert another quarter\n";
    }

    public function ejectQuarter()
    {
        echo "Quarter returned\n";
        $this->gumBallMachine->setNoQuarterState();
    }

    public function turnCrank()
    {
        echo "You turned...\n";
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