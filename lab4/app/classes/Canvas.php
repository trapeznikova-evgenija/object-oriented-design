<?php

namespace App;


class Canvas implements CanvasInterface
{
    private $color;

    private $svgFile;

    public function __construct()
    {
        $fileName = "shapes_svg_" . date("H:i:s") . ".svg";
        $this->svgFile = fopen($fileName, 'w');
        $this->writeInFile("<svg  width=\"800\" height=\"800\">");
    }

    public function setColor(string $color)
    {
        $this->color = $color;
    }

    public function drawEllipse(Point $center, float $hR, float $vR)
    {
        $this->writeInFile("<ellipse cx=\"{$center->getXCoord()}\" cy=\"{$center->getYCoord()}\" rx=\"{$hR}\" ry=\"{$vR}\" fill=\"{$this->color}\"/>");
    }

    public function drawLine(Point $from, Point $to)
    {
        $this->writeInFile("<line stroke=\"{$this->color}\" x1=\"{$from->getXCoord()}\" y1=\"{$from->getYCoord()}\" x2=\"{$to->getXCoord()}\" y2=\"{$to->getYCoord()}\" stroke-width='3' />");
    }

    public function getSvgFile()
    {
        $this->writeInFile("</svg>");
        fclose($this->svgFile);
        return $this->svgFile;
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