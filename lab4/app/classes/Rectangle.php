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

    protected function draw(Canvas $canvas)
    {
        echo "I draw rectangle" . PHP_EOL;
    }
}