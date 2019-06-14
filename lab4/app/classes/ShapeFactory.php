<?php

namespace App;


use shapeException\ShapeException;

class ShapeFactory implements ShapeFactoryInterface
{
    private const RECTANGLE = "rectangle";
    private const TRIANGLE = "triangle";
    private const ELLIPSE = "ellipse";
    private const POLYGON = "polygon";

    public function createShape(string $description) : Shape
    {
        $parsedArray = $this->getParsedString($description);

        switch ($parsedArray[0])
        {
            case self::ELLIPSE :
                return $this->createEllipse($parsedArray);

            case self::POLYGON :
                return $this->createPolygon($parsedArray);

            case self::RECTANGLE :
                return $this->createRectangle($parsedArray);

            case self::TRIANGLE :
                return $this->createTriangle($parsedArray);
            default:
                throw new ShapeException("There is no such shape.");
        }
    }

    private function createEllipse($parsedArray) : Shape
    {
        if (count($parsedArray) != 6)
        {
            throw new ShapeException("Incorrect argument numbers");
        }

        $shapeColor = Color::getColorCode($parsedArray[1]);
        $centerPointCoord = new Point($parsedArray[2], $parsedArray[3]);
        $horizontalRadius = $parsedArray[4];
        $verticalRadius = $parsedArray[5];

        return new Ellipse($shapeColor, $centerPointCoord, $horizontalRadius, $verticalRadius);
    }

    private function createPolygon($parsedArray) : Shape
    {
        if (count($parsedArray) != 6)
        {
            throw new ShapeException("Incorrect argument numbers");
        }

        $shapeColor = Color::getColorCode($parsedArray[1]);
        $vertexCount = $parsedArray[2];
        $center = new Point($parsedArray[3], $parsedArray[4]);
        $raduis = $parsedArray[5];

        return new RegularPolygon($shapeColor, $vertexCount, $center, $raduis);
    }

    private function createTriangle($parsedArray) : Shape
    {
        if (count($parsedArray) != 8)
        {
            throw new ShapeException("Incorrect argument numbers");
        }

        $shapeColor = Color::getColorCode($parsedArray[1]);
        $vertex1 = new Point($parsedArray[2], $parsedArray[3]);
        $vertex2 = new Point($parsedArray[4], $parsedArray[5]);
        $vertex3 = new Point($parsedArray[6], $parsedArray[7]);

        return new Triangle($shapeColor, $vertex1, $vertex2, $vertex3);
    }

    private function createRectangle($parsedArray) : Shape
    {
        if (count($parsedArray) != 6)
        {
            throw new ShapeException("Incorrect argument numbers");
        }

        $shapeColor = Color::getColorCode($parsedArray[1]);
        $leftTop = new Point($parsedArray[2], $parsedArray[3]);
        $rightBottom = new Point($parsedArray[4], $parsedArray[5]);

        return new Rectangle($shapeColor, $leftTop, $rightBottom);
    }

    private function getParsedString(string $string)
    {
        $parsingArray = explode(" ", $string);
        $resultArray = [];

        for ($i = 0; $i < count($parsingArray); $i++)
        {
            if ($i != 0 && $i != 1)
            {
                $resultArray[$i] = (float) $parsingArray[$i];
            }
            else
            {
                $resultArray[$i] = $parsingArray[$i];
            }
        }

        return $resultArray;
    }
}