<?php

namespace App\classes\common;


class Point
{
    /** @var double  */
    private $x;

    /** @var double  */
    private $y;

    public function __construct(double $x, double $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX() : double
    {
        return $this->x;
    }

    public function getY() : double
    {
        return $this->y;
    }

    public function setX(double $x)
    {
        $this->x = $x;
    }

    public function setY(double $y)
    {
        $this->y = $y;
    }
}