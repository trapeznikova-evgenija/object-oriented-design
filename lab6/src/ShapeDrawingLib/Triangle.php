<?php

namespace ShapeDrawingLib;


use GraphicsLib\CanvasInterface;
use ModernGraphicsLib\RGBAColor;

class Triangle implements CanvasDrawableInterface
{
    private $color;
    private $vertex1;
    private $vertex2;
    private $vertex3;

    public function __construct(Point $x, Point $y, Point $z, RGBAColor $rgbColor = null)
    {
        $this->vertex1 = $x;
        $this->vertex2 = $y;
        $this->vertex3 = $z;

        if ($rgbColor == null)
        {
            $this->color = new RGBAColor(0,0,0,1);
        } else
        {
            $this->color = $rgbColor;
        }
    }

    public function draw(CanvasInterface $canvas)
    {
        echo "draw Triangle" . PHP_EOL;

        $canvas->setColor($this->color);
        $canvas->moveTo($this->vertex1->x, $this->vertex1->y);
        $canvas->lineTo($this->vertex2->x, $this->vertex2->y);
        $canvas->lineTo($this->vertex3->x, $this->vertex3->y);
        $canvas->lineTo($this->vertex1->x, $this->vertex1->y);
    }
}