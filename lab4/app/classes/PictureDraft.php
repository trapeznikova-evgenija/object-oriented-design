<?php

namespace App;


class PictureDraft
{
    private $shapesBox = [];

    public function getShapeCount(): int
    {
        return count($this->shapesBox);
    }

    public function getShapeAt(int $position): Shape
    {
        return $this->shapesBox[$position];
    }

    public function addShapeInBox(Shape $shape)
    {
        array_push($this->shapesBox, $shape);
    }
}