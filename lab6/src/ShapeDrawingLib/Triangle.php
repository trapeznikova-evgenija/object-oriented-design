<?php
/**
 * Created by PhpStorm.
 * User: evgeniya
 * Date: 31.03.19
 * Time: 23:24
 */

namespace ShapeDrawingLib;


use GraphicsLib\CanvasInterface;

class Triangle implements CanvasDrawableInterface
{
    private $x;
    private $y;
    private $z;

    public function __construct(Point $x, Point $y, Point $z)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    public function draw(CanvasInterface $canvas)
    {
        // TODO: Implement Draw() method.
    }
}