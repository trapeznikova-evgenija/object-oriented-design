<?php

namespace App;

class Rectangle extends Shape
{
    private $topLeft;
    private $rightBottom;

    public function __construct(string $color, Point $topLeft, Point $rightBottom)
    {
        parent::__construct($color);

        $this->topLeft = $topLeft;
        $this->rightBottom = $rightBottom;
    }

    public function getRightBottom() : Point
    {
        return $this->rightBottom;
    }

    public function getLeftTop() : Point
    {
        return $this->topLeft;
    }

    protected function drawShape(CanvasInterface $canvas)
    {
        $leftBottom = new Point($this->getLeftTop()->getXCoord(), $this->getRightBottom()->getYCoord());
        $rightTop = new Point($this->getRightBottom()->getXCoord(), $this->getLeftTop()->getYCoord());

        $canvas->drawLine($this->topLeft, $rightTop);
        $canvas->drawLine($rightTop, $this->rightBottom);
        $canvas->drawLine($this->rightBottom, $leftBottom);
        $canvas->drawLine($leftBottom, $this->topLeft);
    }
}