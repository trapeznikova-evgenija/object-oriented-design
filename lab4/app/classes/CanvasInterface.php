<?php

namespace App;


interface CanvasInterface
{
    public function setColor(string $color);
    public function drawLine(Point $from, Point $to);
    public function drawEllipse(float $left, float $top, float $width, float $height);
}