<?php

use App\classes\common\RectD;
use App\interfaces\StyleInterface;
use App\interfaces\GroupShapeInterface;

interface ShapeInterface
{
    public function getFrame() : RectD;
    public function setFrame(RectD $rect) : void;

    public function getOutlineStyle() : StyleInterface;
    public function getFillStyle() : StyleInterface;

    public function getGroup() : GroupShapeInterface;
}