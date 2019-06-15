<?php

namespace style;

use common\RGBAColor;
use shapes\GroupShapeInterface;

function getGroupStyleProperty(callable $enumerator, callable $propertyGetter)
{
    $value = null;
    $isFirstValue = true;
    call_user_func($enumerator, function($style) use (&$value, &$isFirstValue, $propertyGetter)
    {
       $currentValue = $propertyGetter($style);

       if ($isFirstValue)
       {
           $value = $currentValue;
           $isFirstValue = false;
       }
       else if ($currentValue !== $value)
       {
           $value = null;
       }
    });
    return $value;
}

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
        return getGroupStyleProperty(
            array($this->groupShape, "enumerateOutlineStyles"),
            function (OutlineStyleInterface $style) { return $style->getColor(); }
        );
    }

    public function getStrokeWidth(): ?float
    {
       return getGroupStyleProperty(
           function ($callback) {$this->groupShape->enumerateOutlineStyles($callback);},
           function (OutlineStyleInterface $style) { return $style->getStrokeWidth(); }
       );
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

    public function isEnabled(): ?bool
    {
        return getGroupStyleProperty(
            array($this->groupShape, "enumerateOutlineStyles"),
            function(OutlineStyleInterface $style) { return $style->isEnabled(); });
    }

    public function enable(bool $enable)
    {
        $this->groupShape->enumerateOutlineStyles(function (OutlineStyleInterface $style) use (&$enable)
        {
            $enable = $style->enable($enable);
        });
    }
}