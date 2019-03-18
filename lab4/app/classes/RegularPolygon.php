<?php

namespace App;


class RegularPolygon extends Shape
{
    private $vertexNumber;
    private $center;
    private $radius;

    public function __construct(string $color, int $vertexNumber, Point $centerCoord, float $radius)
    {
        parent::__construct($color);
        $this->center = $centerCoord;
        $this->radius = $radius;
        $this->vertexNumber = $vertexNumber;
    }

    public function getVertexCount() : int
    {
        return $this->vertexNumber;
    }

    public function getCenterCoord() : Point
    {
        return $this->center;
    }

    public function getRadius() : float
    {
        return $this->radius;
    }

    public function draw(Canvas $canvas)
    {
        echo "I draw polygon";
    }
}