<?php

namespace tests;


use PHPUnit\Framework\TestCase;
use WithState\states\HasQuarterState;

class HasQuarterStateTest extends TestCase
{
    private $gumBallMachine;

    public function testCurrentState()
    {
        $currState = new HasQuarterState($this->gumBallMachine);
        $this->assertEquals("waiting for turn of crank", $currState->toString());
    }

    public function testInsertQuarter()
    {
        $currState = new HasQuarterState($this->gumBallMachine);
        $this->expectOutputString("Quarter inserted. Quarter count 1\n");
        $currState->insertQuarter();
    }

    public function testTurnCrank()
    {
        $currState = new HasQuarterState($this->gumBallMachine);
        $this->expectOutputString("You turned...\nYou cannot return a quarter because you did not add it.\n");
        $currState->turnCrank();
    }

    public function testEjectQuarter()
    {
        $currState = new HasQuarterState($this->gumBallMachine);
        $this->expectOutputString("Returned 0 quarters\n");
        $currState->ejectQuarter();
    }

    public function testDispense()
    {
        $currState = new HasQuarterState($this->gumBallMachine);
        $this->expectOutputString("No gumball dispensed\n");
        $currState->dispense();
    }

    protected function setUp() : void
    {
        parent::setUp();
        $this->gumBallMachine = new GumBallMachineContextMock(14);
    }
}