<?php

namespace ModernGraphicsRenderer;


class Point
{
    private $x;
    private $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function setXCoord(int $x)
    {
        $this->x = $x;
    }

    public function setYCoord(int $y)
    {
        $this->y = $y;
    }

    public function getXCoord() : int
    {
        return $this->x;
    }

    public function getYCoord() : int
    {
        return $this->y;
    }
}