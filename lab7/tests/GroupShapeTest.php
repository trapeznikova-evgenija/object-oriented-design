<?php

namespace tests;

use common\Point;
use common\RGBAColor;
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

    public function testGetColorGroupShapeWithDiffColor()
    {
        $rectangle = new Rectangle(new Point(0, 0), 0, 12);
        $rectangle->getFillStyle()->enable(true);
        $rectangle->getFillStyle()->setColor(new RGBAColor(3, 4, 5));

        $triangle1 = new Triangle(new Point(0, 0), new Point(3, 5), new Point(8, 5));
        $triangle1->getFillStyle()->enable(true);
        $triangle1->getFillStyle()->setColor(new RGBAColor(12, 15, 16));

        $triangle2 = new Triangle(new Point(12, 5), new Point(56, 56), new Point(45, 45));
        $triangle2->getFillStyle()->enable(true);
        $triangle2->getFillStyle()->setColor(new RGBAColor(45, 45, 45));

        $group = new GroupShape();
        $group->insertShape($rectangle);
        $group->insertShape($triangle1);
        $group->insertShape($triangle2);

        $color = $group->getFillStyle()->getColor();

        $this->assertEquals($color, null);
    }

    public function testGetColorGroupShapeWithEqualsColor()
    {
        $rectangle = new Rectangle(new Point(0, 0), 0, 12);
        $rectangle->getFillStyle()->enable(true);
        $rectangle->getFillStyle()->setColor(new RGBAColor(3, 4, 5));

        $triangle1 = new Triangle(new Point(0, 0), new Point(3, 5), new Point(8, 5));
        $triangle1->getFillStyle()->enable(true);
        $triangle1->getFillStyle()->setColor(new RGBAColor(12, 15, 16));

        $triangle2 = new Triangle(new Point(12, 5), new Point(56, 56), new Point(45, 45));
        $triangle2->getFillStyle()->enable(true);
        $triangle2->getFillStyle()->setColor(new RGBAColor(45, 45, 45));

        $group = new GroupShape();
        $group->insertShape($rectangle);
        $group->insertShape($triangle1);
        $group->insertShape($triangle2);

        $rectangle->getFillStyle()->setColor(new RGBAColor(0, 0, 0));
        $triangle1->getFillStyle()->setColor(new RGBAColor(0, 0, 0));
        $triangle2->getFillStyle()->setColor(new RGBAColor(0, 0, 0));

        $color = $group->getFillStyle()->getColor();

        $this->assertEquals($color, new RGBAColor(0, 0, 0));
    }

    public function testStrokeWidthGroupWithDiffStrokeWidth()
    {
        $rectangle = new Rectangle(new Point(0, 0), 0, 12);
        $rectangle->getOutlineStyle()->enable(true);

        $triangle1 = new Triangle(new Point(0, 0), new Point(3, 5), new Point(8, 5));
        $triangle1->getOutlineStyle()->enable(true);

        $triangle2 = new Triangle(new Point(12, 5), new Point(56, 56), new Point(45, 45));
        $triangle2->getOutlineStyle()->enable(true);

        $group = new GroupShape();
        $group->insertShape($rectangle);
        $group->insertShape($triangle1);
        $group->insertShape($triangle2);

        $rectangle->getOutlineStyle()->setStrokeWidth(3);
        $triangle1->getOutlineStyle()->setStrokeWidth(2);
        $triangle2->getOutlineStyle()->setStrokeWidth(3);

        $actualStrokeWidth = $group->getOutlineStyle()->getStrokeWidth();

        $this->assertEquals(null, $actualStrokeWidth);
    }

    public function testStrokeWidthWithEqualsStrokeWidth()
    {
        $rectangle = new Rectangle(new Point(0, 0), 0, 12);
        $rectangle->getOutlineStyle()->enable(true);

        $triangle1 = new Triangle(new Point(0, 0), new Point(3, 5), new Point(8, 5));
        $triangle1->getOutlineStyle()->enable(true);

        $triangle2 = new Triangle(new Point(12, 5), new Point(56, 56), new Point(45, 45));
        $triangle2->getOutlineStyle()->enable(true);

        $group = new GroupShape();
        $group->insertShape($rectangle);
        $group->insertShape($triangle1);
        $group->insertShape($triangle2);

        $rectangle->getOutlineStyle()->setStrokeWidth(3);
        $triangle1->getOutlineStyle()->setStrokeWidth(3);
        $triangle2->getOutlineStyle()->setStrokeWidth(3);

        $actualStrokeWidth = $group->getOutlineStyle()->getStrokeWidth();

        $this->assertEquals(3, $actualStrokeWidth);
    }
}