<?php

namespace drawable;

use shapes\GroupShape;
use shapes\ShapesInterface;

class Slide implements SlideInterface
{
    /** @var GroupShape */
    private $shapeGroup;

    /** @var float*/
    private $width;

    /** @var float*/
    private $height;

    public function __construct(float $slideWidth, float $slideHeight)
    {
        $this->width = $slideWidth;
        $this->height = $slideHeight;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function getShapes(): ShapesInterface
    {
        return $this->shapeGroup;
    }

    public function draw(CanvasInterface $canvas)
    {
        $this->shapeGroup->draw($canvas);
    }
}