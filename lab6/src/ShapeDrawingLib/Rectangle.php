<?php

namespace ShapeDrawingLib;

use GraphicsLib\CanvasInterface;
use ModernGraphicsLib\RGBAColor;

class Rectangle implements CanvasDrawableInterface
{
    private $leftTop;
    private $width;
    private $height;
    private $color;

    public function __construct(Point $leftTop, int $width, int $height, RGBAColor $rgbColor = null)
    {
        $this->height = $height;
        $this->width = $width;
        $this->leftTop = $leftTop;

        if ($rgbColor == null)
        {
            $this->color = new RGBAColor(0,0,0,1);
        } else
        {
            $this->color = $rgbColor;
        }
    }

    public function draw(CanvasInterface $canvas)
    {
        echo "draw Rectangle" .PHP_EOL;

        $canvas->setColor($this->color);
        $canvas->moveTo($this->leftTop->x, $this->leftTop->y);
        $canvas->lineTo($this->leftTop->x + $this->width, $this->leftTop->y);
        $canvas->lineTo($this->leftTop->x + $this->width, $this->leftTop->y + $this->height);
        $canvas->lineTo($this->leftTop->x, $this->leftTop->y + $this->height);
        $canvas->lineTo($this->leftTop->x, $this->leftTop->y);
    }
}