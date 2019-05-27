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
        if ($this->getQuarterCounter() >= 0)
        {
            $strTemplate = "Returned " . $this->getQuarterCounter() . " quarter%s";
            $suffix = ($this->getQuarterCounter() != 1) ? "s" : "";
            $strTemplate = sprintf($strTemplate, $suffix);
            $this->setToZeroQuarterCounter();
            echo $strTemplate . PHP_EOL;
        }
    }

    public function incrementQuarterCounter()
    {
        if ($this->getQuarterCounter() < 5)
        {
            $this->quarterCounter++;
            echo "Quarter inserted. Quarter count " . $this->getQuarterCounter() . PHP_EOL;
        }
        else
        {
            echo "GumBallMachine no longer accepting quarters" . PHP_EOL;
        }
    }

    public function decrementQuarterCounter()
    {
        if ($this->quarterCounter > 0)
        {
            $this->quarterCounter--;
        }
        else
        {
            echo "You cannot return a quarter because you did not add it." . PHP_EOL;
        }
    }

    public function setToZeroQuarterCounter()
    {
        $this->quarterCounter = 0;
    }
}