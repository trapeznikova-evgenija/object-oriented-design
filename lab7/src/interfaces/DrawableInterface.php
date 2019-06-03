<?php

use App\interfaces\CanvasInterface;

interface DrawableInterface
{
    public function draw(CanvasInterface $canvas);
}