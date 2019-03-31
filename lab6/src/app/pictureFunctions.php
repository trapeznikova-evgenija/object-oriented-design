<?php

namespace app;

use GraphicsLib\Canvas;
use ShapeDrawingLib\CanvasPainter;
use ShapeDrawingLib\Point;
use ShapeDrawingLib\Rectangle;
use ShapeDrawingLib\Triangle;

function paintPicture(CanvasPainter $painter)
{
    $trianglePoint1 = new Point(10, 15);
    $trianglePoint2 = new Point(100, 200);
    $trianglePoint3 = new Point(150, 250);
    $rectanglePoint1 = new Point(30, 40);

    $triangle = new Triangle($trianglePoint1, $trianglePoint2, $trianglePoint3);
    $rectangle = new Rectangle($rectanglePoint1, 18, 24);

    //TODO: нарисовать прямоугольник и треугольник при помощи painter
}

function paintPictureOnCanvas()
{
    $simpleCanvas = new Canvas();
    $painter = new CanvasPainter($simpleCanvas);
    paintPicture($painter);
}