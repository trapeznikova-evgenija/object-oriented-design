<?php

namespace WithState\states;
use WithState\interfaces\StateInterface;
use WithState\interfaces\GumBallMachineInterface;

class SoldState implements StateInterface
{
    private $gumballMachine;

    public function __construct(GumBallMachineInterface $gumBallMachine)
    {
        $this->gumballMachine = $gumBallMachine;
    }

    public function insertQuarter()
    {
        echo "Please wait, we're already giving you a gumball\n";
    }

    public function ejectQuarter()
    {
        echo "Sorry you already turned the crank\n";
    }

    public function turnCrank()
    {
        echo "Turning twice doesn't get you another gumball\n";
    }

    public function dispense()
    {
        $this->gumballMachine->releaseBall();

        if ($this->gumballMachine->getBallCount() == 0)
        {
            echo "Oops, out of gumballs\n";
            $this->gumballMachine->setSoldOutState();
        }
        else
        {
            $this->gumballMachine->setNoQuarterState();
        }
    }

    public function toString() : string
    {
        return "delivering a gumball";
    }
}