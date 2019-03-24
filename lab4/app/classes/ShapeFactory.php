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
        $parsedString = $this->getParsedString($description);

        switch ($parsedString[0])
        {
            case self::ELLIPSE :
                return $this->createEllipse($parsedString);

            case self::POLYGON :
                return $this->createPolygon($parsedString);

            case self::RECTANGLE :
                return $this->createRectangle($parsedString);

            case self::TRIANGLE :
                return $this->createTriangle($parsedString);
            default:
                throw new ShapeException("There is no such shape.");
        }
    }

    private function createEllipse($parsedString) : Shape
    {
        if (count($parsedString) != 6)
        {
            throw new ShapeException("Incorrect argument numbers");
        }
        $shapeColor = Color::getColorCode($parsedString[1]);
        $centerPointCoord = new Point($parsedString[2], $parsedString[3]);
        $horizontalRadius = $parsedString[4];
        $verticalRadius = $parsedString[5];

        return new Ellipse($shapeColor, $centerPointCoord, $horizontalRadius, $verticalRadius);
    }

    private function createPolygon($parsedString) : Shape
    {
        $shapeColor = Color::getColorCode($parsedString[1]);
        $vertexCount = $parsedString[2];
        $center = new Point($parsedString[3], $parsedString[4]);
        $raduis = $parsedString[5];

        return new RegularPolygon($shapeColor, $vertexCount, $center, $raduis);
    }

    private function createTriangle($parsedString) : Shape
    {
        $shapeColor = Color::getColorCode($parsedString[1]);
        $vertex1 = new Point($parsedString[2], $parsedString[3]);
        $vertex2 = new Point($parsedString[4], $parsedString[5]);
        $vertex3 = new Point($parsedString[6], $parsedString[7]);

        return new Triangle($shapeColor, $vertex1, $vertex2, $vertex3);
    }

    private function createRectangle($parsedString) : Shape
    {
        $shapeColor = Color::getColorCode($parsedString[1]);
        $leftTop = new Point($parsedString[2], $parsedString[3]);
        $rightBottom = new Point($parsedString[4], $parsedString[5]);

        return new Rectangle($shapeColor, $leftTop, $rightBottom);
    }

    private function getParsedString(string $string)
    {
        return explode(" ", $string);
    }
}