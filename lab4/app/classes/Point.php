<?php

namespace App;


class Point
{
    private $x;
    private $y;

    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function setXCoord(float $x)
    {
        $this->x = $x;
    }

    public function setYCoord(float $y)
    {
        $this->y = $y;
    }

    public function getXCoord() : float
    {
        return $this->x;
    }

    public function getYCoord()
    {
        return $this->y;
    }
}