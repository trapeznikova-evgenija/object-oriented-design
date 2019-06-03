<?php

namespace App\interfaces;


interface OutlineStyleInterface extends StyleInterface
{
    public function setStrokeWidth(double $width);
    public function getStrokeWidth() : double;
}