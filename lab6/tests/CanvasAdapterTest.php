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
    public function testOnPaint()
    {
//        $renderer = new ModernGraphicsRenderer();
//        $adapter = new CanvasAdapter($renderer);
//        $painter = new CanvasPainter($adapter);
//
//
//        $trianglePoint1 = new Point();
//        $trianglePoint1->x = 40;
//        $trianglePoint1->y = 60;
//        $trianglePoint2 = new Point();
//        $trianglePoint2->x = 180;
//        $trianglePoint2->y = 250;
//        $trianglePoint3 = new Point();
//        $trianglePoint3->x = 450;
//        $trianglePoint3->y = 344;
//
//        $rectanglePoint1 = new Point();
//        $rectanglePoint1->x = 0;
//        $rectanglePoint1->y = 0;
//
//        $triangle = new Triangle($trianglePoint1, $trianglePoint2, $trianglePoint3);
//        $rectangle = new Rectangle($rectanglePoint1, 120, 240);
//
//        $painter->draw($triangle);
//        $painter->draw($rectangle);

    }

    public function testCheckMoveTo()
    {
        $renderer = new ModernGraphicsRenderer();
        $adapter = new CanvasAdapter($renderer);

        $adapter->moveTo(12, 10);


    }

    public function testCheckOnException()
    {
        $this->setExpectedException('LogicException');
        $renderer = new ModernGraphicsRenderer();
        $renderer->drawLine(new \ModernGraphicsLib\Point(3, 4), new \ModernGraphicsLib\Point(8, 15) );
    }


}