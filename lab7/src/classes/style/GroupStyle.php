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
        return getGroupStyleProperty(
            array($this->groupShape, "enumerateOutlineStyles"),
            function (StyleInterface $style) { return $style->getColor(); }
        );
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
        return getGroupStyleProperty(
            $this->groupShape->enumerateOutlineStyles,
            function(StyleInterface $style){ return $style->isEnabled(); });
    }

    public function enable(bool $enable)
    {
        $this->groupShape->enumerateFillStyles(function (StyleInterface $style) use ($enable)
        {
            $style->enable($enable);
        });
    }
}