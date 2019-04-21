<?php

namespace ModernGraphicsLib;

class ModernGraphicsRenderer
{
    private $isDrawing = false;

    public function __destruct()
    {
        if ($this->isDrawing)
        {
            $this->endDraw();
        }
    }

    public function beginDraw()
    {
        if ($this->isDrawing)
        {
            echo "Drawing has already begun";
        }

        echo "<draw>" . PHP_EOL;
        $this->isDrawing = true;
    }

    public function drawLine(Point $start, Point $end, RGBAColor $color)
    {
        if (!$this->isDrawing)
        {
            echo "DrawLine is allowed between BeginDraw()/EndDraw() only";
        }

        echo "<line fromX=". $start->getXCoord() . " fromY=" . $start->getYCoord() . " toX=" . $end->getXCoord() . " toY=" . $end->getYCoord() . ">";
        echo "<color r=" . $color->r . " g=" . $color->g . " b=" . $color->b . " a=" . $color->a . " />";
        echo "</line>" . PHP_EOL;
    }

    public function endDraw()
    {
        if (!$this->isDrawing)
        {
            echo "Drawing has not been started";
        }

        echo "</draw>" . PHP_EOL;
        $this->isDrawing = false;
    }
}