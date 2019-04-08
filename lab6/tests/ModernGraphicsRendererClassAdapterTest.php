<?php

namespace tests;

use PHPUnit\Framework\TestCase;

use app\ModerGraphicsRendererClassAdapter;
use ShapeDrawingLib\CanvasPainter;
use ShapeDrawingLib\Point;
use ShapeDrawingLib\Rectangle;

class ModernGraphicsRendererClassAdapterTest extends TestCase
{
    public function testCheckDrawTriangle()
    {
        $adapter = new ModerGraphicsRendererClassAdapter();

        $painter = new CanvasPainter($adapter);
        $startRectanglePoint = new Point();
        $startRectanglePoint->x = 2;
        $startRectanglePoint->y = 2;
        $painter->draw(new Rectangle($startRectanglePoint, 10, 15));

        $this->expectOutputString("<draw>\ndraw Rectangle\n<line fromX=2 fromY=2 toX=12 toY=2/>\n<line fromX=12 fromY=2 toX=12 toY=17/>\n<line fromX=12 fromY=17 toX=2 toY=17/>\n<line fromX=2 fromY=17 toX=2 toY=2/>\n</draw>\n");

    }
}