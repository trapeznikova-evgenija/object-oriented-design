<?php

namespace drawable;

use shapes\ShapesInterface;
use shapes\GroupShape;

interface SlideInterface extends DrawableInterface
{
    public function getWidth() : float;
    public function getHeight() : float;

    public function getShapes() : ShapesInterface;
    public function addShape(GroupShape $shape) : void;
}