<?php

namespace shapes;

use common\RectD;
use style\StyleInterface;
use style\OutlineStyleInterface;


interface ShapeInterface
{
    public function getFrame() : RectD;
    public function setFrame(RectD $rect) : void;

    public function getOutlineStyle() : OutlineStyleInterface;
    public function getFillStyle() : StyleInterface;

    public function getGroup() : GroupShapeInterface;
}