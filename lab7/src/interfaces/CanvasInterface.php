<?php

namespace App\interfaces;


use App\classes\common\Point;
use App\classes\common\RGBAColor;

interface CanvasInterface
{
    public function setLineColor(RGBAColor $color);
    public function setLineWidth(double $width);
    public function beginFill(RGBAColor $color);
    public function endFill();
    public function moveTo(Point $point);
    public function lineTo(Point $point);
    public function drawEllipse(Point $center, double $horizontalR, double $verticalR);
    public function fillPolygon();
}