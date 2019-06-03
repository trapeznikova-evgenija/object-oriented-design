<?php

namespace App\classes\common;


class RGBAColor
{
    private $r;
    private $g;
    private $b;
    private $a;

    /**
     * RGBAColor constructor.
     * @param $r
     * @param $g
     * @param $b
     * @param $a
     */
    public function __construct($r, $g, $b, $a)
    {
        $this->a = $a;
        $this->b = $b;
        $this->r = $r;
        $this->g = $g;
    }

    public function setR($r)
    {
        $this->r = $r;
    }
}