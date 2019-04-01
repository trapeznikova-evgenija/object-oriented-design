<?php

namespace ModernGraphicsLib;

class ModernGraphicsRenderer
{
    private $isDrawing = false;
    private $outstream = "";

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
            throw LogicException("Drawing has already begun");
        }

        $this->outstream .= "<draw>";
        $this->isDrawing = true;
    }

    public function drawLine(Point $start, Point $end)
    {
        if (!$this->isDrawing)
        {
            throw LogicException("DrawLine is allowed between BeginDraw()/EndDraw() only");
        }

        $this->outstream .= "<line fromX=\"{$start->getXCoord()}\" fromY=\"{$start->getYCoord()}\" toX=\"{$end->getXCoord()}\" toY=\"{$end->getYCoord()}\"/>)";
    }

    public function endDraw()
    {
        if (!$this->isDrawing)
        {
            throw LogicException("Drawing has not been started");
        }

        $this->outstream .= "</draw>";
        $this->isDrawing = false;
    }
}