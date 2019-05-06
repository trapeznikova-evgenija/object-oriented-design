<?php

namespace tests;


use function foo\func;
use PHPUnit\Framework\TestCase;
use WithState\classes\GumBallMachine;

class GumBallMachineTest extends TestCase
{
    private $outFile1;
    private $outFile2;

    public function testGumBallMachineOnEmpty()
    {
        $gbm = new GumBallMachine(0);
        $this->assertEquals(0, $gbm->getBallCount());
    }

    public function testCheckGettingGumAfterBuy()
    {
        $gbm = new GumBallMachine(3);
        $insctruction = function () use ($gbm)
        {
            $gbm->insertQuarter();
            $gbm->turnCrank();
            $gbm->releaseBall();
        };
        $expectedString = "";
        $this->expectOutputStringWitnMultipleOutput($insctruction, $expectedString);

//        $gbm->toString();
//        $this->expectOutputString("Mighty Gumball, Inc.
//                        PHP-enabled Standing Gumball Model #2019 (with state)
//                        Inventory: 3 gumballs
//                        Machine is sold out");

    }

    private function expectOutputStringWitnMultipleOutput(callable $callback, string $expectedString)
    {
        if (ob_start())
        {

        }
        else
        {
            echo "Не удалось включить буферизацию вывода";
        }
    }

    protected function setUp(): void
    {
        $this->outFile1 = "gm_" . uniqid() . '.txt';
        $this->outFile2 = "gm_" . uniqid() . '.txt';
        parent::setUp();
    }

    protected function tearDown(): void
    {
        if (file_exists($this->outFile1))
        {
            unlink($this->outFile1);
        }

        if (file_exists($this->outFile2))
        {
            unlink($this->outFile2);
        }

        parent::tearDown();
    }
}