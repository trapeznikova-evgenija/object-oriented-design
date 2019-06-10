<?php

namespace common;


class RectD
{
    public $left;
    public $top;
    public $width;
    public $height;

    public function __construct($left, $top, $width, $height)
    {
        $this->left = $left;
        $this->top = $top;
        $this->height = $height;
        $this->width = $width;
    }

    public function getLeftTop() : Point
    {
        return new Point($this->left, $this->top);
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getHeight()
    {
        return $this->height;
    }
}