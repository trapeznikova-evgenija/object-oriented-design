<?php

namespace app;


use GraphicsLib\CanvasInterface;
use ModernGraphicsLib\ModernGraphicsRenderer;
use ModernGraphicsLib\Point;
use ModernGraphicsLib\RGBAColor;

class ModernGraphicsRendererClassAdapter extends ModernGraphicsRenderer implements CanvasInterface
{
    /* ModernGraphicsRenderer Point */
    private $currPoint;
    private $color;

    public function __construct()
    {
        $this->currPoint = new Point(0, 0);
        $this->color = new RGBAColor(0, 0, 0, 1);
    }

    public function beginDraw()
    {
        parent::beginDraw();
    }

    public function endDraw()
    {
        parent::endDraw();
    }

    public function setColor(RGBAColor $rgbColor)
    {
        $this->color = $rgbColor;
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

        $this->drawLine($copiedCurrPoint, $copiedEndPoint, $this->color);
        $this->moveTo($x, $y);
    }
}