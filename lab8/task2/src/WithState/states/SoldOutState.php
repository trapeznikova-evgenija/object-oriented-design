<?php

namespace WithState\states;
use WithState\interfaces\StateInterface;
use WithState\interfaces\GumBallMachineContextInterface;

class SoldOutState implements StateInterface
{
    private $gumBallMachine;

    public function __construct(GumBallMachineContextInterface $gumBallMachine)
    {
        $this->gumBallMachine = $gumBallMachine;
    }

    public function insertQuarter()
    {
        echo "You can't insert a quarter, the machine is sold out\n";
    }

    public function ejectQuarter()
    {
        if ($this->gumBallMachine->getQuarterRegulator()->getQuarterCounter() == 0)
        {
            echo "You can't eject, you haven't inserted a quarter yet\n";
        }
        else
        {
            $this->gumBallMachine->getQuarterRegulator()->returnQuarter();
        }
    }

    public function turnCrank()
    {
        echo "You turned but there's no gumballs\n";
    }

    public function dispense()
    {
        echo "No gumball dispensed\n";
    }

    public function toString() : string
    {
        return "sold out";
    }

    public function fillMachine(int $num): void
    {
        if ($num == 0)
        {
            return;
        }

        $this->gumBallMachine->setNumBalls($num);

        if ($this->gumBallMachine->getQuarterRegulator()->getQuarterCounter() != 0)
        {
            $this->gumBallMachine->setHasQuarterState();
        }
        else
        {
            $this->gumBallMachine->setNoQuarterState();
        }
    }
}