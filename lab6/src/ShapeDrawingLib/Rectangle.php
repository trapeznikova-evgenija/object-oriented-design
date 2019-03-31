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
        // TODO: Implement Draw() method.
    }
}