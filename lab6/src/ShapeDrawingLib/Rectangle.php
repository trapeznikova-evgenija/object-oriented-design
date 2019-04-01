<?php

namespace ShapeDrawingLib;

use GraphicsLib\CanvasInterface;

class Rectangle implements CanvasDrawableInterface
{
    private $leftTop;
    private $width;
    private $height;

    public function __construct(Point $leftTop, int $width, int $height)
    {
        $this->height = $height;
        $this->width = $width;
        $this->leftTop = $leftTop;
    }

    public function draw(CanvasInterface $canvas)
    {
        $canvas->moveTo($this->leftTop->x, $this->leftTop->y);
        $canvas->lineTo($this->leftTop->x + $this->width, $this->leftTop->y);
        $canvas->lineTo($this->leftTop->x + $this->width, $this->leftTop->y + $this->height);
        $canvas->lineTo($this->leftTop->x, $this->leftTop->y + $this->height);
        $canvas->lineTo($this->leftTop->x, $this->leftTop->y);
    }
}