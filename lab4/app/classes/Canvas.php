<?php

namespace App;


class Canvas implements CanvasInterface
{
    private $color;

    public function setColor(string $color)
    {
        $this->color = $color;
    }

    public function drawEllipse(float $left, float $top, float $width, float $height)
    {
        echo "--draw ellipse on canvas--" . PHP_EOL;
        echo "left " . $left . PHP_EOL;
        echo "top " . $top . PHP_EOL;
        echo "width " . $width . PHP_EOL;
        echo "height " . $height . PHP_EOL;
    }

    public function drawLine(Point $from, Point $to)
    {
        echo "--draw line--" . PHP_EOL;
        echo "from " . "<x>=" . $from->getXCoord() . " <y>=" . $from->getYCoord()
              . " to " . "<x>=" . $to->getXCoord() . " <y>=" . $to->getYCoord();
    }
}