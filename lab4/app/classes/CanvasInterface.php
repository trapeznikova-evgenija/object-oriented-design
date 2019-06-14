<?php

namespace App;


interface CanvasInterface
{
    public function setColor(string $color);
    public function drawLine(Point $from, Point $to);
    public function drawEllipse(Point $center, float $width, float $height);
}