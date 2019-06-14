<?php

namespace drawable;

use shapes\ShapeInterface;
use shapes\ShapesInterface;
use shapes\GroupShape;

interface SlideInterface extends DrawableInterface
{
    public function getWidth() : float;
    public function getHeight() : float;

    public function getShapes() : array;
    public function addShape(ShapeInterface $shape) : void;
}