<?php

namespace common;


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
    public function __construct($r, $g, $b, $a = 1)
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

    public function convertColorToString() : string
    {
        $r = dechex($this->r);
        $g = dechex($this->g);
        $b = dechex($this->b);

        $hec = "#" . $r . $g . $b;

        if ($this->a == 0)
        {
            return "#0xFFFFFF00";
        }

        return $hec;
    }
}