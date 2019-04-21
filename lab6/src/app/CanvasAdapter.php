<?php

namespace app;

use GraphicsLib\CanvasInterface;
use ModernGraphicsLib\ModernGraphicsRenderer;
use ModernGraphicsLib\Point;
use ModernGraphicsLib\RGBAColor;

class CanvasAdapter implements CanvasInterface
{
    /* ModernGraphicsLib */
    private $renderer;
    /* ModernGraphicsLib Point */
    private $currPoint;
    /* ModernGraphicsLib RGBAColor */
    private $rgbaColor;

    public function __construct(ModernGraphicsRenderer $renderer)
    {
        $this->renderer = $renderer;
        $this->currPoint = new Point(0, 0);
        $this->rgbaColor = new RGBAColor(0, 0,0,1);
    }

    public function beginDraw()
    {
        $this->renderer->beginDraw();
    }

    public function endDraw()
    {
        $this->renderer->endDraw();
    }

    public function setColor(RGBAColor $rgbColor)
    {
        $this->rgbaColor = $rgbColor;
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

        $this->renderer->drawLine($copiedCurrPoint, $copiedEndPoint, $this->rgbaColor);
        $this->moveTo($x, $y);
    }
}