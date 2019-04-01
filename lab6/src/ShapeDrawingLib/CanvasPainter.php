<?php

namespace ShapeDrawingLib;

use GraphicsLib\CanvasInterface;

class CanvasPainter
{
    private $canvas;

    public function __construct(CanvasInterface $canvas)
    {
        $this->canvas = $canvas;
    }

    public function draw(CanvasDrawableInterface $drawable)
    {
        $drawable->draw($this->canvas);
    }

}