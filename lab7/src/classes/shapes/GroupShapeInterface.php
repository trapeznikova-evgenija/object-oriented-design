<?php

namespace shapes;


interface GroupShapeInterface extends ShapeInterface, ShapesInterface
{
    public function enumerateOutlineStyles(callable $func);
    public function enumerateFillStyles(callable $func);
}