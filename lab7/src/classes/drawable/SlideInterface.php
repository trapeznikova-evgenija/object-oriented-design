<?php

namespace drawable;

use shapes\ShapesInterface;

interface SlideInterface extends DrawableInterface
{
    public function getWidth() : float;
    public function getHeight() : float;

    public function getShapes() : ShapesInterface;
}