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

    protected function drawShape(CanvasInterface $canvas)
    {
        $stepAngle = M_PI / $this->vertexNumber * 2;
        $currAngle = (M_PI / 2) + $stepAngle;

        $topPointYCoord = $this->center->getYCoord() - $this->radius;
        $topPoint = new Point($this->center->getXCoord(), $topPointYCoord);
        $prevPoint = $topPoint;

        for ($i = 0; $i < $this->vertexNumber - 1; ++$i)
        {
            $x = $this->center->getXCoord() + ceil($this->radius * cos($currAngle));
            $y = $this->center->getYCoord() + ceil($this->radius * sin($currAngle));

            $point = new Point($x, $y);
            $canvas->drawLine($prevPoint, $point);

            $prevPoint = $point;
            $currAngle = $currAngle +$stepAngle;
        }

        $canvas->drawLine($prevPoint, $topPoint);
    }
}