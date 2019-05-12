<?php

namespace WithState\states;
use WithState\interfaces\StateInterface;
use WithState\interfaces\GumBallMachineInterface;

class SoldOutState implements StateInterface
{
    private $gumBallMachine;

    public function __construct(GumBallMachineInterface $gumBallMachine)
    {
        $this->gumBallMachine = $gumBallMachine;
    }

    public function insertQuarter()
    {
        echo "You can't insert a quarter, the machine is sold out\n";
    }

    public function ejectQuarter()
    {
        echo "You can't eject, you haven't inserted a quarter yet\n";
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
}