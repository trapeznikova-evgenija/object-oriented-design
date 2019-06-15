<?php

namespace style;


interface OutlineStyleInterface extends StyleInterface
{
    public function setStrokeWidth(float $width);
    public function getStrokeWidth() : ?float;
}