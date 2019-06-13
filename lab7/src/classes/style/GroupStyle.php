<?php

namespace style;

use common\RGBAColor;
use shapes\GroupShapeInterface;

class GroupStyle implements StyleInterface
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

        $this->groupShape->enumerateFillStyles(function (StyleInterface $style) use (&$color, &$colorsArray)
        {
            $color = $style->getColor();
            $colorsArray[] = $color;
        });

        for ($i = 1; $i < count($colorsArray); $i++)
        {
            if (!($colorsArray[$i] == $colorsArray[$i - 1]))
            {
                $color = null;
                break;
            }
        }

        return $color;
    }

    public function setColor(RGBAColor $RGBAColor): void
    {
        $this->groupShape->enumerateFillStyles(function (StyleInterface $style) use ($RGBAColor)
        {
            $style->setColor($RGBAColor);
        });
    }

    public function isEnabled(): bool
    {
        $enable = true;

        $this->groupShape->enumerateFillStyles(function (StyleInterface $style) use (&$enable)
        {
            $enable = $style->isEnabled();
        });

        return $enable;
    }

    public function enable(bool $enable)
    {
        $this->groupShape->enumerateFillStyles(function (StyleInterface $style) use ($enable)
        {
            $style->enable($enable);
        });
    }
}