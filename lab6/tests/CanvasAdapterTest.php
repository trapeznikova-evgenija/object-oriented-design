<?php
namespace tests;

use PHPUnit\Framework\TestCase;

use app\CanvasAdapter;
use ModernGraphicsLib\ModernGraphicsRenderer;

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
        $this->expectOutputString("<draw>\n<line fromX=0 fromY=0 toX=45 toY=47/>\n</draw>\n");
    }
}