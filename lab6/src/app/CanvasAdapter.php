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
        $this->currPoint = new Point(0, 0);
    }

    public function beginDraw()
    {
        $this->renderer->beginDraw();
    }

    public function endDraw()
    {
        $this->renderer->endDraw();
    }

    public function moveTo(int $x, int $y)
    {
        $this->currPoint->setXCoord($x);
        $this->currPoint->setYCoord($y);
    }

    public function lineTo(int $x, int $y)
    {
        $endPoint = new Point($x, $y);

        $copiedCurrPoint = clone $this->currPoint;
        $copiedEndPoint = clone $endPoint;

        $this->renderer->drawLine($copiedCurrPoint, $copiedEndPoint);
        $this->moveTo($x, $y);
    }
}