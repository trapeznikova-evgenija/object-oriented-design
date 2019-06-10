<?php

namespace shapes;

use common\Point;
use common\RectD;
use drawable\CanvasInterface;

class Rectangle extends Shape
{
    /** @var float */
    private $left;

    /** @var float */
    private $top;

    /** @var float */
    private $width;

    /** @var float */
    private $height;

    public function __construct(Point $leftTop, float $width, float $height)
    {
        parent::__construct();

        $this->height = $height;
        $this->width = $width;
        $this->left = $leftTop->getX();
        $this->top = $leftTop->getY();
    }

    public function getFrame(): RectD
    {
        $frame = new RectD($this->left, $this->top, $this->width, $this->height);
        return $frame;
    }

    public function setFrame(RectD $rect): void
    {
        $this->left = $rect->left;
        $this->top = $rect->top;
        $this->width = $rect->width;
        $this->height = $rect->height;
    }

    protected function drawShape(CanvasInterface $canvas)
    {
        $canvas->moveTo(new Point($this->left, $this->top));
        $canvas->lineTo(new Point($this->left + $this->width, $this->top));
        $canvas->lineTo(new Point($this->left + $this->width, $this->top + $this->height));
        $canvas->lineTo(new Point($this->left, $this->top + $this->height));
        $canvas->lineTo(new Point($this->left, $this->top));
    }
}