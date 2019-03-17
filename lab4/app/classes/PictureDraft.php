<?php

namespace App;


class PictureDraft
{
    private $shapesBox = [];

    public function GetShapeCount() : int
    {
        return count($this->shapesBox);
    }

    public function GetShapesBox()
    {
        return $this->shapesBox;
    }

    public function AddShapeInBox(Shape $shape)
    {
        array_push($this->shapesBox, $shape);
    }
}