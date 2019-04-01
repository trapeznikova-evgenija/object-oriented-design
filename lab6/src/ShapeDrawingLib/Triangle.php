<?php

namespace ShapeDrawingLib;


use GraphicsLib\CanvasInterface;

class Triangle implements CanvasDrawableInterface
{
    private $vertex1;
    private $vertex2;
    private $vertex3;

    public function __construct(Point $x, Point $y, Point $z)
    {
        $this->vertex1 = $x;
        $this->vertex2 = $y;
        $this->vertex3 = $z;
    }

    public function draw(CanvasInterface $canvas)
    {
        $canvas->moveTo($this->vertex1->x, $this->vertex2->y);
        $canvas->lineTo($this->vertex2->x, $this->vertex2->y);
        $canvas->lineTo($this->vertex3->x, $this->vertex3->y);
        $canvas->lineTo($this->vertex1->x, $this->vertex1->y);
    }
}