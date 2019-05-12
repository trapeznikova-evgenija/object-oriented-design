<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use WithState\classes\GumBallMachine;
use WithState\states\SoldState;

class SoldStateTest extends TestCase
{
    private $gumBallMachine;

    public function testCurrentState()
    {
        $this->gumBallMachine = new GumBallMachine(12);
        $currState = new SoldState($this->gumBallMachine);
        $this->assertEquals("delivering a gumball", $currState->toString());
    }

    public function testTurnCrank()
    {
        $this->gumBallMachine = new GumBallMachine(15);
        $currState = new SoldState($this->gumBallMachine);
        $this->expectOutputString("Turning twice doesn't get you another gumball\n");
        $currState->turnCrank();

    }

    public function testEjectQuarter()
    {
        $this->gumBallMachine = new GumBallMachine(15);
        $currState = new SoldState($this->gumBallMachine);
        $this->expectOutputString("Sorry you already turned the crank\n");
        $currState->ejectQuarter();
    }

    public function testDispenseWithEmptyGumBallMachine()
    {
        $this->gumBallMachine = new GumBallMachine(0);
        $currState = new SoldState($this->gumBallMachine);
        $this->expectOutputString("Oops, out of gumballs\n");
        $currState->dispense();
    }

    public function testInsertQuarter()
    {
        $this->gumBallMachine = new GumBallMachine(16);
        $currState = new SoldState($this->gumBallMachine);
        $this->expectOutputString("Please wait, we're already giving you a gumball\n");
        $currState->insertQuarter();
    }
}