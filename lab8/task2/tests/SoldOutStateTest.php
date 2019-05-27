<?php

namespace tests;


use PHPUnit\Framework\TestCase;
use WithState\classes\GumBallMachine;
use WithState\states\SoldOutState;
use WithState\states\SoldState;

class SoldOutStateTest extends TestCase
{
    private $gumBallMachine;

    public function testCurrentState()
    {
        $currState = new SoldOutState($this->gumBallMachine);
        $this->assertEquals("sold out", $currState->toString());
    }

    public function testTurnCrank()
    {
        $currState = new SoldOutState($this->gumBallMachine);
        $this->expectOutputString("You turned but there's no gumballs\n");
        $currState->turnCrank();
    }

    public function testEjectQuarter()
    {
        $currState = new SoldOutState($this->gumBallMachine);
        $this->expectOutputString("You can't eject, you haven't inserted a quarter yet\n");
        $currState->ejectQuarter();
    }

    public function testDispense()
    {
        $currState = new SoldOutState($this->gumBallMachine);
        $this->expectOutputString("No gumball dispensed\n");
        $currState->dispense();
    }

    public function testInsertQuarter()
    {
        $currState = new SoldOutState($this->gumBallMachine);
        $this->expectOutputString("You can't insert a quarter, the machine is sold out\n");
        $currState->insertQuarter();
    }

    protected function setUp() : void
    {
        parent::setUp();
        $this->gumBallMachine = new GumBallMachineContextMock(0);
    }
}