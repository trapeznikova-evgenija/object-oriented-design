<?php

namespace style;


use common\RGBAColor;
use shapes\GroupShapeInterface;

class GroupOutlineStyle implements OutlineStyleInterface
{
    /** @var GroupShapeInterface */
    private $groupShape;

    public function __construct(GroupShapeInterface $groupShape)
    {
        $this->groupShape = $groupShape;
    }

    public function getColor(): ?RGBAColor
    {
        $color = null;

        if (empty($this->groupShape))
        {
            return $color;
        }

        $colorsArray = [];

        $this->groupShape->enumerateOutlineStyles(function (OutlineStyleInterface $style) use (&$color,  &$colorsArray)
        {
            $color = $style->getColor();
            $colorsArray[] = $color;
        });

        $color = $this->findGroupPropertyIfEquals($colorsArray);

        return $color;
    }

    public function getStrokeWidth(): ?float
    {
        $strokeWidth = null;
        $strokeWidthArray = [];

        $this->groupShape->enumerateOutlineStyles(function (OutlineStyleInterface $style) use (&$strokeWidth, &$strokeWidthArray)
        {
           $strokeWidth = $style->getStrokeWidth();
           $strokeWidthArray[] = $strokeWidth;
        });

        $strokeWidth = $this->findGroupPropertyIfEquals($strokeWidthArray);

        return $strokeWidth;
    }

    public function setColor(RGBAColor $RGBAColor): void
    {
        $this->groupShape->enumerateOutlineStyles(function (OutlineStyleInterface $style) use ($RGBAColor)
        {
            $style->setColor($RGBAColor);
        });
    }

    public function setStrokeWidth(float $width)
    {
        $this->groupShape->enumerateOutlineStyles(function (OutlineStyleInterface $style) use ($width)
        {
            $style->setStrokeWidth($width);
        });
    }

    public function isEnabled(): bool
    {
        $enable = true;
        $enablesArray = [];

        $this->groupShape->enumerateOutlineStyles(function (OutlineStyleInterface $style) use (&$enable, &$enablesArray)
        {
            $enable = $style->isEnabled();
            $enablesArray[] = $enable;
        });

        $enable = $this->findGroupPropertyIfEquals($enablesArray);

        return $enable;
    }

    public function enable(bool $enable)
    {
        $this->groupShape->enumerateOutlineStyles(function (OutlineStyleInterface $style) use (&$enable)
        {
            $enable = $style->enable($enable);
        });
    }

    private function findGroupPropertyIfEquals(array $colorsArray)
    {
        $color = null;

        for ($i = 1; $i < count($colorsArray); $i++)
        {
            if (!($colorsArray[$i] == $colorsArray[$i - 1]))
            {
                return null;
            }
        }

        return $colorsArray[0];
    }
}