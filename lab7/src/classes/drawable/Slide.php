<?php

namespace drawable;

use shapes\GroupShape;
use shapes\ShapeInterface;
use shapes\ShapesInterface;

class Slide implements SlideInterface
{
    /** @var ShapeInterface[] */
    private $shapes;

    /** @var float*/
    private $width;

    /** @var float*/
    private $height;

    public function __construct(float $slideWidth, float $slideHeight)
    {
        $this->shapes = [];
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

    public function getShapes(): array
    {
        return $this->shapes;
    }

    public function draw(CanvasInterface $canvas)
    {
        $canvas->setCanvasSize($this->width, $this->height);

        foreach ($this->shapes as $shapeGroup)
        {
            $shapeGroup->draw($canvas);
        }
    }

    public function addShape(ShapeInterface $shape) : void
    {
        $this->shapes[] = $shape;
    }
}