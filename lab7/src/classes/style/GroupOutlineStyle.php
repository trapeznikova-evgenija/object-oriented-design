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
    /** @var EnumeratorInterface */
    private $enumerator;

    public function __construct(EnumeratorInterface $enumerator)
    {
        $this->enumerator = $enumerator;
    }

    public function getColor(): ?RGBAColor
    {
        return getGroupStyleProperty(
            array($this->enumerator, "enumerateStyles"),
            function (OutlineStyleInterface $style) { return $style->getColor(); }
        );
    }

    public function getStrokeWidth(): ?float
    {
       return getGroupStyleProperty(
           function ($callback) {$this->enumerator->enumerateStyles($callback);},
           function (OutlineStyleInterface $style) { return $style->getStrokeWidth(); }
       );
    }

    public function setColor(RGBAColor $RGBAColor): void
    {
        $this->enumerator->enumerateStyles(function (OutlineStyleInterface $style) use ($RGBAColor)
        {
            $style->setColor($RGBAColor);
        });
    }

    public function setStrokeWidth(float $width)
    {
        $this->enumerator->enumerateStyles(function (OutlineStyleInterface $style) use ($width)
        {
            $style->setStrokeWidth($width);
        });
    }

    public function isEnabled(): ?bool
    {
        return getGroupStyleProperty(
            array($this->enumerator, "enumerateStyles"),
            function(OutlineStyleInterface $style) { return $style->isEnabled(); });
    }

    public function enable(bool $enable)
    {
        $this->enumerator->enumerateStyles(function (OutlineStyleInterface $style) use (&$enable)
        {
            $enable = $style->enable($enable);
        });
    }
}