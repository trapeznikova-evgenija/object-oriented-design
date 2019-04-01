<?php

namespace app;

use GraphicsLib\CanvasInterface;
use ModernGraphicsLib\ModernGraphicsRenderer;
use ModernGraphicsLib\Point;

class CanvasAdapter implements CanvasInterface
{
    /* ModernGraphicsRenderer */
    private $renderer;
    /* ModernGraphicsRenderer Point */
    private $currPoint;

    public function __construct(ModernGraphicsRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function moveTo(int $x, int $y)
    {
        $this->currPoint->x = $x;
        $this->currPoint->y = $y;
    }

    public function lineTo(int $x, int $y)
    {
        $endPoint = new Point($x, $y);
        $this->renderer->beginDraw();
        $this->renderer->drawLine($this->currPoint, $endPoint);
        $this->renderer->endDraw();
        $this->moveTo($x, $y);
    }
}