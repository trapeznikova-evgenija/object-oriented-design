<?php

namespace App;


class Ellipse extends Shape
{
    private $center;
    private $horizontalRadius;
    private $verticalRadius;

    public function __construct(string $color, Point $center, float $horizontalRadius, float $verticalRadius)
    {
        parent::__construct($color);
        $this->center = $center;
        $this->horizontalRadius = $horizontalRadius;
        $this->verticalRadius = $verticalRadius;
    }

    public function getCenter() : Point
    {
        return $this->center;
    }

    public function getHorizontalRadius() : float
    {
        return $this->horizontalRadius;
    }

    public function getVerticalRadius() : float
    {
        return $this->verticalRadius;
    }

    protected function drawShape(CanvasInterface $canvas)
    {
        $canvas->drawEllipse($this->center, $this->horizontalRadius, $this->verticalRadius);
    }
}