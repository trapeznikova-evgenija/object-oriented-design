<?php

class SoldOutState implements StateInterface
{
    private $gumBallMachine;

    public function __construct(GumBallMachineInterface $gumBallMachine)
    {
        $this->gumBallMachine = $gumBallMachine;
    }

    public function insertQuarter()
    {
        // TODO: Implement insertQuarter() method.
    }

    public function ejectQuarter()
    {
        // TODO: Implement ejectQuarter() method.
    }

    public function turnCrank()
    {
        // TODO: Implement turnCrank() method.
    }

    public function dispense()
    {
        // TODO: Implement dispense() method.
    }

    public function toString()
    {
        // TODO: Implement toString() method.
    }
}