<?php

namespace style;


use common\RGBAColor;

class Style implements StyleInterface
{
    /** @var bool */
    private $isEnabled;

    /** @var RGBAColor */
    private $color;

    public function __construct(bool $isEnabled, RGBAColor $color)
    {
        $this->isEnabled = $isEnabled;
        $this->color = $color;
    }

    public function setColor(RGBAColor $RGBAColor): void
    {
        $this->color = $RGBAColor;
    }

    public function getColor(): RGBAColor
    {
        return $this->color;
    }

    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    public function enable(bool $enable)
    {
       $this->isEnabled = $enable;
    }
}