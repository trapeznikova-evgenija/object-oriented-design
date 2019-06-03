<?php

namespace App\classes;


use App\classes\common\Point;
use App\classes\common\RGBAColor;
use App\interfaces\CanvasInterface;

class Canvas implements CanvasInterface
{
    /*** @var bool */
    private $fillEnabled;

    /*** @var double */
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

    public function __construct()
    {
        $this->currPoint = new Point(0, 0);

        $fileName = "slide_svg_" . date("H:i:s") . ".txt";
        $this->svgFile = fopen($fileName, 'w');
        $this->writeInFile("<svg>");
    }

    public function setLineColor(RGBAColor $color)
    {
       $this->currOutlineColor = $color;
    }

    public function setLineWidth(double $width)
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
                                           stroke=\"{$this->currOutlineColor}\"
                                           fill=\"{$this->currFillColor}\"
                                           stroke-width=\"1\"
                                     />" . PHP_EOL);
        }

        $this->moveTo($point);
    }

    public function moveTo(Point $point)
    {
        $this->currPoint = $point;

        echo "Move to (" . $point->getX() . ", " . $point->getY() . ")" . PHP_EOL;

        if ($this->fillEnabled)
        {
            $this->polygonPoints[] = $point;
        }
    }

    public function drawEllipse(Point $center, double $horizontalR, double $verticalR)
    {
        $this->writeInFile("<ellipse cx=\"{$center->getX()}\" 
                                          cy=\"{$center->getY()}\"
                                          rx=\"{$horizontalR}\"
                                          ry=\"{$verticalR}\"
                                          stroke=\"{$this->currOutlineColor}\"
                                          fill=\"{$this->currFillColor}\"
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
            $this->writeInFile("\" fill=\"{$this->currFillColor}\" 
                                        stroke=\"{$this->currFillColor}\"
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

    private function writeInFile(string $text)
    {
        $writingResult = fwrite($this->svgFile, $text);

        if (!$writingResult)
        {
            echo "Произошла ошибка при записи в файл." . PHP_EOL;
        }
    }
}