<?php

namespace drawable;


use common\Point;
use common\RGBAColor;

class Canvas implements CanvasInterface
{
    /*** @var bool */
    private $fillEnabled;

    /*** @var float */
    private $lineWidth = 0;

    /** @var Point */
    private $currPoint;

    /** @var RGBAColor */
    private $currFillColor;

    /** @var RGBAColor */
    private $currOutlineColor;

    /** @var Point[] */
    private $polygonPoints = [];

    private $svgFile;

    /** @var float */
    private $canvasWidth = 700;

    /** @var float */
    private $canvasHeight = 700;

    public function __construct()
    {
        $this->currPoint = new Point(0, 0);

        $fileName = "slide_svg_" . date("H:i:s") . ".svg";
        $this->svgFile = fopen($fileName, 'w');
        $this->writeInFile("<svg  width=\"{$this->canvasWidth}\" height=\"{$this->canvasHeight}\">");
    }

    public function setLineColor(RGBAColor $color)
    {
       $this->currOutlineColor = $color;
    }

    public function setLineWidth(float $width)
    {
        $this->lineWidth = $width;
    }

    public function lineTo(Point $point)
    {
        if (!$this->fillEnabled)
        {
            echo "Line to (" . $point->getX() . ", " . $point->getY() . ")" . PHP_EOL;
            $this->writeInFile("<line x1=\"{$this->currPoint->getX()}\"
                                           y1=\"{$this->currPoint->getY()}\"
                                           x2=\"{$point->getX()}\"
                                           y2=\"{$point->getY()}\"
                                           stroke=\"{$this->currOutlineColor->convertColorToString()}\"
                                           fill=\"{$this->currFillColor->convertColorToString()}\"
                                           stroke-width=\"1\"
                                     />" . PHP_EOL);
        }

        $this->moveTo($point);
    }

    public function moveTo(Point $point)
    {
        $this->currPoint = $point;

        if ($this->fillEnabled)
        {
            $this->polygonPoints[] = $point;
        }
    }

    public function drawEllipse(Point $center, float $horizontalR, float $verticalR)
    {
        $this->writeInFile("<ellipse cx=\"{$center->getX()}\" 
                                          cy=\"{$center->getY()}\"
                                          rx=\"{$horizontalR}\"
                                          ry=\"{$verticalR}\"
                                          stroke=\"{$this->currOutlineColor->convertColorToString()}\"
                                          fill=\"{$this->currFillColor->convertColorToString()}\"
                                          stroke-width=\"1\"
                                          />" . PHP_EOL);
    }

    public function fillPolygon()
    {
        if (count($this->polygonPoints) > 1)
        {
            $this->writeInFile("<polyline points=\"");

            $pointsStr = "";
            foreach ($this->polygonPoints as $value)
            {
                $pointsStr .= $value->getX() . ", " . $value->getY() . " ";
            }

            $this->writeInFile($pointsStr);
            $this->writeInFile("\" fill=\"{$this->currFillColor->convertColorToString()}\" 
                                        stroke=\"{$this->currOutlineColor->convertColorToString()}\"
                                        stroke-width=\"{$this->lineWidth}\"
                                        />" . PHP_EOL);
        }
    }

    public function getSvgFile()
    {
        $this->writeInFile("</svg>");
        fclose($this->svgFile);
        return $this->svgFile;
    }

    public function beginFill(RGBAColor $color)
    {
        if ($this->fillEnabled)
        {
            echo "Drawing already begin" . PHP_EOL;
        }

        $this->fillEnabled = true;
        $this->currFillColor = $color;
        $this->polygonPoints = [];
    }

    public function endFill()
    {
        if (!$this->fillEnabled)
        {
            echo "Drawing is already finished" . PHP_EOL;
        }

        $this->fillPolygon();
        $this->polygonPoints = [];
        $this->fillEnabled = false;
    }

    public function setCanvasSize(float $width, float $height)
    {
        $this->canvasWidth = $width;
        $this->canvasHeight = $height;
    }

    private function writeInFile(string $text)
    {
        $writingResult = fwrite($this->svgFile, $text);

        if (!$writingResult)
        {
            echo "Произошла ошибка при записи в файл." . PHP_EOL;
        }
    }
}