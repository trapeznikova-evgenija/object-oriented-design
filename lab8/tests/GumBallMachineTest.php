<?php

namespace tests;


use PHPUnit\Framework\TestCase;
use WithState\classes\GumBallMachine;

class GumBallMachineTest extends TestCase
{
    public function testGumBallMachineOnEmpty()
    {
        $gbm = new GumBallMachine(0);
        $this->assertEquals(0, $gbm->getBallCount());
    }

    public function testCheckGettingGumAfterBuy()
    {
        $gbm = new GumBallMachine(3);
//        $gbm->insertQuarter();
//        $gbm->turnCrank();
//        $gbm->releaseBall();
        $this->assertEquals("Mighty Gumball, Inc.
                        PHP-enabled Standing Gumball Model #2019 (with state)
                        Inventory: 3 gumballs
                        Machine is %s", sprintf("Mighty Gumball, Inc.
                        PHP-enabled Standing Gumball Model #2019 (with state)
                        Inventory: sold out gumball
                        Machine is %s", 3, "sold out"));
    }

}