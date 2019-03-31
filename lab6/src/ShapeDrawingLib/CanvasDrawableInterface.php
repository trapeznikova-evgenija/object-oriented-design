<?php
namespace ShapeDrawingLib;

use GraphicsLib\{CanvasInterface};

interface CanvasDrawableInterface
{
    public function draw(CanvasInterface $canvas);
}