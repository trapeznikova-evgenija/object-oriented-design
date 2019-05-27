<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use WithState\states\SoldState;

class SoldStateTest extends TestCase
{
    private $gumBallMachine;

    public function testCurrentState()
    {
        $currState = new SoldState($this->gumBallMachine);
        $this->assertEquals("delivering a gumball", $currState->toString());
    }

    public function testTurnCrank()
    {
        $currState = new SoldState($this->gumBallMachine);
        $this->expectOutputString("Turning twice doesn't get you another gumball\n");
        $currState->turnCrank();

    }

    public function testEjectQuarter()
    {
        $currState = new SoldState($this->gumBallMachine);
        $this->expectOutputString("Sorry you already turned the crank\n");
        $currState->ejectQuarter();
    }

    public function testInsertQuarter()
    {
        $currState = new SoldState($this->gumBallMachine);
        $this->expectOutputString("Please wait, we're already giving you a gumball\n");
        $currState->insertQuarter();
    }

    public function testFillMachine()
    {
        $currState = new SoldState($this->gumBallMachine);
        $currState->fillMachine(2);
        $this->expectOutputString("Can not fill the machine gum balls\n");
    }

    protected function setUp() : void
    {
        parent::setUp();
        $this->gumBallMachine = new GumBallMachineContextMock(2);
    }
}