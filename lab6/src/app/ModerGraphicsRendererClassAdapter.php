<?php

namespace app;


use GraphicsLib\CanvasInterface;
use ModernGraphicsLib\ModernGraphicsRenderer;
use ModernGraphicsLib\Point;

class ModerGraphicsRendererClassAdapter extends ModernGraphicsRenderer implements CanvasInterface
{
    /* ModernGraphicsRenderer Point */
    private $currPoint;

    public function __construct()
    {
        $this->beginDraw();
        $this->currPoint = new Point(0, 0);
    }

    public function moveTo(int $x, int $y)
    {
        $this->currPoint->setXCoord($x);
        $this->currPoint->setYCoord($y);
    }

    public function lineTo(int $x, int $y)
    {
        $endPoint = new Point($x, $y);
        $this->drawLine($this->currPoint, $endPoint);
        $this->moveTo($x, $y);
    }
}