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

    public function draw(CanvasInterface $canvas)
    {
        $canvas->setColor($this->color);
        $this->drawShape($canvas);
    }

    abstract protected function drawShape(CanvasInterface $canvas);
}