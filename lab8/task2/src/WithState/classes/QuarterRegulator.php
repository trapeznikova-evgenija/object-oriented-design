<?php

namespace WithState\classes;


class QuarterRegulator
{
    private $quarterCounter;

    public function __construct()
    {
        $this->setToZeroQuarterCounter();
    }

    public function getQuarterCounter(): int
    {
        return $this->quarterCounter;
    }

    public function returnQuarter()
    {
        if (self::getQuarterCounter() >= 0)
        {
            $strTemplate = "Returned " . self::getQuarterCounter() . "quarter%s";
            $suffix = (self::getQuarterCounter() != 1) ? "s" : "";
            $strTemplate = sprintf($strTemplate, $suffix);
            self::setToZeroQuarterCounter();
            echo $strTemplate . PHP_EOL;
        }
    }

    public function incrementQuarterCounter()
    {
        if ($this->getQuarterCounter() < 5) {
            echo "Quarter inserted. Quarter count " . $this->getQuarterCounter();
            $this->quarterCounter++;
        } else {
            echo "GumBallMachine no longer accepting quarters";
        }
    }

    public function decrementQuarterCounter()
    {
        if ($this->quarterCounter > 0) {
            $this->quarterCounter--;
        } else {
            echo "You cannot return a coin because you did not add it.";
        }
    }

    public function setToZeroQuarterCounter()
    {
        $this->quarterCounter = 0;
    }
}