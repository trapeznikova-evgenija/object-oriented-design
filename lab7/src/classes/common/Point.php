<?php

namespace App\classes\common;


class Point
{
    private $x;
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
}