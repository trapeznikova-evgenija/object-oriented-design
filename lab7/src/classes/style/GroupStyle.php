<?php

namespace style;

use common\RGBAColor;
use shapes\GroupShapeInterface;

class GroupStyle implements StyleInterface
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
            function (StyleInterface $style) { return $style->getColor(); }
        );
    }

    public function setColor(RGBAColor $RGBAColor): void
    {
        $this->enumerator->enumerateStyles(function (StyleInterface $style) use ($RGBAColor)
        {
            $style->setColor($RGBAColor);
        });
    }

    public function isEnabled(): bool
    {
        return getGroupStyleProperty(
            array($this->enumerator, "enumerateStyles"),
            function(StyleInterface $style){ return $style->isEnabled(); });
    }

    public function enable(bool $enable)
    {
        $this->enumerator->enumerateStyles(function (StyleInterface $style) use ($enable)
        {
            $style->enable($enable);
        });
    }
}