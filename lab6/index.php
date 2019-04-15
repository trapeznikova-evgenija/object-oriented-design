<?php
    require_once 'vendor/autoload.php';

use GraphicsLib\Canvas;
use ModernGraphicsLib\ModernGraphicsRenderer;
use ShapeDrawingLib\CanvasPainter;
use ShapeDrawingLib\Point;
use ShapeDrawingLib\Rectangle;
use ShapeDrawingLib\Triangle;
use app\CanvasAdapter;

function paintPicture(CanvasPainter $painter)
{
    $trianglePoint1 = new Point();
    $trianglePoint1->x = 10;
    $trianglePoint1->y = 20;
    $trianglePoint2 = new Point();
    $trianglePoint2->x = 100;
    $trianglePoint2->y = 200;
    $trianglePoint3 = new Point();
    $trianglePoint3->x = 150;
    $trianglePoint3->y = 250;

    $rectanglePoint1 = new Point();
    $rectanglePoint1->x = 30;
    $rectanglePoint1->y = 40;

    $triangle = new Triangle($trianglePoint1, $trianglePoint2, $trianglePoint3);
    $rectangle = new Rectangle($rectanglePoint1, 18, 24);

    $painter->draw($triangle);
    $painter->draw($rectangle);
}

function paintPictureOnCanvas()
{
    $simpleCanvas = new Canvas();
    $painter = new CanvasPainter($simpleCanvas);
    paintPicture($painter);
}

function paintPictureOnModernGraphicsRenderer()
{
    $renderer = new ModernGraphicsRenderer();
    $adapter = new CanvasAdapter($renderer);
    $adapter->beginDraw();
    $painter = new CanvasPainter($adapter);
    paintPicture($painter);
    $adapter->endDraw();
}

function runApp()
{
    echo "Should we use new API (y)?" . PHP_EOL;
    $clientInput = readline();

    if ($clientInput && $clientInput == "y" || $clientInput == "Y")
    {
        paintPictureOnModernGraphicsRenderer();
    }
    else
    {
        paintPictureOnCanvas();
    }
}

runApp();

