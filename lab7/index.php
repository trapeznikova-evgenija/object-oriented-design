<?php
require_once 'vendor/autoload.php';

use common\Point;
use shapes\Triangle;
use common\RectD;
use shapes\Rectangle;
use common\RGBAColor;
use shapes\GroupShape;
use drawable\Canvas;
use drawable\Slide;
use shapes\Shape;

function createHome() : GroupShape
{
    $roof = new Triangle(new Point(20, 120), new Point(120, 0), new Point(220, 120));
    $roof->getOutlineStyle()->setColor(new RGBAColor(77, 49, 49));
    $roof->getFillStyle()->enable(true);
    $roof->getFillStyle()->setColor(new RGBAColor(77, 49, 49));

    $wall = new Rectangle(new Point(20, 120), 200, 200);
    $wall->getOutlineStyle()->setColor(new RGBAColor(12, 12, 12));
    $wall->getFillStyle()->enable(true);
    $wall->getFillStyle()->setColor(new RGBAColor(40, 40, 40));

//    $window = new Rectangle(new Point(30, 180), 50, 50);
//    $window->getOutlineStyle()->enable(true);
//    $window->getOutlineStyle()->setColor(new RGBAColor(217, 207, 22));
//    $window->getOutlineStyle()->setStrokeWidth(3);
//    $window->getFillStyle()->enable(true);
//    $window->getFillStyle()->setColor(new RGBAColor(217, 22, 22));

    $group = new GroupShape();
    $group->insertShape($wall, 0);
    $group->insertShape($roof, 5);
    $group->insertShape($roof, 6);

    return $group;
}

function createSky() : Shape
{
    $sky = new Rectangle(new Point(5, 0), 700, 150);
    $sky->getOutlineStyle()->enable(true);
    $sky->getOutlineStyle()->setColor(new RGBAColor(12, 21, 26));
    $sky->getOutlineStyle()->setStrokeWidth(2);
    $sky->getFillStyle()->enable(true);
    $sky->getFillStyle()->setColor(new RGBAColor(58, 133, 171));

    return $sky;
}

function changeGroupFillStyle(GroupShape $groupShape)
{
    $groupShape->getFillStyle()->enable(true);
    $groupShape->getFillStyle()->setColor(new RGBAColor(255, 255, 255));
}

function createSlide()
{
    $slide = new Slide(800, 800);
    $house = createHome();
    $sky = createSky();

    $house->removeShapeAtIndex(1);

    $slide->addShape($house);
    $svgCanvas = new Canvas();
    $sky->draw($svgCanvas);
    $slide->draw($svgCanvas);
    $svgCanvas->getSvgFile();
}

createSlide();