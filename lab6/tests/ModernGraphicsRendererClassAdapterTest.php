<?php

namespace tests;

use PHPUnit\Framework\TestCase;

use app\ModernGraphicsRendererClassAdapter;
use ShapeDrawingLib\Point;

class ModernGraphicsRendererClassAdapterTest extends TestCase
{
    public function testCheckDrawRectangle()
    {
        $adapter = new ModernGraphicsRendererClassAdapter();

        $adapter->moveTo(2, 2);
        $adapter->lineTo(2 + 10, 2);
        $adapter->lineTo(2 + 10, 2 + 15);
        $adapter->lineTo(2, 2 + 15);
        $adapter->lineTo(2, 2);

        $this->expectOutputString("<draw>\n<line fromX=2 fromY=2 toX=12 toY=2/>\n<line fromX=12 fromY=2 toX=12 toY=17/>\n<line fromX=12 fromY=17 toX=2 toY=17/>\n<line fromX=2 fromY=17 toX=2 toY=2/>\n</draw>\n");
    }

    public function testCheckDrawTriangle()
    {
        $adapter = new ModernGraphicsRendererClassAdapter();

        $vertex1 = new Point();
        $vertex1->x = 1;
        $vertex1->y = 2;

        $vertex2 = new Point();
        $vertex2->x = 5;
        $vertex2->y = 6;

        $vertex3 = new Point();
        $vertex3->x = 10;
        $vertex3->y = 15;

        $adapter->moveTo($vertex1->x, $vertex1->y);
        $adapter->lineTo($vertex2->x, $vertex2->y);
        $adapter->lineTo($vertex3->x, $vertex3->y);
        $adapter->lineTo($vertex1->x, $vertex1->y);

        $this->expectOutputString("<draw>\n<line fromX=1 fromY=2 toX=5 toY=6/>\n<line fromX=5 fromY=6 toX=10 toY=15/>\n<line fromX=10 fromY=15 toX=1 toY=2/>\n</draw>\n");
    }
}