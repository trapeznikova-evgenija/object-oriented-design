<?php

namespace App;


class Triangle extends Shape
{
    private $vertex1;
    private $vertex2;
    private $vertex3;

    public function __construct(string $color, Point $vertex1, Point $vertex2, Point $vertex3)
    {
        parent::__construct($color);
        $this->vertex1 = $vertex1;
        $this->vertex2 = $vertex2;
        $this->vertex3 = $vertex3;
    }

    public function getVertex1() : Point
    {
        return $this->vertex1;
    }

    public function getVertex2() : Point
    {
        return $this->vertex2;
    }

    public function getVertex3() : Point
    {
        return $this->vertex3;
    }

    protected function drawShape(CanvasInterface $canvas)
    {
        $canvas->drawLine($this->vertex1, $this->vertex2);
        $canvas->drawLine($this->vertex2, $this->vertex3);
        $canvas->drawLine($this->vertex3, $this->vertex1);
    }
}