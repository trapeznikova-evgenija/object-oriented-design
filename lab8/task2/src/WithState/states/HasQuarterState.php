<?php

namespace WithState\states;
use WithState\interfaces\StateInterface;
use WithState\interfaces\GumBallMachineContextInterface;

class HasQuarterState implements StateInterface
{
    private $gumBallMachine;

    public function __construct(GumBallMachineContextInterface $gumBallMachine)
    {
        $this->gumBallMachine = $gumBallMachine;
    }

    public function insertQuarter()
    {
        $this->gumBallMachine->getQuarterRegulator()->incrementQuarterCounter();
    }

    public function ejectQuarter()
    {
        $this->gumBallMachine->getQuarterRegulator()->returnQuarter();
        $this->gumBallMachine->setNoQuarterState();
    }

    public function turnCrank()
    {
        echo "You turned...\n";
        $this->gumBallMachine->getQuarterRegulator()->decrementQuarterCounter();
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

    public function fillMachine(int $num) : void
    {
        if ($num == 0)
        {
            $this->gumBallMachine->setSoldOutState();
        }

        $this->gumBallMachine->setNumBalls($num);
    }
}