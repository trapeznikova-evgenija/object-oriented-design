<?php

namespace WithState\states;
use WithState\interfaces\StateInterface;
use WithState\interfaces\GumBallMachineContextInterface;

class NoQuarterState implements StateInterface
{
    private $gumBallMachine;

    public function __construct(GumBallMachineContextInterface $gumBallMachine)
    {
        $this->gumBallMachine = $gumBallMachine;
    }

    public function insertQuarter()
    {
        echo "You inserted a quarter\n";
        $this->gumBallMachine->getQuarterRegulator()->incrementQuarterCounter();
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

    public function fillMachine(int $num): void
    {
        if ($num == 0)
        {
            $this->gumBallMachine->setSoldOutState();
        }

        $this->gumBallMachine->setNumBalls($num);
    }
}