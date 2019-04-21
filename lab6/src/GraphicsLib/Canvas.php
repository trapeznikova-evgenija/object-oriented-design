<?php
namespace GraphicsLib;

use ModernGraphicsLib\RGBAColor;

class Canvas implements CanvasInterface
{
    public function setColor(RGBAColor $rgbColor)
    {
        echo strval($rgbColor) . PHP_EOL;
    }

    public function moveTo(int $x, int $y)
    {
        echo "MoveTo (" . $x . ", " . $y . ")" . PHP_EOL;
    }

    public function lineTo(int $x, int $y)
    {
        echo "LineTo (" . $x . ", " . $y . ")" . PHP_EOL;
    }
}