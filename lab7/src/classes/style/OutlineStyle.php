<?php

namespace style;

use common\RGBAColor;

class OutlineStyle extends Style implements OutlineStyleInterface
{
    /** @var float */
    private $strokeWidth;

    public function __construct(float $strokeWidth, RGBAColor $color, bool $isEnabled)
    {
        $this->strokeWidth = $strokeWidth;

        parent::__construct($isEnabled, $color);
    }

    public function setStrokeWidth(float $width)
    {
        $this->strokeWidth = $width;
    }

    public function getStrokeWidth(): float
    {
        return $this->strokeWidth;
    }

    public function setColor(RGBAColor $RGBAColor): void
    {
       parent::setColor($RGBAColor);
    }

    public function enable(bool $enable)
    {
        parent::enable($enable);
    }

    public function isEnabled(): bool
    {
        return parent::isEnabled();
    }

    public function getColor(): RGBAColor
    {
        return parent::getColor();
    }
}