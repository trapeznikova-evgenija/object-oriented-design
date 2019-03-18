<?php

namespace App;


abstract class Shape
{
    private $color;

    public function __construct(string $color)
    {
        $this->color = $color;
    }

    public function getColor() : string
    {
        return $this->color;
    }

    abstract public function draw(CanvasInterface $canvas);
}