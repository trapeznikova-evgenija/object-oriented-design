<?php

namespace App\interfaces;


interface SlideInterface extends \DrawableInterface
{
    public function getWidth() : double;
    public function getHeight() : double;

    public function getShapes() : ShapesInterface;
}