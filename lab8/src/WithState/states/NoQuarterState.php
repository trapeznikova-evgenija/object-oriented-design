<?php

namespace WithState;

class NoQuarterState implements StateInterface
{
    private $gumBallMachine;

    public function __construct(GumBallMachineInterface $gumBallMachine)
    {
        $this->gumBallMachine = $gumBallMachine;
    }

    public function insertQuarter()
    {
        echo "You inserted a quarter\n";
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

    public function toString()
    {
        echo "waiting for quarter";
    }
}