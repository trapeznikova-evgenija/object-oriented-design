<?php
namespace GraphicsLib;

use ModernGraphicsLib\RGBAColor;

interface CanvasInterface
{
    public function setColor(RGBAColor $rgbColor);
    public function moveTo(int $x, int $y);
    public function lineTo(int $x, int $y);

}