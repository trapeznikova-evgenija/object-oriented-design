<?php

namespace tests;

use common\Point;
use PHPUnit\Framework\TestCase;
use shapes\GroupShape;
use shapes\GroupShapeMock;
use shapes\Rectangle;
use shapes\Triangle;

class GroupShapeTest extends TestCase
{
    public function testInsertShapeInGroup()
    {
        $rectangle = new Rectangle(new Point(0, 0), 0, 12);
        $triangle = new Triangle(new Point(0, 0), new Point(3, 5), new Point(8, 5));

        $groupShape = new GroupShapeMock();
        $groupShape->insertShape($rectangle, 0);
        $groupShape->insertShape($triangle, 8);

        $this->assertEquals("Вы получили фигуру по индексу 1\n", $groupShape->getShapeAtIndex(1));
        $this->assertEquals(2, $groupShape->getShapesCount());
    }

    public function testRemoveShapeInGroupWithNotExistingPosition()
    {
        $rectangle = new Rectangle(new Point(0, 0), 0, 12);
        $triangle1 = new Triangle(new Point(0, 0), new Point(3, 5), new Point(8, 5));
        $triangle2 = new Triangle(new Point(12, 5), new Point(56, 56), new Point(45, 45));

        $groupShape = new GroupShapeMock();
        $groupShape->insertShape($rectangle, 0);
        $groupShape->insertShape($triangle1, 8);
        $groupShape->insertShape($triangle2, 9);

        $groupShape->removeShapeAtIndex(9);
        $this->expectOutputString("Невозможно получить фигуру по позиции: 9\n");
    }

    public function testRemoveShapeInGroupWithExistingPosition()
    {
        $rectangle = new Rectangle(new Point(0, 0), 0, 12);
        $triangle1 = new Triangle(new Point(0, 0), new Point(3, 5), new Point(8, 5));
        $triangle2 = new Triangle(new Point(12, 5), new Point(56, 56), new Point(45, 45));

        $groupShape = new GroupShapeMock();
        $groupShape->insertShape($rectangle, 0);
        $groupShape->insertShape($triangle1, 8);
        $groupShape->insertShape($triangle2, 9);

        $groupShape->removeShapeAtIndex(1);
        $this->expectOutputString("Из группы удалена фигура с индексом 1\n");

        $shapes = $groupShape->getShapes();

        $this->assertEquals($shapes[1], $triangle2);
    }
}