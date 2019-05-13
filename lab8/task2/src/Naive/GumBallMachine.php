<?php

namespace Naive;

class GumBallMachine
{
    /* int */
    private $ballsCount;
    /* State */
    private $state;

    public function __construct(int $ballsCount)
    {
        $this->ballsCount = $ballsCount;
        $this->state = ($ballsCount > 0) ? State::$noQuarter : State::$soldOut;
    }

    public function insertQuarter()
    {
        switch ($this->state)
        {
            case State::$soldOut:
                echo "You can't insert a quarter, the machine is sold out\n";
                break;
            case State::$sold:
                echo "Please wait, we're already giving you a gumball\n";
                break;
            case State::$hasQuarter:
                echo "You can't insert another quarter\n";
                break;
            case State::$noQuarter:
                echo "You inserted a quarter\n";
                $this->state = State::$hasQuarter;
                break;
        }
    }

    public function ejectQuarter()
    {
        switch ($this->state)
        {
            case State::$soldOut:
                echo "You can't eject, you haven't inserted a quarter yet\n";
                break;
            case State::$sold:
                echo "Sorry you already turned the crank\n";
                break;
            case State::$hasQuarter:
                echo "Quarter returned\n";
                $this->state = State::$noQuarter;
                break;
            case State::$noQuarter:
                echo "You haven't inserted a quarter\n";
                break;
        }
    }

    public function turnCrank()
    {
        switch ($this->state)
        {
            case State::$soldOut:
                echo "You turned but there's no gumballs\n";
                break;
            case State::$sold:
                echo "Turning twice doesn't get you another gumball\n";
                break;
            case State::$hasQuarter:
                echo "You turned...\n";
                $this->state = State::$sold;
                break;
            case State::$noQuarter:
                echo "You turned but there's no quarter\n";
                break;
        }
    }

    public function refill(int $ballsCount)
    {
        $this->ballsCount = $ballsCount;
        $this->state = ($ballsCount > 0) ? State::$noQuarter : State::$soldOut;
    }

//    public function toString()
//    {
//        $state = ($this->state == State::$soldOut) ? "sold out" :
//            ($this->state == State::$noQuarter) ? "waiting for quarter" :
//                ($this)
//    }
}