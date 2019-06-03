<?php

namespace App\interfaces;


interface ShapesInterface
{
    public function getShapesCount();
    public function insertShape(\ShapeInterface $shape, int $position);
    public function getShapeAtIndex(int $index) : \ShapeInterface;
    public function removeShapeAtIndex(int $index) : void;
}