<?php

namespace ModernGraphicsLib;


class RGBAColor
{
    public $r;
    public $g;
    public $b;
    public $a;

    public function __construct(float $r, float $g, float $b, float $a)
    {
        $this->r = $r;
        $this->g = $g;
        $this->b = $b;
        $this->a = $a;
    }
}