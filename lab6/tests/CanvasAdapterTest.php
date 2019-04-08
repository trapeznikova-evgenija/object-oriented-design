<?php
namespace tests;

use PHPUnit\Framework\TestCase;

use app\CanvasAdapter;
use ModernGraphicsLib\ModernGraphicsRenderer;
use ShapeDrawingLib\CanvasPainter;
use ShapeDrawingLib\Point;
use ShapeDrawingLib\Rectangle;
use ShapeDrawingLib\Triangle;

class CanvasAdapterTest extends TestCase
{
    public function testCheckMoveTo()
    {
        $renderer = new ModernGraphicsRenderer();
        $adapter = new CanvasAdapter($renderer);

        $adapter->moveTo(12, 10);
        $this->expectOutputString("<draw>\n</draw>\n");
    }

    public function testCheckLineTo()
    {
        $renderer = new ModernGraphicsRenderer();
        $adapter = new CanvasAdapter($renderer);

        $adapter->lineTo(45, 47);
        $this->expectOutputString("<draw>\n <line fromX=0 fromY=0 toX=45 toY=47/>\n</draw>\n");
    }

    public function testCheckOnException()
    {
        $this->setExpectedException('LogicException');
        $renderer = new ModernGraphicsRenderer();
        $renderer->drawLine(new \ModernGraphicsLib\Point(3, 4), new \ModernGraphicsLib\Point(8, 15) );
    }


}