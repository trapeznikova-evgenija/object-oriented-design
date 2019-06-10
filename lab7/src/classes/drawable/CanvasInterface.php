<?php

namespace drawable;

use common\Point;
use common\RGBAColor;

interface CanvasInterface
{
    public function setLineColor(RGBAColor $color);
    public function setLineWidth(float $width);
    public function beginFill(RGBAColor $color);
    public function endFill();
    public function moveTo(Point $point);
    public function lineTo(Point $point);
    public function drawEllipse(Point $center, float $horizontalR, float $verticalR);
    public function fillPolygon();
}