<?php
require_once 'vendor/autoload.php';

use common\Point;
use shapes\Triangle;
use common\RectD;
use shapes\Rectangle;
use common\RGBAColor;
use shapes\GroupShape;
use drawable\Canvas;

$wall = new Rectangle(new Point(0, 120), 300, 300);
$wall->getOutlineStyle()->setColor(new RGBAColor(12, 12, 12));
$wall->getFillStyle()->enable(true);
$wall->getFillStyle()->setColor(new RGBAColor(40, 40, 40));

$window = new Rectangle(new Point(12, 130), 10, 10);
$window->getOutlineStyle()->enable(true);
$window->getOutlineStyle()->setColor(new RGBAColor(217, 207, 22));
$window->getOutlineStyle()->setStrokeWidth(3);
$window->getFillStyle()->enable(true);
$window->getFillStyle()->setColor(new RGBAColor(217, 22, 22));

$group = new GroupShape();
$group->insertShape($wall, 0);
$group->insertShape($window, 1);


$group->getFrame();
$svgCanvas = new Canvas();
$group->draw($svgCanvas);

$svgCanvas->getSvgFile();