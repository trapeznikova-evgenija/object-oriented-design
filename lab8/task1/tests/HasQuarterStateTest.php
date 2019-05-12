<?php

namespace tests;


use PHPUnit\Framework\TestCase;
use WithState\classes\GumBallMachine;
use WithState\states\HasQuarterState;

class HasQuarterStateTest extends TestCase
{
    private $gumBallMachine;

    public function testCurrentState()
    {
        $this->gumBallMachine = new GumBallMachine(12);
        $currState = new HasQuarterState($this->gumBallMachine);
        $this->assertEquals("waiting for turn of crank", $currState->toString());
    }

    public function testTurnCrank()
    {
        $this->gumBallMachine = new GumBallMachine(15);
        $currState = new HasQuarterState($this->gumBallMachine);
        $this->expectOutputString("You turned...\n");
        $currState->turnCrank();

    }

    public function testEjectQuarter()
    {
        $this->gumBallMachine = new GumBallMachine(15);
        $currState = new HasQuarterState($this->gumBallMachine);
        $this->expectOutputString("Quarter returned\n");
        $currState->ejectQuarter();
    }

    public function testDispense()
    {
        $this->gumBallMachine = new GumBallMachine(16);
        $currState = new HasQuarterState($this->gumBallMachine);
        $this->expectOutputString("No gumball dispensed\n");
        $currState->dispense();
    }

    public function testInsertQuarter()
    {
        $this->gumBallMachine = new GumBallMachine(16);
        $currState = new HasQuarterState($this->gumBallMachine);
        $this->expectOutputString("You can't insert another quarter\n");
        $currState->insertQuarter();
    }
}