<?php

use App\classes\common\RectD;
use App\interfaces\StyleInterface;
use App\interfaces\GroupShapeInterface;
use App\interfaces\OutlineStyleInterface;


interface ShapeInterface
{
    public function getFrame() : RectD;
    public function setFrame(RectD $rect) : void;

    public function getOutlineStyle() : OutlineStyleInterface;
    public function getFillStyle() : StyleInterface;

    public function getGroup() : GroupShapeInterface;
}