<?php

namespace App\classes\common;


class RectD
{
    private $left;
    private $top;
    private $width;
    private $height;

    public function __construct($left, $top, $width, $height)
    {
        $this->left = $left;
        $this->top = $top;
        $this->height = $height;
        $this->width = $width;
    }
}