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

        for ($i = 0; $i < count($colorsArray); $i++)
        {
            if (!($colorsArray[$i] == $colorsArray[$i + 1]))
            {
                $color = null;
                break;
            }
        }

        return $color;
    }

    public function getStrokeWidth(): float
    {
        $strokeWidth = null;

        $this->groupShape->enumerateOutlineStyles(function (OutlineStyleInterface $style) use (&$strokeWidth)
        {
           $strokeWidth = $style->getStrokeWidth();
        });

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

        $this->groupShape->enumerateOutlineStyles(function (OutlineStyleInterface $style) use (&$enable)
        {
            $enable = $style->isEnabled();
        });

        return $enable;
    }

    public function enable(bool $enable)
    {
        $this->groupShape->enumerateOutlineStyles(function (OutlineStyleInterface $style) use (&$enable)
        {
            $enable = $style->enable($enable);
        });
    }
}