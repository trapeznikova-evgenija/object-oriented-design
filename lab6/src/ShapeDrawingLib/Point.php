<?php
namespace ShapeDrawingLib;

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

    public function getXCoord() : float
    {
        return $this->x;
    }

    public function getYCoord()
    {
        return $this->y;
    }
}