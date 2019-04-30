<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use WithState\classes\GumBallMachine;
use WithState\states\NoQuarterState;

class NoQuarterStateTest extends TestCase
{
    private $gumBallMachine;

    public function testCurrentState()
    {
        $this->gumBallMachine = new GumBallMachine(12);
        $currState = new NoQuarterState($this->gumBallMachine);
        $this->assertEquals("waiting for quarter", $currState->toString());
    }

    public function testTurnCrank()
    {
        $this->gumBallMachine = new GumBallMachine(15);
        $currState = new NoQuarterState($this->gumBallMachine);
        $this->expectOutputString("You turned but there's no quarter\n");
        $currState->turnCrank();

    }

    public function testEjectQuarter()
    {
        $this->gumBallMachine = new GumBallMachine(15);
        $currState = new NoQuarterState($this->gumBallMachine);
        $this->expectOutputString("You haven't inserted a quarter\n");
        $currState->ejectQuarter();
    }

    public function testDispense()
    {
        $this->gumBallMachine = new GumBallMachine(16);
        $currState = new NoQuarterState($this->gumBallMachine);
        $this->expectOutputString("You need to pay first\n");
        $currState->dispense();
    }

    public function testInsertQuarter()
    {
        $this->gumBallMachine = new GumBallMachine(16);
        $currState = new NoQuarterState($this->gumBallMachine);
        $this->expectOutputString("You inserted a quarter\n");
        $currState->insertQuarter();
    }
}