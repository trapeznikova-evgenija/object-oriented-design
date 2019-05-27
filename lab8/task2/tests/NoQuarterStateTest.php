<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use WithState\states\NoQuarterState;

class NoQuarterStateTest extends TestCase
{
    private $gumBallMachine;

    public function testCurrentState()
    {
        $currState = new NoQuarterState($this->gumBallMachine);
        $this->assertEquals("waiting for quarter", $currState->toString());
    }

    public function testInsertQuarter()
    {
        $currState = new NoQuarterState($this->gumBallMachine);
        $this->expectOutputString("You inserted a quarter\nQuarter inserted. Quarter count 1\nSet Has Quarter State\n");
        $currState->insertQuarter();
    }

    public function testTurnCrank()
    {
        $currState = new NoQuarterState($this->gumBallMachine);
        $this->expectOutputString("You turned but there's no quarter\n");
        $currState->turnCrank();
    }

    public function testEjectQuarter()
    {
        $currState = new NoQuarterState($this->gumBallMachine);
        $this->expectOutputString("You haven't inserted a quarter\n");
        $currState->ejectQuarter();
    }

    public function testDispense()
    {
        $currState = new NoQuarterState($this->gumBallMachine);
        $this->expectOutputString("You need to pay first\n");
        $currState->dispense();
    }

    protected function setUp() : void
    {
        parent::setUp();
        $this->gumBallMachine = new GumBallMachineContextMock(0);
    }
}