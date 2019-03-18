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

    public function draw(Canvas $canvas)
    {
        echo "I draw ellipse" . PHP_EOL;
    }
}