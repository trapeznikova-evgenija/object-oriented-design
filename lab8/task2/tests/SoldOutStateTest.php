<?php

namespace tests;


use PHPUnit\Framework\TestCase;
use WithState\classes\GumBallMachine;
use WithState\states\SoldOutState;

class SoldOutStateTest extends TestCase
{
    private $gumBallMachine;

    public function testCurrentState()
    {
        $this->gumBallMachine = new GumBallMachine(12);
        $currState = new SoldOutState($this->gumBallMachine);
        $this->assertEquals("sold out", $currState->toString());
    }

    public function testTurnCrank()
    {
        $this->gumBallMachine = new GumBallMachine(15);
        $currState = new SoldOutState($this->gumBallMachine);
        $this->expectOutputString("You turned but there's no gumballs\n");
        $currState->turnCrank();

    }

    public function testEjectQuarter()
    {
        $this->gumBallMachine = new GumBallMachine(15);
        $currState = new SoldOutState($this->gumBallMachine);
        $this->expectOutputString("You can't eject, you haven't inserted a quarter yet\n");
        $currState->ejectQuarter();
    }

    public function testDispense()
    {
        $this->gumBallMachine = new GumBallMachine(16);
        $currState = new SoldOutState($this->gumBallMachine);
        $this->expectOutputString("No gumball dispensed\n");
        $currState->dispense();
    }

    public function testInsertQuarter()
    {
        $this->gumBallMachine = new GumBallMachine(16);
        $currState = new SoldOutState($this->gumBallMachine);
        $this->expectOutputString("You can't insert a quarter, the machine is sold out\n");
        $currState->insertQuarter();
    }
}