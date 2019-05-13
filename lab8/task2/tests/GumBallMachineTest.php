<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use WithState\classes\GumBallMachine;

class GumBallMachineTest extends TestCase
{
    private $expectedFile;
    private $actualFile;

    public function testGumBallMachineOnEmpty()
    {
        $gbm = new GumBallMachine(0);
        $this->assertEquals(0, $gbm->getBallCount());
    }

    public function testCheckInsertingQuarters()
    {
        $gbm = new GumBallMachine(3);
        $instruction = function () use ($gbm) {
            $gbm->insertQuarter();
            $gbm->insertQuarter();
            $gbm->insertQuarter();
        };

        $expectedString = "You inserted a quarter\n";
        $expectedString .= "Quarter inserted. Quarter count 1\n";
        $expectedString .= "Quarter inserted. Quarter count 2\n";
        $expectedString .= "Quarter inserted. Quarter count 3\n";

        $this->expectOutputStringWitnMultipleOutput($instruction, $expectedString);
    }

    public function testInsertingMorePossibleQuarters()
    {
        $gbm = new GumBallMachine(4);
        $instruction = function () use ($gbm) {
            $gbm->insertQuarter();
            $gbm->insertQuarter();
            $gbm->insertQuarter();
            $gbm->insertQuarter();
            $gbm->insertQuarter();
            $gbm->insertQuarter();
        };

        $expectedString = "You inserted a quarter\n";
        $expectedString .= "Quarter inserted. Quarter count 1\n";
        $expectedString .= "Quarter inserted. Quarter count 2\n";
        $expectedString .= "Quarter inserted. Quarter count 3\n";
        $expectedString .= "Quarter inserted. Quarter count 4\n";
        $expectedString .= "Quarter inserted. Quarter count 5\n";
        $expectedString .= "GumBallMachine no longer accepting quarters\n";

        $this->expectOutputStringWitnMultipleOutput($instruction, $expectedString);
    }

    public function testGetQuartersWithSoldOutState()
    {
        $gbm = new GumBallMachine(2);
        $instruction = function () use ($gbm) {
            $gbm->insertQuarter();
            $gbm->insertQuarter();
            $gbm->insertQuarter();
            $gbm->insertQuarter();
            $gbm->turnCrank();
            $gbm->turnCrank();
            $gbm->turnCrank();
        };

        $expectedString = "You inserted a quarter\n";
        $expectedString .= "Quarter inserted. Quarter count 1\n";
        $expectedString .= "Quarter inserted. Quarter count 2\n";
        $expectedString .= "Quarter inserted. Quarter count 3\n";
        $expectedString .= "Quarter inserted. Quarter count 4\n";
        $expectedString .= "You turned...\n";
        $expectedString .= "A gumball comes rolling out the slot...\n";
        $expectedString .= "You turned...\n";
        $expectedString .= "A gumball comes rolling out the slot...\n";
        $expectedString .= "Oops, out of gumballs\n";
        $expectedString .= "You turned but there's no gumballs\n";
        $expectedString .= "No gumball dispensed\n";

        $this->expectOutputStringWitnMultipleOutput($instruction, $expectedString);
    }


    public function testCheckInfoAboutGM()
    {
        $gmb = new GumBallMachine(4);
        $gmb->insertQuarter();
        $actualString = $gmb->toString();
        $expectedString = "Mighty Gumball, Inc.\nPHP-enabled Standing Gumball Model #2019 (with state)\nInventory: 4 gumballs\nMachine is waiting for turn of crank";
        $this->assertEquals($expectedString, $actualString);
    }


    public function testEjectOneQuarter()
    {
        $gbm = new GumBallMachine(2);
        $instruction = function () use ($gbm)
        {
            $gbm->insertQuarter();
            $gbm->ejectQuarter();
        };

        $expectedString = "You inserted a quarter\n";
        $expectedString .= "Quarter inserted. Quarter count 1\n";
        $expectedString .= "Returned 1 quarter\n";

        $this->expectOutputStringWitnMultipleOutput($instruction, $expectedString);
    }

    public function testEjectAllInsertedQuarters()
    {
        $gbm = new GumBallMachine(2);
        $instruction = function () use ($gbm)
        {
            $gbm->insertQuarter();
            $gbm->insertQuarter();
            $gbm->insertQuarter();
            $gbm->insertQuarter();
            $gbm->ejectQuarter();
        };

        $expectedString = "You inserted a quarter\n";
        $expectedString .= "Quarter inserted. Quarter count 1\n";
        $expectedString .= "Quarter inserted. Quarter count 2\n";
        $expectedString .= "Quarter inserted. Quarter count 3\n";
        $expectedString .= "Quarter inserted. Quarter count 4\n";
        $expectedString .= "Returned 4 quarters\n";

        $this->expectOutputStringWitnMultipleOutput($instruction, $expectedString);
    }

    public function testEjectQuarterWhenNoQuarter()
    {
        $gbm = new GumBallMachine(3);
        $instruction = function () use ($gbm)
        {
            $gbm->setNoQuarterState();
            $gbm->ejectQuarter();
        };

        $expectedString = "You haven't inserted a quarter\n";
        $this->expectOutputStringWitnMultipleOutput($instruction, $expectedString);
    }

    public function testEjectQuarterWhenTurnCrank()
    {
        $gbm = new GumBallMachine(3);
        $instruction = function () use ($gbm)
        {
            $gbm->insertQuarter();
            $gbm->insertQuarter();
            $gbm->turnCrank();
            $gbm->ejectQuarter();
        };

        $expectedString = "You inserted a quarter\n";
        $expectedString .= "Quarter inserted. Quarter count 1\n";
        $expectedString .= "Quarter inserted. Quarter count 2\n";
        $expectedString .= "You turned...\n";
        $expectedString .= "A gumball comes rolling out the slot...\n";
        $expectedString .= "Returned 1 quarter\n";

        $this->expectOutputStringWitnMultipleOutput($instruction, $expectedString);
    }


    public function testAgainTurnCrankWhereSoldOutState()
    {
        $gmb = new GumBallMachine(1);
        $instructions = function () use ($gmb)
        {
            $gmb->insertQuarter();
            $gmb->turnCrank();
            $gmb->turnCrank();
        };

        $expectedString = "You inserted a quarter\n";
        $expectedString .= "Quarter inserted. Quarter count 1\n";
        $expectedString .= "You turned...\n";
        $expectedString .= "A gumball comes rolling out the slot...\n";
        $expectedString .= "Oops, out of gumballs\n";
        $expectedString .= "You turned but there's no gumballs\n";
        $expectedString .= "No gumball dispensed\n";

        $this->expectOutputStringWitnMultipleOutput($instructions, $expectedString);
    }

    public function testAgainTurnCrankWhereSoldState()
    {
        $gmb = new GumBallMachine(3);
        $instructions = function () use ($gmb)
        {
            $gmb->insertQuarter();
            $gmb->turnCrank();
            $gmb->turnCrank();
        };

        $expectedString = "You inserted a quarter\n";
        $expectedString .= "Quarter inserted. Quarter count 1\n";
        $expectedString .= "You turned...\n";
        $expectedString .= "A gumball comes rolling out the slot...\n";
        $expectedString .= "You turned but there's no quarter\n";
        $expectedString .= "You need to pay first\n";

        $this->expectOutputStringWitnMultipleOutput($instructions, $expectedString);
    }

    private function expectOutputStringWitnMultipleOutput(callable $callback, string $expectedString)
    {
        if (ob_start())
        {
            call_user_func($callback);
            $actualString = ob_get_contents();
            echo $actualString . PHP_EOL;
            echo $expectedString . PHP_EOL;
            ob_end_clean();
            file_put_contents($this->expectedFile, $expectedString);
            file_put_contents($this->actualFile, $actualString);
            $this->assertFileEquals($this->expectedFile, $this->actualFile);
        }
        else
        {
            echo "Не удалось включить буферизацию вывода";
        }
    }

    protected function setUp(): void
    {
        $this->expectedFile = "gm_" . uniqid() . '.txt';
        $this->actualFile = "gm_" . uniqid() . '.txt';
        parent::setUp();
    }

    protected function tearDown(): void
    {
        if (file_exists($this->expectedFile))
        {
            unlink($this->expectedFile);
        }

        if (file_exists($this->actualFile))
        {
            unlink($this->actualFile);
        }

        parent::tearDown();
    }
}