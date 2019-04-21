<?php

namespace tests;

use PHPUnit\Framework\TestCase;

use app\ModernGraphicsRendererClassAdapter;
use ShapeDrawingLib\Point;
use ModernGraphicsLib\RGBAColor;

class ModernGraphicsRendererClassAdapterTest extends TestCase
{
    public function testCheckDrawRectangle()
    {
        $adapter = new ModernGraphicsRendererClassAdapter();
        $adapter->beginDraw();

        $adapter->setColor(new RGBAColor(3.4, 3, 6.5, 0.7));
        $adapter->moveTo(2, 2);
        $adapter->lineTo(2 + 10, 2);
        $adapter->lineTo(2 + 10, 2 + 15);
        $adapter->lineTo(2, 2 + 15);
        $adapter->lineTo(2, 2);

        $adapter->endDraw();
        $this->expectOutputString("<draw>\n<line fromX=2 fromY=2 toX=12 toY=2><color r=3.4 g=3 b=6.5 a=0.7 /></line>\n<line fromX=12 fromY=2 toX=12 toY=17><color r=3.4 g=3 b=6.5 a=0.7 /></line>\n<line fromX=12 fromY=17 toX=2 toY=17><color r=3.4 g=3 b=6.5 a=0.7 /></line>\n<line fromX=2 fromY=17 toX=2 toY=2><color r=3.4 g=3 b=6.5 a=0.7 /></line>\n</draw>\n");
    }

    public function testCheckDrawTriangle()
    {
        $adapter = new ModernGraphicsRendererClassAdapter();
        $adapter->beginDraw();

        $vertex1 = new Point();
        $vertex1->x = 1;
        $vertex1->y = 2;

        $vertex2 = new Point();
        $vertex2->x = 5;
        $vertex2->y = 6;

        $vertex3 = new Point();
        $vertex3->x = 10;
        $vertex3->y = 15;

        $adapter->setColor(new RGBAColor(6.0, 5, 8.1, 0.5));
        $adapter->moveTo($vertex1->x, $vertex1->y);
        $adapter->lineTo($vertex2->x, $vertex2->y);
        $adapter->lineTo($vertex3->x, $vertex3->y);
        $adapter->lineTo($vertex1->x, $vertex1->y);

        $adapter->endDraw();
        $this->expectOutputString("<draw>\n<line fromX=1 fromY=2 toX=5 toY=6><color r=6 g=5 b=8.1 a=0.5 /></line>\n<line fromX=5 fromY=6 toX=10 toY=15><color r=6 g=5 b=8.1 a=0.5 /></line>\n<line fromX=10 fromY=15 toX=1 toY=2><color r=6 g=5 b=8.1 a=0.5 /></line>\n</draw>\n");
    }
}