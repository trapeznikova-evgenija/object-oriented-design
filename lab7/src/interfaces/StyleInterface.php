<?php

namespace App\interfaces;


use App\classes\common\RGBAColor;

interface StyleInterface
{
    public function isEnabled() : bool;
    public function enable(bool $enable);

    public function getColor() : RGBAColor;
    public function setColor(RGBAColor $RGBAColor) : void;
}